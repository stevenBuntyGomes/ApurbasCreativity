import { data } from "jquery";

const state = {
    testimonial: [],
};

const getters = {
    getTestimonial(state){
        return state.testimonial;
    }
};

const actions = {
    fetchGetTestimonial({commit, state}, data){
        axios.post('/api/get-testi-monial')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setTestimonials', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },
    deleteTestiImage({commit, state}, data){
        axios.post('/api/testi-image-delete', {
                        image: data.image,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        // commit('setDeleteService', {
                        //     serviceKey: data.serviceKey,
                        // });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchStoreTestimonial({commit, state}, data){
        axios.post('/api/add-testi-db', {
                        testi_name: data.testi_name,
                        testi_position: data.testi_position,
                        testi_description: data.testi_description,
                        image_name: data.image_name,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setNewTestimonial', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    editTestiDB({commit, state}, data){
        axios.post('/api/edit-testi-db', {
                    testi_name: data.testi_name,
                    testi_position: data.testi_position,
                    testi_description: data.testi_description,
                    image_name: data.image_name,
                    testi_id: data.testi_id,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setEditTestimonial', {
                            testi: response.data,
                            testi_key: data.testi_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchDeleteTestiDB({commit, state}, data){
        axios.post('/api/delete-testi-db', {
                    testi_id: data.testi_id,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setDelTestimonial', {
                            testi: response.data,
                            testi_key: data.testi_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    searchTestiKeywords({commit, state}, data){
axios.post('/api/search-testi-db', {
                    keywords: data.keywords,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setTestimonials', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },
};

const mutations = {
    setNewTestimonial(state, data){
        state.testimonial.data.unshift(data);
    },

    setTestimonials(state, data){
        state.testimonial = data;
    },


    setEditTestimonial(state, data){
        state.testimonial.data[data.testi_key].data.attributes.testi_name = data.testi.data.attributes.testi_name;
        state.testimonial.data[data.testi_key].data.attributes.testi_position = data.testi.data.attributes.testi_position;
        state.testimonial.data[data.testi_key].data.attributes.testi_description = data.testi.data.attributes.testi_description;
        state.testimonial.data[data.testi_key].data.attributes.testi_description = data.testi.data.attributes.testi_description;
        state.testimonial.data[data.testi_key].data.attributes.image_name.data.attributes.image_name = data.testi.data.attributes.image_name.data.attributes.image_name;
        state.testimonial.data[data.testi_key].data.attributes.image_name.data.attributes.path = data.testi.data.attributes.image_name.data.attributes.path;
    },


    setDelTestimonial(state, data){
        state.testimonial.data.splice(data.testi_key, 1);
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
