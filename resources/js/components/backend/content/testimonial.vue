<template>
    <div>
        <div class="row mt-5">
            <Button @click = "addTestimonialModal=true">
                Add Testimonial
            </Button>

            <!-- add testimonial model starts -->
            <Modal
                            v-model="addTestimonialModal"
                            title="Add Testimonial"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Testimonial Name</label><br>
                            <input class="form-control" type="text" v-model="testi_name" placeholder = "Testimonial Name"><br>
                            <br><br>
                            <label for="cars">Testimonial Position</label><br>
                            <input class="form-control" type="text" v-model="testi_position" placeholder = "Testimonial Position"><br>
                            <br><br>
                            <label for="cars">Testimonial Description</label><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="testi_description" placeholder = "Testimonial Description"></textarea><br>
                            <br><br>
                            <label for="cars">Testimonial Image</label><br>
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
                                action="/api/add-testimonial-image">
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "testimonialModalClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addTestiDB">Add Video</button>
                            </div>
                        </Modal>
            <!-- add testimonial model ends -->

            <!-- edit services model starts -->
            <Modal
                            v-model="editTestimonialModal"
                            title="Edit Testimonial"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Testimonial Name</label><br>
                            <input class="form-control" type="text" v-model="testi_name" placeholder = "Testimonial Name"><br>
                            <br><br>
                            <label for="cars">Testimonial Position</label><br>
                            <input class="form-control" type="text" v-model="testi_position" placeholder = "Testimonial Position"><br>
                            <br><br>
                            <label for="cars">Testimonial Description</label><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="testi_description" placeholder = "Testimonial Description"></textarea><br>
                            <br><br>
                            <label for="cars">Testimonial Image</label><br>
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-testimonial-image">
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "testimonialModalClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "editTestiDB">Edit Testimonial</button>
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
                                            <th>Testimonial Name</th>
                                            <th>Testimonial Position</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(testi, testiKey) in getTestimonial.data" :key = "testiKey">
                                            <td>{{ testi.data.testimonial_id }}</td>
                                            <td>{{ testi.data.attributes.testi_name }}</td>
                                            <td>{{ testi.data.attributes.testi_position }}</td>
                                            <td>{{ testi.data.attributes.testi_description }}</td>
                                            <td><img class="img-fluid" style = "height: 50px; width: 50px; border-radius: 50%" :src="testi.data.attributes.image_name.data.attributes.path" :alt="testi.data.attributes.image_name.data.attributes.image_name"></td>
                                            <td><Button @click = "editTestiColumn(testi, testiKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deleteTestiColumn(testi, testiKey)" class = "btn btn-danger">Delete</Button></td>
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
            addTestimonialModal: false,
            editTestimonialModal: false,
            uploadCondition: true,
            image_name: '',
            image_path: '',
            token: '',
            testi_name: '',
            testi_position: '',
            testi_description: '',
            keywords: '',
            testiEditId: null,
            testiKey: null,
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('fetchGetTestimonial');
    },


    methods: {

        addTestiDB(){
            this.$store.dispatch('fetchStoreTestimonial', {
                testi_name: this.testi_name,
                testi_position: this.testi_position,
                testi_description: this.testi_description,
                image_name: this.image_name,

            });

            this.testi_name = '';
            this.testi_position = '';
            this.testi_description = '';
            this.image_name = '';
            this.image_path = '';
            this.addTestimonialModal = false;


        },

        testimonialModalClose(){
            this.addTestimonialModal = false;
            this.editTestimonialModal = false;
        },


        editTestiColumn(testi, testiKey){
            this.testi_name = testi.data.attributes.testi_name;
            this.testi_position = testi.data.attributes.testi_position;
            this.testi_description = testi.data.attributes.testi_description;
            this.image_name = testi.data.attributes.image_name.data.attributes.image_name;
            this.image_path = testi.data.attributes.image_name.data.attributes.path;
            this.testiEditId = testi.data.testimonial_id;
            this.testiKey = testiKey;
            this.editTestimonialModal = true;
            this.uploadCondition = false;
        },

        editTestiDB(testi, testiKey){
            this.$store.dispatch('editTestiDB', {
                testi_name: this.testi_name,
                testi_position: this.testi_position,
                testi_description: this.testi_description,
                image_name: this.image_name,
                testi_id: this.testiEditId,
                testi_key: this.testiKey,
            });

            this.testi_name = '';
            this.testi_position = '';
            this.testi_description = '';
            this.image_name = '';
            this.image_path = '';
            this.testiEditId = '';
            this.testiKey = null;
            this.editTestimonialModal = false;
            this.uploadCondition = true;
        },

        deleteTestiColumn(testi, testiKey){
            this.$store.dispatch('fetchDeleteTestiDB', {
                testi_id: testi.data.testimonial_id,
                testi_key: testiKey,
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

                        this.$store.dispatch('deleteTestiImage', {
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
        fetchTestis(){
            this.$store.dispatch('searchTestiKeywords', {
                    keywords: this.keywords,
                });
        }
    },

    computed:{
        ...mapGetters({
            getTestimonial: 'getTestimonial',
        })
    },


    watch: {
        keywords(after, before) {
            this.fetchTestis();
        }
    },
}
</script>
<style scoped>

</style>
