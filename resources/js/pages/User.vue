<template>
    <div>    
    <section>
        <h1>Daftar List Pengguna</h1>
        <ul>
            <li v-for="user in users" :key="user.id">
                <!-- <router-link :to="profile_uri(user.id)">{{user.name}}</router-link> -->
                <a href="" @click.prevent="lihatuser(user.id)">{{user.name}}</a>
            </li>
        </ul>
    </section>
    </div>
</template>

<script>
export default {   
    data() {
        return{
            users:[],           
        }
    },
    mounted() {
        this.getUsers()
    },
    methods:{
        getUsers(){
            axios.get('/api/users').then((response)=>{
            this.users = response.data           
        })
        },       
        profile_uri(id){
            return '/user/'+id
        },
        lihatuser(id){
            this.$router.push({
                name:'DetailUser',
                params: {id}
            })
        }
    }
}
</script>
