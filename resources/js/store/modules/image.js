const state = {
    imageCategory: [],
    images: [],
};

const getters = {
    getImageCategory(state){
        return state.imageCategory;
    },


    getPortfolioImages(state){
        return state.images;
    }
};

const actions = {
    fetchAddCategory({commit, state}, data){
        axios.post('/api/add-image-category', {
                        categoryName: data.categoryName,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setImageCategory', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchGetImageCategories({commit, state}, data){
        axios.post('/api/get-image-category')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setImageCategoryCollection', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchEditImageCategory({commit, state}, data){
        axios.post('/api/edit-image-category', {
            category_id: data.category_id,
            category_name: data.category_name,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('updateImageCategoryCollection', {
                            image_category: response.data,
                            category_key: data.category_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchDelImageCategory({commit, state}, data){
        axios.post('/api/delete-image-category', {
            category_id: data.category_id,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('deleteImageCategoryCollection', {
                            image_category: response.data,
                            category_key: data.category_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    searchImageCategory({commit, state}, data){
        axios.post('/api/image-category-search', {
                        keywords: data.keywords,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setImageCategoryCollection', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    // portfolio image part starts
    deletePortfolioImage({commit, state}, data){
        axios.post('/api/delete-portfolio-image', {
                        image: data.image,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        // commit('setImageCategoryCollection', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    addImageToDB({commit, state}, data){
        axios.post('/api/add-portfolio-image-db', {
                        image_name: data.image_name,
                        image_category_id: data.image_category_id,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setNewImage', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchGetImage({commit, state}, data){
        axios.post('/api/get-portfolio-image')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setImages', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    fetchEditImagetoDb({commit, state}, data){
        axios.post('/api/edit-portfolio-image', {
            image_edit_id: data.image_edit_id,
            image_name: data.image_name,
            category_id: data.category_id,
            // imageEditKey: data.imageEditKey,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setEditImages', {
                            image: response.data,
                            imageEditKey: data.imageEditKey,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchDeletePortfolioImage({commit, state}, data){
        axios.post('/api/delete-portfolio-image-db', {
            image_id: data.image_id,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('deleteImgeDB', {
                            imageKey: data.imageKey,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    searchImageKeywords({commit, state}, data){
        axios.post('/api/portfolio-image-search', {
                        keywords: data.keywords,

                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setImages', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    }
    // portfolio image part ends
};

const mutations = {
    setImageCategory(state, data){
        state.imageCategory.data.unshift(data);
    },

    setImageCategoryCollection(state, data){
        state.imageCategory = data;
    },

    updateImageCategoryCollection(state, data){
        state.imageCategory.data[data.category_key].data.attributes.category_name = data.image_category.data.attributes.category_name;
    },

    deleteImageCategoryCollection(state, data){
        state.imageCategory.data.splice(data.category_key, 1);
    },

    // image part starts
    setImages(state, data){
        state.images = data;
    },

    setNewImage(state, data){
        state.images.data.unshift(data);
    },


    setEditImages(state, data){
        state.images.data[data.imageEditKey].data.attributes.image_name.data.attributes.image_name = data.image.data.attributes.image_name.data.attributes.image_name;
        state.images.data[data.imageEditKey].data.attributes.image_name.data.attributes.path = data.image.data.attributes.image_name.data.attributes.path;
        state.images.data[data.imageEditKey].data.attributes.image_category.data.image_category_id = data.image.data.attributes.image_category.data.image_category_id;
        state.images.data[data.imageEditKey].data.attributes.image_category.data.attributes.category_name = data.image.data.attributes.image_category.data.attributes.category_name;
    },

    deleteImgeDB(state, data){
        state.images.data.splice(data.imageKey, 1);
    }
    // image part ends


};


export default {
    state,
    getters,
    actions,
    mutations,
};
