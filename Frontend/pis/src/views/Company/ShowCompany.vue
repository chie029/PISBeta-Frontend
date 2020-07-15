<template>
	<ShowForm 
		:header="header"
		@edit="edit($event)">
		<template v-slot:default>
			<div v-if="!isEdit" class="mt-5 d-flex flex-column">
				<label class="mb-0 fsl-16">Code</label>
				<label class="mb-2 fs-16">{{code}}</label>
				<label class="mb-0 fsl-16">Name</label>
				<label class="mb-2 fs-16">{{name}}</label>
				<label class="mb-0 fsl-16">Contact</label>
				<label class="mb-2 fs-16">{{contact}}</label>
				<label class="mb-0 fsl-16">Address</label>
				<label class="mb-2 fs-16">{{address}}</label>
			</div>
			<div v-else class="mt-5 d-flex flex-column">
				<input type="text" class="form-control mb-2" placeholder="Company Code" v-model="code">
				<input type="text" class="form-control mb-2" placeholder="Company Name" v-model="name">
				<input type="text" class="form-control mb-2" placeholder="Company Contact" v-model="contact">
				<textarea type="text" class="form-control mb-4" placeholder="Company Address" rows="3" v-model="address"></textarea>
				<button class="btn btn-success px-4 ml-auto" @click="update()">Update</button>
			</div>
		</template>
	</ShowForm>
</template>

<script>
import Swal from 'sweetalert2'
import ShowForm from '@/components/CardForm.vue';
export default {
	name: 'ShowCompany',
	components: {
		ShowForm,
	},
	data(){
		return{
			isEdit: false,
			header: {
				title: 'Show Company',
				description: 'Preview the details of the company.',
				isEdit: false,
			},
			id: '',
			name: '',
			code: '',
			contact: '',
			address: '',
		}
	},
	created(){
		this.axios.get(this.$store.state.company + 'company/show/' + this.$route.params.id)
		.then(response => {
			console.log(response.data.data);
			this.id = response.data.data.id
			this.name = response.data.data.name
			this.code = response.data.data.code
			this.contact = response.data.data.contact
			this.address = response.data.data.address
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
	},
	methods: {
		edit: function(e) {
			this.isEdit = e;
		},
		update() {
			this.axios.put(this.$store.state.company + 'company/update?token=' + this.$session.get('token'), {
				id: this.id,
				code: this.code,
				name: this.name,
				contact: this.contact,
				address: this.address,
			})
			.then(response => {
				console.log(response.data);
				Swal.fire({
					icon: response.data.status,
					title: response.data.message,
					showConfirmButton: false,
					timer: 1000,
				})
				if (response.data.status == 'success') { this.isEdit = false; this.header.isEdit = false; }
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
	},
	watch: {
		'header.isEdit': function(newVal)  {
			if (newVal == true) {
				this.header.title = 'Edit Company'
				this.header.description = 'Update the details of the company.'
			} else {
				this.header.title = 'Show Company'
				this.header.description = 'Preview the details of the company.'
			}
		},
	}
};
</script>

<style type="text/css">
.fs-16 {
	font-size: 16px;
	font-weight: 600;
}
.fsl-16 {
	font-size: 16px;
	font-weight: 400;
}
</style>