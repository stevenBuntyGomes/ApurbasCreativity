<template>
    <div>
        <div class="row mt-5">
            <div class="col-md-8 col-lg-8">

                                <!-- Simple card -->
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Change Skill Information</h4>
                                        <div class="form-group">
                                            <label for="userName">skill header</label>
                                            <input type="text" name="User Name"
                                                   placeholder="skill_header" class="form-control" v-model = "skill_header">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">first skill</label>
                                            <input type="text"
                                                   placeholder="first_skill" class="form-control" v-model = "first_skill">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">first skill percent</label>
                                            <input type="text"
                                                   placeholder="first_skill_percent" class="form-control" v-model = "first_skill_percent">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">second skill</label>
                                            <input type="text"
                                                   placeholder="second_skill" class="form-control" v-model = "second_skill">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">second skill percent</label>
                                            <input type="text"
                                                   placeholder="second_skill_percent" class="form-control" v-model = "second_skill_percent">
                                        </div>

                                        <div class="form-group">
                                            <label for="emailAddress">third skill </label>
                                            <input type="text"
                                                   placeholder="third_skill" class="form-control" v-model = "third_skill">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">third skill percentage</label>
                                            <input type="text"
                                                   placeholder="third_skill_percent" class="form-control" v-model = "third_skill_percent">
                                        </div>
                                        <h4 class="card-title">Change Language Information</h4>
                                        <div class="form-group">
                                            <label for="emailAddress">language header</label>
                                            <input type="text"
                                                   placeholder="language_header" class="form-control" v-model = "language_header">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">first language</label>
                                            <input type="text"
                                                   placeholder="first_language" class="form-control" v-model = "first_language">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">first language percent</label>
                                            <input type="text"
                                                   placeholder="first_language_percent" class="form-control" v-model = "first_language_percent">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">second language</label>
                                            <input type="text"
                                                   placeholder="second_language" class="form-control" v-model = "second_language">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">second language percent</label>
                                            <input type="text"
                                                   placeholder="second_language_percent" class="form-control" v-model = "second_language_percent">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">third language</label>
                                            <input type="text"
                                                   placeholder="third_language" class="form-control" v-model = "third_language">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">third language percent</label>
                                            <input type="text"
                                                   placeholder="third_language_percent" class="form-control" v-model = "third_language_percent">
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <Button class="btn btn-primary waves-effect waves-light" @click = "changeSkillInfo">
                                                Submit
                                            </Button>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end col -->
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    data:()=> {
        return {
            skill_header: '',
            language_header: '',
            first_skill: '',
            first_skill_percent: '',
            second_skill: '',
            second_skill_percent: '',
            third_skill: '',
            third_skill_percent: '',
            first_language: '',
            first_language_percent: '',
            second_language: '',
            second_language_percent: '',
            third_language: '',
            third_language_percent: '',
        }
    },

    mounted(){
        this.$store.dispatch('fetchSkills');
        this.skill_header = this.getSkills.data.attributes.skill_header;
        this.language_header = this.getSkills.data.attributes.language_header;
        this.first_skill = this.getSkills.data.attributes.first_skill;
        this.first_skill_percent = this.getSkills.data.attributes.first_skill_percent;
        this.second_skill = this.getSkills.data.attributes.second_skill;
        this.second_skill_percent = this.getSkills.data.attributes.second_skill_percent;
        this.third_skill = this.getSkills.data.attributes.third_skill;
        this.third_skill_percent = this.getSkills.data.attributes.third_skill_percent;
        this.first_language = this.getSkills.data.attributes.first_language;
        this.first_language_percent = this.getSkills.data.attributes.first_language_percent;
        this.second_language = this.getSkills.data.attributes.second_language;
        this.second_language_percent = this.getSkills.data.attributes.second_language_percent;
        this.third_language = this.getSkills.data.attributes.third_language;
        this.third_language_percent = this.getSkills.data.attributes.third_language_percent;
    },

    methods:{
        changeSkillInfo(){
            this.$store.dispatch('fetchUpdateSkill', {
                skill_header: this.skill_header,
                language_header: this.language_header,
                first_skill: this.first_skill,
                first_skill_percent: this.first_skill_percent,
                second_skill: this.second_skill,
                second_skill_percent: this.second_skill_percent,
                third_skill: this.third_skill,
                third_skill_percent: this.third_skill_percent,
                first_language: this.first_language,
                first_language_percent: this.first_language_percent,
                second_language: this.second_language,
                second_language_percent: this.second_language_percent,
                third_language: this.third_language,
                third_language_percent: this.third_language_percent,
            });
        }
    },

    computed: {
        ...mapGetters({
            getSkills: 'getSkills',
        })
    },
}
</script>
<style scoped>

</style>
