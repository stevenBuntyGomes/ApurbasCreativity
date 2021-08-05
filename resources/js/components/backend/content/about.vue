<template>
    <div>
        <div class = "row">
            <!-- about Info part starts -->
              <div class="col-md-8 col-lg-6">

                                <!-- Simple card -->
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Change About Information</h4>
                                        <div class="form-group">
                                            <label for="userName">About Header</label>
                                            <input type="text" name="User Name"
                                                   placeholder="User Name" class="form-control" v-model = "about_header">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">About Title</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "about_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">About Title 2</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "about_title_two">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">About Description</label>
                                            <textarea type="description" name="email" rows = "5"
                                                   placeholder="Enter email" class="form-control" v-model = "about_description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">About Button</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "about_button">
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <Button class="btn btn-primary waves-effect waves-light" @click = "changeAboutInfo">
                                                Submit
                                            </Button>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end col -->
            <!-- about info part ends -->
            <!-- about image part starts -->
            <div class="col-md-6 col-lg-6">
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg About Image</h4>
                        <img class = "img-fluid" v-if = "getAboutInfo.data.attributes.about_image.data.attributes.image_name" :src="getAboutInfo.data.attributes.about_image.data.attributes.path">
                        <Button @click = "addingAboutImage()">Add Image</Button>
                        <!-- add image modal starts -->
                        <Modal
                            v-model="addAboutImage"
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
                                action="/api/add-about-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "getAboutInfo.data.attributes.about_image.data.attributes.image_name">
                                <img class = "img-fluid" v-if = "getAboutInfo.data.attributes.about_image.data.attributes.image_name" :src="getAboutInfo.data.attributes.about_image.data.attributes.path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "addAboutImage=false">Close</button>
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
            <!-- about image part ends -->
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    export default {
        data:() => {
            return {
                about_header: '',
                about_title: '',
                about_title_two: '',
                about_description: '',
                about_button: '',
                token: '',
                addAboutImage: false,
                about_image: '',
            }
        },

        mounted(){
            this.$store.dispatch('getAboutInformation');
            this.token = document.head.querySelector('meta[name=csrf-token]').content;
            this.about_header = this.getAboutInfo.data.attributes.about_header;
            this.about_title = this.getAboutInfo.data.attributes.about_title;
            this.about_title_two = this.getAboutInfo.data.attributes.about_title_two;
            this.about_description = this.getAboutInfo.data.attributes.about_description;
            this.about_button = this.getAboutInfo.data.attributes.about_button;
            this.about_image = this.getAboutInfo.data.attributes.about_image;
        },

        methods: {
            changeAboutInfo(){
                this.$store.dispatch('changeAboutInformation', {
                    about_header: this.about_header,
                    about_title: this.about_title,
                    about_title_two: this.about_title_two,
                    about_description: this.about_description,
                    about_button: this.about_button,
                });
            },

            addingAboutImage(){
                this.addAboutImage = true;
            },




            // image Upload starts
            handleSuccess (res, file) {

                this.getAboutInfo.data.attributes.about_image.data.attributes.path = res.data.attributes.path;
                this.getAboutInfo.data.attributes.about_image.data.attributes.image_name = res.data.attributes.image_name;

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
                        var image = this.getAboutInfo.data.attributes.about_image.data.attributes.image_name;
                        this.getAboutInfo.data.attributes.about_image.data.attributes.image_name = '';
                        this.getAboutInfo.data.attributes.about_image.data.attributes.path = '';
                        this.$store.dispatch('delAboutImage');
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            // addImage to DB starts
            addImagetoDb(){
                this.addAboutImage = false;
            },
            // addImage to DB ends
        },


        computed: {
            ...mapGetters({
                getAboutInfo: 'getAboutInfo'
            })
        },
    }
</script>
<style scoped>

</style>
