<template>
  <div id="app" v-if="this.$route.name!='Login'">
    <div class="page-wrapper chiller-theme toggled">
      <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
      </a>
      <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
          <div class="sidebar-brand">
            <a href="#">
              <i class="fas fa-cog" style="font-size: 15px"></i>
            </a>
            <div id="close-sidebar">
              <i class="fas fa-bars" style="font-size: 15px"></i>
            </div>
          </div>
          <div class="sidebar-header">
            <center>
              <div class="user-pic">
                <img class="img-responsive rounded-circle" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                  alt="User picture">
              </div>
            </center>
            <center>
              <div class="user-info">
                <span class="user-name">
                  <strong>Jhon Smith</strong>
                </span>
                <span class="user-role">Administrator</span>
              </div>
            </center>
          </div>
          <!-- sidebar-header  -->
          <div class="sidebar-menu">
            <ul>
              <li :class="{ active: currentPage == '/Dashboard' }">
                <a href="" @click="()=>{this.$router.push({name: 'Dashboard'})}">
                  <i class="fa fa-tachometer-alt"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Company' }">
                <a href="" @click="()=>{this.$router.push({name: 'Company'})}">
                  <i class="fa fa-building"></i>
                  <span>Company</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Department' }">
                <a href="#">
                  <i class="fa fa-university"></i>
                  <span>Department</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Project' }">
                <a href="#">
                  <i class="fa fa-briefcase"></i>
                  <span>Project</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Employee' }">
                <a href="" @click="()=>{this.$router.push({name: 'Employee'})}">
                  <i class="fa fa-user-tie"></i>
                  <span>Employee</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/CreateUser' }">
                <a href="" @click="()=>{this.$router.push({name: 'CreateUser'})}">
                  <i class="fa fa-user-alt"></i>
                  <span>User</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/PayrollGroup' }">
                <a href="#">
                  <i class="fa fa-money-check"></i>
                  <span>Payroll Group</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Compensation' }">
                <a href="#">
                  <i class="fa fa-credit-card"></i>
                  <span>Compensation</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Deduction' }">
                <a href="#">
                  <i class="fa fa-funnel-dollar"></i>
                  <span>Deduction</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/Leave' }">
                <a href="#">
                  <i class="fa fa-calendar-times"></i>
                  <span>Leave</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/LeaveCredit' }">
                <a href="#">
                  <i class="fa fa-file-invoice"></i>
                  <span>Leave Credits</span>
                </a>
              </li>
              <li :class="{ active: currentPage == '/JournalCategory' }">
                <a href="#">
                  <i class="fa fa-book"></i>
                  <span>Journal Category</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
      </nav>
      <!-- sidebar-wrapper  -->
      <main class="page-content">
        <nav class="navbar navbar-expand-sm bg-white">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                <label class="align-self-center m-0 mr-2 p-0 text-dark">Charlie Ching Olivera</label>
                <img class="img-responsive rounded-circle align-self-center" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture" style="width: 30px; height: 30px">
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" @click="logout()">Logout</a>
              </div>
            </li>
          </ul>
        </nav>
        <router-view/>
      </main>
      <!-- page-content" -->
    </div>
  </div>
  <div id="app" v-else>
    <router-view/>
  </div>
</template>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

<script type="text/javascript">
  export default{
    data(){
      return{
        currentPage: this.$route.path,
      }
    },
    created() {
      if (this.$store.state.api_host == 'charlie') {
        this.$store.state.employee = 'http://localhost/PISBeta/Backend/Employees/api/'
        this.$store.state.company = 'http://localhost/PISBeta/Backend/Company/api/'
        this.$store.state.compensation = 'http://localhost/PISBeta/Backend/CompensationandDedution/api/'
      }
    },
    methods:{
      logout(){
        this.axios.post(this.$store.state.employee + 'logout?token=' + this.$session.get('token'))
        .then(response => {
          this.$session.destroy();
          this.$router.push({name: 'Login'})
        })
        .catch(e => {
          this.errors.push(e)
        })
      },
    },
    mounted() {
      $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).parent().hasClass("active")) {
          $(".sidebar-dropdown").removeClass("active");
          $(this).parent().removeClass("active");
        } else {
          $(".sidebar-dropdown").removeClass("active");
          $(this).next(".sidebar-submenu").slideDown(200);
          $(this).parent().addClass("active");
        }
      });

      $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
      });
      $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
      });
    },
    watch:{
        $route (to, from){
            // location.reload();
        }
    } 
  };
</script>

<style type="text/css">
body {
    background: #E4E4E4;
}

img {
    object-fit: cover;
}

.standard-text {
    height: 30px !important;
    font-size: 14px !important;
}

.standard-label{
    font-size: 11px !important;
}

.form-s{
  padding: 5px 0px 5px 0px;
  /*border: 1px solid black;*/
}

.label-s{
    font-size: 13px;
    letter-spacing: 0.7px;
    margin: 0px !important;
    display: block;
}

.label-inline-s {
    font-size: 15px;
    letter-spacing: 0.7px;
    margin: 0px;
}

.inline { 
    float: left !important;
}

.title-s {
    font-size: 15px;
    letter-spacing: 0.7px;
    margin: 0px;
}

.title-md {
    font-size: 18px;
    letter-spacing: 0.7px;
    margin: 0px; 
}

.title-lg {
    font-size: 20px;
    letter-spacing: 0.7px;
    margin: 0px;
}

/* Forms*/
/*.input-edit-s:focus {
    border-color: #F1BE3D !important;
    box-shadow: 0 0 0 0.2rem rgba(241, 190, 61, 0.25) !important;
} */

.input-edit-s {
  background-color: #F8F9FC ;
  color: dimgray;
    display: block;
    height: 35px !important;
    font-size: 14px !important;
  padding-left: 15px;
  border: 1px solid lightgray;
  border-radius: 4px;
  letter-spacing: 0.7px;
}

.input-area-s {
    background-color: #F8F9FC;
    color: dimgray;
    display: block;
    font-size: 14px !important;
    padding: 10px;
    border: 1px solid lightgray;
    border-radius: 4px;
    letter-spacing: 0.7px;
}

.input-area-view-s {
    background-color: #FFFFFF;
    color: dimgray;
    font-size: 14px !important;
    padding: 15px;
    border: 0px;
    pointer-events: none;
    letter-spacing: 0.7px;
}

.input-select-s {
  background-color: #F8F9FC;
  color: dimgray;
    height: 35px !important;
    font-size: 14px !important;
  border: 1px solid lightgray;
  border-radius: 4px;
  letter-spacing: 0.7px;
  text-indent: 10px;
}

.input-view-s {
    background-color: #FFFFFF;
    color: dimgray;
    height: 35px !important;
    font-size: 14px !important;
    padding: 15px;
    margin: 0px;
    border: 0px;
    pointer-events: none;
    letter-spacing: 0.5px;
}

.input-view-m {
    background-color: #FFFFFF;
    color: dimgray;
    height: 30px !important;
    font-size: 14px !important;
    padding: 10px;
    border: 0px;
    pointer-events: none;
    letter-spacing: 0.5px;
}

.input-view-border-0{
  background-color: #FFFFFF;
  color: dimgray;
    display: block;
    height: 35px !important;
    font-size: 14px !important;
  padding: 15px;
  border: 0px solid;
  pointer-events: none;
  letter-spacing: 0.5px;
}

.input-edit-s:focus, .input-area-s:focus, .input-select-s:focus {
    background-color: white;
    /*outline: none !important;
    border-bottom: 2px solid #2A3F54 !important;*/
}


/************************ Borders **************************/

.border {
    border: 1px solid #42BDCF;
}

.border-brown {
    border: 1px solid #C8923B !important;
}

/* Border Left */

.b-left-warning {
    border-left: 1px solid #F7C649 !important;
}

/* Border Right */

.b-right-warning {
    border-right: 1px solid #F7C649 !important;
}

/* Border Bottom */

.border-bottom-white {
    border: 0px;
    border-bottom: 1px solid white !important;
}

.b-bottom-dark {
    border-bottom: 1px solid #C8C8C8;
}

.b-bottom-action:focus{
  border-bottom: 3px solid #42BDCF;
}



.pointer {
    cursor: pointer;
}

.u-hover:hover {
    text-decoration: underline;
    cursor: pointer;
}

.primary-hover:hover {
    color: #4E73DF;
    cursor: pointer;
}

.t-xss {
  font-size: 11px !important;
}

.t-xs {
  font-size: 12px !important;
}

.t-sm {
  font-size: 13px !important;
}

.t-md {
    font-size: 14px !important;
}

.t-lg {
    font-size: 16px !important;
}

.t-xl {
    font-size: 18px !important;
}

.t-primary {
    color: #4E73DF;
}

.t-success {
    color: #1CC88A;
}

.t-dimgray {
  color: dimgray;
}

.t-silver {
    color: #C8C8C8;
}

.t-brown {
    color: #C8923B;
}

.t-darkblue {
    color: #2A3F54;
}

.t-dimgray-14 {
    color: dimgray;
    font-size: 14px;
    letter-spacing: 0.7px;
}

.t-dimgray-16 {
    color: dimgray;
    font-size: 16px;
    letter-spacing: 0.7px;
}

.t-light {
    color: #F3F2EE;
}

.t-light-gray {
    color: lightgray !important;
}

.b-primary {
    background-color: #007BFF !important;
}

.b-success {
    background-color: #1CC88A !important;
}

.b-brown {
    background-color: #C8923B !important;
    opacity: 1;
}

.b-lightblue {
    background-color: #C1C3CD !important;
}

.b-darkblue {
    background-color: #2A3F54 !important;
}

.b-transparent {
    background-color: transparent;
}

.btn-brown {
    background-color: #C8923B !important;
    color: white !important;
    opacity: 0.8;
}

.btn-brown:hover {
    opacity: 1;
}

.btn-brown-outline {
    background-color: white !important;
    color: #C8923B !important;
    border: 1px solid #C8923B !important;
}

.btn-brown-outline:hover {
    background-color: #C8923B !important;
    color: white !important;
}

.w-15{
  width: 15%;
}

.t-uppercase {
  text-transform: uppercase;
}

.t-label-uppercase {
  text-transform: uppercase;
  font-size: 10px !important;
}

.bold {
  font-weight: bold;
}

select option[disabled]:first-child {
  display: none;
}

#upload {
  text-align: center;
}

.img-upload {
  width: 150px;
  height: 150px;
  margin: auto;
  display: block;
  margin-bottom: 10px;
}


.btn-file {
    position: relative;
    overflow: hidden;
}

.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;   
    cursor: inherit;
    display: block;
}

.pointer {
      cursor: pointer !important;
}

.hover:hover {
    border-bottom: 2px solid #315CDA;
}


/* Sidebar CSS */
@keyframes swing {
  0% {
    transform: rotate(0deg);
  }
  10% {
    transform: rotate(10deg);
  }
  30% {
    transform: rotate(0deg);
  }
  40% {
    transform: rotate(-10deg);
  }
  50% {
    transform: rotate(0deg);
  }
  60% {
    transform: rotate(5deg);
  }
  70% {
    transform: rotate(0deg);
  }
  80% {
    transform: rotate(-5deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

@keyframes sonar {
  0% {
    transform: scale(0.9);
    opacity: 1;
  }
  100% {
    transform: scale(2);
    opacity: 0;
  }
}
body {
  font-size: 0.9rem;
}
.page-wrapper .sidebar-wrapper,
.sidebar-wrapper .sidebar-brand > a,
.sidebar-wrapper .sidebar-dropdown > a:after,
.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
.sidebar-wrapper ul li a i,
.page-wrapper .page-content,
.sidebar-wrapper .sidebar-search input.search-menu,
.sidebar-wrapper .sidebar-search .input-group-text,
.sidebar-wrapper .sidebar-menu ul li a,
#show-sidebar,
#close-sidebar {
  -webkit-transition: all 0.3s ease;
  -moz-transition: all 0.3s ease;
  -ms-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

/*----------------page-wrapper----------------*/

.page-wrapper {
  height: 100vh;
}

.page-wrapper .theme {
  width: 40px;
  height: 40px;
  display: inline-block;
  border-radius: 4px;
  margin: 2px;
}

.page-wrapper .theme.chiller-theme {
  background: #1e2229;
}

/*----------------toggeled sidebar----------------*/

.page-wrapper.toggled .sidebar-wrapper {
  left: 0px;
}

@media screen and (min-width: 768px) {
  .page-wrapper.toggled .page-content {
    padding-left: 250px;
  }
}
/*----------------show sidebar button----------------*/
#show-sidebar {
  position: fixed;
  left: 0;
  top: 10px;
  border-radius: 0 4px 4px 0px;
  width: 35px;
  transition-delay: 0.3s;
}
.page-wrapper.toggled #show-sidebar {
  left: -40px;
}
/*----------------sidebar-wrapper----------------*/

.sidebar-wrapper {
  width: 260px;
  height: 100%;
  max-height: 100%;
  position: fixed;
  top: 0;
  left: -300px;
  z-index: 999;
}

.sidebar-wrapper ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar-wrapper a {
  text-decoration: none;
}

/*----------------sidebar-content----------------*/

.sidebar-content {
  max-height: calc(100% - 30px);
  height: calc(100% - 30px);
  overflow-y: auto;
  position: relative;
}

.sidebar-content.desktop {
  overflow-y: hidden;
}

/*--------------------sidebar-brand----------------------*/

.sidebar-wrapper .sidebar-brand {
  padding: 10px 20px;
  display: flex;
  align-items: center;
}

.sidebar-wrapper .sidebar-brand > a {
  text-transform: uppercase;
  font-weight: bold;
  flex-grow: 1;
}

.sidebar-wrapper .sidebar-brand #close-sidebar {
  cursor: pointer;
  font-size: 20px;
}
/*--------------------sidebar-header----------------------*/

.sidebar-wrapper .sidebar-header {
  padding: 20px 30px;
  overflow: hidden;
}

.sidebar-wrapper .sidebar-header .user-pic {
  width: 90px;
  height: 90px;
  padding: 2px;
  border-radius: 12px;
  overflow: hidden;
}

.sidebar-wrapper .sidebar-header .user-pic img {
  object-fit: cover;
  height: 100%;
  width: 100%;
}

.sidebar-wrapper .sidebar-header .user-info > span {
  display: block;
}

.sidebar-wrapper .sidebar-header .user-info .user-role {
  font-size: 13px;
}

/*-----------------------sidebar-search------------------------*/

.sidebar-wrapper .sidebar-search > div {
  padding: 10px 20px;
}

/*----------------------sidebar-menu-------------------------*/

.sidebar-wrapper .sidebar-menu {
  padding-bottom: 10px;
}

.sidebar-wrapper .sidebar-menu .header-menu span {
  font-weight: bold;
  font-size: 14px;
  padding: 15px 20px 5px 20px;
  display: inline-block;
}

.sidebar-wrapper .sidebar-menu ul li a {
  display: inline-block;
  width: 100%;
  text-decoration: none;
  position: relative;
  padding: 8px 30px 8px 20px;
}

.sidebar-wrapper .sidebar-menu ul li a i {
  margin-right: 10px;
  font-size: 12px;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  border-radius: 4px;
}

/*.sidebar-wrapper .sidebar-menu ul li a:hover > i::before {
  display: inline-block;
  animation: swing ease-in-out 0.5s 1 alternate;
}*/

.sidebar-wrapper .sidebar-menu .sidebar-dropdown > a:after {
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  content: "\f105";
  font-style: normal;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  background: 0 0;
  position: absolute;
  right: 15px;
  top: 14px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {
  padding: 5px 0;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li {
  padding-left: 25px;
  font-size: 13px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before {
  content: "\f111";
  font-family: "Font Awesome 5 Free";
  font-weight: 400;
  font-style: normal;
  display: inline-block;
  text-align: center;
  text-decoration: none;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin-right: 10px;
  font-size: 8px;
}

.sidebar-wrapper .sidebar-menu ul li a span.label,
.sidebar-wrapper .sidebar-menu ul li a span.badge {
  float: right;
  margin-top: 8px;
  margin-left: 5px;
}


.sidebar-wrapper .sidebar-menu ul li.active a span {
  color: #c2c2c2;
  font-weight: 400;
}


.sidebar-wrapper .sidebar-menu ul li.active a i {
  /*color: #c2c2c2;*/
  color: #00D3CD;
  text-shadow: 0 0 15px #00D3CD;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,
.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {
  float: right;
  margin-top: 0px;
}

.sidebar-wrapper .sidebar-menu .sidebar-submenu {
  display: none;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown.active > a:after {
  transform: rotate(90deg);
  right: 17px;
}

/*--------------------------side-footer------------------------------*/

.sidebar-footer {
  position: absolute;
  width: 100%;
  bottom: 0;
  display: flex;
}

.sidebar-footer > a {
  flex-grow: 1;
  text-align: center;
  height: 30px;
  line-height: 30px;
  position: relative;
}

.sidebar-footer > a .notification {
  position: absolute;
  top: 0;
}

.badge-sonar {
  display: inline-block;
  background: #980303;
  border-radius: 50%;
  height: 8px;
  width: 8px;
  position: absolute;
  top: 0;
}

.badge-sonar:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  border: 2px solid #980303;
  opacity: 0;
  border-radius: 50%;
  width: 100%;
  height: 100%;
  animation: sonar 1.5s infinite;
}

/*--------------------------page-content-----------------------------*/

.page-wrapper .page-content {
  display: inline-block;
  width: 100%;
  padding-left: 0px;
}

.page-wrapper .page-content > div {
  padding: 20px 40px;
}

.page-wrapper .page-content {
  overflow-x: hidden;
}

/*------scroll bar---------------------*/

::-webkit-scrollbar {
  width: 5px;
  height: 7px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #525965;
  border: 0px none #ffffff;
  border-radius: 0px;
}
::-webkit-scrollbar-thumb:hover {
  background: #525965;
}
::-webkit-scrollbar-thumb:active {
  background: #525965;
}
::-webkit-scrollbar-track {
  background: transparent;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: transparent;
}
::-webkit-scrollbar-track:active {
  background: transparent;
}
::-webkit-scrollbar-corner {
  background: transparent;
}


/*-----------------------------chiller-theme-------------------------------------------------*/

.chiller-theme .sidebar-wrapper {
    background: #31353D;
}

/*.chiller-theme .sidebar-wrapper .sidebar-header,
.chiller-theme .sidebar-wrapper .sidebar-search,
.chiller-theme .sidebar-wrapper .sidebar-menu {
    border-top: 1px solid #3a3f48;
}*/

.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
    border-color: transparent;
    box-shadow: none;
}

.chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-role,
.chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-status,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text,
.chiller-theme .sidebar-wrapper .sidebar-brand>a,
.chiller-theme .sidebar-wrapper .sidebar-menu ul li a,
.chiller-theme .sidebar-footer>a {
    color: #818896;
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li:hover>a,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a,
.chiller-theme .sidebar-wrapper .sidebar-header .user-info,
.chiller-theme .sidebar-wrapper .sidebar-brand>a:hover,
.chiller-theme .sidebar-footer>a:hover i {
    color: #b8bfce;
}

.page-wrapper.chiller-theme.toggled #close-sidebar {
    color: #bdbdbd;
}

.page-wrapper.chiller-theme.toggled #close-sidebar:hover {
    color: #ffffff;
}

.chiller-theme .sidebar-wrapper ul li:hover a i,
.chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
    color: #16c7ff;
    text-shadow:0px 0px 10px rgba(22, 199, 255, 0.5);
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li a i,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
    background: #3a3f48;
}

.chiller-theme .sidebar-wrapper .sidebar-menu .header-menu span {
    color: #6c7b88;
}

.chiller-theme .sidebar-footer {
    background: #3a3f48;
    box-shadow: 0px -1px 5px #282c33;
    border-top: 1px solid #464a52;
}

.chiller-theme .sidebar-footer>a:first-child {
    border-left: none;
}

.chiller-theme .sidebar-footer>a:last-child {
    border-right: none;
}

</style>

