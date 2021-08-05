<template>
    <div>
        <div class="row">
            <Button>
                <router-link to = "/auth/image-category">Image Category</router-link>
            </Button>
        </div>

        <div class="row mt-5">
            <Button @click = "addImageModal=true">
                Add Image
            </Button>
        </div>

        <!-- add services model starts -->
            <Modal
                            v-model="addImageModal"
                            title="Add Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Choose Image Category</label>
                            <select v-model="category_id" name="district">
                                <option v-for="category in getImageCategory.data" :key = "category.data.image_category_id" :value="category.data.image_category_id">{{ category.data.attributes.category_name }}</option>
                            </select>
                            <!-- <input class="form-control" type="text" v-model="servicesTitle" placeholder = "Service Title"><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="servicesDescription" placeholder = "Service Description"></textarea><br> -->
                            <!-- <input class="form-control" type="text" v-model="servicesImage" placeholder = "Service"><br> -->
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-image-image">
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "imageModalClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addImagetoDb">Add Images</button>
                            </div>
                        </Modal>
            <!-- add services model ends -->
            <!-- edit services model starts -->
            <Modal
                            v-model="editImageModal"
                            title="Edit Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Choose Image Category</label>
                            <select v-model="category_id" name="district">
                                <option v-for="category in getImageCategory.data" :key = "category.data.image_category_id" :value="category.data.image_category_id">{{ category.data.attributes.category_name }}</option>
                            </select>
                            <!-- <input class="form-control" type="text" v-model="servicesTitle" placeholder = "Service Title"><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="servicesDescription" placeholder = "Service Description"></textarea><br> -->
                            <!-- <input class="form-control" type="text" v-model="servicesImage" placeholder = "Service"><br> -->
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-image-image">
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "imageModalClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "editImagetoDb">Edit Image Column</button>
                            </div>
                        </Modal>
            <!-- edit services model ends -->

        <div class="row mt-5">
            <input type="text" class="form-control" placeholder = "search" v-model = "keywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Image Category</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(image, imageKey) in getPortfolioImages.data" :key = "imageKey">
                                            <td>{{ image.data.service_id }}</td>
                                            <td>{{ image.data.attributes.image_category.data.attributes.category_name }}</td>
                                            <td><img class="img-fluid" style = "height: 50px; width: 50px; border-radius: 50%" :src="image.data.attributes.image_name.data.attributes.path" :alt="image.data.attributes.image_name.data.attributes.image_name"></td>
                                            <td><Button @click = "editImageColumn(image, imageKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deleteImageColumn(image, imageKey)" class = "btn btn-danger">Delete</Button></td>
                                        </tr>
                                        </tbody>
                                    </table>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    data:() => {
        return {
            addImageModal: false,
            token: '',
            image_name: '',
            image_path: '',
            image_edit_id: '',
            category_id: null,
            uploadCondition: true,
            editImageModal: false,
            imageEditKey: null,
            keywords: '',
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('fetchGetImageCategories');
        this.$store.dispatch('fetchGetImage');
    },

    methods: {

        addImagetoDb(){
            this.$store.dispatch('addImageToDB', {
                image_name: this.image_name,
                image_category_id: this.category_id,
            });

            this.Image_name = '';
            this.image_path = '';
            this.addImageModal = false;
            this.editImageModal = false;
            this.uploadCondition = true;
        },


        imageModalClose(){
            this.Image_name = '';
            this.image_path = '';
            this.image_edit_id = null;
            this.category_id = null;
            this.imageEditKey = null;
            this.addImageModal = false;
            this.editImageModal = false;
        },

        editImageColumn(image, imageKey){
            // this.$store.dispatch('editImageColumn', {

            // });
            this.image_name = image.data.attributes.image_name.data.attributes.image_name;
            this.image_path = image.data.attributes.image_name.data.attributes.path;
            this.image_edit_id = image.data.image_id;
            this.category_id = image.data.attributes.image_category.data.image_category_id;
            this.imageEditKey = imageKey;
            if(this.image_path != null){
                this.uploadCondition = false;
            }
            this.editImageModal = true;

        },

        deleteImageColumn(image, imageKey){
            this.$store.dispatch('fetchDeletePortfolioImage', {
                image_id: image.data.image_id,
                imageKey: imageKey,
            });
        },

        editImagetoDb(){
            this.$store.dispatch('fetchEditImagetoDb', {
                image_edit_id: this.image_edit_id,
                image_name: this.image_name,
                category_id: this.category_id,
                imageEditKey: this.imageEditKey,
            });

            this.Image_name = '';
            this.image_path = '';
            this.image_edit_id = null;
            this.category_id = null;
            this.imageEditKey = null;
            this.editImageModal = false;
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

                        this.$store.dispatch('deletePortfolioImage', {
                            image: this.image_name,
                        });
                        this.image_name = '';
                        this.image_path = '';
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            updateServiceDB(){
                // this.$store.dispatch('fetchUpdateService', {
                //     serviceEditId: this.serviceEditId,
                //     servicesTitleEdit: this.servicesTitleEdit,
                //     servicesDescriptionEdit: this.servicesDescriptionEdit,
                //     servicesImage : this.servicesImage,
                //     serviceKeyUpdate: this.serviceKeyUpdate,

                // });

                // this.editServiceModal = false;
                // this.uploadCondition = false;
                // this.serviceKeyUpdate = null;
            },
        // image modal prt ends

        fetchImages(){
                // var data = this;
                this.$store.dispatch('searchImageKeywords', {
                    keywords: this.keywords,
                });

            },
    },


    computed: {
        ...mapGetters({
            getImageCategory: 'getImageCategory',
            getPortfolioImages: 'getPortfolioImages',
        })
    },

    watch: {
        keywords(after, before) {
            this.fetchImages();
        }
    },
}
</script>
<style scoped>

</style>
