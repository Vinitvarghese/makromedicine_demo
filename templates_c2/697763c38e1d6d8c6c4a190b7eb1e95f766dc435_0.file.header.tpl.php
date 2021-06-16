<?php
/* Smarty version 3.1.30, created on 2020-10-19 18:00:20
  from "/home/makromed/public_html/demo/templates/admin/default/_partial/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9bf483fde7_70585244',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '697763c38e1d6d8c6c4a190b7eb1e95f766dc435' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/_partial/header.tpl',
      1 => 1591649998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f8d9bf483fde7_70585244 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <base href="<?php echo base_url();?>
">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/components.css?v=3" rel="stylesheet" type="text/css">
	<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<?php echo '<script'; ?>
>
		ci_custom_home_url = "<?php echo base_url();?>
";
	<?php echo '</script'; ?>
>
	<!-- Core JS files -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/loaders/pace.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/core/libraries/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/core/libraries/bootstrap.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/loaders/blockui.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/ui/nicescroll.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/ui/drilldown.js"><?php echo '</script'; ?>
>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/switchery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/ui/moment/moment.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/pickers/daterangepicker.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/selects/select2.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/uniform.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/editors/ckeditor/ckeditor.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/notifications/sweet_alert.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/media/fancybox.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/switchery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/switch.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/js/app.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/js/common.js?v=8"><?php echo '</script'; ?>
>
	<!-- /theme JS files -->

	<?php echo '<script'; ?>
> var site_url = document.getElementsByTagName('base')[0].href;<?php echo '</script'; ?>
>
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo site_url_multi($_smarty_tpl->tpl_vars['admin_url']->value);?>
">Makromedicine</a>
				<ul class="nav navbar-nav">
				
				<li>
					<a href="<?php echo site_url_multi('/admin/company_name');?>
?status=0" class="hidden-xs" >Confirm name (<?php echo $_smarty_tpl->tpl_vars['get_new_company_name']->value;?>
)</a>
				</li>
				<li class="dropdown">
					<a href="<?php echo site_url_multi('/admin/confirm_account');?>
?status=0" class="hidden-xs" >Confirm account (<?php echo $_smarty_tpl->tpl_vars['get_comfirm_account']->value;?>
)</a>
				</li>
				<li class="dropdown">
					<a href="<?php echo site_url_multi('/admin/product');?>
?checked=0">Confirm product (<?php echo $_smarty_tpl->tpl_vars['get_confirm_product']->value;?>
)</a>
				</li>
				<li class="dropdown">
					<a href="<?php echo site_url_multi('/admin/user_standart');?>
?status=0" class="hidden-xs" >Confirm standart (<?php echo $_smarty_tpl->tpl_vars['get_user_standart']->value;?>
)</a>
				</li>
				<li class="dropdown">
					<a href="<?php echo site_url_multi('/admin/user/sender/');?>
" class="hidden-xs" >Email Sender</a>
				</li>
				<li class="dropdown">
					<a href="<?php echo site_url_multi('/admin/suggestion');?>
" class="hidden-xs" >Suggestions (<?php echo $_smarty_tpl->tpl_vars['get_suggestion']->value;?>
)</a>
				</li>
			</ul>
			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/images/flags/<?php echo $_smarty_tpl->tpl_vars['current_lang']->value;?>
.png" class="position-left" alt="<?php echo $_smarty_tpl->tpl_vars['languages']->value[$_smarty_tpl->tpl_vars['current_lang']->value]['name'];?>
">
						<?php echo $_smarty_tpl->tpl_vars['languages']->value[$_smarty_tpl->tpl_vars['current_lang']->value]['name'];?>

						<?php if (isset($_smarty_tpl->tpl_vars['languages']->value) && count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?><span class="caret"></span><?php }?>
					</a>

					<?php if (isset($_smarty_tpl->tpl_vars['languages']->value) && count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
						<ul class="dropdown-menu">						
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'language_slug');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language_slug']->value => $_smarty_tpl->tpl_vars['language']->value) {
?>
									<?php if ($_smarty_tpl->tpl_vars['language']->value['admin'] == 1) {?>
										<?php if ($_smarty_tpl->tpl_vars['language_slug']->value != $_smarty_tpl->tpl_vars['current_lang']->value) {?>
											<li><a href="<?php echo site_url($_smarty_tpl->tpl_vars['language_slug']->value);?>
/<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['language']->value['code'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/images/flags/<?php echo $_smarty_tpl->tpl_vars['language']->value['code'];?>
.png" alt="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
"> <?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a></li>
										<?php }?>
									<?php }?>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						</ul>
					<?php }?>
				</li>

				

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/images/placeholders/placeholder.jpg" alt="">
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo site_url_multi($_smarty_tpl->tpl_vars['admin_url']->value);?>
/authentication/logout"><i class="icon-switch2"></i> <?php echo translate('header_user_logout',true);?>
</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	
		<?php echo '<script'; ?>
 type="text/javascript">
			$(document).on('mouseenter','.dropdown-menu li', function() {
				console.log('a');
			    if($(this).find('ul').length){
			        $(this).find('ul').show();
			    }
			});
			$(document).on('mouseleave','.dropdown-menu li',function() {
			    if($(this).find('ul').length){
			        $(this).find('ul').hide();
			    }
			});
		<?php echo '</script'; ?>
>
	<?php }
}
