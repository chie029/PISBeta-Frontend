<template>
	<div>
		<h5 class="mb-4 p-0">
			<i class="fas fa-school"></i> Educational Background
		</h5>
		<div>
			<table id="dataTable" width="100%" cellspacing="0">
				<tbody v-for="(education, index) in educations" v-bind:key="index">
					<tr>
						<td>
							<div id="educational_background" class="my-2 p-4 shadow-sm">
								<input type="text" class="form-control mb-3" placeholder="Institute Name" v-model="education.institute_name">
								<input type="text" class="form-control my-3" placeholder="Institute Location" v-model="education.institute_location">
								<div class="d-flex my-3">
									<select class="form-control mr-1" v-model="education.graduation_month">
										<option value="" disabled selected>Graduation Month</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
									<select class="form-control ml-1" v-model="education.graduation_year">
										<option value="" disabled selected>Graduation Year</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
								<select class="form-control my-3" v-model="education.qualification">
									<option value="" disabled selected>Qualification</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
								<input type="text" class="form-control my-4" placeholder="Major" v-model="education.major">
								<textarea class="form-control mt-3" placeholder="Additional Information" v-model="education.additional_information"></textarea>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="d-flex my-3">
				<button type="button" class='delete btn btn-danger btn-sm mr-2' @click="deleteEducation()">Delete</button>
				<button type="button" class='btn btn-success btn-sm' @click="addEducation()">Add</button>
			</div>
		</div>
	</div>
</template>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
export default{
	name: 'EducaitonalBackground',
	data() {
		return {
			educations: [],
		}
	},
	methods: {
		addEducation: function () {
			this.educations.push({});
		},
		deleteEducation: function () {
			this.educations.pop();
		},
	},
	watch: {
		educations: {
			handler: function() {
				this.$emit('newdata', this.educations);
			},
			deep: true
		}
	},
};
</script>