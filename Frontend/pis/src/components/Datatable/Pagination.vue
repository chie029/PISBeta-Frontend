<template>
	<div id="table-footer" class="m-0 p-0 w-100">
		<div class="m-0 bg-light px-5 pt-2 d-flex justify-content-between">
			<div class="m-0 pt-2 px-2 pb-0 d-flex">
				<p><b>{{paginate.total}}</b> items total</p>
				<p>
				<select id="length" v-model="paginate.rows">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				rows per page</p>
			</div>
			<div id="paginate_button" class="d-flex">
				<button class="btn btn-priamry btn-sm align-self-start" @click="()=>this.$emit('page', [paginate.first, paginate.rows])">&#11164;</button>
				<button class="btn btn-priamry btn-sm align-self-start" @click="()=>this.$emit('page', [paginate.previous, paginate.rows])">Prev</button>
				<span>
					<button v-for="index in paginate.last_page" v-bind:key="index" :id="'btn-' + index" class="btn btn-priamry btn-sm align-self-start btn_paginate" @click="changePageIndex(index, paginate.rows)">{{index}}</button>
				</span>
				<button class="btn btn-priamry btn-sm align-self-start" @click="()=>this.$emit('page', [paginate.next, paginate.rows])">Next</button>
				<button class="btn btn-priamry btn-sm align-self-start" @click="()=>this.$emit('page', [paginate.last, paginate.rows])">&#11166;</button>
				<div id="page_info" class="ml-2 align-self-center">
					<p>Page <span>{{paginate.current_page}}</span> of <span>{{paginate.last_page}}</span></p>
				</div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
export default{
	props: {
		paginate: {
			total: '',
			rows: '',
			first: '',
			previous: '',
			next: '',
			last: '',
			last_page: '',
			current_page: '',
		}
	},
	watch: {
		'paginate.rows': function(newVal) {
			this.$emit('show', newVal);
		},
		'paginate.current_page': function(newVal) {
			const $ = window.$;
			$("#paginate_button span .btn_paginate").removeClass('active');
			$("#paginate_button span .btn_paginate:nth-child("+newVal+")").addClass('active');
		}
	},
	methods: {
		changePageIndex: function(index, rows){
			this.$emit('pageIndex', [index, rows]);
		}
	},
	mounted(){
		const $ = window.$;
		$("#paginate_button span .btn_paginate:nth-child(1)").addClass('active');
	},
};
</script>

<style type="text/css">
	p {
		font-size: 13px;
		letter-spacing: 0.5px;
		margin-right: 15px;
	}

	.btn:focus {
		outline: none;
		box-shadow: none;
	}

	#length {
		outline: none;
		border: none;
		background-color: transparent;
		font-weight: bold;
	}

	#paginate_button button {
		border-radius: 0;
	}

	#paginate_button span .btn_paginate.active {
		border-top: 2px solid #4E73DF;
		color: #4E73DF;
	}

	#page_info span {
		font-weight: 500;
	}
</style>