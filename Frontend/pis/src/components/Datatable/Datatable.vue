<template>
	<div>
		<div class="pt-5 bg-white rounded">
			<div class="px-5 mx-5">
				<div class="d-flex justify-content-between">
					<div>
						<h4 class="mb-0">Create Company</h4>
						<p>Fill all the fields to register new company.</p>
					</div>
					<div>
						<div class="btn-group">
							<button type="button" class="btn btn-primary btn-sm py-1 px-3 mx-1 dropdown-toggle" data-toggle="dropdown">
							More
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Import</a>
								<a class="dropdown-item" href="#">Export</a>
							</div>
						</div>
						<button class="btn btn-success btn-sm py-1 px-3 mx-1">Create</button>
					</div>
				</div>
				<div class="mt-3">
					<div class="responsive-table">
						<table id="example" class="table borderless">
							<thead>
								<tr>
									<th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
									<th v-for="col in columns" v-bind:key="col">{{ col | capitalize }}</th>
								</tr>
							</thead>
							<tbody>
								<tr class="shadow-sm mt-2 mb-4 p-5" v-for="row in rows" v-bind:key="row">
									<td></td>
									<td v-for="col in columns" v-bind:key="col">{{row[col]}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div id="table-footer" class="d-flex justify-content-between px-5 py-4 bg-light rounded">
				<div class="d-flex ml-5">
					<div class="align-self-center m-0 p-0 mr-2" id="custom_info"></div>
					<div class="align-self-center m-0 p-0 ml-2" id="custom_length"></div>
				</div>
				<div id="custom_pagination"></div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		rows: [],
	},
	computed: {
		"columns": function columns() {
			if (this.rows.length == 0) {
				return [];
			}
			return Object.keys(this.rows[0])
		},
	},
	filters: {
		capitalize: function (str) {
			return str.charAt(0).toUpperCase() + str.slice(1)
		}
	},
	watch: {
		rows: {
			handler: function() {
				const $ = window.$;
				$(document).ready(function() {
					var table = $('#example').DataTable({
						language: { 
							search: "",
							"info": "<b>_MAX_</b> items total",
							"lengthMenu": "_MENU_ rows per page",
							"lengthChange": true,
							"paginate": {
								"first": "&#11164;",
								"last": "&#11166;",
							}
						},
						"pagingType": "full_numbers",
						'columnDefs': [{
							'targets': 0,
							'searchable': false,
							'orderable': false,
							'className': 'dt-body-center',
							'render': function (data){
								return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
							}
						}],
					}); 
					$('#example_filter input').attr('placeholder', 'Search');
					$("#custom_pagination").append($(".dataTables_paginate"));
					$("#custom_info").append($("#example_info"));
					$("#custom_length").append($("#example_length"));

					$('#example tbody').on('change', 'input[type="checkbox"]', function(){
						if(!this.checked){
							var el = $('#example-select-all').get(0);
							if(el && el.checked && ('indeterminate' in el)){
								el.indeterminate = true;
							}
						}
					});
					$('#example-select-all').on('click', function(){
						var rows = table.rows({ 'search': 'applied' }).nodes();
						$('input[type="checkbox"]', rows).prop('checked', this.checked);
					});
					$('#frm-example').on('submit', function(){
						var form = this;
						table.$('input[type="checkbox"]').each(function(){
							if(!$.contains(document, this)){
								if(this.checked){
									$(form).append(
										$('<input>')
										.attr('type', 'hidden')
										.attr('name', this.name)
										.val(this.value)
									);
								}
							}
						});
					});
				});
			}
		}
	},
};
</script>


<style>
#table-footer #example_length label {
	margin-bottom: 0px !important;
}

#example_filter input{
	border-radius: 30px;
	padding-left: 15px;
	padding-right: 15px;
	padding-top: 4px;
	padding-bottom: 5px;
	border: none;
	background-color: rgba(0,0,0,0.1);
}

#example_filter input:focus, 
#example_length select:focus {
    outline: none;
}

#example_paginate {
	margin-right: 55px !important;
}

#example_length select {
	border: none;
	background-color: transparent;
	font-weight: bold;
}

.borderless td, .borderless th, .borderless thead, .borderless tbody, .borderless tr {
    border: none;
}

table {
    border-spacing: 0 0.5em !important;
    border-collapse: separate;
    padding: 10px;
}

.paginate_button {
	cursor: pointer;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 5px;
	margin-left: 3px;
	margin-right: 3px;
}

a.current {
	font-weight: 500;
	color: #2364A3;
	border-top: 2px solid #2364A3;
}
</style>