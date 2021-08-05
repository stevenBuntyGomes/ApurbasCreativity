const state = {
    footer: [],
    socialFooter: [],
};

const getters = {
    getFooter(state){
        return state.footer;
    },


    getSocialFooter(state){
        return state.socialFooter;
    },
};

const actions = {
    fetchFootertext({commit, state}, data){
        axios.post('/api/get-footer-text')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setFooterText', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    updateFooterText({commit, state}, data){
        axios.post('/api/update-footer-text', {
                site_name: data.site_name,
                site_note: data.site_note,
                site_address: data.site_address,
                site_city: data.site_city,
                site_email: data.site_email,
                site_contact: data.site_contact,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setFooterText', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },



    // footer social starts

    deleteSocialImage({commit, state}, data){
        axios.post('/api/delete-social-image', {
                image: data.image,
                // playlist_key: data.playlist_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        // commit('setVideoPlaylist', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchStoreSocialDB({commit, state}, data){
        axios.post('/api/social-image-db', {
                social_name: data.social_name,
                social_link: data.social_link,
                image_name: data.image_name,
                // playlist_key: data.playlist_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setSocialFooter', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchFooterSocial({commit, state}, data){
        axios.post('/api/get-social-db')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setAllSocialFooter', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchDeleteSocialIcon({commit, state}, data){
        axios.post('/api/delete-footer-social', {
            social_id: data.social_id,
            // social_key: data.social_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setDeleteSocialFooter', {
                            social_id: data.social_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchSearchSocial({commit, state}, data){
        axios.post('/api/search-footer-social', {
            keywords: data.keywords,
            // social_key: data.social_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setAllSocialFooter', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    }
    // footer social ends
};

const mutations = {
    setFooterText(state, data){
        state.footer = data;
    },


    setSocialFooter(state, data){
        state.socialFooter.data.unshift(data);
    },


    setAllSocialFooter(state, data){
        state.socialFooter = data;
    },

    setDeleteSocialFooter(state, data){
        state.socialFooter.data.splice(data.social_id, 1);
    },


};


export default {
    state,
    getters,
    actions,
    mutations,
}
