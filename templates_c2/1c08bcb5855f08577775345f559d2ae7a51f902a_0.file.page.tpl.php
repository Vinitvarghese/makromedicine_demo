<?php
/* Smarty version 3.1.30, created on 2020-10-26 21:20:04
  from "/home/makromed/public_html/demo/templates/default/page.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f970544b8e8d2_12810834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c08bcb5855f08577775345f559d2ae7a51f902a' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/page.tpl',
      1 => 1603718917,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f970544b8e8d2_12810834 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_521790775f970544b8dea1_78207989', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_521790775f970544b8dea1_78207989 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="wrap margin-top-100 col-md-12">
      <div class="container">
        <div class="row">
          <div class="clearfix"></div>
          <div class="col-md-12" id="about">
            <?php if (!empty($_smarty_tpl->tpl_vars['page']->value->image)) {?>

            <div class="col-md-4 no-padding-left">
              <div class="about-img">
                <img src="<?php echo base_url('uploads');?>
/<?php echo $_smarty_tpl->tpl_vars['page']->value->image;?>
" alt="">
              </div>
            </div>
            <?php }?>
            
            <div class="<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->image)) {?> col-md-8 <?php } else { ?> col-md-12 <?php }?>">
              <div class="about-title">
                <h1> <?php echo $_smarty_tpl->tpl_vars['page']->value->title;?>
</h1>
              </div>
              <div class="about-description">
                  <p><?php echo $_smarty_tpl->tpl_vars['page']->value->description;?>
</p>
              </div>
              <div class="about-description">
                <a href="<?php echo base_url('company-list/');?>
">Companies List</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
}
}
/* {/block 'content'} */
}
