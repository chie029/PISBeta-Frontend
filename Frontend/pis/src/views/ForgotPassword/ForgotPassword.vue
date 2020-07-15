<template>
<div id="forgotpassword" class="d-flex p-5" style="height: 100vh; background-color: #2A3F54">
  <div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 col-12">
      <div class="card" style="border: none" v-if="!isEmailSent">
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <div class="py-2 px-3" style="background-color: rgba(249, 99, 50, 0.7)" v-if="!isSuccess"><h5>{{error}}</h5></div>
          <h4 class="text-white">Send Email</h4>
          <input type="email" v-model="email" class="form-control" placeholder="Enter Email">
          <button type="button" @click="sendEmail()" class="btn btn-warning text-white w-100 mt-3">Submit</button>
        </div>
      </div>
      <div class="card" style="border: none" v-else>
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <h4 class="text-white">Email Sent</h4>
          <label class="text-white">Your access control is sent to your email. Wait for the link sent to your email.</label>
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
  name: 'ForgotPassword',
  data() {
    return {
      email: '',
      code: '',
      error: [],
      isSuccess: true,
      isEmailSent: false
    }
  },
  created: function(){
    if (!this.$session.exist()) {
      this.$router.push({name: 'ForgotPassword'})
    }
  },
  methods : { 
    sendEmail()
    {
      this.axios.post('http://127.0.0.1:8000/api/user/send', {
        email: this.email,
        })
      .then(response => {
        if (response.status === 200) {
          if (response.data.status == 'Success') {
            this.$session.start()
            this.$session.set('email', this.email)
            this.isEmailSent = true
          } else {
            this.isSuccess = false
            this.error = response.data.message
          }
        }
      })
      .catch(e => {
        this.error.push(e)
        alert('error');
      })
    },
    checkCode()
    {
      this.axios.post('http://127.0.0.1:8000/api/user/confirmCode', {
        email: this.$session.get('email'),
        code: this.code
        })
      .then(response => {
        if (response.status === 200) {
          if (response.data.status == 'Success') {
            this.$router.push({name: 'ChangePassword'});
          } else {
            this.isSuccess = false
            this.error = response.data.message
          }
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
    login()
    {
      this.$router.push({name: 'Login'});
    },
  },
};
</script>