<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
          


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Jobs</h3>
                <div class="card-tools">
             <router-link to="/createjob" class="btn btn-success ml-6 mb-3"> <i class="fas fa-user-md"></i> New Opening  </router-link>
                </div>
                           <div class="form-inline ml-3" style="float:right; border-radius: 20px;">
                  <div class="input-group input-group-sm">
                 <input class="form-control form-control-navbar" v-model="searche" type="search" @keyup="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
              <button class="btn btn-navbar"  @click.prevent="search" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped ">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Internal Reference</th>
                    <th> Title </th>
                    <th> Expiration date </th>
                    <th> Status </th>
                    <th> &nbsp; </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="job in jobs.jobs.data" :key="job.id">
                    <td>{{ job.id }}</td> 
                    <td> {{job.internal_reference}} </td>
                    <td> {{job.title}} </td>
                    <td> {{ job.expiry_date }} </td>
                    <td>
                               <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                          <img :src="`/img/icon/status.png`" style="width: 25px;">
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                       <li> <a class="dropdown-item" href="#" 
                         @click="Status(job.id,'Draft')">  <span> Draft </span> </a>
                         <a class="dropdown-item" href="#" 
                         @click="Status(job.id,'Active')">  <span> Active </span> </a>
                         <a class="dropdown-item" href="#" 
                         @click="Status(job.id,'Closed')">  <span> Closed </span> </a>
                         
                        </li>
                        </ul>
                        &nbsp; {{job.status}}
                    </div> 
                     </td>
                    <td> <router-link :to="`/updatejob/${job.id}`"  style="background-color: #00a8cc"  class="btn "> <i style="color: #fff" class="fas fa-user-edit"></i></router-link>
                 <a href="#" class="btn btn-danger"  @click="deleteJob(job.id)"  ><i      class="fas fa-trash-alt"></i></a>
                 <router-link :to="`/viewjob/${job.id}`" :title="job.tit" style="background-color: #00a8cc"  class="btn ">  <i class="fas fa-eye"></i> </router-link>  
                 <a href="#" class="btn btn-info" style="background-color: #00a8cc"  @click="chargerid(job.id)"> <i class="fas fa-plus-circle"></i> New Field </a> </td>
                  </tr>
                  </tbody>
               
                </table>
              </div>
              <!-- /.card-body -->
            </div>


             </div>
               <pagination :data="jobs.jobs" @pagination-change-page="getResults"></pagination>
            </div>
            
                  <form @submit.prevent="ajouterField()">
<div class="modal fade" id="AjouterField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Field:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
      <label>Name of field <span style="color: red;">*</span></label>
      <input v-model="form.field" type="text" name="field"
        class="form-control" :class="{ 'is-invalid': form.errors.has('field') }">
      <has-error :form="form" field="field"></has-error>
    </div>
                 <div class="form-group">
                <label >Type <span style="color: red;">*</span></label>
                <select v-model="form.type" name  id="type" class="form-control" 
                 :class="{ 'is-invalid': form.errors.has('type') }" >
                   <option value="" disabled selected>Select type</option>
        <option value="input">Input</option>
        <option value="Textarea">Textarea</option>
        <option value="checkbox"> checkbox </option>
        
                
                </select>
             <has-error :form="form" field="type"></has-error>
            </div>
             <div class="form-group">
                <label >Position</label>
            <input v-model="form.position" type="number" name="position"
        class="form-control" :class="{ 'is-invalid': form.errors.has('position') }">
             <has-error :form="form" field="position"></has-error>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class=" btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
    
</template>
<script>

    export default {
 data(){
            return{
                AuthStr : localStorage.getItem('membre_token'),
                jobs:{
                    jobs:{}
                },
                searche:'',

                 user:JSON.parse(localStorage.getItem('user')),

                form : new Form({
                id:'',
                field:'',
                type:'',
                position:'',
                }),
                key:'',
                
            }
        },

               methods:{
                     search(){
                fire.$emit('search');
            },
               
                 ajouterField(){
                            let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                            };
                            this.form.id=this.key;
                this.form.post('/api/formsfield/'+this.key,axiosConfig).then(()=>{
                    this.form.reset();
                fire.$emit('ajoutcompanie');
                $("#AjouterField").modal('hide');
                Toast.fire({
                        icon: 'success',
                        title: 'Field Added'
                        })
                }).catch(()=>{
                });
               },
                chargerid($id){
                     this.key=$id;
                        this.form.reset();
              $("#AjouterField").modal('show')
               },
           Status($id,$status){
             axios.post('/api/status/'+$id+'/'+$status).then(()=>{
                 fire.$emit('ajoutjob');
                Toast.fire({
                        icon: 'success',
                        title: 'Status changed successfully'
                        })
                }).catch(()=>{
                });
            },
                   
                 deleteJob(id){
             seww.fire({
            title: 'Are you sure?',
            text: "You will not be able to go back!",
            icon: 'warning',

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete!'
            }).then((result) => {
           if(result.value){
              let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.delete('api/job/'+id,axiosConfig).then(function(){

                    seww.fire(
                    'Delete!',
                    'job deleted.',
                    'success'
                    )

             fire.$emit('ajoutjob');

                }).catch(()=>{
                    seww.fire(
                    'Failure !!!!'


                    );
                });
           }
                })
            },
                getResults( page = 1) {
      		     	axios.get('api/job?page=' + page)
				         .then(response => {
				       this.jobs = response.data;
                    });
                  },
                   afficherJob(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('api/job',axiosConfig).then(({ data }) =>(this.jobs = data));
                   },
                
                           },

             created(){
                 fire.$on('search',()=>{
            let query = this.searche;
            axios.get('/api/searchc?s='+query).then(({ data }) =>(this.jobs = data)).catch(()=>{
            })
            }),
                 this.afficherJob();
                 fire.$on('ajoutjob',()=>{
                     this.afficherJob();
                 });
        


             },
         
                  computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
    }
</script>
