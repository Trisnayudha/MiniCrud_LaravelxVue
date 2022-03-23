<template>
    <div>
        <h1>Edit User</h1>
        <form @submit.prevent="handleUpdate">
        <div class="input-group">
            <label for="">Name</label>
            <input type="text" v-model="user.name">
            <div class="error" v-if="errors.name">
                {{ errors.name[0] }}
            </div>
        </div>
        <div class="input-group">
            <label for="">Email</label>
            <input type="text" v-model="user.email">
            <div class="error" v-if="errors.email">
                {{ errors.email[0] }}
            </div>
        </div>
        
        <button type="submit">Update</button>
        </form>
    </div>
</template>
<style>
    .input-group{
        margin-bottom: 5px;
    }
</style>

<script>
export default {
    props: ['id'],
    data(){
       return{
           user:{
               name:'',
               email:'',               
           },
           errors:{}
       }
   },
   mounted() {
        this.getUser()
    },
   methods: {
       getUser(){
            axios.get('/api/users/'+ this.id).then((response) => {    
            console.log(response)
            this.user = response.data
        })
        },
       handleUpdate(){
           axios.put('/api/users/' + this.id , this.user).then((response) => {
               if(response.data.status){
                this.$noty.success(response.data.message)
                   this.$router.push({
                       name: 'DetailUser'
               })
            }
           }).catch((error) => {
               if(error.response.status == 403){
                   this.errors = error.response.data.message
               }
           })
       }
   }
}
</script>