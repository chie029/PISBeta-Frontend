<template>
	<CreateForm :header="header">
		<template v-slot:default>
			<form-wizard @on-complete="onComplete" step-size="sm" color="#2ACB91">
				<h5 slot="title" hidden></h5>
				<tab-content icon="fas fa-user" title="Basic Information">
					<BasicInformation @newdata="getBasic($event)"></BasicInformation>
				</tab-content>
				<tab-content icon="fas fa-school" title="Educational Background">
					<EducationalBackground @newdata="getEducation($event)"></EducationalBackground>
				</tab-content>
				<tab-content icon="fas fa-user" title="Additional Information">
					<AdditionalInformation @newdata="getAdditional($event)"></AdditionalInformation>
				</tab-content>
				<tab-content icon="fas fa-user" title="Position Details">
					<PositionDetails @newdata="getPosition($event)"></PositionDetails>
				</tab-content>
				<tab-content icon="fas fa-user" title="Payroll Details">
					<PayrollDetails @newdata="getPayroll($event)"></PayrollDetails>
				</tab-content>
				<tab-content icon="fas fa-user" title="Upload Image">
					<UploadImage @newdata="getImage($event)"></UploadImage>
				</tab-content>
			</form-wizard>
		</template>
	</CreateForm>
</template>

<script>
import Swal from 'sweetalert2/src/sweetalert2.js'
import CreateForm from '@/components/CardForm.vue';
import BasicInformation from '@/components/Employee/BasicInformation.vue';
import EducationalBackground from '@/components/Employee/EducationalBackground.vue';
import AdditionalInformation from '@/components/Employee/AdditionalInformation.vue';
import PositionDetails from '@/components/Employee/PositionDetails.vue';
import PayrollDetails from '@/components/Employee/PayrollDetails.vue';
import UploadImage from '@/components/Employee/UploadImage.vue';
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';
export default{
	name: 'CreateEmployee',	
	components: {
		CreateForm,
		FormWizard,
		TabContent,
		BasicInformation,
		EducationalBackground,
		AdditionalInformation,
		PositionDetails,
		PayrollDetails,
		UploadImage,
	},
	data() {
		return {
			header: {
				title: 'Create Company',
				description: 'Fill all the fields to register new company.',
			},
			basicInformation: { 
				employeeCode: '', 
				suffixName: '',
				firstName: '',
				middleName: '',
				lastName: '',
				companyEmail: '',
				personalEmail: '',
			},
			educationalBackground: [],
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
			positionDetails: { 
				selected_company: '',
				selected_department: '',
				selected_report_to: '',
				position: '',
				selected_project: '',
			},
			payrollDetails: [],
			image: '',
			activeTabIndex: 0,
			responses: [],
		};
	},
	methods: {
		onComplete: function(){
			this.axios.post(this.$store.state.employee + 'employee/store?token=' + this.$session.get('token'), {
				employee_basic_information: this.basicInformation,
				employee_educational_background: this.educationalBackground,
				employee_additional_information: this.additionalInformation,
				employee_position: this.positionDetails,
				employee_payroll_details: this.payrollDetails,
			})
			.then(response => {

				if (response.data.status == 'failed') {
					Swal.fire({
						icon: 'error',
						title: response.data.result,
						showConfirmButton: false,
						timer: 4000,
						onClose: this.$router.push({name: 'Login'})
					})
				}
				
				if (response.data.status == 'Success') {
					this.$router.push({name: 'CreateEmployee'});
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
		getBasic: function(e) {
			[
				this.basicInformation.employeeCode, 
				this.basicInformation.suffixName, 
				this.basicInformation.firstName, 
				this.basicInformation.middleName, 
				this.basicInformation.lastName, 
				this.basicInformation.companyEmail, 
				this.basicInformation.personalEmail,
			] = e;
		},
		getEducation: function(e) {
			this.educationalBackground = e;
		},
		getAdditional: function(e) {
			[
				this.additionalInformation.religion, 
				this.additionalInformation.marital_status, 
				this.additionalInformation.gender, 
				this.additionalInformation.height, 
				this.additionalInformation.weight, 
				this.additionalInformation.birth_date, 
				this.additionalInformation.birth_place,
				this.additionalInformation.present_address, 
				this.additionalInformation.province_address,
			] = e;
		},
		getPosition: function(e) {
			[
				this.positionDetails.selected_company, 
				this.positionDetails.selected_department, 
				this.positionDetails.selected_report_to, 
				this.positionDetails.position, 
				this.positionDetails.selected_project, 
			] = e;
		},
		getPayroll: function(e) {
			this.payrollDetails = e;
		},
		getImage: function(e) {
			this.image = e;
		},
	},
};
</script>