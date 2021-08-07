<template>
<div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
  <div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Create Job opportunity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
     <div class="card-body">
        <form @submit.prevent="ajouterJob()">

             <div class="form-group">
                <label for="salary">Internal Reference</label>
                <input v-model="form.internal_reference" type="text" id="internal_reference"  class="form-control" value="" required>
                <has-error :form="form" field="internal_reference"></has-error>
            </div>
            
            <div class="form-group ">
                <label for="title">title</label>
                <input v-model="form.title" type="text" id="title"  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }"
           required>
              <has-error :form="form" field="title"></has-error>
            </div>
                      <div>
                  <label>Expiry Date</label> <br>
                  
            <date-picker v-model="form.expiry_date" valueType="format"></date-picker> 
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
                <textarea v-model="form.description" id="description"  class="form-control"
                :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                 <has-error :form="form" field="description"></has-error>
            </div>
            <div class="form-group">
                <label for="requirements">requirements</label>
                <textarea v-model="form.requirements" id="requirements"  class="form-control"
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
                <input v-model="form.salary" type="text" id="salary"  class="form-control" value="" required>
                <has-error :form="form" field="salary"></has-error>
            </div>
              <div class="form-group">
                <label for="salary">Required years of experience</label>
                <input v-model="form.experience" type="text" id="salary"  class="form-control" value="" required>
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
                     
              AuthStr : localStorage.getItem('membre_token'),
            
       form : new Form({
        id:'',
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


         created(){

      this.afficherCompanies();
      this.afficherLocations();
      this.afficherCategories();
      this.afficherContracts()

                       },
           methods:{
          
               ajouterJob(){
                
                this.form.post("api/job").then(()=>this.form.post('api/categoryjob').then(()=>{
                fire.$emit('ajoutjob');
             
                this.form.reset();
                Toast.fire({
                        icon: 'success',
                        title: 'Job Added'

                }),
                 setTimeout(() => {
                    window.location.href = '/job'
                }, 1000)

                }).catch((response)=>{ console.log(response);


                 }));
                    },

                     afficherLocations(){
                              let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                   axios.get('api/joblocation',axiosConfig).then(({data})=>(this.locations = data));

               },
               
                    afficherCategories() {
                             let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                axios.get("api/jobcategory",axiosConfig).then(({ data }) => (this.categories = data));
                       },
                   afficherCompanies(){
                            let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                axios.get("api/jobcompany",axiosConfig).then(({ data }) => (this.companies = data));

                   },
                     afficherContracts(){
                axios.get("api/jobcontract").then(({ data }) => (this.contracts = data));
                   },


                      },
                        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
            
           }

    
</script>
