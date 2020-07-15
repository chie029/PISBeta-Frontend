<template>
<div id="changepassword" class="d-flex p-5" style="height: 100vh; background-color: #2A3F54">
  <div class="container">
	<div class="row d-flex justify-content-center">
		<div class="col-md-6 col-12">
      <div class="card" style="border: none" v-if="isConfirm">
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <div class="py-2 px-3" style="background-color: rgba(249, 99, 50, 0.7)" v-if="!isSuccess"><h5>{{error}}</h5></div>
          <h5 class="text-white mb-3">Change Password</h5>
          <input type="password" v-model="password" class="form-control my-2" placeholder="Enter New Password">
          <input type="password" v-model="confirm_password" class="form-control my-2" placeholder="Confirm Password">
          <button type="button" @click="changePassword()" class="btn btn-warning text-white w-100 mt-2">Submit</button>
        </div>
      </div>
      <div class="card" style="border: none" v-if="isInvalid">
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <h5 class="text-white mb-3">Token Invalid!</h5>
          <br>
          <label>Click the link sent in your email.</label>
        </div>
      </div>
      <div class="card" style="border: none" v-if="isExpired">
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <h5 class="text-white mb-3">Token Expired!</h5>
          <br>
          <label class="text-white">Send another link for Change Password.</label>
          {{error}}
          <br>
          <button class="btn btn-warning text-white" @click="sendEmail()">Click here to Send Email</button>
        </div>
      </div>
      <div class="card" style="border: none" v-if="isSend">
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <h5 class="text-white mb-3">Request Sent!</h5>
          <br>
          <label class="text-white">Check your email for a new link sent</label>
        </div>
      </div>
      <div class="card" style="border: none" v-if="isChanged">
        <div class="card-header pt-3 pb-1 px-4" style="background-color: #1C2A38"><h5 class="text-white"></h5></div>
        <div class="card-body py-4 px-5" style="background-color: rgba(42, 63, 84, 0.9);">
          <h5 class="text-white mb-3">Password Succesfully Changed!</h5>
          <br>
          <label class="text-white">Go to <b><a href="" class="text-white" @click="loginPage()">Login</a></b>.</label>
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
  name: 'ChangePassword',
  data() {
    return {
      code: this.$route.params.id,
      email: this.$route.params.email,
      password: '',
      confirm_password: '',
      error: '',
      isSuccess: true,
      isChanged: false,
      isConfirm: false,
      isInvalid: false,
      isExpired: false,
      isSend: false,
    }
  },
  created() {
    this.axios.post('http://127.0.0.1:8000/api/user/confirmCode', {
      email: this.email,
      code: this.code,
      })
    .then(response => {
      if (response.data.status == 'Failed') {
        if (response.data.message == 'Invalid') {
          this.isInvalid = true;
        } else if (response.data.message == 'Expired') {
          this.isExpired = true;
        }
      } else {
        this.isConfirm = true;
      }
    })
    .catch(e => {
        console.log(e);
        Swal.fire({
          icon: 'info',
          title: 'Check your Connection!',
          showConfirmButton: false,
          timer: 4000,
          onClose: this.$router.push({name: 'Login'})
        })
    })
  },
  methods : {
    sendEmail(){
      this.axios.post('http://127.0.0.1:8000/api/user/send', {
        email: this.email,
        })
      .then(response => {
        if (response.status === 200) {
          if (response.data.status == 'Success') {
            this.isSend = true;
            this.isExpired = false;
          }
        }
      })
      .catch(e => {
        console.log(e);
        Swal.fire({
          icon: 'info',
          title: 'Check your Connection!',
          showConfirmButton: false,
          timer: 4000,
          onClose: this.$router.push({name: 'Login'})
        })
      })
    },
    changePassword(){
      this.axios.post('http://127.0.0.1:8000/api/user/changePassword', {
        email: this.email,
        password: this.password,
        confirm_password: this.confirm_password,
        })
      .then(response => {
        if (response.status === 200) {
          if (response.data.status == 'Failed') {
            this.error = response.data.message;
            this.isSuccess = false;
          } else {
            this.isConfirm = false;
            this.isChanged = true;
          }
        }
      })
      .catch(e => {
        console.log(e);
        Swal.fire({
          icon: 'info',
          title: 'Check your Connection!',
          showConfirmButton: false,
          timer: 4000,
          onClose: this.$router.push({name: 'Login'})
        })
      })
    },
    loginPage() {
      this.$router.push({name: 'Login'});
    }
  },
};
</script>