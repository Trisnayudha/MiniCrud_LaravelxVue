<template>
    <div>
    <section>
        <h1>Hallo {{ detailUser.name }}</h1>
        <h3> Email:  {{detailUser.email}}</h3>
        <router-link :to="{name: 'User'}">Kembali</router-link>
        <a href="" @click.prevent="handlingDelete()"> Delete</a>
        <a href="" @click.prevent="handlingEdit()"> Edit </a>
    </section> 
    </div>
</template>

<script>
export default {
    props: ['id'],
    data() {
        return{
            detailUser:{}
        }
    },
    watch:{
    '$route':'getUser'
    },
    mounted() {
        this.getUser()
    },
    methods:{
        getUser(){
            axios.get('/api/users/'+ this.id).then((response) => {    
            this.detailUser = response.data
        })
        },
        handlingDelete(){
            if(confirm('Apakah anda yakin menghapus data ini?')){
                axios.delete('/api/users/' + this.id).then((response) => {
                    if(response.data.status){
                this.$noty.success(response.data.message)
                   this.$router.push({
                       name: 'User'
                    })
                }
                }).catch((error) => {
                    console.log(error)
                })
            }else{
                return false;
            }
        },
        handlingEdit(){
             this.$router.push({
                name:'EditUser',
                params: {id: this.id}
            })
        }
    }
}
</script>
