<template>
    <div>
        <div class="row mt-5">
            <!-- <Button @click = "addFooterModal=true">
                Add Footer
            </Button> -->

            <div class="col-md-6 col-lg-6">

                                <!-- Simple card -->
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg Footer Texts</h4>
                                        <div class="form-group">
                                            <label for="userName">Site Name*</label>
                                            <input type="text" name="User Name"
                                                   placeholder="User Name" class="form-control" v-model = "site_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Site Note*</label>
                                            <input type="text" name="text"
                                                   placeholder="Enter email" class="form-control" v-model = "site_note">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Site Address*</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "site_address">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Site City*</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "site_city">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Site Email*</label>
                                            <input type="email" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "site_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Site Contact Number*</label>
                                            <input type="email" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "site_contact">
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <Button class="btn btn-primary waves-effect waves-light" @click = "updateFooterText">
                                                Submit
                                            </Button>
                                        </div>

                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <div class="row mt-5 mb-5">
            <Button @click = "addFooterSocial=true">
                Add Footer Social
            </Button>


            <!-- add Footer model starts -->
            <Modal
                            v-model="addFooterSocial"
                            title="Add Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Choose Image Category</label>

                            <input class="form-control" type="text" v-model="social_name" placeholder = "Social Name"><br>
                            <input class="form-control" type="text" v-model="social_link" placeholder = "Social Link"><br>
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-footer-social-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "image_name">
                                <img class = "img-fluid" v-if = "image_path" :src="image_path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "socialImageClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addSocialDB">Add Social</button>
                            </div>
                        </Modal>
            <!-- add Footer model ends  -->
        </div>
        <div class="row mt-5">
            <input type="text" class="form-control" placeholder = "search by video name" v-model = "keywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Social Name</th>
                                            <th>Social Link</th>
                                            <th>Social Image</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(social, socialKey) in getSocialFooter.data" :key = "socialKey">
                                            <td>{{ social.data.social_id }}</td>
                                            <td>{{ social.data.attributes.social_name }}</td>
                                            <td><a target="blank" v-bind:href="social.data.attributes.social_link">{{ social.data.attributes.social_name }}</a></td>
                                            <td><img class="img-fluid" style = "height: 50px; width: 50px; border-radius: 50%" :src="social.data.attributes.image_name.data.attributes.path" :alt="social.data.attributes.image_name.data.attributes.image_name"></td>
                                            <!-- <td><Button @click = "editVideoColumn(social, socialKey)" class = "btn btn-primary">Edit</Button></td> -->
                                            <td><Button @click = "deleteSocialColumn(social, socialKey)" class = "btn btn-danger">Delete</Button></td>
                                        </tr>
                                        </tbody>
                                    </table>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    data:() =>{
        return {
            addFooterModal: false,
            site_name: '',
            site_note: '',
            site_address: '',
            site_city: '',
            site_email: '',
            site_contact: '',
            addFooterSocial: false,
            token: '',
            social_name: '',
            social_link: '',
            image_name: '',
            image_path: '',
            uploadCondition: true,
            keywords: '',
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('fetchFootertext');
        this.$store.dispatch('fetchFooterSocial');
        this.site_name = this.getFooter.data.attributes.site_name;
        this.site_note = this.getFooter.data.attributes.site_note;
        this.site_address = this.getFooter.data.attributes.site_address;
        this.site_city = this.getFooter.data.attributes.site_city;
        this.site_email = this.getFooter.data.attributes.site_email;
        this.site_contact = this.getFooter.data.attributes.site_contact;
    },


    methods: {
        updateFooterText(){
            this.$store.dispatch('updateFooterText', {
                site_name: this.site_name,
                site_note: this.site_note,
                site_address: this.site_address,
                site_city: this.site_city,
                site_email: this.site_email,
                site_contact: this.site_contact,
            });
        },


        socialImageClose(){
            this.addFooterSocial = false;
        },

        addSocialDB(){
            this.$store.dispatch('fetchStoreSocialDB', {
                social_name: this.social_name,
                social_link: this.social_link,
                image_name: this.image_name,
            });
            this.social_name = '';
            this.social_link = '';
            this.image_name = '';
            this.image_path = '';
            this.addFooterSocial = false;

        },

        deleteSocialColumn(social, socialKey){
            this.$store.dispatch('fetchDeleteSocialIcon', {
                social_id: social.data.social_id,
                social_key: socialKey,
            });
        },

        // image Upload starts
            handleSuccess (res, file) {
                this.image_path = res.data.attributes.path;
                this.image_name = res.data.attributes.image_name;

                this.uploadCondition = false;

            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },

            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            // handleRemove (file) {
            //     if(this.uploadImageCondition){
            //         const fileList = this.$refs.upload.fileList;
            //         this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            //     }
            // },


            // deleteImage Drag Drop starts
            deleteImage(isAdd=true){
                this.uploadCondition = true;


                if(this.uploadCondition){
                    if(!isAdd){//for editingIconImage
                    // this.isIconImageNew = true;
                    // var image = this.data.imageName;
                    // this.data.imageName = '';
                    }else{
                        // var image = this.servicesImage;

                        this.$store.dispatch('deleteSocialImage', {
                            image: this.image_name,
                        });
                        this.image_name = '';
                        this.image_path = '';
                    }
                    this.$refs.upload.clearFiles();
                }

            },

            fetchSocial(before, after){
                this.$store.dispatch('fetchSearchSocial', {
                    keywords: this.keywords,
                });
            },
            // deleteImage Drag Drop ends
        // image modal prt ends

    },

    computed: {
        ...mapGetters({
            getFooter: 'getFooter',
            getSocialFooter: 'getSocialFooter',
        })
    },

    watch: {
        keywords(after, before) {
            this.fetchSocial();
        }
    },


}
</script>
<style scoped>

</style>
