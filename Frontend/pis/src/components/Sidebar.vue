<template>
	<div class="sidenav">
		<div class="w-100 d-flex justify-content-between py-3 px-4">
			<i class="fa fa-cog btn-icon"></i>
			<i class="fa fa-sign-out-alt btn-icon" @click="logout()"></i>
		</div>
		<div class="m-0 p-0 w-100">
			<center>
				<img :src="require('../assets/Images/' + image)" width="80px" height="80px" class="mt-4 rounded-circle">
				<h5 class="m-0 mt-3 p-0 text-white">{{name}}</h5>
				<h6 class="m-0 p-0" style="color: #C8C8C8">{{email}}</h6>
			</center>
		</div>
		<div class="mt-5">
			<button class="dropdown-btn"><i class="fa fa-building ml-1 mr-3" style="font-size: 16px"></i>Company 
			<!-- <i class="fa fa-caret-down"></i> -->
			</button>
			<div class="dropdown-container">
				<a href="#"><i class="fa fa-building ml-2 mr-3"></i>Company</a>
				<a href="#"><i class="fa fa-network-wired ml-1 mr-3"></i>Department</a>
				<a href="#"><i class="fa fa-project-diagram ml-1 mr-3"></i>Project</a>
				<a href="#"><i class="fa fa-book ml-2 mr-3"></i>Journal Category</a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-users mr-3" style="font-size: 16px"></i>Employee 
			<!-- <i class="fa fa-caret-down"></i> -->
			</button>
			<div class="dropdown-container">
				<a href="#"><i class="fa fa-users ml-1 mr-3"></i>Employee</a>
				<a href="#"><i class="fa fa-user-friends ml-1 mr-3"></i>User</a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-money-check mr-3" style="font-size: 16px"></i>Payroll Details 
			<!-- <i class="fa fa-caret-down"></i> -->
			</button>
			<div class="dropdown-container">
				<a href="#"><i class="fa fa-money-check ml-1 mr-3"></i>Payroll Group</a>
				<a href="#"><i class="fa fa-hand-holding-usd ml-1 mr-3"></i>Compensation</a>
				<a href="#"><i class="fa fa-funnel-dollar ml-1 mr-3"></i>Deduction</a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-calendar-minus ml-1 mr-3" style="font-size: 16px"></i>Leave 
			<!-- <i class="fa fa-caret-down"></i> -->
			</button>
			<div class="dropdown-container">
				<a href="#"><i class="fa fa-calendar-minus ml-1 mr-3"></i>Leave</a>
				<a href="#"><i class="fa fa-receipt ml-2 mr-3"></i>Leave Credits</a>
			</div>
		</div>
	</div>
</template>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
export default{
	data(){
		return {
			image: '',
			name: '',
			email: ''
		}
	},
	mounted() {
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

		// $('.dropdown-btn').click(function(){
		// 	$('button.dropdown-btn').removeClass('active');
		// 	$('.dropdown-container').css("display", "none");
		// });
		for (i = 0; i < dropdown.length; i++) {
			dropdown[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var dropdownContent = this.nextElementSibling;
				if (dropdownContent.style.display === "block") {
					dropdownContent.style.display = "none";
				} else {
					dropdownContent.style.display = "block";
				}
			});
		}
	},
	methods : {
		logout(){
			this.$session.destroy();
			this.$router.push({name: 'Login'})
		}
	},
    created() {
		this.name = this.$session.get('name')
		this.email = this.$session.get('email')
		this.image = this.$session.get('image')
	}
};
</script>

<style>

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
	padding: 10px 8px 10px 16px;
	text-decoration: none;
	font-size: 18px;
	color: #D4D4D4;
	display: block;
	border: none;
	background: none;
	width: 100%;
	text-align: left;
	cursor: pointer;
	outline: none;
}

.dropdown-container a {
	font-size: 16px !important;
	background-color: #1C2A38;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
	background-color: rgba(58, 78, 105, 1);
	color: #ffffff;
}

.dropdown-container a:hover {
	background-color: #183246;
	color: #ffffff;
}

.dropdown-btn:focus {
  outline: none;
  box-shadow: none;
}

/* Add an active class to the active dropdown button */
.active {
	background-color: rgba(58, 78, 105, 1);
	color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
	display: none;
	background-color: #1C2A38;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
	float: right;
	padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
	.sidenav {padding-top: 15px;}
	.sidenav a {font-size: 18px;}
}
</style>