<template>
    <div>
        <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu" style = "overflow: scroll;">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            <img :src="authUser.data.attributes.user_image.data.attributes.path" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                        </div>
                        <h5><a href="#">{{ authUser.data.attributes.name }}</a></h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" >
                                    <i class="mdi mdi-settings"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="#" class="text-custom">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul >
                        	<li class="text-muted menu-title">Navigation</li>
                            <li>
                                <a href = "/" class="waves-effect" target = "blank"><i class="mdi mdi-view-dashboard"></i> <span> Visit Site </span> </a>
                            </li>

                            <li>
                                <router-link to = "/auth" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </router-link>
                            </li>

                            <li>
                                <router-link to = "/auth/user" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> User Information </span> </router-link>
                            </li>

                            <li>
                                <router-link to = "/auth/top" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Top Part </span> </router-link>
                            </li>

                            <li>
                                <router-link to = "/auth/about" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> About </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/skill" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Skill </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/Services" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Services </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/image" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Images </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/video" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Videos </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/testimonial" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Testimonial </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/contact" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Messages </span> </router-link>
                            </li>
                            <li>
                                <router-link to = "/auth/footer" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Footer Part </span> </router-link>
                            </li>


                            <li>
                                <a @click = "AuthLogOut" class="waves-effect"><i class="mdi mdi-logout"></i>Log Out</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

export default {

    data:() => {
        return {

        }
    },

    mounted(){

    },



    methods: {
        AuthLogOut(){
            this.$store.dispatch('fetchAuthLogout');
        }
    },





    computed: {
        ...mapGetters({
                authUser: 'authUser',
                // getWindowWidth: 'getWindowWidth',
            })
    },
}
</script>
<style scoped>

</style>
