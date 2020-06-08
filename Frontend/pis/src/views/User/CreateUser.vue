<template>
	<div id="createuser">
		<div class="p-5 bg-white rounded">
			<div class="px-5">
				<h4 class="mb-0">Create User</h4>
				<p>Fill all the fields to register new user.</p>
				<div class="mt-5">
					<select class="form-control mb-3" v-model="employee">
						<option value="" selected disabled>Select Employement Status</option>
						<option v-for="(person, index) in employees" v-bind:value="person.value" v-bind:key="index">
						{{ person.text }}
						</option>
					</select>
					<div v-if="isEmployee">
						<input type="text" class="form-control my-3" placeholder="Email" v-model="email">
						<input type="password" class="form-control my-3" placeholder="Password" v-model="password">
						<input type="password" class="form-control my-3" placeholder="Confirm Password" v-model="confirm_password">
						<div class="d-flex w-100 justify-content-end mt-5">
							<button class="btn btn-success btn-sm px-5 py-2">Submit</button>
						</div>
						<hr>
						<div class="d-flex w-100 justify-content-end">
							<label style="color: rgba(0,0,0,0.5)">If all fields are correct click the submit button</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'CreateUser',
	data(){
		return {
			isEmployee: false,
			employee: '',
			employees: [
				{text: 'Charlie Oivera', value: 'ZGH003'},
			],
			email: '',
			password: '',
			confirm_password: '',
		}
	},
	watch: {
		employee: {
			handler: function() {
				this.isEmployee = true
			},
			deep: true
		}
	}
};
</script>-