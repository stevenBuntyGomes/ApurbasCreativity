<template>
    <div>
        <div class = "row">
            <div class="col-md-6 col-lg-6">

                                <!-- Simple card -->
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg Profile Name</h4>
                                        <div class="form-group">
                                            <label for="userName">User Name*</label>
                                            <input type="text" name="User Name"
                                                   placeholder="User Name" class="form-control" v-model = "changeAuthName">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Email address*</label>
                                            <input type="text" name="email"
                                                   placeholder="Enter email" class="form-control" v-model = "changeAuthEmil">
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" @click = "updateUserName">
                                                Submit
                                            </button>
                                        </div>

                    </div>
                </div>

            </div><!-- end col -->


            <div class="col-md-6 col-lg-6">

                                <!-- Simple card -->
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg Account Password</h4>
                        <div class = "alert alert-danger" v-if = "getChangeStatus.data == 1">
                            <p>Old Password is wrong</p>
                        </div>
                        <div class = "alert alert-danger" v-else-if = "getChangeStatus.data == 2">
                            <p>Old Password and New Password are same</p>
                        </div>
                        <div class = "alert alert-danger" v-else-if = "getChangeStatus.data == 3">
                            <p>New Password and Confirm Password are not same</p>
                        </div>
                        <div class = "alert alert-success" v-else-if = "getChangeStatus.data == 4">
                            <p>Password Changed successfully!</p>
                        </div>
                                        <div class="form-group">
                                            <label for="pass1">Old Password*</label>
                                            <input v-model = "oldPassword" type="password" required placeholder="Old Password"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass1">New Password*</label>
                                            <input v-model = "password" type="password" placeholder="Password" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="passWord2">Confirm Password *</label>
                                            <input data-parsley-equalto="#pass1" v-model = "confirmPassword" type="password" required
                                                   placeholder="Password" class="form-control">
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" @click = "updatePassword">
                                                Update Password
                                            </button>
                                        </div>

                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <div class = "row">
            <div class="col-md-6 col-lg-6">
                <div class="card m-b-20">
                    <!-- <img class="card-img-top img-fluid text-center" src="assets/images/gallery/1.jpg" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title text-center">Chaneg Profile Image</h4>
                        <img class = "img-fluid" v-if = "authUser.data.attributes.user_image.data.attributes.path" :src="authUser.data.attributes.user_image.data.attributes.path">
                        <Button @click = "addingImage()">Add Image</Button>
                        <!-- add image modal starts -->
                        <Modal
                            v-model="addImage"
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
                                action="/api/profile/add-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "authUser.data.attributes.user_image.data.attributes.path">
                                <img class = "img-fluid" v-if = "authUser.data.attributes.user_image.data.attributes.path" :src="authUser.data.attributes.user_image.data.attributes.path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "addImage=false">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addImagetoDb">Update</button>
                            </div>
                        </Modal>
                        <!-- add image modal ends -->

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" @click = "updatePassword">
                                                Update Image
                                            </button>
                                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    data:() => {
        return {
            changeAuthName: '',
            changeAuthEmil: '',
            oldPassword: null,
            password: null,
            confirmPassword: null,
            addImage: false,
            uploadCondition: true,
            visible: false,
            token: '',
            userImage: '',
            userImagePath: '',
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.changeAuthName = this.authUser.data.attributes.name;
        this.changeAuthEmil = this.authUser.data.attributes.email;
        // if(this.authUser.data.attributes.user_image.data.attributes.path != null){
        //     uploadCondition = false;
        // }
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
            getChangeStatus: 'getChangeStatus',
        })
    },

    methods: {
        updateUserName(){
           this.$store.dispatch('fetchUpdateUserName', {
               changeAuthName: this.changeAuthName,
               changeAuthEmil: this.changeAuthEmil,
           });
        //    this.authUser.data.attributes.name = this.changeAuthName;
        //    this.authUser.data.attributes.email = this.changeAuthEmil;
        },

        // update userPassword starts
        updatePassword(){
            this.$store.dispatch('fetchUpdatePassword', {
                oldPassword: this.oldPassword,
                password: this.password,
                confirmPassword: this.confirmPassword,
            });
            this.oldPassword = '';
            this.password = '';
            this.confirmPassword = '';
        },
        // update userPassword ends

        // add image starts
        addingImage(){
            this.addImage = true;
        },
        // add image ends

        // image Upload starts
            handleSuccess (res, file) {

                this.authUser.data.attributes.user_image.data.attributes.path = res.data.attributes.path;
                this.authUser.data.attributes.user_image.data.attributes.image_name = res.data.attributes.image_name;

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
                        var image = this.authUser.data.attributes.user_image.data.attributes.image_name;
                        this.authUser.data.attributes.user_image.data.attributes.image_name = '';
                        this.authUser.data.attributes.user_image.data.attributes.path = '';
                        this.$store.dispatch('delUserImage', {
                            imageName: image,
                        });
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            // addImage to DB starts
            addImagetoDb(){
                this.addImage = false;
            },
            // addImage to DB ends
    },
}
</script>
<style scoped>
    .modalButton{
        border-radius: 10px;
    }
</style>
