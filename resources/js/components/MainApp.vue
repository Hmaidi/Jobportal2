<template>
    <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
<!--link rel="shortcut icon" href="/img/icon/logo1.png"-->
  <title>Job Portal</title>

 <!-- Font Awesome Icons -->
<link rel="stylesheet" href="/css/app.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
 <vue-progress-bar></vue-progress-bar>
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav mt">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>


    </ul>


    <!-- Right navbar links -->
       <ul class="navbar-nav ml-auto">


      <!-- Notifications Dropdown Menu -->
   
    
</ul>
    
</nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <router-link to="/home" class="brand-link">
 
 <img src="/img/icon/logo.jpg"
           
           class="brand-image img-circle elevation-3"
           style="opacity: .6">
 <span class="brand-text font-weight-light">Job Portal</span>
    </router-link>

   
      
   
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img :src="`/img/profile/${ aut.user.photo}`" class="img-circle elevation-2" alt="User Image">

  </div>
        <div class="info">
        <a href="#" class="d-block">{{ currentUser.name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     
                <li class="nav-item">
      
                        <router-link :to="`/profile/${currentUser.id}`" class="nav-link">
                      
                        <i class="fas fa-id-badge" style="color:#05dfd7"></i> 
                        <p>Profile</p>
                        </router-link>
                      </li>
                        <li class="nav-item">
                        
                        <router-link to="/companie" class="nav-link">
                        
                
                       <i class="fas fa-building" style="color:#05dfd7"></i> 
                        <p>Companies</p>
                        </router-link>
                    </li>
                         <li class="nav-item">
                        
                        <router-link to="/categorie" class="nav-link">
                        
                       <i class="fas fa-align-justify" style="color:#05dfd7"></i> 
                        <p>Competency center</p>
                        </router-link>
                    </li>
                         <li class="nav-item">
                        
                        <router-link to="/location" class="nav-link">
                        
                       <i class="fas fa-location-arrow" style="color:#05dfd7"></i> 
                        <p>Locations</p>
                        </router-link>
                    </li>

                         <li class="nav-item">
                        
                        <router-link to="/contracttype" class="nav-link">
                        
                       <i class="fas fa-file-signature" style="color:#05dfd7"></i> 
                        <p>Contracts Type</p>
                        </router-link>
                    </li>
                         <li class="nav-item">
                        
                        <router-link to="/job" class="nav-link">
                        
                       <i class="fas fa-user-md" style="color:#05dfd7"></i> 
                        <p>Jobs</p>
                        </router-link>
                    </li>
       
        <li class="nav-item">
           <a href="#!" @click.prevent="logout" class="nav-link">
           <i class="fas fa-lock-open" style="color:#05dfd7" ></i>
              <p>
               Logout
              </p>
         </a>
         </li>

   



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->

    <div class="content">
    
      <div class="container-fluid">
      
        <router-view ></router-view>
           
           

                <!-- /.row -->
      </div><!-- /.container-fluid -->
    
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Job Portal
    </div>
    <!-- Default to the left -->
     <strong>Copyright  &copy; 2021 <a href="#">Machinestalk</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

</body>
</html>
</template>
<script>


    export default {
        name: 'main-app',
      
        data(){
            return{

            aut: {
                user:{},
            },
            notifications:{
            notification: {},
            },
              

            
            }
        },
            methods: {

            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            
        },
             
        
      computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        created(){
           axios.get('/api/userconnecté').then(({ data }) =>(this.aut = data));
            axios.get('/api/notification').then(({ data }) =>(this.notifications = data));
        }
    }
</script>
