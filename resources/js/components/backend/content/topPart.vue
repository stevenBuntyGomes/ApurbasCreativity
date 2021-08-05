<template>
    <div>
        <div class = "row">
            <!-- logo image part starts -->

            <div class="col-md-8 col-lg-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <Button>
                            <router-link to = "/auth/logo" class="waves-effect">Update Logo </router-link>
                        </Button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <Button>
                            <router-link to = "/auth/typed" class="waves-effect">Update Typed </router-link>
                        </Button>
                    </div>
                </div>
            </div>

            <!-- logo image part ends -->
        </div>
        <div class = "row">
            <!-- banner Info part starts -->
              <div class="col-md-8 col-lg-6">

                                <!-- Simple card -->
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Change Banner Info</h4>
                                        <div class="form-group">
                                            <label for="userName">Banne Info One</label>
                                            <input type="text" name="User Name"
                                                   placeholder="User Name" class="form-control" v-model = "banner_info_one">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Banner Info Two</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "banner_info_two">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Banner Info Three</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "banner_info_three">
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <Button class="btn btn-primary waves-effect waves-light" @click = "changeBannerInfo">
                                                Submit
                                            </Button>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end col -->
            <!-- banner info part ends -->
            <!-- banner image part starts -->
            <div class="col-md-6 col-lg-6">
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg Banner Image</h4>
                        <img class = "img-fluid" v-if = "getterBannerInfo.data.attributes.banner_image.data.attributes.image_name" :src="getterBannerInfo.data.attributes.banner_image.data.attributes.path">
                        <Button @click = "addingBannerImage()">Add Image</Button>
                        <!-- add image modal starts -->
                        <Modal
                            v-model="addBannerImage"
                            title="Change Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-banner-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "getterBannerInfo.data.attributes.banner_image.data.attributes.image_name">
                                <img class = "img-fluid" v-if = "getterBannerInfo.data.attributes.banner_image.data.attributes.image_name" :src="getterBannerInfo.data.attributes.banner_image.data.attributes.path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "addBannerImage=false">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addImagetoDb">Update</button>
                            </div>
                        </Modal>
                        <!-- add image modal ends -->

                                        <!-- <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" @click = "updatePassword">
                                                Update Image
                                            </button>
                                        </div> -->


                    </div>
                </div>
            </div>


            <!-- banner image part ends -->
        </div>

    </div>
</template>
<script>
import {mapGetters} from 'vuex';


export default {

    data:() =>{
        return {
            banner_info_one: '',
            banner_info_two: '',
            banner_info_three: '',
            banner_image: '',
            token: '',
            addBannerImage: false,
            uploadCondition: true,
        }
    },


    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('fetchGetBannerInformation');
        this.banner_info_one = this.getterBannerInfo.data.attributes.banner_info_one;
        this.banner_info_two = this.getterBannerInfo.data.attributes.banner_info_two;
        this.banner_info_three = this.getterBannerInfo.data.attributes.banner_info_three;
    },


    methods: {

        addingBannerImage(){
            this.addBannerImage = true;
        },


        changeBannerInfo(){
            this.$store.dispatch('fetchBannerInformation', {
                banner_id: this.getterBannerInfo.data.banner_id,
                banner_info_one: this.banner_info_one,
                banner_info_two: this.banner_info_two,
                banner_info_three: this.banner_info_three,
            });
        },


        // image Upload starts
            handleSuccess (res, file) {

                this.getterBannerInfo.data.attributes.banner_image.data.attributes.path = res.data.attributes.path;
                this.getterBannerInfo.data.attributes.banner_image.data.attributes.image_name = res.data.attributes.image_name;

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
                        var image = this.getterBannerInfo.data.attributes.banner_image.data.attributes.image_name;
                        this.getterBannerInfo.data.attributes.banner_image.data.attributes.image_name = '';
                        this.getterBannerInfo.data.attributes.banner_image.data.attributes.path = '';
                        this.$store.dispatch('delBannerImage');
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            // addImage to DB starts
            addImagetoDb(){
                this.addBannerImage = false;
            },
            // addImage to DB ends
    },


    computed: {
        ...mapGetters({
            getterBannerInfo: 'getterBannerInfo',
            authUser: 'authUser',
        })
    }
}
</script>
<style scoped>

</style>
