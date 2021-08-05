<template>
    <div>
        <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <router-view :key = "$route.fullPath"></router-view>
                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    2016 - 2018 © Adminto. Coderthemes.com
                </footer>

            </div>

        <!-- ============================================================== -->
        <!-- end right Content here -->
        <!-- ============================================================== -->
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    mounted(){
        this.$store.dispatch('fetchAuthUser');
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
