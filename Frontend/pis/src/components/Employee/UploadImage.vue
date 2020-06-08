<template>
	<div>
		<h5 class="mb-4 p-0">
			<i class="fas fa-user"></i> Upload Image
		</h5>
		<div v-if="!image">
			<center>
				<h2>Select an image</h2>
				<p class="text-success mb-4">Almost done! Upload a photo of the employee!</p>
				<img src="../../assets/img/default.jpg" class="rounded-circle img-upload" />
				<span class="btn btn-success btn-sm btn-file">
					<i class="fas fa-fw fa-image text-white"></i> Choose Photo<input type="file" @change="onFileChange">
				</span>
				<br>
				<br>
			</center>
		</div>
		<div v-else>
			<center>
				<h2>Select an image</h2>
				<p class="text-success mb-4">Almost done! Please review all the details before saving!</p>
				<img :src="image" class="rounded-circle img-upload" />
				<span class="btn btn-success btn-sm btn-file">
					<i class="fas fa-fw fa-image text-white"></i> Change Photo<input type="file" @change="onFileChange">
				</span>
				<br>
				<br>
			</center>
		</div>
	</div>
</template>

<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
export default{
	data() {
		return {
			image: ''
		}
	},
	methods: {
		onFileChange(e) {
			var files = e.target.files || e.dataTransfer.files;
			if (!files.length)
				return;
				this.createImage(files[0]);
		},
		createImage(file) {
			// var image = new Image();
			var reader = new FileReader();
			var vm = this;

			reader.onload = (e) => {
				vm.image = e.target.result;
			};
			reader.readAsDataURL(file);
		},
		removeImage: function () {
			this.image = '';
		}
	},
	watch: {
		image: {
			handler: function() {
				this.$emit('newdata', this.image);
			},
			deep: true
		}
	},
};
</script>