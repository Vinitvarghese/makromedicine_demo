<?php
/* Smarty version 3.1.30, created on 2020-09-15 05:28:21
  from "/home/makromed/public_html/demo/templates/admin/default/authentication/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f6018b54a9ab3_85382808',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '505c2a79193c0a9c5541d54f410ede0f3e669cee' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/authentication/login.tpl',
      1 => 1591650058,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f6018b54a9ab3_85382808 (Smarty_Internal_Template $_smarty_tpl) {
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
<link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/images/favicon.png">
<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/components.css" rel="stylesheet" type="text/css">
<link href="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/css/colors.css" rel="stylesheet" type="text/css">

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/loaders/pace.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/core/libraries/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/core/libraries/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/loaders/blockui.min.js"><?php echo '</script'; ?>
>

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
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/uniform.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/notifications/sweet_alert.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/ui/nicescroll.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/tags/tagsinput.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/media/fancybox.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/switchery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/styling/switch.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/js/plugins/forms/tags/tokenfield.min.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/js/app.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/assets/js/common.js"><?php echo '</script'; ?>
>
</head>
<body class="login-container">
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content">
					<?php echo form_open();?>

						<div class="panel panel-body login-form">
							<div class="text-center">
								<h5 class="content-group">
									<?php echo translate('login_head');?>

									<small class="display-block"><?php echo translate('login_head_message');?>
</small>
								</h5>
							</div>
							<?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
								<div class="alert alert-danger">
									<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

								</div>
							<?php }?>						
							<div class="form-group has-feedback has-feedback-left">
								<?php echo form_input('login','','class="form-control input-roundless" placeholder="Login" autocomplete="username" autofocus');?>

								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>
							<div class="form-group has-feedback has-feedback-left">
								<?php echo form_password('password','','class="form-control input-roundless" placeholder="Password" autocomplete="current-password"');?>

								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											<?php echo form_checkbox('remember','1','',array("class"=>"styled"));?>

											<?php echo translate('remember_me');?>

										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
                                <button type="submit" class="btn btn-primary input-roundless color-microsoft btn-block"><i class="icon-lock"></i> <strong><?php echo mb_strtoupper(translate('sign_in'), 'UTF-8');?>
<strong></button>
							</div>							
						</div>
					<?php echo form_close();?>

					<div class="footer text-muted text-center"><?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>
</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html><?php }
}
