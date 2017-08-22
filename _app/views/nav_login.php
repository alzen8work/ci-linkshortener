<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="<?php echo lang('url[home]'); ?>" class="navbar-brand">
					<img src="<?php echo lang('app[img]'); ?>" style="width:1.3em;float:left">
					&nbsp;<?php echo ucwords(lang('app[name]'));?>
				</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">

			</div>
			<!-- /.navbar-collapse -->
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<?php if(empty($_SESSION['user'])): ?>
					<!--<li><a class="btn_login cursor_btn"><?php //echo ucwords(lang('btn[login]')); ?></a></li>-->
					<li><a href="<?php echo ucwords(lang('url[login]')) ?>" class="cursor_btn"><?php echo ucwords(lang('btn[login]')); ?></a></li>
					<!-- /.messages-menu -->
					<?php else: ?>
					<li><a class="cursor_btn help_btn"><?php echo (empty($_SESSION['user']['user_name']))?'':'<b>'.$_SESSION['user']['user_name'].'</b>' ?></a></li>
					<li><a href="<?php echo ucwords(lang('url[logout]')) ?>" class="cursor_btn"><?php echo ucwords(lang('btn[logout]')); ?></a></li>
					
					<?php endif; ?>
				</ul>
			</div>
			<!-- /.navbar-custom-menu -->
		</div>
		<!-- /.container-fluid -->
	</nav>
</header>

<!-- LOGIN ####################################################-->
<form id="form_login" >
<div id="modal_login" class="modal fade" role="dialog">
	<div class="modal-dialog  modal-info modal-md">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close form_login_close" >&times;</button>
				<h4 class="modal-title text-center"><?php echo ucwords(lang('app[name_2]')); ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-5 col-md-5 col-sm-5 hidden-xs">							
						<img src="<?php echo lang('app[img_2]'); ?>" style="width:100%;float:left">
					</div>
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
						<div class="clearfix">&nbsp;</div>
							<div class="form-group has-feedback">
								<input type="email" name="email" class="form-control" 
								placeholder="<?php echo ucwords(lang('login[email]')); ?>">
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback">
								<input type="password" name="pw" class="form-control" 
								placeholder="<?php echo ucwords(lang('login[password]')); ?>">
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							</div>
							
							<div class="form-group has-feedback">
									<button type="submit" name="su" class="btn btn-success btn-block">
										<?php echo ucwords(lang('btn[login]')); ?>
									</button>
							</div>
							
							<div class="form-group has-feedback">
								<a href="<?php echo ucwords(lang('url[profile]'));?>" 
									target="_blank"
									name="su" class="btn btn-warning btn-block">
									<?php 
										//echo ucwords(lang('btn[register]')); 
										echo ucwords(lang('btn[more_info]')); 
									?>
								</a>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>

<!-- OTHER ####################################################-->
<div id="modal_other" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<div class="login-box-body">
					<div class="form-group has-feedback">
						<input type="email" name="email" class="form-control" placeholder="Email">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="pw" class="form-control" placeholder="Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<input type="submit" name="su" value="Login" class="btn btn-primary btn-block btn-flat">
						</div>
						<!-- /.col -->
					</div>
				</div>
			</div>
			<div class="modal-footer hide">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>