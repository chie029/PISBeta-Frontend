<template>
	<div id="employee">
		<div class="m-0 pt-5 px-5 bg-white">
			<TableHeader
				:header="header">
			</TableHeader>
			<Table
				:rows="employees"
				:cid="ids"
				@search="search($event)">
			</Table>
		</div>
		<Pagination
			:paginate="footer"
			@show="changeShow($event)"
			@page="changePage($event)"
			@pageIndex="changePageIndex($event)">
		</Pagination>
	</div>
</template>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
import Swal from 'sweetalert2/src/sweetalert2.js'
import TableHeader from '@/components/Datatable/TableHeader.vue';
import Table from '@/components/Datatable/Table.vue';
import Pagination from '@/components/Datatable/Pagination.vue';
export default {
	name: 'Employee',
	components:{
		TableHeader,
		Table,
		Pagination,
	},
	data() {
		return {
			isInvalid: '',
			header: {
				title: 'Employee List',
				description: 'Here is the list of the employees.',
				create: 'CreateEmployee',
			},
			employees: [],
			ids: [],
			searchitem: '',
			footer: {
				total: '',
				rows: '',
				first: '',
				previous: '',
				next: '',
				last: '',
				last_page: '',
				current_page: '',
			},
			errors: [],
		}
	},
	methods: {
		getRecords: function(){
			var url = this.$store.state.employee + 'employee?token=' + this.$session.get('token');
			this.dataTable(url);
		},
		search: function(e) {
			if (e != '') {
				var url = this.$store.state.employee + 'employee?token=' + this.$session.get('token') + '&search=' + e;
				this.dataTable(url);
			}else {
				this.getRecords();
			}
		},
		changeShow: function(e) {
			var url = this.$store.state.employee + 'employee?token='+this.$session.get('token')+'&show=' + e;
			this.dataTable(url);
		},
		changePage: function(e){
			if (e[0] != null) {
				var url = e[0] + '&token='+this.$session.get('token')+'&show=' + e[1];
				this.dataTable(url);
			}
		},
		changePageIndex: function(e){
			var url = this.$store.state.employee + 'employee?token='+this.$session.get('token')+'&page=' + e[0] + '&show=' + e[1];
			this.dataTable(url);
		},
		dataTable(url){
			this.checkToken();

			this.axios.get(url)
			.then(response => {
				this.employees = [];
				this.ids = [];
				console.log(response);
				for (var i = response.data.result.data.length - 1; i >= 0; i--) {
					var cid = response.data.result.data[i].id
					var name = response.data.result.data[i].basic_information.first_name + " " +response.data.result.data[i].basic_information.middle_name +" "+response.data.result.data[i].basic_information.last_name
					var code = response.data.result.data[i].basic_information.employee_code
					var email = response.data.result.data[i].email
					var position = response.data.result.data[i].position.position
					var department = response.data.result.data[i].position.department.department_name
					var company = response.data.result.data[i].position.company.company_name
					this.employees.push({ 
						'Code': code,
						'Employee': name,
						'Email': email,
						'Position': position,
						'Department': department,
						'Company': company,
					});
					this.ids.push({'id': cid});
				}
				this.footer.total = response.data.result.total;
				this.footer.rows = response.data.result.per_page;
				this.footer.first = response.data.result.first_page_url;
				this.footer.previous = response.data.result.prev_page_url;
				this.footer.next = response.data.result.next_page_url;
				this.footer.last = response.data.result.last_page_url;
				this.footer.last_page = response.data.result.last_page;
				this.footer.current_page = response.data.result.current_page;
			})
			.catch(e => {
				console.log(e);
				Swal.fire({
					icon: 'info',
					title: e,
					showConfirmButton: false,
					timer: 4000,
					// onClose: this.$router.push({name: 'Login'})
				})
			})
		},
		checkToken(){
			this.axios.get(this.$store.state.employee + 'get-auth?token=' + this.$session.get('token'),)
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
			})
			.catch(e => {
				console.log(e);
				Swal.fire({
					icon: 'info',
					title: 'Check your Connection !',
					showConfirmButton: false,
					timer: 4000,
					onClose: this.$router.push({name: 'Login'})
				})
			})
		}
	},
	beforeMount(){
		this.getRecords();
	}
};
</script>
