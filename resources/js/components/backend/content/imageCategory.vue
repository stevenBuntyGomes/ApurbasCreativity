<template>
    <div>
        <div class="row">
            <Button @click = "addImageCategoryModal=true">
                Add Image Category
            </Button>
            <!-- add services model starts -->
            <Modal
                            v-model="addImageCategoryModal"
                            title="Change Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <input class="form-control" type="text" v-model="categoryName" placeholder = "Image Name"><br>
                            <!-- <input class="form-control" type="text" v-model="servicesImage" placeholder = "Service"><br> -->
                            <!-- <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-categor-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload> -->
                            <!-- <div class = "demo-upload-list" v-if = "servicesImage">
                                <img class = "img-fluid" v-if = "serviceImage_path" :src="serviceImage_path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div> -->
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "closeAddCategoryButton">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addImagetoDb">Add Image Category</button>
                            </div>
                        </Modal>
            <!-- add category model ends -->
            <!-- edit category model starts -->
            <Modal
                            v-model="editImageCategoryModal"
                            title="Change Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <input class="form-control" type="text" v-model="categoryName" placeholder = "Image Name"><br>
                            <!-- <input class="form-control" type="text" v-model="servicesImage" placeholder = "Service"><br> -->
                            <!-- <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-categor-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload> -->
                            <!-- <div class = "demo-upload-list" v-if = "servicesImage">
                                <img class = "img-fluid" v-if = "serviceImage_path" :src="serviceImage_path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div> -->
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "editCategory">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "editCategoryDB">Add Image Category</button>
                            </div>
                        </Modal>
            <!-- add category model ends -->
        </div>
        <div class="row mt-5">
            <input type="text" class="form-control" placeholder = "search" v-model = "imageCategoryKeywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(imageCategory, categoryKey) in getImageCategory.data" :key = "categoryKey">
                                            <td>{{ imageCategory.data.image_category_id }}</td>
                                            <td>{{ imageCategory.data.attributes.category_name }}</td>
                                            <td><Button @click = "editCategoryBtn(imageCategory, categoryKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deleteCategory(imageCategory, categoryKey)" class = "btn btn-danger">Delete</Button></td>
                                        </tr>
                                        </tbody>
                                    </table>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    data:()=> {
        return {
            addImageCategoryModal: false,
            editImageCategoryModal: false,
            imageCategoryKeywords: null,
            categoryName: '',
            categoryImage: '',
            editCategoryId: null,
            categoryKey: null,
            uploadCondition: true,
            token: '',
            // editCategoryName:
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('fetchGetImageCategories');
    },


    methods: {
        addImagetoDb(){
            this.$store.dispatch('fetchAddCategory', {
                categoryName: this.categoryName,
            });
            this.categoryName = '';
            this.addImageCategoryModal = false;
        },

        editCategoryBtn(category, categoryKey){
            this.editImageCategoryModal = true;
            this.editCategoryId = category.data.image_category_id;
            this.categoryKey = categoryKey;
            this.categoryName = category.data.attributes.category_name;
        },

        editCategory(){
            this.categoryName = '';
            this.editImageCategoryModal = false;
        },

        editCategoryDB(){
            this.$store.dispatch('fetchEditImageCategory', {
                category_id: this.editCategoryId,
                category_name: this.categoryName,
                category_key: this.categoryKey,
            });
            this.editCategoryId = null;
            this.categoryKey = null;
            this.categoryName = '';
            this.editImageCategoryModal = false;
        },

        deleteCategory(category, categoryKey){
            this.$store.dispatch('fetchDelImageCategory', {
                category_id: category.data.image_category_id,
                category_key: categoryKey,
            });
        },

        closeAddCategoryButton(){
            this.addImageCategoryModal = false;
            this.categoryName = '';
        },

        // image modal prt starts
        // image Upload starts
            handleSuccess (res, file) {

                // this.serviceImage_path = res.data.attributes.path;
                // this.servicesImage = res.data.attributes.image_name;

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
                this.$refs.upload.clearFiles();

                // if(this.uploadCondition){
                //     if(!isAdd){//for editingIconImage
                //     // this.isIconImageNew = true;
                //     // var image = this.data.imageName;
                //     // this.data.imageName = '';
                //     }else{
                //         // var image = this.servicesImage;

                //         this.$store.dispatch('deleteServiceImage', {
                //             image: this.servicesImage,
                //         });

                //         this.servicesImage = '';
                //         this.serviceImage_path = '';
                //     }
                //
                // }

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
        fetch(){
                // var data = this;
                this.$store.dispatch('searchImageCategory', {
                    keywords: this.imageCategoryKeywords,
                });

            },
    },


    computed: {
        ...mapGetters({
            getImageCategory: 'getImageCategory',
        })
    },


    watch: {
        imageCategoryKeywords(after, before) {
            this.fetch();
        }
    },
}
</script>
<style scoped>

</style>
