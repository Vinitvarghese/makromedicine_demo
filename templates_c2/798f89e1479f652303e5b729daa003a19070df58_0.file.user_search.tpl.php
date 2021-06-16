<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:58:08
  from "/home/makromed/public_html/demo/templates/default/search/user_search.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f98196040f255_09181268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '798f89e1479f652303e5b729daa003a19070df58' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/search/user_search.tpl',
      1 => 1603718930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f98196040f255_09181268 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1235545995f98196040e507_90564521', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_1235545995f98196040e507_90564521 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" style="padding-top:25px;padding-bottom:15px;">
              <div class="col-md-3 no-padding">
                <select class="selectpicker show-menu-arrow search_country_user" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Country" style="width:100%;">
                   <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
?>
                   <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value->code;?>
" data-group="<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['country_id']->value == $_smarty_tpl->tpl_vars['country']->value->id) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
</option>
                   <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                </select>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="col-md-12 no-padding">
                  <table class="table table-bordered" >
                    <thead>
                      <tr role="row">
                        <td rowspan="1" colspan="1" class="align-text white-back"></td>
                        <td colspan="6" class="align-text blue-back">WHO IS SEARCHING</td>
                        <td colspan="3" class="align-text red-back">SEARCHING FOR WHAT</td>
                      </tr>
                      <tr role="row">
                        <td></td>
                        <td class="align-text">Company</td>
                        <td class="align-text">Company person</td>
                        <td class="align-text">Country</td>
                        <td class="align-text align-width">Email</td>
                        <td class="align-text align-width">Phone</td>
                        <td class="align-text align-width">Website</td>
                        <td class="align-text">Product Type</td>
                        <td class="align-text">Status</td>
                        <td class="align-text">Standard</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($_smarty_tpl->tpl_vars['get_user']->value) && !empty($_smarty_tpl->tpl_vars['get_user']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['get_user']->value, 'company');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
?>
                      <tr role="row">
                        <td class="closed_tb"><i class="fa fa-plus open_table"></i></td>
                        <td class="closed_tb align-text align-name"><a href="'<?php echo base_url("company/");
echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
"><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</a></td>
                        <td class="closed_tb align-text"><?php echo $_smarty_tpl->tpl_vars['company']->value->fullname;?>
</td>
                        <td class="closed_tb align-text align-width">
                          <center>
                              <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo get_country_name($_smarty_tpl->tpl_vars['company']->value->country_id);?>
">
                                  <img src="<?php echo base_url('templates/default/assets/img/country/');
echo get_country_code($_smarty_tpl->tpl_vars['company']->value->country_id);?>
.png" alt="<?php echo get_country_name($_smarty_tpl->tpl_vars['company']->value->country_id);?>
" class="table-img">
                              </a>
                          </center>
                        </td>
                        <td class="closed_tb align-text align-width"><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
"><i class="fa fa-envelope"></i></a></td>
                        <td class="closed_tb align-text align-width"><a href="tel:<?php echo $_smarty_tpl->tpl_vars['company']->value->phone;?>
"><i class="fa fa-phone"></i></a></td>
                        <td class="closed_tb align-text align-width"><a href="<?php echo $_smarty_tpl->tpl_vars['company']->value->website;?>
" target="_blank"><i class="fa fa-globe"></i></a></td>
                        <td class="closed_tb ">
                          <span>
                            <?php if (isset($_smarty_tpl->tpl_vars['pr']->value)) {?>
                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pr']->value[$_smarty_tpl->tpl_vars['company']->value->id], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                              <?php if (!empty(get_product_type_name($_smarty_tpl->tpl_vars['value']->value['product_type_id']))) {
echo get_product_type_name($_smarty_tpl->tpl_vars['value']->value['product_type_id']);?>
,<?php }?>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>
                          </span>
                        </td>
                        <td class="closed_tb align-text">
                          <span>
                            <?php if (isset($_smarty_tpl->tpl_vars['user_groups']->value)) {?>
                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_groups']->value[$_smarty_tpl->tpl_vars['company']->value->id], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                              <?php if (!empty(get_group_name($_smarty_tpl->tpl_vars['value']->value['group_id']))) {
echo get_group_name($_smarty_tpl->tpl_vars['value']->value['group_id']);?>
,<?php }?>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>
                          </span>
                        </td>
                        <td class="closed_tb align-text">
                          <span>
                            <?php if (isset($_smarty_tpl->tpl_vars['user_standarts']->value)) {?>
                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_standarts']->value[$_smarty_tpl->tpl_vars['company']->value->id], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                              <?php if (!empty(get_standart_name($_smarty_tpl->tpl_vars['value']->value['standart_id']))) {
echo get_standart_name($_smarty_tpl->tpl_vars['value']->value['standart_id']);?>
,<?php }?>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>
                          </span>
                        </td>
                      </tr>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                      <?php }?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
  $(document).ready(function(){
     $('.search_country_user').change(function(){
       var value = $(this).val();
       var group_id = $(this).find(':selected').attr('data-group');
       window.location = site_url+'search/groups/'+value+'/'+group_id+'/';
     });
  });
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'content'} */
}
