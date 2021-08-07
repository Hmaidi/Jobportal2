<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Job offer details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Job details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5> Title: <span class="text-muted well well-sm shadow-none"> {{jobs.job.title}} </span> </h5>
            </div>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                   
                  Internal Reference : <small class="text-muted well well-sm shadow-none"> {{jobs.job.internal_reference}} </small> <small class="float-right">{{jobs.job.status}}</small>
                  </h4>
                  <hr>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <strong>Company</strong><br>
                <p class="text-muted well well-sm shadow-none" v-for="companie in companies.companie.data" :v-if="companie.job_id == key" :key="companie.id" > {{companie.name}}</p>
                
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  
                  
                    <strong>Location</strong><br>
                    
                     <p class="text-muted well well-sm shadow-none" v-for="location in locations.location.data" :v-if="location.job_id == key" :key="location.id" > {{location.name}}</p>
                     <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Contract type</b>
                  <br>
                <p class="text-muted well well-sm shadow-none" v-for="contract in contracts.contract.data" :v-if="contract.job_id == key" :key="contract.id" > {{contract.name}}</p>
               <br>
                </div>
                
                <!-- /.col -->
              </div>
           
             
              <!-- /.row -->

              <div class="row">
                <div class="col-6">
                  <p class="lead">Description</p>
                 

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
               {{jobs.job.description}}
                  </p>
                </div>
            
                <div class="col-6">
                   <p class="lead">Requirements</p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
               {{jobs.job.requirements}}
                  </p>
                
                </div>
               
              </div>
             
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" style="float: right; color: blue; backgroung-color: grey;" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                </div>
              </div>
            </div>
           

          </div>
        </div>
      </div>
    </section>
           </div>
        </div>
    </div>
    
</template>
<script>
    export default {
      data(){
            return{
               key: this.$route.params.id,
                AuthStr : localStorage.getItem('membre_token'),
                jobs:{
                    job:{}
                },
                   categories:{
               categorie:{}
           },
          companies:{
               companie:{}
           },
           locations:{
               location:{}
           },
           contracts:{
              contract:{},
          },
                 user:JSON.parse(localStorage.getItem('user')),

            }
        },

               methods:{
           
              
                   afficherJob(){
                   
                    axios.get('/api/getjob/'+this.key).then(({ data }) =>(this.jobs = data));
                   },
                     afficherLocations(){
                  
                   axios.get('/api/getlocation/'+this.key).then(({data})=>(this.locations = data));

               },
               
                    afficherCategories() {
                    
                 axios.get('/api/getcategory/'+this.key).then(({ data }) => (this.categories = data));
                       },
                   afficherCompanies(){
                    
                axios.get('/api/getcompany/'+this.key).then(({ data }) => (this.companies = data));

                   },
                       afficherContracts(){
                axios.get('/api/getcontract/'+this.key).then(({ data }) => (this.contracts = data));
                   },
               },
  
       /*   created(){
         
                 this.afficherJob();
                this.afficherCompanies();
                this.afficherLocations();
                this.afficherCategories();
  },*/
         
                  computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        mounted() {
               this.afficherJob();
               this.afficherCompanies();
                this.afficherLocations();
               this.afficherCategories();
              this.afficherContracts()
},
            
           }
</script>
