 
 <template>
     
<div class="global">
    
    <div class="box-area">
    
        <div class="banner-area">
                
                 <center>  <h2>{{ jobs.jobs.title }}</h2> </center>	
                
                </div>
        
        </div>
               <div class="content-area">
          <div class="wrapper">
            <h2><b> Form Application</b></h2>
            
    <div class="card-body">
        <form @submit.prevent="Apply()">

             <div class="form-group">
                <label for="salary">Name</label>
                <input  v-model="form.name" type="text" id="name"  class="form-control" value="" required>
          
            </div>
            
            <div class="form-group ">
                <label for="title">Email</label>
                <input  v-model="form.email" type="text" id="email"  class="form-control" 
           required>
        
            </div>
                    
                    <div class="form-group ">
                <label for="title">Address</label>
                <input  v-model="form.address" type="text" id="address"  class="form-control" 
           required>
        
            </div>
            <div class="form-group">
                <label for="company">Phone</label>
                  <input v-model="form.phone" type="text" id="phone"  class="form-control" 
           required>
          
            </div>
            <div class="form-group">
                <label for="full_description">Skills</label>
                <textarea v-model="form.skills" id="skills"  class="form-control"
               ></textarea>
                 
            </div>
            <div class="form-group">
                <label for="salary">Required years of experience</label>
                <input v-model="form.experience" type="text" id="salary"  class="form-control" value="" required>
           
            </div>

   <div class="form-group" v-for="forme in forms.forms" :key="forme.id">
               
                 <label for="name">{{ forme.field }}</label>
                 
                   <input @click="chargerid(forme.id)" v-if="forme.type == 'input'" type="text" v-model="form.value" id="name" class="form-control">
                 <textarea @click="chargerid(forme.id)" v-if="forme.type == 'Textarea'" v-model="form.value"   class="form-control" ></textarea>
                      
               
             </div>
                  
                         <div class="form-group">
                <label for="location">Resume</label>
                <select v-model="form.resume"  id="location" class="form-control" required>
                    <option value="" disabled selected>Select Resume</option>
                            <option v-for ="(file , index) in files.files" :key="index" v-if="file.type == 'resume'"  v-bind:value="file.id">{{ file.name }}</option>
                </select>
      
            </div>
               <!--div class="form-group" >
               
                 <label for="name">Name resume</label>
                   <input v-model="form.resume1" id="name" class="form-control" type="text" name="name">
                 <div class="input-group mt-2"><div class="custom-file"><input type="file" v-on:change="onFileChange" name="file"  class="custom-file-input"> <label for="exampleInputFile" class="custom-file-label">
                     Choose file:</label></div></div>
                      
               
             </div-->
      
   
   
            <div>
                <input class="btn btn-danger" type="submit" value="submit">
            </div>
        </form>
            </div>



      
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
              form : new Form({
        name:'',
        address:'',
        skills:'',
        email:'',
        phone:'',
        resume:'',
        diploma:'',
        experience:'',
        value:'',
         resume1:'',
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
                jobs:{
                    jobs:{}
                },
                id:'',
      forms:{
          forms:{}
      },
           users:{
                  users:{},
              },
              User1:JSON.parse(localStorage.getItem('user')),
   

             key: this.$route.params.id,
                
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
                       afficherJob(){
                   
                    axios.get('/api/getindexjob/'+this.key).then(({ data }) =>(this.jobs = data));
                   
                   },
                 
            fillform(){
                 this.form.fill(this.User1);
               },
                  Apply(){
                
                this.form.post('/api/applicationform/'+this.key).then(()=>this.form.post('/api/extrafielsapplications/'+this.id).then(()=>{
                
             
                this.form.reset();
                Toast.fire({
                        icon: 'success',
                        title: 'Application done successfuly'

                }),
                 setTimeout(() => {
                    window.location.href = '/listjob'
                }, 1000)

                }).catch((response)=>{ console.log(response);


                 }));
                    },
                onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
                 
            },
              afficherForms(){
                   
                    axios.get('/api/formsjob/'+this.key).then(({ data }) =>(this.forms = data));
                   
                   },
                   chargerid(id){
                       this.id = id;
                   }
               },

             created(){
   
                this.afficherJob();
            
                axios.get('/api/file/'+this.User1.id).then(({data}) => {this.files =data});
                
                this.afficherMembre();   
                 this.afficherForms();
              this.form.fill(this.User1);
              
              
                     },
                    
                   
             computed: {
               currentUser() {
                return this.$store.getters.currentUser
            }
        },
         
       
    }
</script>
