<template>
    <div>
        <div class="row">
            <Button>
                <router-link to = "/auth/video-playlist">Video PlayList</router-link>
            </Button>
        </div>
        <div class="row mt-5">
            <Button @click = "addVideoModal=true">Add Video</Button>

            <!-- add services model starts -->
            <Modal
                            v-model="addVideoModal"
                            title="Add Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Choose Video Playlist</label>
                            <select v-model="playlist_id" name="district">
                                <option v-for="playlist in getVideoPlaylists.data" :key = "playlist.data.playlist_id" :value="playlist.data.playlist_id">{{ playlist.data.attributes.playlist_title }}</option>
                            </select>
                            <input class="form-control" type="text" v-model="video_name" placeholder = "Video Name"><br>
                            <input class="form-control" type="text" v-model="video_link" placeholder = "Youtube Video Link"><br>
                            <label for="cars">Video Thumbnail Image</label><br>
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
                                action="/api/add-video-image">
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "videoeModalClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addVideoDB">Add Video</button>
                            </div>
                        </Modal>
            <!-- add services model ends -->
            <!-- edit services model starts -->
            <Modal
                            v-model="editVideoModal"
                            title="Edit Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Choose Video Playlist</label>
                            <select v-model="playlist_id" name="district">
                                <option v-for="playlist in getVideoPlaylists.data" :key = "playlist.data.playlist_id" :value="playlist.data.playlist_id">{{ playlist.data.attributes.playlist_title }}</option>
                            </select>
                            <input class="form-control" type="text" v-model="video_name" placeholder = "Video Name"><br>
                            <input class="form-control" type="text" v-model="video_link" placeholder = "Youtube Video Link"><br>
                            <label for="cars">Video Thumbnail Image</label><br>
                            <Upload
                                v-if = "uploadCondition"
                                ref="upload"
                                type="drag"
                                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                :on-success="handleSuccess"
                                :format="['jpg','jpeg','png', 'svg']"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/api/add-video-image">
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "videoeModalClose">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "editVideoDB">Edit Video Column</button>
                            </div>
                        </Modal>
            <!-- edit services model ends -->
        </div>
        <div class = "row mt-5">
            <input type="text" class="form-control" placeholder = "search by video name" v-model = "keywords">
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
                                        <tr v-for = "(videos, videoKey) in getVideos.data" :key = "videoKey">
                                            <td>{{ videos.data.video_id }}</td>
                                            <td>{{ videos.data.attributes.video_playlist.data.attributes.playlist_title }}</td>
                                            <td>{{ videos.data.attributes.video_name }}</td>
                                            <td>{{ videos.data.attributes.video_link }}</td>
                                            <td><img class="img-fluid" style = "height: 50px; width: 50px; border-radius: 50%" :src="videos.data.attributes.image_name.data.attributes.path" :alt="videos.data.attributes.image_name.data.attributes.image_name"></td>
                                            <td><Button @click = "editVideoColumn(videos, videoKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deleteVideoColumn(videos, videoKey)" class = "btn btn-danger">Delete</Button></td>
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
            addVideoModal: false,
            editVideoModal: false,
            uploadCondition: true,
            token: '',
            playlist_id: null,
            video_name: '',
            image_name: '',
            image_path: '',
            video_link: '',
            keywords: '',
            videoEditKey: null,
            videoEditId: null,
        }
    },

    mounted(){
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
        this.$store.dispatch('fetchGetPlylist');
        this.$store.dispatch('fetchGetVideos');
    },


    methods: {
        addVideoDB(){
            this.$store.dispatch('storeVideoDB', {
                playlist_id: this.playlist_id,
                video_name: this.video_name,
                video_link: this.video_link,
                image_name: this.image_name,
            });
            this.playlist_id = '';
            this.video_name = '';
            this.video_link = '';
            this.image_name = '';
            this.addVideoModal = false;
            this.uploadCondition = true;

        },

        videoeModalClose(){
            this.addVideoModal = false;
            this.editVideoModal = false;
        },

        editVideoColumn(videos, videoKey){
            this.videoEditId = videos.data.video_id;
            this.playlist_id = videos.data.attributes.video_playlist.data.playlist_id;
            this.video_name = videos.data.attributes.video_name;
            this.image_name = videos.data.attributes.image_name.data.attributes.image_name;
            this.image_path = videos.data.attributes.image_name.data.attributes.path;
            this.video_link = videos.data.attributes.video_link;
            this.videoEditKey = videoKey;
            this.uploadCondition = false;
            this.editVideoModal = true;
        },

        editVideoDB(){
            this.$store.dispatch('editVideoDB', {
                playlist_id: this.playlist_id,
                video_name: this.video_name,
                image_name: this.image_name,
                video_link: this.video_link,
                video_id: this.videoEditId,
                videoKey: this.videoEditKey,
            });

            this.videoEditId = null;
            this.playlist_id = null;
            this.video_name = '';
            this.image_name = '';
            this.image_path = '';
            this.video_link = '';
            this.videoEditKey = null;
            this.uploadCondition = true;
            this.editVideoModal = false;
        },


        deleteVideoColumn(video, videoKey){
            this.$store.dispatch('deleteVideoDB', {
                video_id: video.data.video_id,
                video_key: videoKey,
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

                        this.$store.dispatch('deleteVideoImage', {
                            image: this.image_name,
                        });
                        this.image_name = '';
                        this.image_path = '';
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends
        // image modal prt ends
            fetchVideos(){
                this.$store.dispatch('searchVideosKeywords', {
                    keywords: this.keywords,
                });
            }

    },

    computed: {
        ...mapGetters({
            getVideoPlaylists: 'getVideoPlaylists',
            getVideos: 'getVideos',
        })
    },


    watch: {
        keywords(after, before) {
            this.fetchVideos();
        }
    },
}
</script>
<style scoped>

</style>
