<template>
	<div id="createuser">
		<div class="m-0 pt-5 px-5 bg-white">
			<TableHeader
				:header="header">
			</TableHeader>
			<Table
				:rows="companies"
				:cid="ids"
				@search="search($event)">
			</Table>
		</div>
		<Pagination
			:paginate="footer">
		</Pagination>
	</div>
</template>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
			header: {
				title: 'Company List',
				description: 'Here is the list of the company.',
			},
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
			}
		}
	},
	methods: {
		search: function(e) {
			if (e != '') {
				this.axios.get(this.$store.state.company + 'company?search=' + e)
				.then(response => {
					this.companies = [];
					this.ids = [];
					console.log(response);
					for (var i = response.data.data.data.length - 1; i >= 0; i--) {
						var cid = response.data.data.data[i].company_id
						var name = response.data.data.data[i].company_name
						var code = response.data.data.data[i].company_code
						var contact = response.data.data.data[i].company_contact
						var address = response.data.data.data[i].company_address
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
				})
				.catch(e => {
					this.errors.push(e)
					alert('error');
				})
			}else {
				this.getRecords();
			}
		},
		getRecords: function(){
			this.companies = [];
			this.axios.get(this.$store.state.company + 'company')
			.then(response => {
				this.companies = [];
				this.ids = [];
				console.log(response);
				for (var i = response.data.data.data.length - 1; i >= 0; i--) {
					var cid = response.data.data.data[i].company_id
					var name = response.data.data.data[i].company_name
					var code = response.data.data.data[i].company_code
					var contact = response.data.data.data[i].company_contact
					var address = response.data.data.data[i].company_address
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
			})
			.catch(e => {
				this.errors.push(e)
				alert('error');
			})
		}
	},
	beforeMount(){
		this.getRecords();
	}
};
</script>
