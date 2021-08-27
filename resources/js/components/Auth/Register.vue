<template>
    <div class="register-page" style="background-image:url(/img/banner-3.jpg);
			background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;">
            <div class="d-flex justify-content-center h-100">

			<div class="user_card">

				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="/img/icon/logo.jpg" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					 
                    <form method="post" ref="form">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="name" placeholder="Full name" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <p class="small text-danger mb-3" v-html="errors.name"></p>

                        <div class="input-group">
                            <input type="email" class="form-control" v-model="email" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <p class="small text-danger mb-3" v-html="errors.email"></p>


                        <div class="input-group">
                            <input type="password" class="form-control" v-model="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <p class="small text-danger mb-3" v-html="errors.password"></p>

                        <div class="input-group">
                            <input type="password" class="form-control" v-model="password_confirmation" placeholder="Retype password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <p class="small text-danger mb-3" v-html="errors.password_confirmation"></p>

                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-block" @click="validate($event)">Register</button>
                            </div>
                       
                        </div>
                    </form>
                  
				</div>

				
					  <div class="mt-4">
                    <div class="d-flex justify-content-center links" style="color: white;">
					 <router-link to="/login" style="color: white;">	I already have an account</router-link>

					</div>
 
                               <div class="d-flex justify-content-center links" style="color: white;">
                   <errors :success="success" :failure="failure" :message="message" :loading="loading" />

					</div>
                    </div>
                 

			

			</div>



		</div>

     
    </div>
</template>

<script>
import Errors from '../partials/Errors.vue'

export default {
    components: { Errors },
    name: "Register",
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            success: false,
            failure: false,
            message: '',
            token: document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            loading: false,
            errors: {
                name: '',
                email: '',
                username: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        validate(event) {
            event.preventDefault()
            // Show the loading alert
            this.loading = true
            this.failure = false
            this.success = false
            
            // Register the user
            let user = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                _token: this.token
            }
            // Empty the errors
            this.errors.name = null
            this.errors.email = null
            this.errors.password = null
            axios.post('api/auth/register', user)
            .then(res => {
                this.loading = false
                this.success = true
                this.message = "Successfully registred."
                this.failure = false

                setTimeout(() => {
                    window.location.href = '/home'
                }, 1000)
            })
            .catch(err => {
                this.loading = false
                this.failure = true
                // Show the error message
                this.message = err.response.data.message
                this.errors.name = err.response.data.errors.name ? err.response.data.errors.name[0] : null
                this.errors.email = err.response.data.errors.email ? err.response.data.errors.email[0] : null
                this.errors.password = err.response.data.errors.password ? err.response.data.errors.password[0] : null
                this.success = false
            })
        }
    }
}
</script>
<style scoped>
.error {
    text-align: center;
    color: red;

}
	/* Coded with love by Mutiullah Samim */
  
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: 150px;;

			background:rgba(14, 2, 80, 0.685);
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 10px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background:#fff;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #343a40 !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #343a40 !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
</style>