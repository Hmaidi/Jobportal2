<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-sm-12 mt-4" >
          


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contract Type</h3>
                <div class="card-tools">
                  <button class="btn btn-success ml-6 mb-3" @click="newer()"><i class="fas fa-file-signature"></i> Add</button>
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
                  <tr v-for="contract in contracts.contract.data" :key="contract.id">
                    <td>{{ contract.id }}</td>
                    <td> {{contract.name}} </td>
                    <td> <a href="#" class="btn " style="background-color: #00a8cc" @click="editContract(contract)"><i style="color: #fff" class="fas fa-user-edit"></i></a>
                 <a href="#" class="btn btn-danger"  @click="deleteContract(contract.id)"  ><i      class="fas fa-trash-alt"></i></a> </td>
                   
                  </tr>
                  </tbody>
               
                </table>
              </div>
              <!-- /.card-body -->
            </div>


             </div>
               <pagination :data="contracts.contract" @pagination-change-page="getResults"></pagination>
            </div>
            
               <!-- Modal -->
    <form @submit.prevent=" x ? modifier() :ajouterContract()">
<div class="modal fade" id="AjouterContract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-show="!x">Add Contract:</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-show="x">Edit Contract:</h5>
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
                contracts:{
                    contract:{}
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

                 deleteContract(id){
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
                    this.form.delete('api/contract/'+id).then(function(){

                    seww.fire(
                    'Delete!',
                    'Contract type deleted.',
                    'success'
                    )

             fire.$emit('ajoutcontract');

                }).catch(()=>{
                    seww.fire(
                    'Failure !!!!'


                    );
                });
           }
                })
            },
                getResults( page = 1) {
      		     	axios.get('api/contract?page=' + page)
				         .then(response => {
				       this.contracts = response.data;
                    });
                  },
                   afficherContract(){
                    let axiosConfig = {
                    headers: {
                    "Authorization": 'Bearer '+this.user['token']
                    }
                    };
                    axios.get('api/contract',axiosConfig).then(({ data }) =>(this.contracts = data));
                   },
               ajouterContract(){
                this.form.post('api/contract').then(()=>{
                    // this.$Progress.start()
                    this.form.reset();
                  //  this.$Progress.finish()
                fire.$emit('ajoutcontract');
                $("#AjouterContract").modal('hide');

                Toast.fire({
                        icon: 'success',
                        title: 'Contract Added'
                        })
                }).catch(()=>{

                });



               },
               modifier(){

               this.form.put('api/contract/'+ this.form.id).then(function(){

             $('#AjouterContract').modal('hide')

                    seww.fire(
                    'Edit!',
                    'Your Contract informations has been Updated.',
                    'success'
                    )
                    fire.$emit('ajoutcontract');

             }).catch(function(){

             })
            },
              editContract(contract){
                  this.x=true;
               $("#AjouterContract").modal('show');
               this.form.fill(contract)
              },
              newer(){
                   this.x=false
                  this.form.reset();
              $("#AjouterContract").modal('show')
               },

             },
             created(){
                 fire.$on('search',()=>{
            let query = this.searche;
            axios.get('/api/searchcontract?s='+query).then(({ data }) =>(this.contracts = data)).catch(()=>{
            })
            }),
                 this.afficherContract();
                 fire.$on('ajoutcontract',()=>{
                     this.afficherContract();
                 });
           

             },
              computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },

    }
</script>
