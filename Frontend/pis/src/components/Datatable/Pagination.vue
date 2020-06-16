<template>
	<div id="table-footer" class="m-0 p-0 w-100">
		<div class="m-0 bg-light px-5 py-2 d-flex justify-content-between">
			<div class="m-0 p-2 d-flex">
				<p><b>{{paginate.total}}</b> items total</p>
				<p>{{wow}}
				<select id="length" v-model="paginate.rows">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				rows per page</p>
			</div>
			<div class="d-flex">
				<button class="btn btn-priamry align-self-start">&#11164;</button>
				<button class="btn btn-priamry align-self-start">Prev</button>
				<span>
					<button class="btn btn-priamry align-self-start">1</button>
					<button class="btn btn-priamry align-self-start">2</button>
					<button class="btn btn-priamry align-self-start">3</button>
					<button class="btn btn-priamry align-self-start">4</button>
					<button class="btn btn-priamry align-self-start">5</button>
					<button class="btn btn-priamry align-self-start">6</button>
				</span>
				<button class="btn btn-priamry align-self-start">Next</button>
				<button class="btn btn-priamry align-self-start">&#11166;</button>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
export default{
	data(){
		return{
			wow: '',
		}
	},
	props: ['paginate'],
	watch: {
		paginate: function() {
			this.wow = 'next'
		}
	}
};
</script>

<style type="text/css">
	p {
		font-size: 13px;
		letter-spacing: 0.5px;
		margin-right: 15px;
	}

	#length {
		outline: none;
		border: none;
		background-color: transparent;
		font-weight: bold;
	}
</style>