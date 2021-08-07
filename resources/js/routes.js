
import home from './components/Home.vue'
import Main  from './components/MainApp.vue'
import Login  from './components/Auth/loginForm.vue'
import Pass from './components/Auth/respassword.vue'
import profile from './components/User/profile.vue'
import job from './components/Admin/Jobs/Job.vue'
import createjob from './components/Admin/Jobs/CreateJob.vue'
import updatejob from './components/Admin/Jobs/UpdateJob.vue'
import register from './components/Auth/Register.vue'
import categorie from './components/Admin/Categorie.vue'
import location from './components/Admin/Location.vue'
import companie from './components/Admin/Companie.vue'
import contracttype from './components/Admin/ContractType.vue'
import viewjob from './components/Admin/Jobs/ViewJob.vue'

export const routes = [
    {path: '/', component: Main ,meta: {requiresAuth: true},children:[
      

        {path: '/home' , component: home , meta: {requiresAuth: true}},
        {path: '/profile/:id' , component: profile , meta: {requiresAuth: true}},
        {path: '/job' , component: job , meta: {requiresAuth: true}},
        {path: '/location' , component: location , meta: {requiresAuth: true}},
        {path: '/categorie' , component: categorie , meta: {requiresAuth: true}},
        {path: '/contracttype' , component: contracttype , meta: {requiresAuth: true}},
        {path: '/companie' , component: companie , meta: {requiresAuth: true}},
        {path: '/updatejob/:id' , component: updatejob , meta: {requiresAuth: true}},
        {path: '/createjob' , component: createjob , meta: {requiresAuth: true}},
        {path: '/viewjob/:id' , component: viewjob , meta: {requiresAuth: true}},
        
        ]
},
    {path: '/login', component: Login,meta: {requiresAuth: false}},
    {path: '/register', component: register,meta: {requiresAuth: false}},
 {path: '/reset-password', component:Pass},
   {path: '*' , name:'not-found' ,component:    require('./components/404.vue').default },
   


  ];

