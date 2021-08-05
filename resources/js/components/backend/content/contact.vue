<template>
    <div>
        <div class = "row mt-5">
            <input type="text" class="form-control" placeholder = "search by contact name" v-model = "keywords">
            <table class="table table-bordered">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>




                                        <tr v-for = "(contact, contactKey) in getContacts.data" :key = "contactKey">
                                            <td>{{ contact.data.contact_id }}</td>
                                            <td>{{ contact.data.attributes.contact_name }}</td>
                                            <td>{{ contact.data.attributes.contact_email }}</td>
                                            <td>{{ contact.data.attributes.contact_description }}</td>
                                            <td><Button @click = "deleteContactColumn(contact, contactKey)" class = "btn btn-danger">Delete</Button></td>
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
            keywords: '',
        }
    },

    mounted(){
        this.$store.dispatch('fetchContacts');
    },

    methods: {
        deleteContactColumn(contact, contactKey){
            this.$store.dispatch('deleteContact', {
                contact_id: contact.data.contact_id,
                contact_key: contactKey,
            });
        },


        fetchContacts(){
                // var data = this;
                this.$store.dispatch('searchContactKeywords', {
                    keywords: this.keywords,
                });

            },
    },


    computed: {
        ...mapGetters({
            getContacts: 'getContacts',
        })
    },

    watch: {
        keywords(after, before) {
            this.fetchContacts();
        }
    },
}
</script>
<style scoped>

</style>
