import Vue from 'vue'
import Vuex from 'vuex'
import User from './modules/user.js'
import Top from './modules/top.js'
import title from './modules/title.js'
import about from './modules/about.js'
import services from './modules/services.js'
import Image from './modules/image.js'
import Video from './modules/video.js'
import Testimonial from './modules/testimonial.js'
import Footer from './modules/footer.js'
import Skill from './modules/skill.js'
import Typed from './modules/typed.js'
import Contact from './modules/contact.js'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        User,
        Top,
        title,
        about,
        services,
        Image,
        Video,
        Testimonial,
        Footer,
        Skill,
        Typed,
        Contact,
    }
});
