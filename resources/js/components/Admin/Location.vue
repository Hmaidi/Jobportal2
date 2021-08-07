<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
          


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Locations</h3>
                <div class="card-tools">
                  <button class="btn btn-success ml-6 mb-3" @click="newer()"><i class="fas fa-location-arrow"></i> Add</button>
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
                    <th>Name</th>
                    <th>Operations</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="location in locations.location.data" :key="location.id">
                    <td>{{ location.id }}</td>
                    <td> {{ location.name }} </td>
                    <td> <a href="#" class="btn " style="background-color: #00a8cc" @click="editLocation(location)"><i style="color: #fff" class="fas fa-user-edit"></i></a>
                 <a href="#" class="btn btn-danger"  @click="deleteLocation(location.id)"  ><i      class="fas fa-trash-alt"></i></a> </td>
                   
                  </tr>
                  </tbody>
               
                </table>
              </div>
              <!-- /.card-body -->
            </div>


             </div>
               <pagination :data="locations.location" @pagination-change-page="getResults"></pagination>
            </div>
            
               <!-- Modal -->
    <form @submit.prevent=" x ? modifier() :ajouterLocation()">
<div class="modal fade" id="AjouterLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-show="!x">Add Location:</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-show="x">Edit Location:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
      <label>Name</label>
      <input v-model="form.name" type="text" name="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
      <has-error :form="form" field="name"></has-error>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" v-show="!x" class=" btn btn-primary">Add</button>
         <button type="submit" v-show="x" class="btn btn-primary" >Edit</button>
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
                x:false,
                locations:{
                    location:{}
                },
                searche:'',

                form : new Form({
                id:'',
                name:'',
                }),
                
                 user:JSON.parse(localStorage.getItem('user')),

            }
        },

               methods:{
                     search(){
                fire.$emit('search');
            },

                 deleteLocation(id){
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
                    this.form.delete('api/location/'+id).then(function(){

                    seww.fire(
                    'Delete!',
                    'Location deleted.',
                    'success'
                    )

             fire.$emit('ajoutlocation');

                }).catch(()=>{
                    seww.fire(
                    'Failure !!!!'


                    );
                });
           }
                })
            },
                getResults( page = 1) {
      		     	axios.get('api/location?page=' + page)
				         .then(response => {
				       this.categories = response.data;
                    });
                  },
                   afficherLocation(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('api/location',axiosConfig).then(({ data }) =>(this.locations = data));
                   },
               ajouterLocation(){
                this.form.post('api/location').then(()=>{
                    // this.$Progress.start()
                    this.form.reset();
                  //  this.$Progress.finish()
                fire.$emit('ajoutlocation');
                $("#AjouterLocation").modal('hide');

                Toast.fire({
                        icon: 'success',
                        title: 'Location Added'
                        })
                }).catch(()=>{

                });



               },
               modifier(){

               this.form.put('api/location/'+ this.form.id).then(function(){

             $('#AjouterLocation').modal('hide')

                    seww.fire(
                    'Edit!',
                    'Your Location informations has been Updated.',
                    'success'
                    )
                    fire.$emit('ajoutlocation');

             }).catch(function(){

             })
            },
              editLocation(location){
                  this.x=true;
               $("#AjouterLocation").modal('show');
               this.form.fill(location)
              },
              newer(){
                   this.x=false
                  this.form.reset();
              $("#AjouterLocation").modal('show')
               },

             },
             created(){
                 fire.$on('search',()=>{
            let query = this.searche;
            axios.get('/api/searchlocation?s='+query).then(({ data }) =>(this.locations = data)).catch(()=>{
            })
            }),
                 this.afficherLocation();
                 fire.$on('ajoutlocation',()=>{
                     this.afficherLocation();
                 });
           

             },
              computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },

    }
</script>
