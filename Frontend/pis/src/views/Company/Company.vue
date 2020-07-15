<template>
	<div id="company">
		<div class="m-0 pt-5 px-5 bg-white">
			<TableHeader
				:header="header">
			</TableHeader>
			<Table
				:rows="companies"
				:cid="ids"
				:page="page"
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
import Swal from 'sweetalert2'
import TableHeader from '@/components/Datatable/TableHeader.vue';
import Table from '@/components/Datatable/Table.vue';
import Pagination from '@/components/Datatable/Pagination.vue';
export default {
	name: 'Company',
	components:{
		TableHeader,
		Table,
		Pagination,
	},
	data() {
		return {
			isInvalid: '',
			header: {
				title: 'Company List',
				description: 'Here is the list of the company.',
				create: 'CreateCompany'
			},
			page: [ 'ShowCompany' ],
			companies: [],
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
			var url = this.$store.state.company + 'company';
			this.dataTable(url);
		},
		search: function(e) {
			if (e != '') {
				var url = this.$store.state.company + 'company?search=' + e;
				this.dataTable(url);
			}else {
				this.getRecords();
			}
		},
		changeShow: function(e) {
			var url = this.$store.state.company + 'company?show=' + e;
			this.dataTable(url);
		},
		changePage: function(e){
			if (e[0] != null) {
				var url = e[0] + '&show=' + e[1];
				this.dataTable(url);
			}
		},
		changePageIndex: function(e){
			var url = this.$store.state.company + 'company?page=' + e[0] + '&show=' + e[1];
			this.dataTable(url);
		},
		dataTable(url){
			this.checkToken();

			this.axios.get(url)
			.then(response => {
				this.companies = [];
				this.ids = [];
				console.log(response);
				for (var i = response.data.data.data.length - 1; i >= 0; i--) {
					var cid = response.data.data.data[i].id
					var name = response.data.data.data[i].name
					var code = response.data.data.data[i].code
					var contact = response.data.data.data[i].contact
					var address = response.data.data.data[i].address
					this.companies.push({ 
						'name': name, 
						'code': code,
						'contact': contact,
						'address': address,
					});
					this.ids.push({'id': cid});
				}
				this.footer.total = response.data.data.total;
				this.footer.rows = response.data.data.per_page;
				this.footer.first = response.data.data.first_page_url;
				this.footer.previous = response.data.data.prev_page_url;
				this.footer.next = response.data.data.next_page_url;
				this.footer.last = response.data.data.last_page_url;
				this.footer.last_page = response.data.data.last_page;
				this.footer.current_page = response.data.data.current_page;
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
		checkToken(){
			this.axios.get(this.$store.state.employee + 'get-auth?token=' + this.$session.get('token'))
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
					title: 'Check you Connection!',
					showConfirmButton: false,
					timer: 4000,
				})
			})
		}
	},
	beforeMount(){
		this.getRecords();
	}
};
</script>
