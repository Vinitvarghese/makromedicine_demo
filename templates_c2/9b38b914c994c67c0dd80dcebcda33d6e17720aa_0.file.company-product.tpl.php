<?php
/* Smarty version 3.1.30, created on 2020-10-27 14:57:53
  from "/home/makromed/public_html/demo/templates/default/company/company-product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f97fd3102c3d5_02027695',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b38b914c994c67c0dd80dcebcda33d6e17720aa' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/company-product.tpl',
      1 => 1603718948,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f97fd3102c3d5_02027695 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16274748375f97fd3102b2c9_21594982', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_16274748375f97fd3102b2c9_21594982 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
<div class="n_content_area full_width products_container">
<a href="#" id="openMenu" class="pages-menu-float">Menu</a>
    <div class="container-fluid">
        <div class="row">
            <?php $_smarty_tpl->_subTemplateRender("file:../company/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            
            <div class="n_right_section decrease_padding start_with_text">
                <div class="with_buttons full_width">
                    <h2>Products</h2>
                    <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] && $_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['UserData']->value->id) {?>
                        <a href="<?php echo base_url('/product');?>
" class="add-new-interest n_green_col">Add Product</a>
                    <?php }?>
                </div>
                <div class="full_width">
                    <div class="row">
                        
                        <div class="scroll_table_n full_width lst_tbl adj_colapse">
                            
                            <table id="example" >
                                    
                                    <tbody>
                                    <tr>
                                        
                                        <th class="two">
                                            
                                            Product Type
                                        </th>
                                        <th class="three">
                                            
                                            Brand Name
                                        </th>
                                        <th class="four">
                                            
                                            Content
                                        </th>
                                        <th class="five">
                                            
                                            Dosage Form
                                        </th>
                                        
                                        <th class="seven">
                                            
                                            Medical Classification
                                        </th>
                                        
                                        <th class="nine" style="min-width:70px!important"><a href="#" style="margin-left:8px"></a></th>
                                        
                                    </tr>
                                    
                                    <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
                                            <?php $_smarty_tpl->_assignInScope('company', get_company_name($_smarty_tpl->tpl_vars['product']->value->user_id));
?>
                                            <?php $_smarty_tpl->_assignInScope('atc_code', json_decode($_smarty_tpl->tpl_vars['product']->value->atc_code));
?>
                                            <?php $_smarty_tpl->_assignInScope('herbal', json_decode($_smarty_tpl->tpl_vars['product']->value->herbal));
?>
                                            <?php $_smarty_tpl->_assignInScope('animals', json_decode($_smarty_tpl->tpl_vars['product']->value->animal));
?>
                                            <?php $_smarty_tpl->_assignInScope('casNumbers', json_decode($_smarty_tpl->tpl_vars['product']->value->cas));
?>
                                            <?php if (count($_smarty_tpl->tpl_vars['atc_code']->value) > 0 || count($_smarty_tpl->tpl_vars['herbal']->value) > 0 || count($_smarty_tpl->tpl_vars['animals']->value) > 0 || count($_smarty_tpl->tpl_vars['casNumbers']->value) > 0) {?>
                                                <?php if (isset($_smarty_tpl->tpl_vars['company']->value->company_name)) {?>
                                                    <?php if (!empty(trim($_smarty_tpl->tpl_vars['company']->value->company_name))) {?>
                                                        <tr>
                                                            
                                                            <td class="closed_tb two">
                                                                <p style="display:inline-block;"><?php echo get_product_type_name($_smarty_tpl->tpl_vars['product']->value->pr_type);?>
</p>
                                                            </td>
                                                            <td class="closed_tb three">
                                                                <p><?php echo $_smarty_tpl->tpl_vars['product']->value->title;?>
</p>
                                                            </td>
                                                            <td class="closed_tb content four">
                                          <span>
                                          <?php if (count($_smarty_tpl->tpl_vars['atc_code']->value) > 0) {?>
                                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['atc_code']->value, 'atc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['atc']->value) {
?>
                                                  <b><?php echo get_atc_code_no($_smarty_tpl->tpl_vars['atc']->value->id);?>
</b>
                                                  <span>(<?php echo $_smarty_tpl->tpl_vars['atc']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['atc']->value->vdoza);?>
)</span>
                                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                          <?php }?>
                                              <?php if (count($_smarty_tpl->tpl_vars['herbal']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herbal']->value, 'herb');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['herb']->value) {
?>
                                                      <b><?php echo get_herbal_name($_smarty_tpl->tpl_vars['herb']->value->id);?>
</b>
                                                      <span>(<?php echo $_smarty_tpl->tpl_vars['herb']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['herb']->value->vdoza);?>
)</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                              <?php if (count($_smarty_tpl->tpl_vars['animals']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animals']->value, 'animal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['animal']->value) {
?>
                                                      <b><?php echo get_animal_name($_smarty_tpl->tpl_vars['animal']->value->id);?>
</b>
                                                      <span><?php echo $_smarty_tpl->tpl_vars['animal']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['animal']->value->vdoza);?>
</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                              <?php if (count($_smarty_tpl->tpl_vars['casNumbers']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['casNumbers']->value, 'casss');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['casss']->value) {
?>
                                                      <b><?php echo get_cas_name($_smarty_tpl->tpl_vars['casss']->value->id);?>
</b>
                                                      <span><?php echo $_smarty_tpl->tpl_vars['casss']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['casss']->value->vdoza);?>
</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                          </span>
                                                            </td>
                                                            <td class="closed_tb five">
                                        <span>
                                          <?php $_smarty_tpl->_assignInScope('var', json_decode($_smarty_tpl->tpl_vars['product']->value->packing_type));
?>
                                            <?php if (count($_smarty_tpl->tpl_vars['var']->value) > 0) {?>
                                                <?php $_smarty_tpl->_assignInScope('f', json_decode(json_encode($_smarty_tpl->tpl_vars['var']->value[0])));
?>
                                                <b><?php echo get_packing_type_name($_smarty_tpl->tpl_vars['f']->value->id);?>
</b>
                                                <span>(<?php if ($_smarty_tpl->tpl_vars['f']->value->mdoza2 != 0) {
echo $_smarty_tpl->tpl_vars['f']->value->mdoza2;
}?> <?php echo get_unit_name($_smarty_tpl->tpl_vars['f']->value->vdoza2);?>
 <?php if ($_smarty_tpl->tpl_vars['f']->value->mdoza != 0) {
echo $_smarty_tpl->tpl_vars['f']->value->mdoza;
}?> <?php echo get_drug_type_code($_smarty_tpl->tpl_vars['f']->value->vdoza);?>
)</span>
                                            <?php }?>
                                        </span>
                                                            </td>
                                                            
                                                            <td class="closed_tb seven">
                                        <span>
                                          <?php if (!empty($_smarty_tpl->tpl_vars['product']->value->medical_cl)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, get_selected_medical($_smarty_tpl->tpl_vars['product']->value->medical_cl), 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                              <b><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</b>
                                          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php } else { ?> <?php }?>
                                        </span>
                                                            </td>
                                                            
                                                            <td class="closed_tb nine">
                                                                <center>
                                                                    <a type="button" class="btn btn-info btn-circle btn-lg" data-target="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"  href="<?php echo site_url_multi('product/view/');
echo $_smarty_tpl->tpl_vars['product']->value->id;
if ($_smarty_tpl->tpl_vars['product']->value->alias) {?>-<?php echo $_smarty_tpl->tpl_vars['product']->value->alias;
}?>"><i class="fa fa-info"></i></a>
                                                                </center>
                                                            </td>
                                                            
                                                        </tr>
                                                    <?php }?>
                                                <?php }?>
                                            <?php }?>
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

            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->


    <?php echo '<script'; ?>
>
        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->lat) || !empty($_smarty_tpl->tpl_vars['UserData']->value->lng)) {?>
        var json_lat = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lat;?>
;
        var json_lng = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lng;?>
;
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
';
        
        
        <?php } else { ?>
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
';
        
        
        <?php }?>
    <?php echo '</script'; ?>
>
    <?php
}
}
/* {/block 'content'} */
}
