<template>
    <div>
        <div class = "row mt-5">
            <Button class = "btn btn-success" @click = "addOnServices()">Add Services</Button>

            <!-- add services model starts -->
            <Modal
                            v-model="addServices"
                            title="Change Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <input class="form-control" type="text" v-model="servicesTitle" placeholder = "Service Title"><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="servicesDescription" placeholder = "Service Description"></textarea><br>
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
                                action="/api/add-service-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "servicesImage">
                                <img class = "img-fluid" v-if = "serviceImage_path" :src="serviceImage_path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "addServices=false">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addImagetoDb">Add Service</button>
                            </div>
                        </Modal>
            <!-- add services model ends -->
            <!-- edit services model starts -->
            <Modal
                            v-model="editServiceModal"
                            title="Edit Service"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <input class="form-control" type="text" v-model="servicesTitleEdit" placeholder = "Service Title"><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="servicesDescriptionEdit" placeholder = "Service Description"></textarea><br>
                            <!-- <input class="form-control" type="text" v-model="servicesImage" placeholder = "Service"><br> -->
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :data = "{'servicesImage' : servicesImage, 'serviceEditId': serviceEditId}"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/edit-service-image">
                                <div style="padding: 20px 0">
                                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                    <p>Click or drag files here to upload</p>
                                </div>
                            </Upload>
                            <div class = "demo-upload-list" v-if = "servicesImage">
                                <img class = "img-fluid" v-if = "serviceImage_path" :src="serviceImage_path">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                                </div>
                            </div>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "editServiceModal=false">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "updateServiceDB()">Add Service</button>
                            </div>
                        </Modal>
            <!-- edit services model ends -->
        </div>
        <div class="row mt-5">
            <input type="text" class="form-control" placeholder = "search" v-model = "keywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Service Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(service, serviceKey) in getServices.data" :key = "serviceKey">
                                            <td>{{ service.data.service_id }}</td>
                                            <td>{{ service.data.attributes.service_title }}</td>
                                            <td>{{ service.data.attributes.service_description }}</td>
                                            <td><img class="img-fluid" style = "height: 50px; width: 50px; border-radius: 50%" :src="service.data.attributes.service_image.data.attributes.path" :alt="service.data.attributes.service_image.data.attributes.image_name"></td>
                                            <td><Button @click = "editService(service, serviceKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deleteService(service, serviceKey)" class = "btn btn-danger">Delete</Button></td>
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
            addServices: false,
            uploadCondition: true,
            servicesTitle: '',
            servicesDescription: '',
            servicesImage: '',
            serviceImage_path: '',
            token: '',
            keywords: null,
            search: [],
            // edit modal starts
            editServiceModal: false,
            servicesTitleEdit: '',
            servicesDescriptionEdit: '',
            serviceEditId: null,
            serviceKeyUpdate: null,
            // edit modal ends
        }
    },

    mounted(){
        this.$store.dispatch('fetchGetServices');
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
    },




    methods: {

        fetch(){
                // var data = this;
                this.$store.dispatch('searchKeywords', {
                    keywords: this.keywords,
                });

            },


        // edit servicePart Starts
        editService(service, serviceKey){
            this.editServiceModal = true;
            if(service.data.attributes.service_image.data.attributes.image_name != null){
                this.uploadCondition = false;
            }
            this.servicesImage = service.data.attributes.service_image.data.attributes.image_name;
            this.serviceImage_path = service.data.attributes.service_image.data.attributes.path;
            this.serviceEditId = service.data.service_id;
            this.servicesTitleEdit = service.data.attributes.service_title;
            this.servicesDescriptionEdit = service.data.attributes.service_description;
            this.serviceKeyUpdate = serviceKey;


            // this.$store.dispatch('editServicePart', {
            //     service: service,
            //     serviceKey: serviceKey,
            // });
        },
        // edit servicePart ends
        // delete servicePart starts
        deleteService(service, serviceKey){
            this.$store.dispatch('fetchDeleteService', {
                service_id: service.data.service_id,
                serviceKey: serviceKey,
            });
        },
        // delete servicePart ends


        addOnServices(){
            this.addServices = true;
        },


        addImagetoDb(){
            this.$store.dispatch('fetchStoreServices', {
                servicesTitle: this.servicesTitle,
                servicesDescription: this.servicesDescription,
                servicesImage: this.servicesImage,
            });
            this.servicesTitle = '';
            this.servicesDescription = '';
            this.servicesImage = '';
            this.uploadCondition = true;
            this.addServices = false;
        },


        // image Upload starts
            handleSuccess (res, file) {

                this.serviceImage_path = res.data.attributes.path;
                this.servicesImage = res.data.attributes.image_name;

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

                        this.$store.dispatch('deleteServiceImage', {
                            image: this.servicesImage,
                        });

                        this.servicesImage = '';
                        this.serviceImage_path = '';
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            updateServiceDB(){
                this.$store.dispatch('fetchUpdateService', {
                    serviceEditId: this.serviceEditId,
                    servicesTitleEdit: this.servicesTitleEdit,
                    servicesDescriptionEdit: this.servicesDescriptionEdit,
                    servicesImage : this.servicesImage,
                    serviceKeyUpdate: this.serviceKeyUpdate,

                });

                this.editServiceModal = false;
                this.uploadCondition = false;
                this.serviceKeyUpdate = null;
            }


    },




    computed: {
        ...mapGetters({
            getServices: 'getServices',
        })
    },

    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },

}
</script>
<style scoped>

</style>
