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
	$menus = Modules::run('admin/menu/index');
	//echo"<pre>";print_r($menus);echo"</pre>";
?>
<!-- BEGIN MAIN NAVIGATION -->
<ul id="menu" class="unstyled accordion collapse in">
	<?php $current_uri = $this->uri->segment(2); ?>
	<?php foreach($menus as $menu) : ?>
		<?php $jml_sub = count($menu['sub_menu']); ?>
		<li class="accordion-group <?php echo (in_array($current_uri,$menu['url_sub_menu']))? "active": "" ?>">
			<a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#<?php echo $menu['url'] ?>-nav">
				<i class="icon-dashboard icon-large"></i> <?php echo $menu['label'] ?> <span class="label label-inverse pull-right"><?php echo $jml_sub ?></span>
			</a>
			<?php if($jml_sub > 0) : ?>
				<ul class="collapse <?php echo (in_array($current_uri,$menu['url_sub_menu']))? "in": "" ?>" id="<?php echo $menu['url'] ?>-nav">
					<?php for ($i=0; $i < $jml_sub; $i++) : ?>
						<li><a href="<?php echo site_url("admin/".$menu['sub_menu'][$i]['url']) ?>"><i class="icon-angle-right"></i> <?php echo $menu['sub_menu'][$i]['label'] ?></a></li>
					<?php endfor; ?>
				</ul>
			<?php endif ?>
		</li>
	<?php endforeach ?>
</ul>
<!-- END MAIN NAVIGATION -->