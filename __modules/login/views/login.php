<div class="content-wrapper" style="background-color: #00c0ef !important;">
	<div class="container" >
		<div class="login-box short-code-login">
  <div class="login-logo">
    <a href=""><?php echo ucwords(lang('app[name_3]')); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color: rgba(255, 255, 255, 0.28) !important;">
				<div class="row">
					<div class="col-lg-5 col-md-5 col-sm-5 hidden-xs">							
						<img src="<?php echo lang('app[img_2]'); ?>" style="width:100%;float:left">
					</div>
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
						<div class="clearfix">&nbsp;</div>
							<div class="form-group has-feedback">
       						<input type="text" name="AUTH_USER" class="form-control"
								placeholder="<?php echo ucwords(lang('login[email]')); ?>">
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback">
        					<input type="password" name="AUTH_PW" class="form-control" 
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
  <!-- /.login-box-body -->
</div>
		<script>
			$(document).ready(function(){
				// init_detail();
				init_default();
			});
		</script>
	</div>
</div>
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