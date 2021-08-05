const state = {
    contacts: [],
};

const getters = {
    getContacts(state){
        return state.contacts;
    }
};

const actions = {
    fetchContacts({commit, state}, data){
        axios.post('/api/get-contact')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setContacts', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    deleteContact({commit, state}, data){
        axios.post('/api/delete-contact', {
            contact_id: data.contact_id,

        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setDelContact', {
                            contact_key: data.contact_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },



};

const mutations = {
    setContacts(state, data){
        state.contacts = data;
    },

    setDelContact(state, data){
        state.contacts.data.splice(data.contact_key, 1);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
}
