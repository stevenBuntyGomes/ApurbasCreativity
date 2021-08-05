import { data } from "jquery";

const state = {
    types: [],
};

const getters = {
    getTyped(state){
        return state.types;
    }
};

const actions = {
    fetchTyped({commit, state}, data){
        axios.post('/api/get-typed')
            .then(function (response) {
                commit('setTypedInfo', response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    },


    fetchAddTyped({commit, state}, data){
        axios.post('/api/store-typed', {
            typed_name: data.typed_name,
        })
            .then(function (response) {
                commit('addTypedInfo', response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    fetchEditTyped({commit, state}, data){
        axios.post('/api/edit-typed', {
            typed_name: data.typed_name,
            typed_id: data.typed_id,
        })
            .then(function (response) {
                commit('editTypedInfo', {
                    typed: response.data,
                    typed_key: data.typed_key,
                });
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    fetchDeleteTyped({commit, state}, data){
        axios.post('/api/delete-typed', {
            typed_id: data.typed_id,

        })
            .then(function (response) {
                commit('deleteTypedInfo', {
                    typed_key: data.typed_key,
                });
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};

const mutations = {
    setTypedInfo(state, data){
        state.types = data;
    },

    addTypedInfo(state, data){
        state.types.data.unshift(data);
    },

    editTypedInfo(state, data){
        state.types.data[data.typed_key].data.attributes.typed_name = data.typed.data.attributes.typed_name;
    },

    deleteTypedInfo(state, data){
        state.types.data.splice(data.typed_key, 1);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
}
