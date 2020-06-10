<template>
	<div>
		<h5 class="mb-4 p-0">
			<i class="fas fa-user"></i> Position Details
		</h5>
		<div>
			<select class="form-control mb-3" v-model="positionDetails.selected_company">
				<option value="" selected disabled>-- Select Company --</option>
				<option v-for="(company, index) in companies" v-bind:value="company.value" v-bind:key="index">
				{{ company.text }}
				</option>
			</select>
			<select class="form-control my-3" v-model="positionDetails.selected_department">
				<option value="" selected disabled>-- Select Department --</option>
				<option v-for="(department, index) in departments" v-bind:value="department.value" v-bind:key="index">
				{{ department.text }}
				</option>
			</select>
			<select class="form-control my-3" v-model="positionDetails.selected_report_to">
				<option value="" selected disabled>-- Select Adviser --</option>
				<option v-for="(report, index) in reports" v-bind:value="report.value" v-bind:key="index">
				{{ report.text }}
				</option>
			</select>
			<input type="text" class="form-control mb-3" placeholder="Employee Position" v-model="positionDetails.position">
			<select class="form-control my-3" v-model="positionDetails.selected_project">
				<option value="" selected disabled>-- Select Project --</option>
				<option v-for="(project, index) in projects" v-bind:value="project.value" v-bind:key="index">
				{{ project.text }}
				</option>
			</select>
		</div>
	</div>
</template>

<script>
	export default{
		name: 'PositionDetails',
		data(){
			return {
				positionDetails: { 
					selected_company: '',
					selected_department: '',
					selected_report_to: '',
					position: '',
					selected_project: '',
				},
				companies: [],
				departments: [],
				reports: [],
				projects: [],
			}
		},
		watch: {
			positionDetails: {
				handler: function() {
					this.$emit('newdata', [
						this.positionDetails.selected_company, 
						this.positionDetails.selected_department, 
						this.positionDetails.selected_report_to, 
						this.positionDetails.position, 
						this.positionDetails.selected_project, 
					]);
				},
				deep: true
			}
		},
	};
</script>