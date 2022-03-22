<template>
    <div>
    <section>
        <h1>Hallo {{ detailUser.name }}</h1>
        <h3> Email:  {{detailUser.email}}</h3>
        <router-link :to="{name: 'User'}">Kembali</router-link>
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
            axios.get('/api/users/'+ this.id).then((response)=>{   
            this.detailUser = response.data
        })
        }
    }
}
</script>
