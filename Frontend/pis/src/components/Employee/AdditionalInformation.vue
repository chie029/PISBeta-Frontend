<template>
	<div>
		<h5 class="mb-4 p-0">
			<i class="fas fa-user"></i> Additonal Information
		</h5>
		<div>
			<input type="text" class="form-control my-3" placeholder="Religion" v-model="additionalInformation.religion">
			<input type="text" class="form-control my-3" placeholder="Marital Status" v-model="additionalInformation.marital_status">
			<select class="form-control my-3" v-model="additionalInformation.gender">
				<option value="" disabled selected>Select Gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			<div class="d-flex p-0 my-3">
				<input type="text" class="form-control mr-1" placeholder="Height" v-model="additionalInformation.height">
				<input type="text" class="form-control ml-1" placeholder="Weight" v-model="additionalInformation.weight">
			</div>
			<input type="date" class="form-control my-3" v-model="additionalInformation.birth_date">
			<input type="text" class="form-control my-3" placeholder="Birth Place" v-model="additionalInformation.birth_place">
			<input type="text" class="form-control my-3" placeholder="Present Address" v-model="additionalInformation.present_address">
			<input type="text" class="form-control mt-3" placeholder="Province Address" v-model="additionalInformation.province_address">
		</div>
	</div>
</template>

<script>
	export default{
		name: 'AdditionalInformation',
		data(){
			return {
				additionalInformation: { 
					religion: '', 
					marital_status: '',
					gender: '',
					height: '',
					weight: '',
					birth_date: '',
					birth_place: '',
					present_address: '',
					province_address: '',
				},
			}
		},
		watch: {
			additionalInformation: {
				handler: function() {
					this.$emit('newdata', [
						this.additionalInformation.religion, 
						this.additionalInformation.marital_status, 
						this.additionalInformation.gender, 
						this.additionalInformation.height, 
						this.additionalInformation.weight, 
						this.additionalInformation.birth_date, 
						this.additionalInformation.birth_place,
						this.additionalInformation.present_address, 
						this.additionalInformation.province_address,
					]);
				},
				deep: true
			}
		},
	};
</script>