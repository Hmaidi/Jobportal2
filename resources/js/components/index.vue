<template>
  <div class="global">
    
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                  <router-link to="/listjob"><b>Machinestalk</b></router-link>
                </div>
                <nav>
                    <router-link   v-if="!currentUser" to="/login"> Login </router-link> 
                  <router-link v-if="!currentUser" to="/register"> Register</router-link>

                  <router-link v-if="currentUser" :to="`/profile/${currentUser.id}`">Dashbord</router-link>
                  <a href="#!" v-if="currentUser" @click.prevent="logout" > Logout  </a>
                 
                </nav>
            </div>
        </header>
    <div>
    <router-view> </router-view>
    </div>
    </div>
   
  </div>
</template>

<style scoped>
.job {
  border: 0.5px solid rgb(155, 151, 151);
  box-shadow: 2px 2px 5px rgb(128, 125, 125);
  padding: 8px 12px;
  margin: 3% ;
  border-radius: 30px;
  text-align: center;
  width: 70%;
  position: relative;
  margin-left: 15%;
}
select {
    background-color: rgba(214, 247, 240, 0.493);
    color: white;
    font: bold;
}
option {
    background-color: rgba(214, 247, 240, 0.493);
    color: black;
    font: bold;
}
input {
    background-color: rgba(214, 247, 240, 0.493);
    color: white;
    font: bold;
}
::placeholder {
    color: white;
    font: bold;
}
.global {
	text-align: center;
  
}
.wrapper {
	width: 1170px;
	margin: 0 auto;
    text-align: center;
    justify-content: center;
    align-items: center;

}

header {
	height: 100px;
	background: rgb(14, 2, 80);
	width: 100%;
	z-index: 10;
	position: fixed;
}

.logo {
	width: 30%;
	float: left;
	line-height: 100px;
}
.logo a {
	text-decoration: none;
	font-size: 30px;
	font-family: poppins;
	color: #fff;
	letter-spacing: 5px;
}
nav {
	float: right;
	line-height: 100px;
}
nav a {
	text-decoration: none;
	font-family: poppins;
	letter-spacing: 4px;
	font-size: 20px;
	margin: 0 10px;
	color: #fff;
}
.banner-area {
	width: 100%;
	height: 550px;
	position: absolute;
	top: 100px;
    background-image:url(/img/banner-3.jpg);
    /*background-image: url(https://i.postimg.cc/T3B3WFcv/2.jpg);*/
	-webkit-background-size: cover;
	background-size: cover;
	background-position: center center;
    justify-content: center;
    align-items: center;
    text-align: center;
    
}
.select-list {
    margin-top: 18%;
}
.banner-area h2 {
	padding-top: 8%;
	font-size: 70px;
	font-family: poppins;
	text-transform: uppercase;
	color: #fff;
}
.lien:hover{
    color: rgb(12, 187, 149);
}
.content-area {
	width: 100%;
	position: absolute;
	top: 450px;
	background: white;
	height: 1500px;
    justify-content: center;
     
}
.content-area h2 {
	font-family: poppins;
	letter-spacing: 4px;
	padding-top: 30px;
	font-size: 40px;
	
}
.content-area p {
	padding: 2% 0px;
	font-family: poppins;
	line-height: 30px;
}

</style>

<script>
    export default {
 data(){
            return{
              searche:'',
                jobs:{
                    jobs:{}
                },
               categories:{
               categories:{}
           },
          companies:{
               companies:{}
           },
           locations:{
               locations:{}
           },
        
          contracts:{
              contracts:{},
          },
        
      location_id:'',
      categorie_id:'',
      contract_id:'',

             
                
            }
        },

               methods:{
                         search(){
                fire.$emit('search');
            },
      
                   afficherJob(){
                    axios.get('/api/indexjob').then(({ data }) =>(this.jobs = data));
                   },
                  afficherLocations(){
                   
                   axios.get('api/indexlocation').then(({data})=>(this.locations = data));

               },
                    afficherCategories() {
                 
                axios.get("api/indexcategory").then(({ data }) => (this.categories = data));
                       },
                   afficherCompanies(){
                   
                axios.get("api/indexcompany").then(({ data }) => (this.companies = data));

                   },
                     afficherContracts(){
                axios.get("api/indexcontract").then(({ data }) => (this.contracts = data));
                   },

                  searchwithcategorie(){
                      fire.$emit('searchcategorie');
                     
                  },
                  searchwithlocation(){
                        fire.$emit('searchlocation');
               
                  },
                  searchwithcontract(){
                        fire.$emit('searchcontract');
                  
                  },
                          logout() {
                this.$store.commit('logout');
                this.$router.push('/listjob');
            },
                           },

             created(){
                  fire.$on('search',()=>{
         let query = this.searche;
            axios.get('/api/searchjob?s='+query).then(({ data }) =>(this.jobs = data)).catch(()=>{
            })
            }),
                   fire.$on('searchlocation',()=>{
            
            axios.get('api/searchwithlocation/'+this.location_id).then(({ data }) =>(this.jobs = data)).catch(()=>{
            })
            }),
                   fire.$on('searchcategorie',()=>{
       
            axios.get('api/searchwithcategorie/'+this.categorie_id).then(({ data }) =>(this.jobs = data)).catch(()=>{
            })
            }),
                   fire.$on('searchcontract',()=>{
       
            axios.get('api/searchwithcontract/'+this.contract_id).then(({ data }) =>(this.jobs = data)).catch(()=>{
            })
            }),
           this.afficherJob();
           this.afficherCompanies();
           this.afficherLocations();
           this.afficherCategories();
           this.afficherContracts();
  
  
             },
                  computed: {
            currentUser() {
                return this.$store.getters.currentUser
                
            }
        },
       
    }
</script>
