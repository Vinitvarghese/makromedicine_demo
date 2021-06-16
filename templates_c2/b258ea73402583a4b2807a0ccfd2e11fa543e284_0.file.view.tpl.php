<?php
/* Smarty version 3.1.30, created on 2020-10-26 18:12:32
  from "/home/makromed/public_html/demo/templates/default/product/view.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f96d950963719_44815441',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b258ea73402583a4b2807a0ccfd2e11fa543e284' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/product/view.tpl',
      1 => 1603718926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f96d950963719_44815441 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5330014545f96d950962622_43042633', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_5330014545f96d950962622_43042633 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="clearfix"></div>
<style>
    .not-active,.not-active td{
        background-color: #FFCDD2!important;
    }
    #example_wrapper{
    max-width: 1326px;
    margin: 0 auto;
    }
    .dataTables_paginate{
    float:right!important;
    }
    .tables-data .table-search-not{
    width:100%;
    }
</style>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
                <div class="col-md-12 no-padding">
                    <div class="col-md-3 no-padding profile-left"  style="padding-bottom:0px;">
                        <div class="left-sidebar" style="min-height:308px;">
                          <?php if (count($_smarty_tpl->tpl_vars['product_images']->value) > 0) {?>

                          <?php } else { ?>
                            <img src="<?php echo base_url('templates/default/assets/img/download.png');?>
" style="width: 100%;" alt="">
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-md-9 profile-right no-padding-right" style="padding-bottom:0px;">
                      <div class="right-content">
                          <div class="col-md-12">
                              <h1 class="main-info-title">Product information</h1>
                          </div>
                          <div class="col-md-12 no-padding right-content-inner">
                            <div class="col-md-6">
                              <div class="profile-information bug-fixed" style="padding-left: 21px;">
                                <div class="form-group">
                                    <p>Product Name</p>
                                    <span><?php echo $_smarty_tpl->tpl_vars['product']->value->title;?>
</span>
                                </div>
                                <div class="form-group">
                                    <p>Product Type</p>
                                    <span><?php echo get_product_type_name($_smarty_tpl->tpl_vars['product']->value->pr_type);?>
</span>
                                </div>
                                <div class="form-group">
                                    <p>Content Type</p>
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value->poly == 0) {?>
                                    <span>Monocomponent</span>
                                    <?php } else { ?>
                                    <span>Policomponent</span>
                                    <?php }?>
                                </div>
                                <div class="form-group">
                                    <p>Country</p>
                                     <span><a href="<?php echo site_url('search?search_type=3&country=');
echo $_smarty_tpl->tpl_vars['product']->value->country;?>
" target="_blank"><?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
</a></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="profile-information bug-fixed" style="padding-left: 21px;">
                                <div class="form-group">
                                    <?php $_smarty_tpl->_assignInScope('atc_code', json_decode($_smarty_tpl->tpl_vars['product']->value->atc_code));
?>
                                    <?php $_smarty_tpl->_assignInScope('herbal', json_decode($_smarty_tpl->tpl_vars['product']->value->herbal));
?>
                                    <?php $_smarty_tpl->_assignInScope('animals', json_decode($_smarty_tpl->tpl_vars['product']->value->animal));
?>
                                    <?php $_smarty_tpl->_assignInScope('casNumbers', json_decode($_smarty_tpl->tpl_vars['product']->value->cas));
?>
                                    <p>Content</p>
                                    <span>
                                    <?php if (count($_smarty_tpl->tpl_vars['atc_code']->value) > 0) {?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['atc_code']->value, 'atc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['atc']->value) {
?>
                                            <?php echo get_atc_code_no($_smarty_tpl->tpl_vars['atc']->value->id);?>
 <?php echo $_smarty_tpl->tpl_vars['atc']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['atc']->value->vdoza);?>

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
                                            <?php echo get_herbal_name($_smarty_tpl->tpl_vars['herb']->value->id);?>
 <?php echo $_smarty_tpl->tpl_vars['herb']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['herb']->value->vdoza);?>

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
                                            <?php echo get_animal_name($_smarty_tpl->tpl_vars['animal']->value->id);?>
 <?php echo $_smarty_tpl->tpl_vars['animal']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['animal']->value->vdoza);?>

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
                                            <?php echo get_cas_name($_smarty_tpl->tpl_vars['casss']->value->id);?>
 <?php echo $_smarty_tpl->tpl_vars['casss']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['casss']->value->vdoza);?>

                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    <?php }?>
                                  </span>
                                </div>
                                <div class="form-group">
                                    <p>Dossage form</p>
                                    <span>
                                      <?php $_smarty_tpl->_assignInScope('var', json_decode($_smarty_tpl->tpl_vars['product']->value->packing_type));
?>
                                      <?php if (count($_smarty_tpl->tpl_vars['var']->value) > 0) {?>
                                          <?php $_smarty_tpl->_assignInScope('f', json_decode(json_encode($_smarty_tpl->tpl_vars['var']->value[0])));
?>
                                          <?php echo get_packing_type_name($_smarty_tpl->tpl_vars['f']->value->id);?>
 <?php if ($_smarty_tpl->tpl_vars['f']->value->mdoza2 != 0) {
echo $_smarty_tpl->tpl_vars['f']->value->mdoza2;
}?> <?php echo get_unit_name($_smarty_tpl->tpl_vars['f']->value->vdoza2);?>
 <?php if ($_smarty_tpl->tpl_vars['f']->value->mdoza != 0) {
echo $_smarty_tpl->tpl_vars['f']->value->mdoza;
}?> <?php echo get_drug_type_code($_smarty_tpl->tpl_vars['f']->value->vdoza);?>

                                      <?php }?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <p>Medical Classification</p>
                                    <span>
                                      <span>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['product']->value->medical_cl)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, get_selected_medical($_smarty_tpl->tpl_vars['product']->value->medical_cl), 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?> <?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
, <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php } else { ?> <?php }?>
                                      </span>
                                    </span>
                                </div>
                              </div>
                            </div>
                            <?php if (!empty($_smarty_tpl->tpl_vars['product']->value->description)) {?>
                            <div class="col-md-12">
                              <div class="profile-information bug-fixed" style="padding-left: 21px;">
                                <div class="form-group">
                                    <p>Description</p>
                                    <span><?php echo $_smarty_tpl->tpl_vars['product']->value->description;?>
</span>
                                </div>
                              </div>
                            </div>
                            <?php }?>
                            <div class="clearfix"> </div>
                          </div>
                          <div class="clearfix"> </div>
                      </div>
                    </div>
                    <div class="col-md-12 no-padding">
                      <div class="right-content">
                          <div class="col-md-12">
                              <h1 class="main-info-title">Company information</h1>
                              
                              <?php $_smarty_tpl->_assignInScope('company', get_company_name($_smarty_tpl->tpl_vars['product']->value->user_id));
?>
                          </div>
                          <div class="col-md-12 no-padding right-content-inner">
                            <div class="profile-information bug-fixed" style="padding-left: 21px;">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <div class="bio-image">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['company_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
" style="width: 70%;"/>
                                  </div>
                                  <div class="form-group">
                                      <center>
                                        <div class="btn-group">
                                          <a href="<?php echo base_url('company/');
echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
" target="_blank" class="btn btn-info" style="margin-top:25px;font-size:13px;"> <i class="fa fa-info-circle"></i> Get Company</a>
                                          <a href="<?php echo base_url('company/product/');
echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
" target="_blank" class="btn btn-warning" style="margin-top:25px;font-size:13px;"> <i class="fa fa-list"></i> Get Company Product</a>
                                        </div>
                                      </center>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                    <p>Company name</p>
                                    <span><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</span>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?>
                                <div class="form-group">
                                    <p>Company email</p>
                                    <span><?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
</span>
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <p>Company info</p>
                                    <p><?php echo $_smarty_tpl->tpl_vars['company']->value->company_info;?>
</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"> </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php
}
}
/* {/block 'content'} */
}
