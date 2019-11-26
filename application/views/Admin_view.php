	<!-- nav fixed on top -->
	<nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo base_url() ?>">Baobab Homestay</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<div class="d-inline-flex text-white">
					<span>Xin chào, <?php echo $this->session->userdata('username');?></span>
					<a class="nav-link" href="<?php echo base_url('admin/logout');?>">Đăng xuất</a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- Body main wrapper start -->
	<div class="wrapper bg-white">
		
		<div class="container-fluid">
		  <div class="row">
		    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
		      <div class="sidebar-sticky">
		        <ul class="nav flex-column">
		          <!-- <li class="nav-item">
		            <a class="nav-link admin" href="<?php //echo base_url() ?>admin">
		              <i class="icofont-home"></i>
		              Tổng quan <span class="sr-only">(current)</span>
		            </a>
		          </li> -->
		          <li class="nav-item">
		            <a class="nav-link room" href="<?php echo base_url() ?>admin/room">
		              <i class="icofont-building-alt"></i>
		              Phòng
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link client" href="<?php echo base_url() ?>admin/client">
		              <i class="icofont-live-support"></i>
		              Khách thuê
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link orders" href="<?php echo base_url() ?>admin/orders">
		              <i class="icofont-list"></i>
		              Đơn đặt phòng
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link account" href="<?php echo base_url() ?>admin/account">
		              <i class="icofont-spanner"></i>
		              Tài khoản
		            </a>
		          </li>
		          <!-- <li class="nav-item">
		            <a class="nav-link" href="#">
		              <span data-feather="layers"></span>
		              Integrations
		            </a>
		          </li> -->
		        </ul>

		        <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
		          <span>Saved reports</span>
		          <a class="d-flex align-items-center text-muted" href="#">
		            <span data-feather="plus-circle"></span>
		          </a>
		        </h6>
		        <ul class="nav flex-column mb-2">
		          <li class="nav-item">
		            <a class="nav-link" href="#">
		              <span data-feather="file-text"></span>
		              Current month
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">
		              <span data-feather="file-text"></span>
		              Last quarter
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">
		              <span data-feather="file-text"></span>
		              Social engagement
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">
		              <span data-feather="file-text"></span>
		              Year-end sale
		            </a>
		          </li>
		        </ul> -->
		      </div>
		    </nav>

			<!-- insert part view -->




			<!-- <div class="row">
			  <nav class="navbar navbar-default">
			      <div class="container-fluid">
			        <div class="navbar-header">
			          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			          </button>
			          <a class="navbar-brand" href="#">LOGO</a>
			        </div>
			        <div id="navbar" class="navbar-collapse collapse">
			          <ul class="nav navbar-nav"> -->
			            <!--ACCESS MENUS FOR ADMIN-->
			            <!-- <?php //if($this->session->userdata('level')==='1'):?>
			              <li class="active"><a href="#">Dashboard</a></li>
			              <li><a href="#">Posts</a></li>
			              <li><a href="#">Pages</a></li>
			              <li><a href="#">Media</a></li> -->
			            <!--ACCESS MENUS FOR STAFF-->
			            <!-- <?php //elseif($this->session->userdata('level')==='2'):?>
			              <li class="active"><a href="#">Dashboard</a></li>
			              <li><a href="#">Pages</a></li>
			              <li><a href="#">Media</a></li> -->
			            <!--ACCESS MENUS FOR AUTHOR-->
			            <!-- <?php //else:?>
			              <li class="active"><a href="#">Dashboard</a></li>
			              <li><a href="#">Posts</a></li>
			            <?php //endif;?>
			          </ul>
			          <ul class="nav navbar-nav navbar-right">
			            <li><a href="<?php //echo base_url('admin/logout');?>">Sign Out</a></li>
			          </ul> -->
			        <!-- </div> --><!--/.nav-collapse -->
			      <!-- </div> --><!--/.container-fluid -->
			    <!-- </nav> -->

			<!-- <div class="jumbotron">
			  <h1>Welcome Back <?php //echo $this->session->userdata('username');?></h1>
			</div>
			 <a href="<?php //echo base_url('admin/logout');?>">Sign Out</a>
			</div> -->

	
