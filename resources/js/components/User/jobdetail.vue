<template>
  <div class="global">
    
    <div class="box-area">
    
        <div class="banner-area">
                
                  <center>  <h2>{{ jobs.jobs.title }}</h2> </center>	
                
                </div>
        
        </div>
        <div class="content-area">
            
          <div class="wrapper">
            
              <div class="col-lg-8 post-list">
    
        <div class="single-post d-flex flex-row" >

            <div class="details">
           <br>
                <strong style="float: left;"> Description  : </strong> <br>
                
                  <span style="float: left;">  {{ jobs.jobs.description }} </span>  <br>
                
                
                
               <span style="float: left;">     <strong> salary :  </strong> {{ jobs.jobs.salary}}  </span><br> 
                  
                
                   
               <span style="float: left;">   <strong> Requirements: </strong>   {{ jobs.jobs.requirements}}  </span>  <br>
                 <span style="float: left;" v-for="location in locations.locations.data" v-if="location.id == jobs.jobs.location_id" :key="location.id">   <strong> Location: </strong>   {{ location.name}}  </span>  <br>
                   <span style="float: left;" v-for="companie in companies.companies.data" v-if="companie.id == jobs.jobs.company_id" :key="companie.id">   <strong> Companie:   </strong>   {{companie.name}}  </span>  <br>
                     <span style="float: left;" v-for="contract in contracts.contracts.data" v-if="contract.id == jobs.jobs.contract_id" :key="contract.id" >   <strong> Contract Type: </strong>   {{ contract.name}}  </span>  <br>
                       <span style="float: left;">   <strong> Expiration date: </strong>   {{ jobs.jobs.expiry_date}}  </span>  <br>
            </div>
        </div>
 

    <!--router-link :to="`/formapplication/${this.key}`"  class="text-uppercase loadmore-btn mx-auto d-block">Apply</router-link-->
    <a  @click="onLinkClicked()" class="text-uppercase loadmore-btn mx-auto d-block">Apply</a>
</div>
      
          </diV>
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
       
   

             key: this.$route.params.id,
                
            }
        },

               methods:{
                         search(){
                fire.$emit('search');
            },
      
                       afficherJob(){
                   
                    axios.get('/api/getindexjob/'+this.key).then(({ data }) =>(this.jobs = data));
                   
                   },
                  afficherLocations(){
                   
                   axios.get('/api/indexlocation').then(({data})=>(this.locations = data));

               },
                    afficherCategories() {
                 
                axios.get("/api/indexcategory").then(({ data }) => (this.categories = data));
                       },
                   afficherCompanies(){
                   
                axios.get("/api/indexcompany").then(({ data }) => (this.companies = data));

                   },
                     afficherContracts(){
                axios.get("/api/indexcontract").then(({ data }) => (this.contracts = data));
                   },
                   onLinkClicked() {
                       
    if(!this.$store.getters.currentUser) {
          this.$router.push({ path: '/login', query: { redirect: '/formapplication/'+this.key } });    
    }
    else {
         this.$router.push('/formapplication/'+this.key ); 
    }
          

                           },
               },

             created(){
   
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
