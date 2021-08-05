<template>
    <div>
        <Navbar></Navbar>
        <LeftSideBar></LeftSideBar>
        <ContentPage></ContentPage>
        <RightSlideBar></RightSlideBar>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

import Navbar from './backend/nav.vue'
import LeftSideBar from './backend/leftSidebar.vue'
import ContentPage from './backend/contentPage.vue'
import RightSlideBar from './backend/rightSlidebar.vue'

export default {

    data:() => {
        return {

        }
    },


    mounted(){
        this.$store.dispatch('fetchAuthUser');
    },

    components: {
        Navbar,
        LeftSideBar,
        ContentPage,
        RightSlideBar,
    },

    computed: {
        ...mapGetters({
                authUser: 'authUser',
                // getWindowWidth: 'getWindowWidth',
            })
    },


    watch: {
            $route(to, from) {
                this.$store.dispatch('setPageTitle', to.meta.title);

            },


        },
}
</script>
<style scoped>

</style>
