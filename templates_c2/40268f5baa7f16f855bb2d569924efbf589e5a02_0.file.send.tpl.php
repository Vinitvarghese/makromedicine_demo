<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:03:30
  from "/home/makromed/public_html/demo/templates/admin/default/user/send.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9925d239c322_50543508',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40268f5baa7f16f855bb2d569924efbf589e5a02' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/user/send.tpl',
      1 => 1591650063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9925d239c322_50543508 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17464808005f9925d239b836_89992150', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_17464808005f9925d239b836_89992150 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title text-semibold"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
		<div class="heading-elements"></div>
	</div>

	<?php if (validation_errors()) {?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger no-border">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

		    </div>
		</div>
	</div>
	<?php }?>

	<?php echo form_open(current_url(),'class="form-horizontal has-feedback", id="form-save"');?>

	<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
		<li class="active"><a href="#general" data-toggle="tab"><i class="icon-menu7 position-left"></i> <?php echo translate("tab_general",true);?>
</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="general">
			<div class="panel-body">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_field']->value['general'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
				<div class="form-group <?php ob_start();
echo $_smarty_tpl->tpl_vars['key']->value;
$_prefixVariable1=ob_get_clean();
if (form_error($_smarty_tpl->tpl_vars['form_field']->value['general'][$_prefixVariable1]['name'])) {?>has-error<?php }?>">
					<?php ob_start();
echo $_smarty_tpl->tpl_vars['key']->value;
$_prefixVariable2=ob_get_clean();
echo form_label($_smarty_tpl->tpl_vars['form_field']->value['general'][$_prefixVariable2]['label'],$_smarty_tpl->tpl_vars['key']->value,array('class'=>'control-label col-md-2'));?>

					<div class="col-md-10">
					<?php ob_start();
echo $_smarty_tpl->tpl_vars['key']->value;
$_prefixVariable3=ob_get_clean();
echo form_element($_smarty_tpl->tpl_vars['form_field']->value['general'][$_prefixVariable3]);?>

					<?php ob_start();
echo $_smarty_tpl->tpl_vars['key']->value;
$_prefixVariable4=ob_get_clean();
echo form_error($_smarty_tpl->tpl_vars['form_field']->value['general'][$_prefixVariable4]['name']);?>

					</div>
					<?php ob_start();
echo $_smarty_tpl->tpl_vars['key']->value;
$_prefixVariable5=ob_get_clean();
if ($_smarty_tpl->tpl_vars['form_field']->value['general'][$_prefixVariable5]['name'] == 'email') {?>
					<div class="col-md-10 col-md-offset-2" style="margin-top:15px;">
					<p>Other emails:</p>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_other_data']->value, 'p_info');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p_info']->value) {
?>
							<p><?php echo $_smarty_tpl->tpl_vars['p_info']->value;?>
</p>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

					</div>
					
					<?php if (isset($_smarty_tpl->tpl_vars['oldemail']->value)) {?>
					<div class="col-md-10 col-md-offset-2" style="margin-top:15px;">
					<p>Old email:</p>
						<?php echo $_smarty_tpl->tpl_vars['oldemail']->value;?>

					</div>
					<?php }?>
					<?php }?>

				</div>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</div>
		</div>
	</div>
	<?php echo form_close();?>

</div>

<?php echo '<script'; ?>
 type="text/javascript">
  $(document).on('change','#user_id', function(){
    var value = $(this).val();
    $.ajax({
			url: "/admin/user/get_email/",
			type: "post",
			data: {'value':value},
			success: function (data) {
        if(data != false)
        {
          $('#email').val(data);
        }
        else
        {
          $('#email').remove();
        }
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
  });
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'content'} */
}
