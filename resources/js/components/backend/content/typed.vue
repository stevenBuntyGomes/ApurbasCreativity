<template>
    <div>
        <div class="row mt-5">
            <Button @click = "addTypedModal=true">
                Add Typed Text
            </Button>

            <!-- add typed model starts -->
            <Modal
                            v-model="addTypedModal"
                            title="Add Typed"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Add Typed Text</label>

                            <input class="form-control" type="text" v-model="typed_name" placeholder = "Typed Name"><br>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "closeTyped">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "addTypedDB">Add Typed</button>
                            </div>
                        </Modal>
            <!-- add typed model ends  -->
            <!-- add typed model starts -->
            <Modal
                            v-model="editTypedModal"
                            title="Edit Typed"
                            :mask-closable = 'false'
                            :closable = 'false'>
                            <label for="cars">Edit Typed Text</label>

                            <input class="form-control" type="text" v-model="typed_name" placeholder = "Typed Name"><br>
                            <div slot = "footer">
                                <button class = "btn-danger p-1 modalButton" type = "default" @click = "closeTyped">Close</button>
                                <button class = "btn-success p-1 modalButton" type = "primary" @click = "editTypedDB">Edit Typed</button>
                            </div>
                        </Modal>
            <!-- add typed model ends  -->
        </div>
        <div class = "row mt-5">
            <input type="text" class="form-control" placeholder = "search by video name" v-model = "keywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for = "(typed, typedKey) in getTyped.data" :key = "typedKey">
                                            <td>{{ typed.data.typed_id }}</td>
                                            <td>{{ typed.data.attributes.typed_name }}</td>
                                            <td><Button @click = "editTypedColumn(typed, typedKey)" class = "btn btn-primary">Edit</Button></td>
                                            <td><Button @click = "deleteTypedoColumn(typed, typedKey)" class = "btn btn-danger">Delete</Button></td>
                                        </tr>
                                        </tbody>
                                    </table>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    export default {
        data:() => {
            return {
                addTypedModal: false,
                editTypedModal: false,
                typed_name: '',
                keywords: '',
                typed_id: null,
                typed_key: null,
            }
        },


        mounted(){
            this.$store.dispatch('fetchTyped');
        },

        methods: {
            closeTyped(){
                this.addTypedModal = false;
                this.editTypedModal = false;
            },

            addTypedDB(){
                this.$store.dispatch('fetchAddTyped', {
                    typed_name: this.typed_name,
                });

                this.typed_name = '';
                this.addTypedModal = false;
            },

            editTypedColumn(typed, typedKey){
                this.editTypedModal = true;
                this.typed_name = typed.data.attributes.typed_name;
                this.typed_id = typed.data.typed_id;
                this.typed_key = typedKey;
            },

            editTypedDB(){
                this.$store.dispatch('fetchEditTyped', {
                    typed_name: this.typed_name,
                    typed_id: this.typed_id,
                    typed_key: this.typed_key,
                });
                this.typed_name = '';
                this.typed_key = null;
                this.typed_id = null;
                this.editTypedModal = false;
            },

            deleteTypedoColumn(typed, typedKey){
                this.$store.dispatch('fetchDeleteTyped', {
                    typed_id: typed.data.typed_id,
                    typed_key: typedKey,
                });
            },
        },


        computed: {
            ...mapGetters({
                getTyped: 'getTyped',
            })
        },
    }
</script>
<style scoped>

</style>
