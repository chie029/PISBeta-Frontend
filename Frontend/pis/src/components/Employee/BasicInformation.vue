<template>
	<div>
		<h5 class="mb-4 p-0">
			<i class="fas fa-user"></i> Basic Information
		</h5>
		<div>
			<input type="text" class="form-control mb-3" placeholder="Employee Code" v-model="basicInformation.employeeCode">
			<div class="d-flex p-0 my-3">
				<input type="text" class="form-control mr-1" placeholder="Suffix Name" v-model="basicInformation.suffixName">
				<input type="text" class="form-control mx-1" placeholder="First Name" v-model="basicInformation.firstName">
				<input type="text" class="form-control mx-1" placeholder="Middle Name" v-model="basicInformation.middleName">
				<input type="text" class="form-control ml-1" placeholder="Last Name" v-model="basicInformation.lastName">
			</div>
			<div class="d-flex p-0 mt-3">
				<input type="text" class="form-control mr-1" placeholder="Company Email" v-model="basicInformation.companyEmail">
				<input type="text" class="form-control ml-1" placeholder="Personal Email" v-model="basicInformation.personalEmail">
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name: 'Basicinformation',
		data(){
			return {
				basicInformation: { 
					employeeCode: '', 
					suffixName: '',
					firstName: '',
					middleName: '',
					lastName: '',
					companyEmail: '',
					personalEmail: '',
				},
			}
		},
		watch: {
			basicInformation: {
				handler: function() {
					this.$emit('newdata', [
						this.basicInformation.employeeCode, 
						this.basicInformation.suffixName, 
						this.basicInformation.firstName, 
						this.basicInformation.middleName, 
						this.basicInformation.lastName, 
						this.basicInformation.companyEmail, 
						this.basicInformation.personalEmail,
					]);
				},
				deep: true
			}
		},
	};
</script>