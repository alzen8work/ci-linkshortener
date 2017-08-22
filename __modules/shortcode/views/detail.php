<?php echo (!empty($form_action))?form_open($form_action):''; ?>
<div class="content-wrapper" >
	<div class="jumbo" style="">
		<div class="container">
			<h2><?php echo ucwords(lang('shorten[header]')) ?></h2>	
			
			<?php
				$input['id']		= 'urls[url]';
				$input['name']		= 'urls[url]';
				$input['type']		= 'text';
				$input['class']		= 'form-control';
				echo '<p>'.form_input($input).'</p>';
			?>
			<?php
				$submit['id']		= 'processtype[save]';
				$submit['name']		= 'processtype[save]';
				$submit['class']	= 'btn btn-md btn-default';
				echo '<p>'.form_submit($submit,ucwords(lang('btn[shorten_url]'))).'</p>';
			?>
			
			<?php echo (empty($msg))?'':'<div class="errors">'.$msg.'</div>'; ?>	
		</div>
	</div>
	<div class="container"></div>
	<div class="container">
		<div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
      </div>
	</div>
	<script>
		$(document).ready(function(){
			init_detail();
		});
	</script>	
</div>
<?php echo (!empty($form_action))? form_close():''; ?>
