<template>
	<div id="table" class="m-0 p-0">
		<div class="table-responsive">
			<div id="search">
				<span class="fas fa-search"></span>
				<input id="table-search" type="text" class="from-control m-0" v-model="search" placeholder="Search">
				<span class="fas fa-times" @click="()=>this.search = ''"></span>
			</div>
			<table id="table" class="table borderless m-0 p-0">
				<thead>
					<tr>
						<th style="width: 10px"><input type="checkbox" v-model="allSelected" @click="selectAll"></th>
						<th style="width: 20px" v-for="col in columns" v-bind:key="col">{{ col | capitalize }}</th>
					</tr>
				</thead>
				<tbody>
					<tr class="pointer" v-for="(row, index) in rows" v-bind:key="index" @click="show(cid[index]['id'], page)">
						<td class="align-middle"><input type="checkbox" @click="select" v-model="itemid" :value="cid[index]['id']"></td>
						<td class="align-middle" v-for="col in columns" v-bind:key="col">{{ row[col] }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return{
			allSelected: false,
			itemid: [],
			search: '',
			sample: ''
		}
	},
	props: {
		rows: [],
		cid: [],
		page: [],
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
			return str.toUpperCase()
		},
		limit: function(str) {
			var length = 50;
			if (str.length > length) {
				return str.substring(0, length) + '...';
			}
			return str;
		},
	},
	methods: {
        selectAll: function() {
            this.itemid = [];
            this.allSelected = !this.allSelected;

            if (this.allSelected) {
				for (var i = this.cid.length - 1; i >= 0; i--) {
					this.itemid.push(this.cid[i].id.toString());
                }
            }
        },
        select: function() {
            this.allSelected = false;
        },
        show(id, page) {
			this.$router.push({name: page, params: {id: id}});
        }
	},
	watch: {
		search: {
			handler: function() {
				this.$emit('search', this.search);
			}
		},
	},
};
</script>

<style type="text/css">
	table {
		border-spacing: 0 0.4em !important;
		box-sizing: border-box;
		border-collapse: separate;
		padding: 10px;
		border: none !important;
	}

	table tbody tr td:nth-child(1) { 
		border-left: 0.5px solid rgba(194,194,194,0.8); 
		border-top: 0.5px solid #C2C2C2; 
		border-bottom: 4px solid #C2C2C2; 
		border-top-left-radius: 5px;
		border-bottom-left-radius: 5px;
	}

	table tbody tr td { 
		border-top: 0.5px solid #C2C2C2 !important; 
		border-bottom: 4px solid #C2C2C2 !important;
		font-weight: 500;
		font-size: 13px;
	}

	table tbody tr td:last-child { 
		border-right: 4px solid rgba(194,194,194,0.8); 
		border-top: 1px solid #C2C2C2; 
		border-bottom: 4px solid #C2C2C2;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;
	}

	table thead tr th {
		color: #7F7F7F;
		font-weight: 500 !important;
		font-size: 13px;
	}

	.borderless td, .borderless th, .borderless tr, .borderless thead {
		border: none;
	}

	#search{
		float: right;
		border-radius: 5px;
		background-color: #F1F1F1;
		padding-left: 10px;
		padding-right: 10px;
		width: auto;
	}

	#search #table-search{
		background-color: #F1F1F1;
		margin-right: 5px;
		margin-left: 10px;
		padding: 5px;
		border: none;
	}

	#search #table-search:focus {
		outline: none;
	}

	#search span {
		margin-left: 5px;
		width: 15px;
		color: #7F7F7F;
		font-size: 13px;
	}

	.pointer {
		cursor: pointer;
	}
</style>