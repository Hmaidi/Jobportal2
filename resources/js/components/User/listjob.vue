<template>
<div>
        <div class="banner-area">
          
           
          
         
        <div class="select-list">
            <form action="enhanced-results.html">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                   
                                 
                                       <select @click="searchwithlocation()"  id="location" class="form-control"  data-placeholder="Any" style="width: 100%;"
                 v-model="location_id" >
                    <option value="" disabled selected>Select Location</option>
        <option  v-for ="(location , index) in locations.locations.data" :key="index" v-bind:value="location.id">{{ location.name }}</option>
                  
                </select>
                                   
                                </div>


                            </div>
                            <div class="col-3">
                                <div class="form-group">
                        
                <select @click="searchwithcategorie()" v-model="categorie_id" name  id="categories" class="form-control" 
                >
                   <option value="" disabled selected>Select Competency center</option>
        <option  v-for ="(categorie , index) in categories.categories.data" :key="index" v-bind:value="categorie.id">{{ categorie.name }}</option>
                
                </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                     
                <select @click="searchwithcontract()" v-model="contract_id"  name  id="contract_id" class="form-control" 
                  >
                   <option value="" disabled selected>Select type</option>
       <option  v-for ="(contract , index) in contracts.contracts.data" :key="index" v-bind:value="contract.id">{{ contract.name }}</option>  
                
                </select> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" v-model="searche"  @keyup="search" placeholder="Type your keywords here" >
                                <div class="input-group-append">
                                    <button style="background-color: white" type="submit" @click.prevent="search" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div class="content-area">
          <div class="wrapper">
            <h2><b>Job Opportunities</b></h2>
              <!--div class="col-lg-8 post-list"-->
    
        <div  v-for="job in jobs.jobs.data" :key="job.id">
            <div class="job">
                <div >
                   
                        <router-link :to="`/jobdetail/${job.id}`"> <h4 style="color: rgb(70,130,180);">{{ job.title }}</h4> </router-link>
                			
                   
                </div>
                
                 <strong > Description  : </strong> <br>
                
                  <span >  {{ job.description }} </span>  <br>        
               <span >   <strong> requirements: </strong>   {{ job.requirements}}  </span>  <br>
                
                
                    
            </div>
        
        </div>
 

    <a class="text-uppercase loadmore-btn mx-auto d-block" href="">Load More Job Posts</a>

      
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
