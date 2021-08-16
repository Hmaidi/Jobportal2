<template>
<div class="container">
<section class="content mt-4">



</section>
</div>
</template>
<script>
export default {
data(){
return{
id: this.$route.params.id,

user:JSON.parse(localStorage.getItem('user')),



}

},
created(){



},
methods:{


},
computed: {
currentUser() {
return this.$store.getters.currentUser
}
},
mounted() {
console.log('Component mounted.')
}
}
</script>