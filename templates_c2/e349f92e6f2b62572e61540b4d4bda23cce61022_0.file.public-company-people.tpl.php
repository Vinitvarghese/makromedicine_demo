<?php
/* Smarty version 3.1.30, created on 2020-10-28 08:52:42
  from "/home/makromed/public_html/demo/templates/default/company/public-company-people.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f98f91a9d6d14_15820145',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e349f92e6f2b62572e61540b4d4bda23cce61022' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-company-people.tpl',
      1 => 1603802536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/public-company-sidebar.tpl' => 1,
  ),
),false)) {
function content_5f98f91a9d6d14_15820145 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21111014615f98f91a9d6264_63049986', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_21111014615f98f91a9d6264_63049986 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
<div class="n_content_area full_width">
<a href="#" id="openMenu" class="public-menu-float">Menu</a>

    <div class="container-fluid">
        <div class="row">
            <?php $_smarty_tpl->_subTemplateRender("file:../company/public-company-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <div class="n_right_section start_with_text employee_l">
                <div class="with_buttons full_width">
                    <h2>EMPLOYEES</h2>
                    <!--<a href="#" class="n_green_col">Add Products</a>-->
                </div>

                <div class="full_width employes_page">
                <div class="row">
                <?php if (count($_smarty_tpl->tpl_vars['owner']->value) > 0) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['owner']->value, 'ow');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ow']->value) {
?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['ow']->value['photo'];?>
" alt="img">
                        <h5><?php echo $_smarty_tpl->tpl_vars['ow']->value['name'];?>
</h5>
                        <span class="gray_anch"><?php echo $_smarty_tpl->tpl_vars['ow']->value['position'];?>
</span>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
            <?php if (count($_smarty_tpl->tpl_vars['approved_users']->value) > 0) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['approved_users']->value, 'approved_user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['approved_user']->value) {
?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['approved_user']->value['photo'];?>
" alt="img">
                        <h5><?php echo $_smarty_tpl->tpl_vars['approved_user']->value['name'];?>
</h5>
                        <span class="gray_anch"><?php echo $_smarty_tpl->tpl_vars['approved_user']->value['position'];?>
</span>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
                </div>
                
            </div>






            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
<?php
}
}
/* {/block 'content'} */
}
