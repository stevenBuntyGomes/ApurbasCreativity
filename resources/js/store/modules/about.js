const state = {
    aboutInfo: null,
};

const getters = {
    getAboutInfo(state){
        return state.aboutInfo;
    }
};

const actions = {
    getAboutInformation({commit, state}, data){
        axios.post('/api/get-about')
            .then(function (response) {
                // handle success
                commit('setAboutInfo', response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
    },


    changeAboutInformation({commit, state}, data){
        axios.post('/api/change-about-info', {
            about_header: data.about_header,
            about_title: data.about_title,
            about_title_two: data.about_title_two,
            about_description: data.about_description,
            about_button: data.about_button,
        })
            .then(function (response) {
                // handle success
                commit('setAboutInfo', response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
    },


    delAboutImage({commit, state}, data){
        axios.post('/api/about/remove-image')
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
    setAboutInfo(state, data){
        state.aboutInfo = data;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
}
