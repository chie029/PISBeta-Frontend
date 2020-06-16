<template>
	<div id="createuser">
		<div class="p-5 bg-white rounded">
			<div class="px-5">
				<h4 class="mb-0">Create User</h4>
				<p>Fill all the fields to register new user.</p>
				<div class="mt-5">
					<select class="form-control mb-3" v-model="employee">
						<option value="" selected disabled>-- Select Employement --</option>
						<option v-for="(person, index) in employees" v-bind:value="person.value" v-bind:key="index">
						{{ person.text }}
						</option>
					</select>
					<div v-if="isEmployee">
						<input type="text" class="form-control my-3" placeholder="Email" v-model="email">
						<input type="password" class="form-control my-3" placeholder="Password" v-model="password">
						<input type="password" class="form-control my-3" placeholder="Confirm Password" v-model="confirm_password">
						<div class="d-flex flex-row my-3">
							<div class="form-check mr-3">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" @change="()=>this.isPis=!this.isPis" value="PIS" v-model="app">Personal Information System
								</label>
							</div>
							<div class="form-check mx-3">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Timekeeping" v-model="app">Timekeeping Application
								</label>
							</div>
							<div class="form-check ml-3">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Payroll" v-model="app">Payroll Management
								</label>
							</div>
						</div>
						<div class="d-flex flex-column mt-4" v-if="isPis">
							<h6 style="color: dimgray">PIS Modules</h6>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Company" v-model="modules">Company
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Department" v-model="modules">Department
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Project" v-model="modules">Project
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Employee" v-model="modules">Employee
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="User" v-model="modules">User
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Payroll Group" v-model="modules">Payroll Group
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Compensation" v-model="modules">Compensation
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Deduction" v-model="modules">Deduction
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Leave" v-model="modules">Leave
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Leave Credits" v-model="modules">Leave Credits
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" value="Journal Category" v-model="modules">Journal Category
								</label>
							</div>
						</div>
						<div class="d-flex w-100 justify-content-end mt-5">
							<button class="btn btn-success btn-sm px-5 py-2" @click="submit()">Submit</button>
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
			employees: [],
			email: '',
			password: '',
			confirm_password: '',
			app: [],
			modules: [],
			role: [],
			isPis: false,
			responses: [],
		}
	},
	watch: {
		employee: {
			handler: function() {
				this.isEmployee = true
			},
			deep: true
		}
	},
	methods: {
		submit() {
			this.role = {app: this.app,modules: this.modules};
			this.axios.post(this.$store.state.employee + 'user/createUser', {
				role: this.role,
				password: this.password,
				employee_id: this.employee
			})
			.then(response => {
				this.responses = response.data;
			})
			.catch(e => {
				this.errors.push(e)
				alert('error');
			})
		}
	},
	created() {
		this.axios.get(this.$store.state.employee + 'employee/user')
		.then(response => {
			for (var i = response.data.message.length - 1; i >= 0; i--) {
				var name = response.data.message[i].employee_basic_information.first_name + ' ' + response.data.message[i].employee_basic_information.middle_name + ' ' + response.data.message[i].employee_basic_information.last_name + ' ' + '(' + response.data.message[i].employee_basic_information.employee_code + ')'
				var code = response.data.message[i].employee_id
				this.employees.push({ text: name, value: code, });
				this.email = response.data.message[i].employee_basic_information.email
			}
		})
		.catch(e => {
			this.errors.push(e)
			alert('error');
		})
	}
};
</script>-