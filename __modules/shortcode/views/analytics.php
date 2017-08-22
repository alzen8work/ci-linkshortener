<?php echo (!empty($form_action))?form_open($form_action):''; ?>
<div class="content-wrapper">
	<div class="container">
		<section class="content">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pull-right">
				    <!-- small box -->
				    
				    <div class="small-box bg-aqua">
				        <div class="inner">
				            <h3><span class="total_clicks"></span></h3>
				            <p><?php echo ucwords(lang('analytics[total_clicks]'));?></p>
				        </div>
				        <div class="icon">
				            <i class="fa fa-mouse-pointer "></i>
				        </div>
				        <a href="<?php echo lang('url[profile]'); ?>" target="_blank" class="small-box-footer">
				        	<?php echo ucwords(lang('analytics[more_info]')); ?>
				        	<i class="fa fa-arrow-circle-right"></i>
					    </a>
				    </div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
				    <div class="box box-solid box-info">
						<div class="box-header with-border">
							<h4>
								<?php if(!empty($_SESSION['user'])): ?>
								<a href="<?php echo base_url(); ?>" >
									<i class="fa fa-arrow-left" aria-hidden="true"></i>
								</a>
								<?php endif; ?>
								<b><?php echo ucwords(lang('analytics[header]'));?></b>
								<a href="" target="_blank" class="shortcode_url">
									<span class="shortcode_display"><?php echo lang('analytics[short_url]');?></span>
								</a>
							</h4>
						</div>
						<div class="box-body">
							<span>
								<?php echo ucwords(lang('analytics[created_on]'));?>
								<span class="created_on"></span>
							</span>
							<br>
							<span>
								<?php echo ucwords(lang('analytics[long_url]'));?>
								<a class="long_url" href="" target="_blank">
									<span class="long_url"></span>&nbsp;&nbsp;<i class="fa fa-external-link"></i>
								</a>
							</span>
						</div>
				    </div>
				</div>
				
				<!--BROWSER ########################################################################-->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[browsers]'));?>
							</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						<!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<table class="table table-striped">
								<thead>
					                <tr>
					                  <th><?php echo ucwords(lang('analytics[type]')); ?></th>
					                  <th><?php echo ucwords(lang('analytics[compare]')); ?></th>
					                  <th style="width: 50px"><?php echo ucwords(lang('analytics[clicks]')); ?></th>
					                </tr>
								</thead>
				                <tbody class="populate_browser">
				               </tbody>
				           </table>
						</div>
						<!-- /.box-body -->
						<div class="box-footer hide">
							
						</div>
						<!-- box-footer -->
					</div>
					<!-- /.box -->
				</div>
				
				<!--REFERRERS ########################################################################-->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[referrers]'));?>
							</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						<!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<table class="table table-striped">
								<thead>
					                <tr>
					                  <th style="width: 50px"><?php echo ucwords(lang('analytics[clicks]')); ?></th>
					                  <th><?php echo ucwords(lang('analytics[referrer_url]'));?></th>
					                </tr>
								</thead>
				                <tbody class="populate_referrer">
				              </tbody>
				           </table>
						</div>
						<!-- /.box-body -->
						<div class="box-footer hide">
							The footer of the box
						</div>
						<!-- box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.row -->
				
				<!--platform ########################################################################-->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[platforms]'));?>
							</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						<!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<table class="table table-striped">
								<thead>
					                <tr>
					                  <th><?php echo ucwords(lang('analytics[type]')); ?></th>
					                  <th><?php echo ucwords(lang('analytics[compare]')); ?></th>
					                  <th style="width: 50px"><?php echo ucwords(lang('analytics[clicks]')); ?></th>
					                </tr>
								</thead>
				                <tbody class="populate_platform">
				               </tbody>
				           </table>
						</div>
						<!-- /.box-body -->
						<div class="box-footer hide">
							
						</div>
						<!-- box-footer -->
					</div>
					<!-- /.box -->
				</div>
				
				<!--COUNTRY ########################################################################-->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[countries]'));?>
							</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						<!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<table class="table table-striped">
								<thead>
					                <tr>
					                  <th style="width: 50px"><?php echo ucwords(lang('analytics[clicks]')); ?></th>
					                  <th><?php echo ucwords(lang('analytics[countries]'));?></th>
					                </tr>
								</thead>
				                <tbody class="populate_country">
				              </tbody>
				           </table>
						</div>
						<!-- /.box-body -->
						<div class="box-footer hide">
							The footer of the box
						</div>
						<!-- box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.row -->
			</div>
			
			
			
			<?php //ChartJS Feature ######################################################################## ?>
			<div class="row hide">
				
				<!--REFEREAL ########################################################################-->
				<div class="col-sm-12 col-md-6">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[referrers]'));?>
							</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-8">
									<div class="chart-responsive">
										<canvas id="pieChart" height="160" width="205" style="width: 205px; height: 160px;"></canvas>
									</div>
									<!-- ./chart-responsive -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<ul class="chart-legend clearfix">
										<li><i class="fa fa-circle-o text-red"></i> Chrome</li>
										<li><i class="fa fa-circle-o text-green"></i> IE</li>
										<li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
										<li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
										<li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
										<li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
									</ul>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.box-body -->
						<div class="box-footer no-padding">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">United States of America
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
								<li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
								</li>
								<li><a href="#">China
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
							</ul>
						</div>
						<!-- /.footer -->
					</div>
				</div>
				
				<!--BROWSER ########################################################################-->
				<div class="col-sm-12 col-md-6">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[browsers]'));?>
							</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               						 </button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-8">
									<div class="chart-responsive">
										<canvas id="pieChart2" height="160" width="205" style="width: 205px; height: 160px;"></canvas>
									</div>
									<!-- ./chart-responsive -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<ul class="chart-legend clearfix">
										<li><i class="fa fa-circle-o text-red"></i> Chrome</li>
										<li><i class="fa fa-circle-o text-green"></i> IE</li>
										<li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
										<li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
										<li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
										<li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
									</ul>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.box-body -->
						<div class="box-footer no-padding">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">United States of America
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
								<li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
								</li>
								<li><a href="#">China
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
							</ul>
						</div>
						<!-- /.footer -->
					</div>
				</div>
				
				
				<!--COUNTRY ########################################################################-->
				<div class="col-sm-12 col-md-6">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[countries]'));?>
							</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
								<div class="btn-group">
									<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-wrench"></i></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-8">
									<p class="text-center">
										<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
									</p>

									<div class="chart">
										<!-- Sales Chart Canvas -->
										<canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
									</div>
									<!-- /.chart-responsive -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<p class="text-center">
										<strong>Goal Completion</strong>
									</p>

									<div class="progress-group">
										<span class="progress-text">Add Products to Cart</span>
										<span class="progress-number"><b>160</b>/200</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Complete Purchase</span>
										<span class="progress-number"><b>310</b>/400</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-red" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Visit Premium Page</span>
										<span class="progress-number"><b>480</b>/800</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-green" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Send Inquiries</span>
										<span class="progress-number"><b>250</b>/500</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- ./box-body -->
						<div class="box-footer">
							<div class="row">
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
										<h5 class="description-header">35,210.43</h5>
										<span class="description-text">TOTAL REVENUE</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										<h5 class="description-header">10,390.90</h5>
										<span class="description-text">TOTAL COST</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
										<h5 class="description-header">24,813.53</h5>
										<span class="description-text">TOTAL PROFIT</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block">
										<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
										<h5 class="description-header">1200</h5>
										<span class="description-text">GOAL COMPLETIONS</span>
									</div>
									<!-- /.description-block -->
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->

				</div>
				
				<!--PLATFORM ########################################################################-->
				<div class="col-sm-12 col-md-6">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">
								<?php echo ucwords(lang('analytics[platforms]'));?>
							</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
								<div class="btn-group">
									<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-wrench"></i></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-8">
									<p class="text-center">
										<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
									</p>

									<div class="chart">
										<!-- Sales Chart Canvas -->
										<canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
									</div>
									<!-- /.chart-responsive -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<p class="text-center">
										<strong>Goal Completion</strong>
									</p>

									<div class="progress-group">
										<span class="progress-text">Add Products to Cart</span>
										<span class="progress-number"><b>160</b>/200</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Complete Purchase</span>
										<span class="progress-number"><b>310</b>/400</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-red" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Visit Premium Page</span>
										<span class="progress-number"><b>480</b>/800</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-green" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Send Inquiries</span>
										<span class="progress-number"><b>250</b>/500</span>

										<div class="progress sm">
											<div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
										</div>
									</div>
									<!-- /.progress-group -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- ./box-body -->
						<div class="box-footer">
							<div class="row">
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
										<h5 class="description-header">35,210.43</h5>
										<span class="description-text">TOTAL REVENUE</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										<h5 class="description-header">10,390.90</h5>
										<span class="description-text">TOTAL COST</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
										<h5 class="description-header">24,813.53</h5>
										<span class="description-text">TOTAL PROFIT</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block">
										<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
										<h5 class="description-header">1200</h5>
										<span class="description-text">GOAL COMPLETIONS</span>
									</div>
									<!-- /.description-block -->
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>

				<!-- /.row -->
			</div>
			
			<!--TIMEFRAME ########################################################################-->
			<!-- /.box -->
			<div class="box hide">
				<div class="box-header with-border">
					<h3 class="box-title">
						<?php echo ucwords(lang('analytics[timeframe]'));?>
					</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						<div class="btn-group">
							<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-wrench"></i></button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
						<!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-8">
							<p class="text-center">
								<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
							</p>

							<div class="chart">
								<!-- Sales Chart Canvas -->
								<canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
							</div>
							<!-- /.chart-responsive -->
						</div>
						<!-- /.col -->
						<div class="col-md-4">
							<p class="text-center">
								<strong>Goal Completion</strong>
							</p>

							<div class="progress-group">
								<span class="progress-text">Add Products to Cart</span>
								<span class="progress-number"><b>160</b>/200</span>

								<div class="progress sm">
									<div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
								</div>
							</div>
							<!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Complete Purchase</span>
								<span class="progress-number"><b>310</b>/400</span>

								<div class="progress sm">
									<div class="progress-bar progress-bar-red" style="width: 80%"></div>
								</div>
							</div>
							<!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Visit Premium Page</span>
								<span class="progress-number"><b>480</b>/800</span>

								<div class="progress sm">
									<div class="progress-bar progress-bar-green" style="width: 80%"></div>
								</div>
							</div>
							<!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Send Inquiries</span>
								<span class="progress-number"><b>250</b>/500</span>

								<div class="progress sm">
									<div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
								</div>
							</div>
							<!-- /.progress-group -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- ./box-body -->
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
								<h5 class="description-header">35,210.43</h5>
								<span class="description-text">TOTAL REVENUE</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
								<h5 class="description-header">10,390.90</h5>
								<span class="description-text">TOTAL COST</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
								<h5 class="description-header">24,813.53</h5>
								<span class="description-text">TOTAL PROFIT</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 col-xs-6">
							<div class="description-block">
								<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
								<h5 class="description-header">1200</h5>
								<span class="description-text">GOAL COMPLETIONS</span>
							</div>
							<!-- /.description-block -->
						</div>
					</div>
					<!-- /.row -->
				</div>
				<!-- /.box-footer -->
			</div>
			<!-- /.box -->
		</section>


		<section class="content debug_mode" style="display:none">
			<div class="row well load_header"></div>
			<div class="row well load_detail"></div>
		</section>
		
		<section class="content-header hide">
			<h1>
				<?php echo ucwords(lang('analytics[header]'));?>
				<a href="" class="shortcode_url">
					<span class="shortcode_display"><?php echo lang('analytics[short_url]');?></span>
				</a>
			</h1>
			<p>
			</p>
			<p>
				<?php echo ucwords(lang('analytics[created_on]'));?>
				<span class="created_on"></span>
			</p>
			<p>
				<?php echo ucwords(lang('analytics[long_url]'));?>
				<a class="long_url" href="" target="_blank">
					<span class="long_url"></span>
				</a>
			</p>
			<p>
				<?php echo ucwords(lang('analytics[total_clicks]'));?>
				<span class="total_clicks"></span>
			</p>
			<ol class="breadcrumb hide">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Layout</a></li>
				<li class="active">Top Navigation</li>
			</ol>
		</section>
		<script>
			$(document).ready(function() {
				init_analytics();
			});
		</script>
	</div>
</div>
<?php echo (!empty($form_action))? form_close():''; ?>
