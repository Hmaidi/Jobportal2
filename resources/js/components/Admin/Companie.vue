<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
          


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Companies</h3>
                <div class="card-tools">
                  <button class="btn btn-success ml-6 mb-3" @click="newer()"><i class="fas fa-building"></i>  Add</button>
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
                  <tr v-for="companie in companies.companie.data" :key="companie.id">
                    <td>{{ companie.id }}</td>
                    <td> {{companie.name}} </td>
                    <td> <a href="#" class="btn " style="background-color: #00a8cc" @click="editCompanie(companie)"><i style="color: #fff" class="fas fa-user-edit"></i></a>
                 <a href="#" class="btn btn-danger"  @click="deleteCompanie(companie.id)"  ><i      class="fas fa-trash-alt"></i></a> </td>
                   
                  </tr>
                  </tbody>
               
                </table>
              </div>
              <!-- /.card-body -->
            </div>


             </div>
               <pagination :data="companies.companie" @pagination-change-page="getResults"></pagination>
            </div>
            
               <!-- Modal -->
    <form @submit.prevent=" x ? modifier() :ajouterCompanie()">
<div class="modal fade" id="AjouterCompanie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-show="!x">Add Companie:</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-show="x">Edit Companie:</h5>
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
                companies:{
                    companie:{}
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

                 deleteCompanie(id){
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
                    this.form.delete('api/companie/'+id).then(function(){

                    seww.fire(
                    'Delete!',
                    'Companie deleted.',
                    'success'
                    )

             fire.$emit('ajoutcompanie');

                }).catch(()=>{
                    seww.fire(
                    'Failure !!!!'


                    );
                });
           }
                })
            },
                getResults( page = 1) {
      		     	axios.get('api/companie?page=' + page)
				         .then(response => {
				       this.companies = response.data;
                    });
                  },
                   afficherCompanie(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('api/companie',axiosConfig).then(({ data }) =>(this.companies = data));
                   },
               ajouterCompanie(){
                this.form.post('api/companie').then(()=>{
                    // this.$Progress.start()
                    this.form.reset();
                  //  this.$Progress.finish()
                fire.$emit('ajoutcompanie');
                $("#AjouterCompanie").modal('hide');

                Toast.fire({
                        icon: 'success',
                        title: 'Companie Added'
                        })
                }).catch(()=>{

                });



               },
               modifier(){

               this.form.put('api/companie/'+ this.form.id).then(function(){

             $('#AjouterCompanie').modal('hide')

                    seww.fire(
                    'Edit!',
                    'Your Companie informations has been Updated.',
                    'success'
                    )
                    fire.$emit('ajoutcompanie');

             }).catch(function(){

             })
            },
              editCompanie(categorie){
                  this.x=true;
               $("#AjouterCompanie").modal('show');
               this.form.fill(categorie)
              },
              newer(){
                   this.x=false
                  this.form.reset();
              $("#AjouterCompanie").modal('show')
               },

             },
             created(){
                 fire.$on('search',()=>{
            let query = this.searche;
            axios.get('/api/searchcompanie?s='+query).then(({ data }) =>(this.companies = data)).catch(()=>{
            })
            }),
                 this.afficherCompanie();
                 fire.$on('ajoutcompanie',()=>{
                     this.afficherCompanie();
                 });
           

             },
              computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },

    }
</script>
