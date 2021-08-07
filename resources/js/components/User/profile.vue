<template>
 <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12"  >
             <div class="content-wrapper"  style="min-height: 1416.81px; margin-left:50px;">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6" >
            <ol class="breadcrumb float-sm-right">
          
              <li class="breadcrumb-item"><router-link to="/home" >Home</router-link></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="row">

        <div class="col-md-3"   v-for="user in users.users.data"  v-if=" user.id == key "  :key="user.id">


            <!-- Profile Image -->
            <div class="card card-primary card-outline"  >
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="`/img/profile/${ user.photo }`"   alt="User profile picture" >
                </div>
                  <h3 class="profile-username text-center"> {{user.name}} </h3>


                <ul class="list-group list-group-unbordered mb-3">
             
                </ul>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary" >
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <strong><i class="fas fa-phone mr-1"></i>phone</strong>

                <p class="text-muted">
                <strong>  {{user.phone}}  </strong>
                </p>

                <hr>
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  <strong>   {{user.education }} </strong>

                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">
                 <strong>  {{user.address}}   </strong>
                </p>
                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                     <strong>   {{user.skills}}  </strong>

                  <span class="tag tag-danger"></span>

                </p>

                <hr>


              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
            
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#infos" data-toggle="tab">My information</a></li>
                  <li class="nav-item"><a class="nav-link" href="#resume" data-toggle="tab">My resumes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#diploma" data-toggle="tab">My diplomas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#credentials" data-toggle="tab">My credentials</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                     <div class="active tab-pane" id="infos">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input v-model="form.name" type="email" class="form-control" id="inputName" 
                          placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                          
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input v-model="form.skills" type="text" class="form-control" id="inputSkills"
                           placeholder="Skills" :class="{ 'is-invalid': form.errors.has('skills') }">
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input v-model="form.address" type="text" class="form-control" id="inputAddress" 
                          placeholder="Address" :class="{ 'is-invalid': form.errors.has('address') }">
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input v-model="form.phone" type="number" class="form-control" id="inputPhone" 
                          placeholder="Phone" :class="{ 'is-invalid': form.errors.has('phone') }">
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="inputEducation" class="col-sm-2 col-form-label">Education</label>
                        <div class="col-sm-10">
                          <input v-model="form.education" type="text" class="form-control" id="inputEducation" placeholder="Education"
                          :class="{ 'is-invalid': form.errors.has('education') }">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                      <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                      <div class="col-sm-10">
                      <input type="file"  name="photo"   @change="updateProfile" class="form-input" :class="{ 'is-invalid': form.errors.has('photo') }" >
                      </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button  @click.prevent="updateInfo" type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                     <div class="tab-pane" id="credentials">
                    <form class="form-horizontal">
                
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                         <input v-model="form.email" id="email" type="email" name="email" placeholder="Email"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                  
                        </div>
                        
                      </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                         <div class="col-sm-10">
                            <input v-model="form.password" id="password" type="password" name="password" placeholder="password"
                             class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                  
                         </div>
                        </div>
        
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>

                          <div class="tab-pane" id="resume">
                
                        <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
               <div class="form-group row">
               <form  @submit="formSubmit" enctype="multipart/form-data">
                 <label for="name">Name resume</label>
                   <input v-model="form.resume" id="name" class="form-control" type="text" name="name">
                 <div class="input-group mt-2"><div class="custom-file"><input type="file" v-on:change="onFileChange" name="file"  class="custom-file-input"> <label for="exampleInputFile" class="custom-file-label">
                     Choose file:</label></div></div>
                      <button class="btn btn-success mt-2">Submit</button>
               </form>
      </div>
      </div>
      </div>
      
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Resume list</h3>
              </div>
             
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Resume</th>
                      <th></th>
                      <th style="width: 40px">Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="file in files.files" v-if="file.type == 'resume'" :key="file.id" >
                      <td>{{ file.id }}</td>
                      <td>{{ file.name}}</td>
                      
                      <td>
                             <div  >
              <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><a style="text-decoration:none; color:black;"  :href="`/upload/${file.ref}`" target="_blank">
                   <i class="fas fa-file-alt"></i>{{ file.ref }}</a></a>
                </li>
              </ul>
              </div>
                      </td>
                      <td><a href="#" class="btn btn-danger" @click="deletefile(file.id)" ><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
         
            </div>
                    
                  </div>
        <div class="tab-pane" id="diploma">
                
                        <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
               <div class="form-group row">
               <form  @submit="formSubmitdiploma" enctype="multipart/form-data">
                 <label for="name">Name diplomas</label>
                   <input v-model="form.diploma" id="name" class="form-control" type="text" name="name">
                 <div class="input-group mt-2"><div class="custom-file"><input v-on:change="onFileChange" type="file" name="file"  class="custom-file-input"> <label for="exampleInputFile" class="custom-file-label">
                     Choose file:</label></div></div>
                      <button  class="btn btn-success mt-2">Submit</button>
               </form>
      </div>
      </div>
      </div>
                              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Diploma list</h3>
              </div>
             
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Diploma</th>
                      <th></th>
                      <th style="width: 40px">Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="file in files.files" v-if="file.type == 'diploma'" :key="file.id" >
                      <td>{{ file.id }}</td>
                      <td>{{ file.name}}</td>
                      
                      <td>
                             <div  >
              <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><a style="text-decoration:none; color:black;"  :href="`/upload/${file.ref}`" target="_blank">
                   <i class="fas fa-file-alt"></i>{{ file.ref }}</a></a>
                </li>
              </ul>
              </div>
                      </td>
                      <td><a href="#" class="btn btn-danger" @click="deletefile(file.id)" ><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
         
            </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
    </div>
             </div>
            </div>
        </div>
 </div>
</template>

<script>
    export default {
  data(){
   return{
   form : new Form({
        name:'',
        address:'',
        eucation:'',
        photo:'',
        skills:'',
        email:'',
        phone:'',
        password:'',
        resume:'',
        diploma:'',

       }),
          file:{
                name:'',
                id:'',
                type:'',
                ref:'',
              },
             files :{
               files:{},
             },
    key : this.$route.params.id,
            
                 users:{
                  users:{},
              },
              User1:JSON.parse(localStorage.getItem('user')),
  
   }
  },
        methods:{
          afficherMembre(){
            let axiosConfig = {

                    headers: {
                    "Authorization": 'Bearer '+this.User1['token']
                    }
            };
                   axios.get('/api/users',axiosConfig).then(({ data }) =>(this.users = data));
              },
             getProfilePhoto(){

                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            },

          updateInfo(){
            this.form.put('/api/profile')
                .then(()=>{
                    fire.$emit('ajoutprofile');
                    this.form.reset();

                  Toast.fire({
                         icon: 'success',
                        title: 'Profile Updated'

                });
                location.reload();
                 })
                .catch(() => {
                                   });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swett({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large photo',
                    })
                    return false;
                }

                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            },
       onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
                 
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.file);
                    let axiosConfig = {

                    headers: {
                    "Authorization": 'Bearer '+this.User1['token']
                    }
            };
                axios.post('/api/formSubmitResume/'+this.key, formData, config).then(()=>this.form.post('/api/updateresume/'+this.key,axiosConfig)
                .then(function (response) {
                    this.form.reset();
                    fire.$emit('ajoutprofile');
                       Toast.fire({
                         icon: 'success',
                        title: 'Resume Uploaded'

                });
                    currentObj.success = response.data.success;
                }))
                .catch((error)=> {
            this.form.reset();
                    fire.$emit('ajoutprofile');
                       Toast.fire({
                         icon: 'success',
                        title: 'Resume Uploaded'
                });
                });
            },
              deletefile(id){
           seww.fire({
            title: 'Are you sure?',
            text: "You will not be able to go back!",
            icon: 'warning',

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'delete!'
            }).then((result) => {
           if(result.value){
                this.form.delete('/api/File/' + id).then(function(){
                seww.fire(
                    'Delete!',
                    'resume deleted.',
                    'success'
                    )

             fire.$emit('ajoutprofile');

                }).catch(()=>{
                    seww.fire(
                    'Failure !!!!'
                    );
                });
           }
            })
            },
          formSubmitdiploma(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.file);
                    let axiosConfig = {

                    headers: {
                    "Authorization": 'Bearer '+this.User1['token']
                    }
            };
                axios.post('/api/formSubmitdiploma/'+this.key, formData, config).then(()=>this.form.post('/api/updatediploma/'+this.key,axiosConfig)
                .then(function (response) {
                    this.form.reset();
                    fire.$emit('ajoutprofile');
                       Toast.fire({
                         icon: 'success',
                        title: 'Diploma Uploaded'

                });
                    currentObj.success = response.data.success;
                }))
                .catch((error)=> {
            this.form.reset();
                    fire.$emit('ajoutprofile');
                       Toast.fire({
                         icon: 'success',
                        title: 'Diploma Uploaded'
                });
                });
            },
 
        },
        created(){
                         fire.$on('ajoutprofile',()=>{
                           axios.get('/api/file/'+this.key).then(({data}) => {this.files =data});
   this.afficherMembre();});
   this.afficherMembre();
    
                 
                    
                    axios.get('/api/file/'+this.key).then(({data}) => {this.files =data});
    },
computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
}
    }

</script>
