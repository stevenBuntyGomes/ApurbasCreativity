const state = {
    bannerInfo: null,
};


const getters = {
    getterBannerInfo(state){
        return state.bannerInfo;
    }
};


const actions = {
    fetchBannerInformation({commit, state}, data){
        axios.post('/api/store-change/banner-info', {
            banner_id: data.banner_id,
            banner_info_one: data.banner_info_one,
            banner_info_two: data.banner_info_two,
            banner_info_three: data.banner_info_three,
        })
        .then(function (response) {
            commit('setBannerInfo', response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },


    fetchGetBannerInformation({commit, state}, data){
        axios.post('/api/get-banner')
            .then(function (response) {
                // handle success
                commit('setBannerInfo', response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
    },


    delBannerImage({commit, state}, data){
        axios.post('/api/banner/remove-image')
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
    setBannerInfo(state, data){
        state.bannerInfo = data;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
