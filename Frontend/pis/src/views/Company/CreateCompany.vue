<template>
	<CreateForm :header="header">
		<template v-slot:default>
			<div class="mt-5 d-flex flex-column">
				<input type="text" class="form-control mb-2" placeholder="Company Code" v-model="code">
				<input type="text" class="form-control mb-2" placeholder="Company Name" v-model="name">
				<input type="text" class="form-control mb-2" placeholder="Company Contact" v-model="contact">
				<textarea type="text" class="form-control mb-3" placeholder="Company Address" rows="3" v-model="address"></textarea>
				<button class="btn btn-success px-4 ml-auto" @click="create()">Create</button>
			</div>
		</template>
	</CreateForm>
</template>

<script>
import Swal from 'sweetalert2'
import CreateForm from '@/components/CardForm.vue';
export default {
	name: 'CreateCompany',
	components: {
		CreateForm,
	},
	data(){
		return{
			header: {
				title: 'Create Company',
				description: 'Fill all the fields to register new company.',
			},
			code: '',
			name: '',
			contact: '',
			address: '',
		}
	},
	methods: {
		create(){
			this.axios.post(this.$store.state.company + 'company/store?token=' + this.$session.get('token'), {
				code: this.code,
				name: this.name,
				contact: this.contact,
				address: this.address,
				created_by: this.$session.get('user')
			})
			.then(response => {
				console.log(response.data);
				Swal.fire({
					icon: 'info',
					title: response.data.result,
					showConfirmButton: false,
					timer: 4000,
					// onClose: this.$router.push({name: 'Company'})
				})
			})
			.catch(e => {
				console.log(e);
				Swal.fire({
					icon: 'info',
					title: 'Check your Connection!',
					showConfirmButton: false,
					timer: 4000,
				})
			})
		}
	}
};
</script>