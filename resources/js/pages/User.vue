<template>
    <div>
    <section v-if="name">
        <h1>Hallo {{ name }}</h1>
        <router-link :to="{name: 'User'}">Kembali</router-link>
    </section>
    <section v-else>
        <h1>Daftar List Pengguna</h1>
        <ul>
            <li v-for="user in users" :key="user.id">
                <router-link :to="profile_uri(user.name)">{{user.name}}</router-link>
            </li>
        </ul>
    </section>

    </div>

</template>

<script>
export default {
    props: ['name'],
    data() {
        return{
            users:[
                {id:1,name:'Asep'},
                {id:2,name:'Cecep'},
                {id:3,name:'Batagor'},
            ]
        }
    },
    methods:{
        profile_uri(name){
            return '/user/'+name
        }
    }
}
</script>
