import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import user from './components/backend/content/user.vue'
import topPart from './components/backend/content/topPart.vue'
import Logo from './components/backend/content/updateLogo.vue'
import About from './components/backend/content/about.vue'
import Services from './components/backend/content/services.vue'
import Image from './components/backend/content/image.vue'
import ImageCategory from './components/backend/content/ImageCategory.vue'
import Video from './components/backend/content/video.vue'
import VideoPlaylist from './components/backend/content/videoPlaylist.vue'
import Testimonial from './components/backend/content/testimonial.vue'
import Footer from './components/backend/content/footer.vue'
import Skill from './components/backend/content/skill.vue'
import Typed from './components/backend/content/typed.vue'
import Contact from './components/backend/content/contact.vue'


const routes = [
        {
            path: '/auth/user',
            component: user,
            name: 'userinfo',
            meta: { title: 'userInfo'},
        },
        {
            path: '/auth/top',
            component: topPart,
            name: 'topPart',
            meta: { title: 'topPart'},
        },
        {
            path: '/auth/logo',
            component: Logo,
            name: 'Logo',
            meta: { title: 'Logo'},
        },
        {
            path: '/auth/about',
            component: About,
            name: 'About',
            meta: { title: 'About'},
        },
        {
            path: '/auth/Services',
            component: Services,
            name: 'Services',
            meta: { title: 'Services'},
        },
        {
            path: '/auth/image',
            component: Image,
            name: 'Image',
            meta: { title: 'Image'},
        },
        {
            path: '/auth/image-category',
            component: ImageCategory,
            name: 'ImageCategory',
            meta: { title: 'Image Category'},
        },
        {
            path: '/auth/video',
            component: Video,
            name: 'Video',
            meta: { title: 'Video'},
        },
        {
            path: '/auth/video-playlist',
            component: VideoPlaylist,
            name: 'VideoPlaylist',
            meta: { title: 'VideoPlaylist'},
        },
        {
            path: '/auth/testimonial',
            component: Testimonial,
            name: 'Testimonial',
            meta: { title: 'Testimonial'},
        },
        {
            path: '/auth/footer',
            component: Footer,
            name: 'Footer',
            meta: { title: 'Footer'},
        },
        {
            path: '/auth/skill',
            component: Skill,
            name: 'Skill',
            meta: { title: 'Skill'},
        },
        {
            path: '/auth/typed',
            component: Typed,
            name: 'Typed',
            meta: { title: 'Typed'},
        },
        {
            path: '/auth/contact',
            component: Contact,
            name: 'Contact',
            meta: { title: 'Contact'},
        },
];

export default new VueRouter({
    mode: 'history',
    routes,
})
