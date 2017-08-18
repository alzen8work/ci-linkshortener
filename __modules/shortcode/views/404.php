<div class="content-wrapper">
	<div class="container">
		<span class="text-center">
			<h4>
				<span class="fa-stack fa-4x">
					<i class="fa fa-cloud fa-stack-2x " style="color:#16a085;"></i>	
					<i class="fa fa-exclamation fa-stack-1x fa-inverse faa-shake animated"></i>	
				</span>
			</h4>
			<h2><?php echo lang('msg[404_main]'); ?></h2>
			<h4><?php echo (empty($msg))?'':$msg; ?></h4>
			<h2>
				<a href="<?php echo lang('url[home]'); ?>" 
					class="btn btn-danger btn-lg btn_home">
					<i class="fa fa-home fa-fw"></i> <?php echo lang('btn[home]'); ?>
				</a>					
			</h2>
		</span>				
	</div>
</div>
<script>
	$(document).ready(function(){
		init_404();
	});
</script>