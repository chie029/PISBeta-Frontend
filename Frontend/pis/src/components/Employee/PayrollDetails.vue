<template>
	<div>
		<h5 class="mb-4 p-0">
			<i class="fas fa-user"></i> Payroll Details
		</h5>
		<div>
			<select class="form-control mb-3" v-model="payrollDetails.employment_status">
				<option value="" selected disabled>Select Employement Status</option>
				<option v-for="(status, index) in payrollDetails.status" v-bind:value="status.value" v-bind:key="index">
				{{ status.text }}
				</option>
			</select>
			<input type="date" class="form-control my-3" placeholder="Date Hired" v-model="payrollDetails.date_hired">
			<select class="form-control mb-3" v-model="payrollDetails.employment_type">
				<option value="" selected disabled>Select Employment Type</option>
				<option v-for="(type, index) in payrollDetails.employment_types" v-bind:value="type.value" v-bind:key="index">
				{{ type.text }}
				</option>
			</select>
			<input type="date" class="form-control my-3" placeholder="Efferctive Date" v-model="payrollDetails.effective_date">
			<input type="date" class="form-control my-3" placeholder="End Date" v-model="payrollDetails.end_date">
			<input type="text" class="form-control my-3" placeholder="Basic Salary" v-model="payrollDetails.basic_salary">
			<select class="form-control my-3" v-model="payrollDetails.wage_type">
				<option value="" selected disabled>Select Wage Type</option>
				<option v-for="(type, index) in payrollDetails.wage_types" v-bind:value="type.value" v-bind:key="index">
				{{ type.text }}
				</option>
			</select>
			<select class="form-control my-3" v-model="payrollDetails.payout_type">
				<option value="" selected disabled>Select Wage Type</option>
				<option v-for="(type, index) in payrollDetails.payout_types" v-bind:value="type.value" v-bind:key="index">
				{{ type.text }}
				</option>
			</select>
			<select class="form-control my-3" v-model="payrollDetails.tax_computation">
				<option value="" selected disabled>Select Wage Type</option>
				<option v-for="(tax, index) in payrollDetails.tax_computations" v-bind:value="tax.value" v-bind:key="index">
				{{ tax.text }}
				</option>
			</select>
			<div class="d-flex my-3">
				<input type="text" class="form-control" placeholder="TIN Number" v-model="payrollDetails.tin_number">
				<input type="text" class="form-control" placeholder="SSS Number" v-model="payrollDetails.sss_number">
				<input type="text" class="form-control" placeholder="Philhealth Number" v-model="payrollDetails.philhealth_number">
				<input type="text" class="form-control" placeholder="HDMF Number" v-model="payrollDetails.pagibig_number">
			</div>
			<select class="form-control my-3" v-model="payrollDetails.payroll_group">
				<option value="" selected disabled>Select Wage Type</option>
				<option v-for="(group, index) in payrollDetails.payroll_groups" v-bind:value="group.value" v-bind:key="index">
				{{ group.text }}
				</option>
			</select>
			<div class="d-flex justify-content-center p-5 rounded mb-3" style="background-color: rgba(0,0,0,0.1)">
				<div class="d-flex align-self-center">
					<div class="d-flex flex-row justify-content-center align-self-center px-5 py-3">
						<label>SSS</label>
						<label>{{government_number.SSS}}</label>
					</div>
					<div class="d-flex flex-row justify-content-center align-self-center px-5 py-3">
						<label>Philhealth</label>
						<label>{{government_number.Philhealth}}</label>
					</div>
					<div class="d-flex flex-row justify-content-center align-self-center px-5 py-3">
						<label>Pagibig</label>
						<label>{{government_number.Pagibig}}</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name: 'PayrollDetails',
		data(){
			return {
				government_number: {
					SSS: '',
					Philhealth: '',
					Pagibig: '',
				} ,
				payrollDetails: { 
					employment_status: '',
					status: [],
					date_hired: '',
					employment_type: '',
					employment_types: [],
					effective_date: '',
					end_date: '',
					basic_salary: '',
					wage_type: '',
					wage_types: [],
					payout_type: '',
					payout_types: [],
					tax_computation: '',
					tax_computations: [],
					tin_number: '',
					sss_number: '',
					philhealth_number: '',
					pagibig_number: '',
					payroll_group: '',
					payroll_groups: [],
				},
			}
		},	
		watch: {
			positionDetails: {
				handler: function() {
					this.$emit('newdata', this.payrollDetails);
				},
				deep: true
			}
		},
	};
</script>