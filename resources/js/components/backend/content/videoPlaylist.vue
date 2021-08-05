<template>
    <div>
        <div class="row mt-5">
            <Button @click = "addPlaylistModal=true">Add Video PlayList</Button>
            <!-- add services model starts -->
            <Modal
                            v-model="addPlaylistModal"
                            title="Change Image"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <input class="form-control" type="text" v-model="playListTitle" placeholder = "playlist title"><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="playListDescription" placeholder = "playlist Description"></textarea><br>
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "closePlaylistButton">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addPlayListDB">Add Image Category</button>
                            </div>
                        </Modal>
            <!-- add category model ends -->
            <!-- edit playlist model starts -->
            <Modal
                            v-model="editPlaylistModal"
                            title="Edit Playlist"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <input class="form-control" type="text" v-model="playListTitle" placeholder = "playlist title"><br>
                            <textarea rows = "5" class="form-control" type="description" v-model="playListDescription" placeholder = "playlist Description"></textarea><br>
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
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "closePlaylistButton">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "editPlayListDB">Edit Playlist</button>
                            </div>
                        </Modal>
            <!-- edit playlist model ends -->
        </div>
        <div class="row mt-5">
            <input type="text" class="form-control" placeholder = "search" v-model = "keywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Playlist Title</th>
                                            <th>Playlist Description</th>
                                            <th>Type</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(playlist, playlistKey) in getVideoPlaylists.data" :key = "playlistKey">
                                            <td>{{ playlist.data.playlist_id }}</td>
                                            <td>{{ playlist.data.attributes.playlist_title }}</td>
                                            <td>{{ playlist.data.attributes.playlist_description }}</td>
                                            <td><Button @click = "editPaylist(playlist, playlistKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deletePaylist(playlist, playlistKey)" class = "btn btn-danger">Delete</Button></td>
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
            addPlaylistModal: false,
            editPlaylistModal: false,
            playListTitle: '',
            playListDescription: '',
            editPlaylistId: null,
            playlistKeyEdit: null,
            keywords: '',
        }
    },

    mounted(){
        this.$store.dispatch('fetchGetPlylist');
    },

    methods: {
        closePlaylistButton(){
            this.addPlaylistModal = false;
            this.playListTitle = '';
            this.playListDescription = '';
            this.editPlaylistId = null;
            this.playlistKeyEdit = null;
            this.editPlaylistModal = false;
        },

        addPlayListDB(){
            this.$store.dispatch('fetchAddPlaylist', {
                playlist_title: this.playListTitle,
                playlist_description: this.playListDescription,
            });
            this.addPlaylistModal = false;
            this.playListTitle = '';
            this.playListDescription = '';
        },

        editPaylist(playlist, playlistKey){
            this.playListTitle = playlist.data.attributes.playlist_title;
            this.playListDescription = playlist.data.attributes.playlist_description;
            this.editPlaylistId = playlist.data.playlist_id;
            this.playlistKeyEdit = playlistKey;
            this.editPlaylistModal = true;
        },

        editPlayListDB(){
            this.$store.dispatch('fetchEditPlayListDB', {
                playlist_title: this.playListTitle,
                playlist_description: this.playListDescription,
                playlist_id: this.editPlaylistId,
                playlist_key: this.playlistKeyEdit,
            });

            this.playListTitle = '';
            this.playListDescription = '';
            this.editPlaylistId = null;
            this.playlistKeyEdit = null;
            this.editPlaylistModal = false;
        },

        deletePaylist(playlist, playlistKey){
            this.$store.dispatch('deletePlaylistDB', {
                playlist_id: playlist.data.playlist_id,
                playlist_key: playlistKey,
            });
        },

        fethPlaylist(){
            this.$store.dispatch('fetchSearchPlaylist', {
                keywords: this.keywords,
            });
        }
    },

    computed: {
        ...mapGetters({
            getVideoPlaylists: 'getVideoPlaylists',
        })
    },
    watch: {
        keywords(after, before){
            this.fethPlaylist();
        }
    }
}
</script>
<style scoped>

</style>
