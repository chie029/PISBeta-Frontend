<template>
<div id="login" class="d-flex" style="height: 100vh; background-color: #2A3F54">
  <div class="container align-self-center">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-12 col-md-9">
          <div class="p-0" style="background-color: rgba(42, 63, 84, 0.8);">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-xl-6 b-right-warning d-flex justify-content-center">
                <img class="align-self-center" src="../assets/img/pis_caimito_apps_logo.jpg" width="80%">
              </div>
              <div class="col-lg-6 pl-5 py-2">
                <form @submit="login" class="user">
                  <div class="form-s">
                    <input type="email" class="form-control" id="exampleInputUsername" placeholder="Enter Username" v-model="email" required>
                  </div>
                  <div class="form-s">
                    <input type="password" class="form-control" placeholder="Password"  v-model="password" required>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label text-white" for="customCheck">Remember Me</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-warning text-white border-0 btn-block">
                    Login
                  </button>
                  <div class="float-right">
                    <a class="small text-white" href="" @click="forgotPassword()">Forgot Password?</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
      errors: [],
    }
  },
  methods : { 
    login(e){
      e.preventDefault();
      this.axios.post(this.$store.state.employee + 'login', {
        email: this.email,
        password: this.password
        })
      .then(response => {
        if (response.data.status == "success") {
          this.$session.start()
          this.$session.set('user', response.data.result.user)
          this.$session.set('token', response.data.result.token)
          // this.$session.set('image', response.data.user.image)
          this.$session.set('name', response.data.result.user.basic_information.first_name + " " + response.data.result.user.basic_information.middle_name + " " + response.data.result.user.basic_information.last_name)
          this.$session.set('email', response.data.result.user.email)
          this.$router.push({name: 'Dashboard'});
        } else {
          Swal.fire({
            icon: 'error',
            title: response.data.result,
            showConfirmButton: false,
            timer: 1500,
            onClose: this.$router.push({name: 'Login'})
          })
        }
      })
      .catch(e => {
        console.log(e);
        Swal.fire({
          icon: 'info',
          title: e,
          showConfirmButton: false,
          timer: 2000,
          onClose: this.$router.push({name: 'Login'})
        })
      })
    },
    forgotPassword(){
      this.$router.push({name: 'ForgotPassword'})
    }
  },
};
</script>