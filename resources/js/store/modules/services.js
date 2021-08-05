const state = {
    services: [],
};

const getters = {
    getServices(state){
        return state.services;
    },
};

const actions = {
    fetchStoreServices({commit, state}, data){
        axios.post('/api/store-services', {
            servicesTitle: data.servicesTitle,
            servicesDescription: data.servicesDescription,
            servicesImage: data.servicesImage,
        })
        .then(function (response) {
            commit('setServiceInfo', response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },



    deleteServiceImage({commit, state}, data){
        axios.post('/api/delete-service-image', {
            image: data.image,

        })
        .then(function (response) {
            commit('setBannerInfo', response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },


    fetchGetServices({commit, state}, data){
        axios.post('/api/get-services')
        .then(function (response) {
            commit('setServices', response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },


    searchKeywords({commit, state}, data){
        axios.post('/api/service-search', {
                        keywords: data.keywords,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setServices', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchUpdateService({commit, state}, data){
        axios.post('/api/service-edit', {
                        serviceEditId: data.serviceEditId,
                        servicesTitleEdit: data.servicesTitleEdit,
                        servicesDescriptionEdit: data.servicesDescriptionEdit,
                        servicesImage: data.servicesImage,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('updateService', {
                            service: response.data,
                            serviceKey: data.serviceKeyUpdate,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    // delete service starts
    fetchDeleteService({commit, state}, data){
        axios.post('/api/service-delete', {
                        service_id: data.service_id,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setDeleteService', {
                            serviceKey: data.serviceKey,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    }
    // delete service emds
};

const mutations = {
    setServiceInfo(state, data){

    },


    setServices(state, data){
        state.services = data;
    },


    updateService(state, data){
        state.services.data[data.serviceKey].data.attributes.service_title = data.service.data.attributes.service_title;
        state.services.data[data.serviceKey].data.attributes.service_description = data.service.data.attributes.service_description;
        state.services.data[data.serviceKey].data.attributes.service_image.data.attributes.image_name = data.service.data.attributes.service_image.data.attributes.image_name;
        state.services.data[data.serviceKey].data.attributes.service_image.data.attributes.path = data.service.data.attributes.service_image.data.attributes.path;

        //state.posts.data[data.postKey].data.attributes.comments = data.comments;
    },


    setDeleteService(state, data){
        state.services.data.splice(data.serviceKey, 1);
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};
