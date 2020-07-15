<template>
	<div id="createemployee">
		<div class="p-5 bg-white rounded">
			<div class="px-5">
				<div class="d-flex justify-content-between">
					<div>
						<h4 class="mb-0">{{header.title}}</h4>
						<p>{{header.description}}</p>
					</div>
					<div v-if="!ifCreate(header.title)">
						<i class="fa" v-bind:class="{ 'fa-edit': !header.isEdit, 'fa-times': header.isEdit }" style="font-size: 18px;" @click="()=>header.isEdit = !header.isEdit"></i>
					</div>
				</div>
				<div class="my-2">
					<slot></slot>
				</div>
			</div>	
		</div>
	</div>
</template>

<script type="text/javascript">
export default {
	props: ['header'],
	methods: {
		ifCreate(string){
			if (string.includes('Create')) {
				return true;
			}
			return false;
		}
	},
	watch: {
		'header.isEdit': function(newVal)  {
			this.$emit('edit', newVal);
		},
	}
};
</script>