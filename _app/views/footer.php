
			<footer class="main-footer">
				<div class="container">
						<div class="pull-left ">
							<span class="hidden-xs">
								<strong>
									<?php echo lang('app[copy]'); ?>
								</strong> 
							</span>
							<strong> <?php echo date("Y") ?></strong> 
							<span class="hidden-lg hidden-md hidden-sm ">
								<?php echo lang('app[copy2]'); ?>
							</span>
							<a target="_blank" href="<?php echo lang('url[profile]'); ?>">
								<?php echo lang('app[owner_comp]'); ?>
							</a>
							<span class="hidden-xs">
								<?php echo lang('app[right]'); ?>
							</span> 
						</div>
						<div class="pull-right">	
							<div class="dropdown dropup">
								<button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
									<?php echo ucwords(lang('txt[language]')); ?>&nbsp;
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#" class="text-center change_lang"><?php echo ucwords(lang('txt[english]')); ?></a></li>
									<li><a href="#" class="text-center change_lang" data-id="chinese_simplified"><?php echo ucwords(lang('txt[chinese_simplified]')); ?></a></li>
								</ul>
							</div>
						</div>
						<div class="pull-right hidden-xs ">
							&nbsp;	&nbsp;				
						</div>
						<div class="pull-right hidden-xs">
							<?php echo lang('app[version]'); ?> 				
						</div>
				</div><!-- /.container -->
			</footer>
		</div>
		<!-- ./wrapper -->
	</body>
</html>