<template>
	<div id="table-header">
		<div class="d-flex justify-content-between">
			<div class="m-0 p-0">
				<h3 class="mb-0">{{header.title}}</h3>
				<p>{{header.description}}</p>
			</div>
			<div class="d-flex pt-3">
				<div class="dropdown">
					<button type="button" class="btn btn-primary btn-sm align-self-start mx-1 px-3" data-toggle="dropdown">
					<i class="fa fa-ellipsis-h" aria-hidden="true"></i> More
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Import</a>
						<a class="dropdown-item" href="#">Export</a>
						<a class="dropdown-item" href="#">Archived</a>
					</div>
				</div>
				<button class="btn btn-success btn-sm align-self-start mx-1 px-3" @click="()=>this.$router.push({name: header.create})"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
export default {
	props: ['header'],
};
</script>