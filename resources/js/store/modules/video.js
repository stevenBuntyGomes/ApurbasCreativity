const state = {
    videoPlayList: [],
    videos: [],
};

const getters = {
    getVideoPlaylists(state){
        return state.videoPlayList;
    },

    getVideos(state){
        return state.videos;
    }
};

const actions = {
    fetchAddPlaylist({commit, state}, data){
        axios.post('/api/add-video-playlist', {
                        playlist_title: data.playlist_title,
                        playlist_description: data.playlist_description,
                    })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('addPlaylist', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchGetPlylist({commit, state}, data){
        axios.post('/api/get-video-playlist')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setVideoPlaylist', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchEditPlayListDB({commit, state}, data){
        axios.post('/api/edit-video-playlist', {
                playlist_title: data.playlist_title,
                playlist_description: data.playlist_description,
                playlist_id: data.playlist_id,
                // playlist_key: data.playlistKeyEdit,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('updateVideoPlaylist', {
                            playlist: response.data,
                            playlist_key: data.playlist_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    deletePlaylistDB({commit, state}, data){
        axios.post('/api/delete-video-playlist', {
                playlist_id: data.playlist_id,
                // playlist_key: data.playlist_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('deleteVideoPlaylist', {
                            playlist_key: data.playlist_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchSearchPlaylist({commit, state}, data){
        axios.post('/api/search-video-playlist', {
                keywords: data.keywords,
                // playlist_key: data.playlist_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setVideoPlaylist', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },


    // start video image part

    deleteVideoImage({ommit, state}, data){
        axios.post('/api/delete-video-image', {
                image: data.image,
                // playlist_key: data.playlist_key,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        // commit('setVideoPlaylist', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    storeVideoDB({commit, state}, data){
        axios.post('/api/store-video', {
                playlist_id: data.playlist_id,
                video_name: data.video_name,
                video_link: data.video_link,
                image_name: data.image_name,

        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setVideo', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    fetchGetVideos({commit, state}, data){
        axios.post('/api/get-video')
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setAllVideo', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    editVideoDB({commit, state}, data){
        axios.post('/api/edit-video-db', {
            video_id: data.video_id,
            playlist_id: data.playlist_id,
            video_name: data.video_name,
            image_name: data.image_name,
            video_link: data.video_link,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setEditVideo', {
                            video: response.data,
                            videoKey: data.videoKey,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    deleteVideoDB({commit, state}, data){
        axios.post('/api/delete-video-db', {
            video_id: data.video_id,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setDeleteVideo', {
                            video: response.data,
                            video_key: data.video_key,
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    },

    searchVideosKeywords({commit, state}, data){
        axios.post('/api/search-video-db', {
            keywords: data.keywords,
        })
                    .then(function (response) {
                        // data.search = response.data;
                        // console.log(response.data);
                        commit('setAllVideo', response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
    }
    // end video image part
};


const mutations = {
    setVideoPlaylist(state, data){
        state.videoPlayList = data;
    },

    addPlaylist(state, data){
        state.videoPlayList.data.unshift(data);
    },

    updateVideoPlaylist(state, data){
        state.videoPlayList.data[data.playlist_key].data.attributes.playlist_title = data.playlist.data.attributes.playlist_title;
        state.videoPlayList.data[data.playlist_key].data.attributes.playlist_description = data.playlist.data.attributes.playlist_description;
        state.videoPlayList.data[data.playlist_key].data.attributes.type = data.playlist.data.attributes.type;
        state.videoPlayList.data[data.playlist_key].data.attributes.updated_at = data.playlist.data.attributes.updated_at;
    },

    deleteVideoPlaylist(state, data){
        state.videoPlayList.data.splice(data.playlist_key, 1);
    },

    // video part starts
    setVideo(state, data){
        state.videos.data.unshift(data);
    },

    setAllVideo(state, data){
        state.videos = data;
    },

    setEditVideo(state, data){
        state.videos.data[data.videoKey].data.attributes.video_name = data.video.data.attributes.video_name;
        state.videos.data[data.videoKey].data.attributes.video_link = data.video.data.attributes.video_link;
        state.videos.data[data.videoKey].data.attributes.video_playlist.data.attributes.playlist_title = data.video.data.attributes.video_playlist.data.attributes.playlist_title;
        state.videos.data[data.videoKey].data.attributes.video_playlist.data.attributes.playlist_description = data.video.data.attributes.video_playlist.data.attributes.playlist_description;
        state.videos.data[data.videoKey].data.attributes.video_playlist.data.playlist_id = data.video.data.attributes.video_playlist.data.playlist_id;
        state.videos.data[data.videoKey].data.attributes.image_name.data.attributes.image_name = data.video.data.attributes.image_name.data.attributes.image_name;
        state.videos.data[data.videoKey].data.attributes.image_name.data.attributes.path = data.video.data.attributes.image_name.data.attributes.path;
    },


    setDeleteVideo(state, data){
        state.videos.data.splice(data.video_key, 1);
    }
    // video part ends
};

export default {
    state,
    getters,
    actions,
    mutations,
}
