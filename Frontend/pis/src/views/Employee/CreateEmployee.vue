<template>
	<div id="createemployee">
		<div class="p-5 bg-white rounded">
			<div class="px-5">
				<h4 class="mb-0">Create Employee</h4>
				<p>Fill all the fields to register new employee.</p>
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
			</div>
		</div>
	</div>
</template>

<script>
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
				company: '', 
				department: '',
				report_to: '',
				position: '',
				projects: [],
			},
			payrollDetails: [],
			image: '',
			activeTabIndex: 0
		};
	},
	methods: {
		onComplete: function(){
			alert('Yay. Done!');
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
				this.positionDetails.company, 
				this.positionDetails.department, 
				this.positionDetails.report_to, 
				this.positionDetails.position, 
				this.positionDetails.projects, 
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