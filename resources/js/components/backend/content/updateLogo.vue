<template>

    <div>
        <!-- banner image part starts -->
            <div class="col-md-6 col-lg-6">
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg Logo</h4>
                        <img class = "img-fluid" v-if = "getLogo.data.attributes.logo_image.data.attributes.image_name" :src="getLogo.data.attributes.logo_image.data.attributes.path">
                        <Button @click = "addingBannerImage()">Add Image</Button>
                        <!-- add image modal starts -->
                        <Modal
                            v-model="addLogoImage"
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
                                action="/api/add-logo-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "getLogo.data.attributes.logo_image.data.attributes.image_name">
                                <img class = "img-fluid" v-if = "getLogo.data.attributes.logo_image.data.attributes.image_name" :src="getLogo.data.attributes.logo_image.data.attributes.path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "addLogoImage=false">Close</button>
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
</template>
<script>
import {mapGetters} from 'vuex'

export default {

    data:() => {
        return {
            addLogoImage: false,
            token: '',
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('FetchGetUserLogo');
    },

    methods: {
        addingBannerImage(){
            this.addLogoImage = true;
        },


        // image Upload starts
            handleSuccess (res, file) {

                this.getLogo.data.attributes.logo_image.data.attributes.path = res.data.attributes.path;
                this.getLogo.data.attributes.logo_image.data.attributes.image_name = res.data.attributes.image_name;

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
                        var image = this.getLogo.data.attributes.logo_image.data.attributes.image_name;
                        this.getLogo.data.attributes.logo_image.data.attributes.image_name = '';
                        this.getLogo.data.attributes.logo_image.data.attributes.path = '';
                        this.$store.dispatch('delLogoImage');
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            // addImage to DB starts
            addImagetoDb(){
                this.addLogoImage = false;
            },
            // addImage to DB ends
    },


    computed: {
        ...mapGetters({
            getLogo: 'getLogo'
        })
    },
}
</script>
<style scoped>

</style>
