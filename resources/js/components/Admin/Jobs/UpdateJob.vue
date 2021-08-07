<template>
<div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
  <div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Update Job opportunity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
     <div class="card-body">
        <form @submit.prevent="UpdateJob()">

             <div class="form-group">
                <label for="salary">Internal Reference</label>
                <input @click="fillform()" v-model="form.internal_reference"  type="text" id="internal_reference"  class="form-control" value="" required>
                <has-error :form="form" field="internal_reference"></has-error>
            </div>
            
            <div class="form-group ">
                <label for="title">title</label>
                <input @click="fillform()" v-model="form.title" type="text" id="title"  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }"
           required>
              <has-error :form="form" field="title"></has-error>
            </div>
                      <div>
                  <label>Expiry Date</label> <br>
                  
            <date-picker @click="fillform()" v-model="form.expiry_date" valueType="format"></date-picker> 
             </div>
                  <br>
            <div class="form-group">
                <label for="company">company</label>
                <select v-model="form.company_id"  id="company" class="form-control select2" 
                :class="{ 'is-invalid': form.errors.has('company_id') }" required>
                   <option value="" disabled selected>Select Company</option>
        <option v-for ="(companie , index) in companies.companie.data" :key="index" v-bind:value="companie.id">{{ companie.name }}</option>
                </select>
           <has-error :form="form" field="company_id"></has-error>
            </div>
            <div class="form-group">
                <label for="full_description">Description</label>
                <textarea @click="fillform()" v-model="form.description" id="description"  class="form-control"
                :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                 <has-error :form="form" field="description"></has-error>
            </div>
            <div class="form-group">
                <label for="requirements">requirements</label>
                <textarea @click="fillform()" v-model="form.requirements" id="requirements"  class="form-control"
                :class="{ 'is-invalid': form.errors.has('requirements') }"></textarea>
              <has-error :form="form" field="requirements"></has-error>
            </div>
  
            <div class="form-group">
                <label for="location">Location</label>
                <select v-model="form.location_id"  id="location" class="form-control" 
                :class="{ 'is-invalid': form.errors.has('location') }" required>
                    <option value="" disabled selected>Select Location</option>
        <option v-for ="(location , index) in locations.location.data" :key="index" v-bind:value="location.id">{{ location.name }}</option>
                  
                </select>
         <has-error :form="form" field="location"></has-error>
            </div>
            <div class="form-group">
                <label for="categories">Competency center</label>
                <select v-model="form.categories" name  id="categories" class="form-control" 
                 :class="{ 'is-invalid': form.errors.has('categories') }" multiple="multiple">
                   <option value="" disabled selected>Select Competency center</option>
        <option v-for ="(categorie , index) in categories.categorie.data" :key="index" v-bind:value="categorie.id">{{ categorie.name }}</option>
                
                </select>
             <has-error :form="form" field="categories"></has-error>
            </div>
             <div class="form-group">
                <label for="categories">Contract Type</label>
                <select v-model="form.contract_id" name  id="contract_id" class="form-control" 
                 :class="{ 'is-invalid': form.errors.has('contract_id') }" >
                   <option value="" disabled selected>Select type</option>
        <option v-for ="(contract , index) in contracts.contract.data" :key="index" v-bind:value="contract.id">{{ contract.name }}</option>
                
                </select>
             <has-error :form="form" field="contract_id"></has-error>
            </div>
             <div class="form-group">
                <label for="salary">salary</label>
                <input @click="fillform()" v-model="form.salary" type="text" id="salary"  class="form-control" value="" required>
                <has-error :form="form" field="salary"></has-error>
            </div>
              <div class="form-group">
                <label for="salary">Required years of experience</label>
                <input @click="fillform()" v-model="form.experience" type="text" id="salary"  class="form-control" value="" required>
                <has-error :form="form" field="experience"></has-error>
            </div>
   
            <div>
                <input class="btn btn-danger" type="submit" value="submit">
            </div>
        </form>
            </div>
            
            </div>
          
           </div>
        </div>
</div>
  
</template>
<script>  
 import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';

    export default {
         components: { DatePicker },
      data(){
            return{
               key: this.$route.params.id,
                AuthStr : localStorage.getItem('membre_token'),
                jobs:{
                    job:{}
                },
                   form : new Form({
       // id:'',
        title:'',
        salary:'',
        company_id:'',
        location_id:'',
        requirements:'',
        description:'',
        categories:[],
        expiry_date:'',
        internal_reference:'',
        contract_id:'',
        expiry_date:'',
        experience:'',
       }),
               
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
           
                UpdateJob(){
                
                this.form.put('/api/job/'+this.key).then(()=>{
                fire.$emit('ajoutjob');
             
                this.form.reset();
                Toast.fire({
                        icon: 'success',
                        title: 'Job Updated'

                }),
                 setTimeout(() => {
                    window.location.href = '/job'
                }, 1000)

                }).catch((response)=>{ console.log(response);


                 });
                    },
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
               
               fillform(){
                 this.form.fill(this.jobs.job);
               }
  },
         created(){
    
              
  },
         
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
              this.afficherContracts();
              
},
            
           }

    
</script>
