<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo (empty($title_info))?ucwords(lang('app[name]')):$title_info; ?>
		</title>
		<link rel="icon" type="image/png" href="<?php echo lang('app[img]'); ?>">
		<?php
			// Meta Headers
			if (isset($metaheaders) && is_array($metaheaders))
			{
				foreach ($metaheaders as $meta)
				{
					echo '<meta '.$meta.'>';
				}
			}
			// css files
			if (isset($cssfiles) && is_array($cssfiles)) 
			{
				foreach ($cssfiles as $file)
				{
					echo '<link rel="stylesheet" type="text/css" href="'.$file.'" />';
				}
			}
			// javascript files
			if (isset($jsfiles) && is_array($jsfiles)) 
			{
				foreach ($jsfiles as $file)
				{
					echo '<script src="'.$file.'"></script>';
				}
			}

			// javascripts
			if (isset($jscripts) && is_array($jscripts)) 
			{
				foreach ($jscripts as $script)
				{
					echo "<script>\n".$script."\n</script>";
				}
			}
		?>
	</head>
	<!-- <body class=" skin-black"> -->
	<body class="layout-top-nav skin-black fixed">
		<div class="wrapper">