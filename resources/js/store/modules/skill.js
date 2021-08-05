const state = {
    skills: [],
};

const getters = {
    getSkills(state){
        return state.skills;
    }
};

const actions = {
    fetchSkills({commit, state}, data){
        axios.post('/api/get-skills')
        .then(function (response) {
            commit('setSkills', response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    fetchUpdateSkill({commit, state}, data){
        axios.post('/api/update-skills', {
                skill_header: data.skill_header,
                language_header: data.language_header,
                first_skill: data.first_skill,
                first_skill_percent: data.first_skill_percent,
                second_skill: data.second_skill,
                second_skill_percent: data.second_skill_percent,
                third_skill: data.third_skill,
                third_skill_percent: data.third_skill_percent,
                first_language: data.first_language,
                first_language_percent: data.first_language_percent,
                second_language: data.second_language,
                second_language_percent: data.second_language_percent,
                third_language: data.third_language,
                third_language_percent: data.third_language_percent,
        })
        .then(function (response) {
            commit('setSkills', response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
};

const mutations = {
    setSkills(state, data){
        state.skills = data;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
