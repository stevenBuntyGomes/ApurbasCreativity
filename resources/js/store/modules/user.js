const state = {
    user: null,
    changeStatus: 0,
    userLogo: null,
};


const getters = {
    authUser(state){
        return state.user;
    },


    getChangeStatus(state){
        return state.changeStatus;
    },


    // get logo starts
    getLogo(state){
        return state.userLogo;
    }
    // get logo ends
};

const actions = {

    fetchAuthUser({commit, state}, data){
        axios.get('/api/getAuthUser')
            .then(function (response){
                // self.user = response.data;
                // window.location.reload();
                commit('setAuthUser', response.data);
            })
            .catch(function (error){
                // console.log('unable to fetch auth user')
            })
    },


    // update userName and email starts

    fetchUpdateUserName({commit, state}, data){
        axios.post('/api/auth-user/nameUpdate', {
            'updateUserName': data.changeAuthName,
            'updateUserEmail': data.changeAuthEmil,
        })
            .then(function (response) {
                // commit('setUserFriendship', null);
                commit('setAuthUser', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },

    // update userName and email ends


    // update userPassword starts

    fetchUpdatePassword({commit, state}, data){
        axios.post('/api/auth-user/passwordUpdate', {
            'oldPassword': data.oldPassword,
            'password': data.password,
            'confirmPassword': data.confirmPassword,
        })
            .then(function (response) {
                // commit('setUserFriendship', null);
                commit('passChangeStatus', response);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },


    // update userPassword ends

    fetchAuthLogout(){
        axios.post('/logout')
            .then(function (response){
                // self.user = response.data;
                window.location.reload();
            })
            .catch(function (error){
                // console.log('unable to fetch auth user')
            })
    },


    // delete User Image start
    delUserImage({commit, state}, data){
        axios.post('/api/profile/remove-image', {
            'imageName': data.imageName,
        })
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                // commit('deImage', response.data);
            })
            .catch(function (error) {

            });
    },

    // delete User Image ends
    // logo part starts

    FetchGetUserLogo({commit, state}, data){
        axios.post('/api/user/get-logo')
            .then(function (response) {
                commit('setUserLogo', response.data);
            })
            .catch(function (error) {

            });
    },

    delLogoImage({commit, state}, data){
        axios.post('/api/logo/remove-image')
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                // commit('deImage', response.data);
            })
            .catch(function (error) {

            });
    }

};


const mutations = {
    setAuthUser(state, data){
        if(data == 1){
            return;
        }else{
            state.user = data;
        }
    },


    passChangeStatus(state, data){
        state.changeStatus = data;
    },

    // set userLogo start
    setUserLogo(state, data){
        state.userLogo = data;
    },
    // set userLogo end
};


export default {
    state,
    getters,
    actions,
    mutations,
}
