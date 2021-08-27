<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
          


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Job Applications</h3>
                <div class="card-tools">
    
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
                    <th>Job </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Resume </th>
             
                    
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="application in applications.applications.data"  :key="application.id">
                    <td v-for="job in jobs.jobs.data" v-if="job.id == application.job_id"  :key="job.id"> {{job.title}} </td>
                    <td v-for="user in users.users.data" v-if="user.id == application.user_id" :key="user.id">{{ user.name }}</td>
                    <td v-for="user in users.users.data" v-if="user.id == application.user_id" :key="user.id">{{ user.email}} </td>
                   
                <td> <a href="" class="btn-link text-secondary"><a v-for="file in files.files.data" v-if="file.type == 'resume' && application.file_id == file.id" :key="file.id" style="text-decoration:none; color:black;"  :href="`/upload/${file.ref}`" target="_blank">
                   <i class="fas fa-file-alt"></i>{{ file.ref }}</a></a>
                    </td>
                    
                  
                  </tr>
                  </tbody>
               
                </table>
              </div>
              <!-- /.card-body -->
            </div>


             </div>
               <pagination :data="applications.applications" @pagination-change-page="getResults"></pagination>
            </div>
            
               <!-- Modal -->

        </div>
    
</template>
<script>

    export default {
 data(){
            return{
               
                applications:{
                    applications:{}
                },
                searche:'',

                users:{
                    users:{}
                },
                jobs:{
                    jobs:{}

                },
                files :{
               files:{},
             },
                 user:JSON.parse(localStorage.getItem('user')),

            }
        },

               methods:{
                     search(){
                fire.$emit('search');
            },

                
            
            
                getResults( page = 1) {
      		     	axios.get('api/application?page=' + page)
				         .then(response => {
				       this.companies = response.data;
                    });
                  },
                   afficherApplications(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('/api/application',axiosConfig).then(({ data }) =>(this.applications = data));
                   },
       
                     afficherUsers(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('/api/users',axiosConfig).then(({ data }) =>(this.users = data));
                   },

                   
                     afficherjobs(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('/api/job',axiosConfig).then(({ data }) =>(this.jobs = data));
                   },
        
         
             },
             created(){
                 fire.$on('search',()=>{
            let query = this.searche;
            axios.get('/api/searchapplication?s='+query).then(({ data }) =>(this.companies = data)).catch(()=>{
            })
            }),
                 this.afficherApplications();
               this.afficherUsers();
               this.afficherjobs();
           axios.get('/api/files').then(({data}) => {this.files =data});

             },
              computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },

    }
</script>
