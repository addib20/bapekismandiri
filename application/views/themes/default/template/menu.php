<!-- .user-media -->
<div class="media user-media hidden-phone">
	<a href="" class="user-link">
		<?php
			$foto = $this->session->userdata("foto");
			if(!empty($foto)){
				$img_tag = base_url().$foto;
			}
			else{
				$img_tag = base_url()."assets/img/user/user.png";
			}
		?>
		<img src="<?php echo $img_tag ?>" alt="" class="media-object img-polaroid user-img">
		<!--<span class="label user-label">16</span>-->
	</a>

	<div class="media-body hidden-tablet">
		<h5 class="media-heading"><?php echo $this->session->userdata("name") ?></h5>
		<ul class="unstyled user-info">
			<li><span class="badge"><?php echo ucwords($this->session->userdata("akses")) ?></span></li>
			<li>&nbsp;</li>
			<li>Last Access : <br/>
				<small><?php echo $this->datecalc->datepanjang($this->session->userdata("last_login"),'dhbt'); ?></small>
			</li>
		</ul>
	</div>
</div>
<!-- /.user-media -->
<?php
	$menus = Modules::run('admin_dashboard/menu/index');
	//echo"<pre>";print_r($menus);echo"</pre>";
?>
<!-- BEGIN MAIN NAVIGATION -->
<ul id="menu" class="unstyled accordion collapse in">
	<?php $current_uri = $this->uri->segment(1); ?>
	<?php foreach($menus as $menu) : ?>
		<?php $jml_sub = count($menu['sub_menu']); ?>
		<li class="accordion-group <?php echo ($current_uri==$menu['url'])? "active": "" ?>">
			<a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#<?php echo $menu['url'] ?>-nav">
				<i class="icon-dashboard icon-large"></i> <?php echo $menu['label'] ?> <span class="label label-inverse pull-right"><?php echo $jml_sub ?></span>
			</a>
			<?php if($jml_sub > 0) : ?>
				<ul class="collapse <?php echo ($current_uri==$menu['url'])? "in": "" ?>" id="<?php echo $menu['url'] ?>-nav">
					<?php for ($i=0; $i < $jml_sub; $i++) : ?>
						<li><a href="<?php echo site_url($menu['url']."/".$menu['sub_menu'][$i]['url']) ?>"><i class="icon-angle-right"></i> <?php echo $menu['sub_menu'][$i]['label'] ?></a></li>
					<?php endfor; ?>
				</ul>
			<?php endif ?>
		</li>
	<?php endforeach ?>
</ul>
<!--<ul id="menu" class="unstyled accordion collapse in">
	<li class="accordion-group active">
		<a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#dashboard-nav">
			<i class="icon-dashboard icon-large"></i> Dashboard <span
				class="label label-inverse pull-right">2</span>
		</a>
		<ul class="collapse in" id="dashboard-nav">
			<li><a href="index.html"><i class="icon-angle-right"></i> Default Style</a></li>
			<li><a href="alterne.html"><i class="icon-angle-right"></i> Alternative Style</a></li>
		</ul>
	</li>
	<li class="accordion-group ">
		<a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
			<i class="icon-tasks icon-large"></i> Components <span class="label label-inverse pull-right">2</span>
		</a>
		<ul class="collapse " id="component-nav">
			<li><a href="icon.html"><i class="icon-angle-right"></i> Icon & Button</a></li>
			<li><a href="progress.html"><i class="icon-angle-right"></i> Progress</a></li>
		</ul>
	</li>
	<li class="accordion-group ">
		<a data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
			<i class="icon-pencil icon-large"></i> Forms <span class="label label-inverse pull-right">4</span>
		</a>
		<ul class="collapse " id="form-nav">
			<li><a href="form-general.html"><i class="icon-angle-right"></i> General</a></li>
			<li><a href="form-validation.html"><i class="icon-angle-right"></i> Validation</a></li>
			<li><a href="form-wysiwyg.html"><i class="icon-angle-right"></i> WYSIWYG</a></li>
			<li><a href="form-wizard.html"><i class="icon-angle-right"></i> Wizard &amp; File Upload</a></li>
		</ul>
	</li>
	<li><a href="table.html"><i class="icon-table icon-large"></i> Tables</a></li>
	<li><a href="file.html"><i class="icon-file icon-large"></i> File Manager</a></li>
	<li><a href="typography.html"><i class="icon-font icon-large"></i> Typography</a></li>
	<li><a href="maps.html"><i class="icon-map-marker icon-large"></i> Maps</a></li>
	<li><a href="chart.html"><i class="icon-bar-chart icon-large"></i> Charts</a></li>
	<li><a href="calendar.html"><i class="icon-calendar icon-large"></i> Calendar</a></li>
	<li class="accordion-group ">
		<a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#error-nav">
			<i class="icon-warning-sign icon-large"></i> Error Pages <span
				class="label label-inverse pull-right">7</span>
		</a>
		<ul class="collapse" id="error-nav">
			<li><a href="403.html"><i class="icon-angle-right"></i> 403</a></li>
			<li><a href="404.html"><i class="icon-angle-right"></i> 404</a></li>
			<li><a href="405.html"><i class="icon-angle-right"></i> 405</a></li>
			<li><a href="500.html"><i class="icon-angle-right"></i> 500</a></li>
			<li><a href="503.html"><i class="icon-angle-right"></i> 503</a></li>
			<li><a href="offline.html"><i class="icon-angle-right"></i> offline</a></li>
			<li><a href="countdown.html"><i class="icon-angle-right"></i> Under Construction</a></li>
		</ul>
	</li>
	<li><a href="grid.html"><i class="icon-columns icon-large"></i> Grid</a></li>
	<li><a href="blank.html"><i class="icon-check-empty icon-large"></i> Blank Page</a></li>
	<li><a href="login.html"><i class="icon-signin icon-large"></i> Login Page</a></li>
</ul>-->
<!-- END MAIN NAVIGATION -->