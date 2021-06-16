<?php
/* Smarty version 3.1.30, created on 2020-10-26 17:49:33
  from "/home/makromed/public_html/demo/templates/default/home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f96d3ed0a6882_34465612',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '566d0d319fee8d117934737dbd77be9e59efbe24' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/home.tpl',
      1 => 1603718916,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f96d3ed0a6882_34465612 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20938759435f96d3ed0a4217_15743070', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_20938759435f96d3ed0a4217_15743070 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

 <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/jquery-ui.min.css?v=2');?>
">
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url('templates/default/assets/js/jquery-ui.min.js?v=2');?>
"><?php echo '</script'; ?>
>


    <div id="forgetPassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
       <div class="modal-dialog">
           <div class="modal-content">
               <form class="forgetPassword" action="<?php echo base_url();?>
/authentication/forget/" method="post">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">FORGET PASSWORD</h4>
                 </div>
                 <div class="modal-body">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" name="email" class="form-control">
                    </div>
                 </div>
                 <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Send</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
               </form>
           </div>
       </div>
    </div>
    <div class="slider col-md-12 no-padding margin-top-100" <?php if ($_smarty_tpl->tpl_vars['banners']->value) {?> style="background-image: url('<?php echo base_url('uploads/');
echo $_smarty_tpl->tpl_vars['banners']->value->images;?>
');" <?php }?>>
       <div class="opacity-background">
          <div class="container">
             <div class="row">
                <div class="col-md-12 col-xs-12">
                   <?php if ($_smarty_tpl->tpl_vars['banners']->value) {?>

                   <h2 class="slider-title" style="text-align:center; width: 100%;" ><?php echo $_smarty_tpl->tpl_vars['banners']->value->name;?>
</h2>
                   <h3 class="slider-content" style="text-align:center; width: 100%;"  > <?php echo $_smarty_tpl->tpl_vars['banners']->value->description;?>
</h3>
                   <h2 class="slider-end" style="text-align:center; width: 100%;"  >  <?php echo $_smarty_tpl->tpl_vars['banners']->value->button_name;?>
</h2>
                   <?php }?>

                </div>
               <div class="col-md-8 col-md-offset-2 col-xs-12 main-search-bar">
                 <form action="<?php echo base_url('search/');?>
" method="GET">
                     <div class="nav-search">

                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Product</a></li>
                          <li role="presentation"><a href="#event" aria-controls="event" role="tab" data-toggle="tab">Event</a></li>
                          <li role="presentation"><a href="#tender" aria-controls="tender" role="tab" data-toggle="tab">Tender</a></li>
                          <li role="presentation"><a href="#company" aria-controls="company" role="tab" data-toggle="tab">Company</a></li>
                            <!--   <li role="presentation"><a href="javascript:;" disabled>Equipment (Coming Soon)</a></li> -->
                        </ul>

                        <div class="adv-bottom-part">
                          <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" class="search-input" placeholder="Search products (brand name, ATC code, CAS no.)..." id="autoCompSr" autocomplete="off">
                          <button type="submit" class="search-button" name="button"><span class="hidden-xs">Search</span></button>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="product">
                           <input type="hidden" name="search_type" value="3">

                           <select name="pr_type[]" class="selectpicker show-menu-arrow main_product_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Product Type">
                              <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['pr_type']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="user_id[]" class="selectpicker show-menu-arrow main_company_name" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company Name">
                              <?php if ($_smarty_tpl->tpl_vars['companies']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['companies']->value, 'company');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['company']->value->id,$_smarty_tpl->tpl_vars['company_id']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="continent[]" class="selectpicker show-menu-arrow main_company_continent" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent">
                              <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['search_continent']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="content_type[]" class="selectpicker show-menu-arrow main_content_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content Type">
                              <option value="0" <?php if (in_array(0,$_smarty_tpl->tpl_vars['content_types']->value)) {?> selected="selected" <?php }?>>Monocomponent</option>
                              <option value="1" <?php if (in_array(1,$_smarty_tpl->tpl_vars['content_types']->value)) {?> selected="selected" <?php }?>>Policomponent</option>
                           </select>
                           <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Status">
                              <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
if ($_smarty_tpl->tpl_vars['value']->value->id != 6) {?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_status']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                              <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="standart[]" class="selectpicker show-menu-arrow main_standart-type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Standard">
                              <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_standart']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="atc_classifiction[]" class="selectpicker show-menu-arrow main_atc_classifiction" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="ATC Classification">
                              <?php if ($_smarty_tpl->tpl_vars['parent_atc']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parent_atc']->value, 'parent', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['parent']->value) {
?>
                              <optgroup label="<?php echo $_smarty_tpl->tpl_vars['parent']->value->atc_code;?>
 - <?php echo $_smarty_tpl->tpl_vars['parent']->value->meaning;?>
" data-collapsible-optgroup="true" data-load-collapse-optgroup="true">
                                 <?php if ($_smarty_tpl->tpl_vars['list_atc']->value[$_smarty_tpl->tpl_vars['parent']->value->id]) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_atc']->value[$_smarty_tpl->tpl_vars['parent']->value->id], 'child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
?>
                                 <option value="<?php echo $_smarty_tpl->tpl_vars['child']->value->atc_code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['child']->value->atc_code,$_smarty_tpl->tpl_vars['atc_classifiction']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['child']->value->atc_code;?>
 - <?php echo $_smarty_tpl->tpl_vars['child']->value->meaning;?>
</option>
                                 <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                              </optgroup>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="event">
                            <select name="event_type" class="selectpicker show-menu-arrow main_event_type" data-selected-text-format="count > 0" title="Event Type">
                              <option value="0">Event Type</option>
                              <?php if ($_smarty_tpl->tpl_vars['event_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['event_types']->value, 'event_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['event_type']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['event_type']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['event_type_con']->value == $_smarty_tpl->tpl_vars['event_type']->value->id) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['event_type']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="event_continent[]" class="selectpicker show-menu-arrow main_event_continent" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent">
                              <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['event_continent']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <div class="show-menu-arrow country-inner-event btn-group bootstrap-select show-tick"></div>
                           <div class="btn-group bootstrap-select show-tick show-menu-arrow data-event" style="margin-right: 0">
                              <button type="button" class="btn dropdown-toggle bs-placeholder btn-default">
                              <span class="filter-option pull-left">Date</span>
                              <span class="bs-caret"><span class="caret"></span></span>
                              </button>
                              <div class="dropdown-menu open" role="combobox">
                                 <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                    <div class="input-daterange input-group" >
                                       <label>Select Date From...</label>
                                     <div class="input-group date" id="ev_start">
                                          <input type="text" class="form-control" name="start" value="<?php echo $_smarty_tpl->tpl_vars['event_start']->value;?>
" autocomplete="off" >
                                          <div class="input-group-addon" >
                                            <img src="<?php echo base_url('templates/default/assets/img/sys/calendar.png');?>
" alt="">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="input-daterange input-group" >
                                      <label>Select Date To...</label>
                                      <div class="input-group date" id="ev_end" >
                                          <input type="text" class="form-control" name="end" value="<?php echo $_smarty_tpl->tpl_vars['event_end']->value;?>
" autocomplete="off">
                                          <div class="input-group-addon">
                                              <img src="<?php echo base_url('templates/default/assets/img/sys/calendar.png');?>
" alt="">
                                          </div>
                                      </div>
                                    </div>
                                    <a href="#" class="clear-dates"><i class="fa fa-times fa-fw" style="color: red"></i>Clear Date</a>
                                    <div class="clearfix"></div>
                                 </ul>
                              </div>
                           </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="tender">
                            <select name="trade_type" class="selectpicker show-menu-arrow main_event_type" data-selected-text-format="count > 0" title="Trade Terms">
                              <option value="0">Trade Terms</option>
                              <?php if ($_smarty_tpl->tpl_vars['delivery_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['delivery_type']->value, 'del_item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['del_item']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['del_item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['del_item']->value->method_abbr;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>

                            <select name="pr_type[]" class="selectpicker show-menu-arrow main_product_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Product Type">
                              <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['pr_type']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="tender_continent[]" class="selectpicker show-menu-arrow main_tender_continent" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent">
                              <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['event_continent']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>

                           <div class="show-menu-arrow country-inner-tender btn-group bootstrap-select show-tick"></div>

                           <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Status">
                              <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
if ($_smarty_tpl->tpl_vars['value']->value->id != 6) {?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_status']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                              <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="standart[]" class="selectpicker show-menu-arrow main_standart-type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Standard">
                              <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_standart']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="dossage_type" class="selectpicker show-menu-arrow main_event_type" data-selected-text-format="count > 0" title="Dossage Forms">
                              <?php if ($_smarty_tpl->tpl_vars['dossageforms']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dossageforms']->value, 'dos_item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dos_item']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['dos_item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['dos_item']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>


                           <div class="btn-group bootstrap-select show-tick show-menu-arrow data-event" style="margin-right: 0">
                              <button type="button" class="btn dropdown-toggle bs-placeholder btn-default">
                              <span class="filter-option pull-left">Date</span>
                              <span class="bs-caret"><span class="caret"></span></span>
                              </button>
                              <div class="dropdown-menu open" role="combobox">
                                 <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                    <div class="input-daterange input-group" >
                                       <label>Select Date From...</label>
                                     <div class="input-group date" id="ev_start">
                                          <input type="text" class="form-control" name="start" value="<?php echo $_smarty_tpl->tpl_vars['event_start']->value;?>
" autocomplete="off" >
                                          <div class="input-group-addon" >
                                            <img src="<?php echo base_url('templates/default/assets/img/sys/calendar.png');?>
" alt="">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="input-daterange input-group" >
                                      <label>Select Date To...</label>
                                      <div class="input-group date" id="ev_end" >
                                          <input type="text" class="form-control" name="end" value="<?php echo $_smarty_tpl->tpl_vars['event_end']->value;?>
" autocomplete="off">
                                          <div class="input-group-addon">
                                              <img src="<?php echo base_url('templates/default/assets/img/sys/calendar.png');?>
" alt="">
                                          </div>
                                      </div>
                                    </div>
                                    <a href="#" class="clear-dates"><i class="fa fa-times fa-fw" style="color: red"></i>Clear Date</a>
                                    <div class="clearfix"></div>
                                 </ul>
                              </div>
                           </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="company">
                           

                              <select name="event_continent[]" id="company_search_att_continent" class="selectpicker show-menu-arrow" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent">
                                  <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                                      <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['event_continent']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                              </select>

                           <div class="show-menu-arrow btn-group bootstrap-select show-tick country-inner-company-search"></div>

                           <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Status">
                              <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
if ($_smarty_tpl->tpl_vars['value']->value->id != 6) {?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_status']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                              <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                           <select name="standart[]" class="selectpicker show-menu-arrow main_standart-type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Standard">
                              <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_standart']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                              <select name="pr_type[]" class="selectpicker show-menu-arrow main_product_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Product Type">
                                  <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                      <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['pr_type']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                              </select>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="eq">...</div>
                        </div>

                          <button type="button" class="adv-search-button btn btn-default"><i class="fa fa-plus"></i>Advanced search</button>
                      </div>
                      </div>
                 </form>
               </div>

             </div>
          </div>
       </div>
    </div>

    <?php echo '<script'; ?>
>


      $('.clear-dates').on('click',function(e){
        e.preventDefault();
        $(this).parents('.dropdown-menu').find('input[type="text"]').val('');
      })
      $('.adv-search-button').on('click',function(e){
        e.preventDefault();
        if(! $('.nav-search .tab-content').hasClass('opened-adv')){
          $('.opacity-background').animate({
              height: '850px'},
              200, function() {

            });
           $('.slider').animate({
              height: '850px'},
              200, function() {

            });
            $('.nav-search .tab-content').animate({
              height: '120px'},
              200, function() {
             $('.nav-search .tab-content').addClass('opened-adv');
             if($('#product').hasClass('active') && $(window).width()<768){
              $('.opened-adv').addClass('h45');
             }
             else if($('#event').hasClass('active') && $(window).width()<768){
              $('.opened-adv').addClass('h20');
             }
             else if($('#tender').hasClass('active') && $(window).width()<768){
              $('.opened-adv').addClass('h20');
             }
            });
          }
          else{

             $('.opacity-background').animate({
              height: '500px'},
              200, function() {

            });

               $('.slider').animate({
              height: '500px'},
              200, function() {

            });

          $('.nav-search .tab-content').removeClass('opened-adv');

          if($(window).width()<768){
            $('.opened-adv').removeClass('h45 h20');
          }

             $('.nav-search .tab-content').animate({
              height: '0'},
              200, function() {

            });
          }
      })

      $('.nav-search a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var tab = e.target;
      if($(tab).attr('href') == '#product'){
            $( "#autoCompSr" ).autocomplete({
                source: site_url+'getProductList',
                minLength:2,
                select: function( event, ui ) {
                  var alias = ui.item.alias;
                   window.location = alias;
            }

            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            var st = (item.type !== undefined) ? 'hasborder' : '';
            return $( "<li class=\""+st+"\"></li>" )
                .data( "item.autocomplete", item )
                .append( '<div>'+item.label+'</div>')
                .appendTo( ul );
            };



            $('.main-search-bar .search-input').attr('placeholder','Search products (brand name, ATC code, CAS no.)...');
            $('[name="search_type"]').val(3);
      }
      else if($(tab).attr('href') == '#event'){
        $('.main-search-bar .search-input').attr('placeholder','Search events');
        $('[name="search_type"]').val(1);
        $('#autoCompSr').autocomplete("destroy");
        $('#autoCompSr').removeData('autocomplete');
      }
      else if($(tab).attr('href') == '#tender'){
        $('.main-search-bar .search-input').attr('placeholder','Search tenders');
        $('[name="search_type"]').val(2);
        $('#autoCompSr').autocomplete("destroy");
        $('#autoCompSr').removeData('autocomplete');
      }
      else if($(tab).attr('href') == '#company'){
          $('.main-search-bar .search-input').attr('placeholder','Search companies');
          $('[name="search_type"]').val(5);
          $('#autoCompSr').autocomplete("destroy");
          $('#autoCompSr').removeData('autocomplete');
      }
      })

    $('.selectpicker').on('loaded.bs.select',function(){
        $('.bs-select-all').each(function(index, el) {
          $(this).replaceWith('<input type="checkbox" id="selall'+index+'"><label for="selall'+index+'" class="sel-toggle">Select All</label>');
        });
        $('.bs-deselect-all').remove();
    })

    $(document).on('click','.sel-toggle', function(e){
      e.preventDefault();
      e.stopPropagation();
      $(this).prev().attr('checked',!$(this).prev().attr('checked'));
      if(!$(this).parents('.btn-group').hasClass('all-sl')){
       $(this).parents('.btn-group').find('.selectpicker').selectpicker('selectAll');
       $(this).parents('.btn-group').addClass('all-sl');
      }
      else{
        $(this).parents('.btn-group').find('.selectpicker').selectpicker('deselectAll');
       $(this).parents('.btn-group').removeClass('all-sl');
      }
    })

    <?php echo '</script'; ?>
>
    <div class="clearfix"></div>
    <div class="col-md-12 service">
      <div id="myModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">REGİSTRATİON</h4>
                 </div>
                 <div class="modal-body">
                    <p>Register to view more options</p>
                 </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-info register_list_open" data-dismiss="modal">Register</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
      </div>
       <div class="what_is_of_interest"><?php echo translate('whats_interest');?>
</div>
       <div class="container">
          <div class="row">
             <div class="col-md-12 main-flex">

                <div class="service-box col-md-3 col-sm-6 col-xs-6">
                    <a <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> href="<?php echo site_url_multi('search/groups/');
echo $_smarty_tpl->tpl_vars['country_code']->value;?>
/2" <?php } else { ?>href="#" class="triggerSignup"<?php }?>>
                    <div class="service-box-img">
                        <img src="<?php echo base_url('templates/default/assets/img/sys/company1.svg');?>
" alt="" class="img-responsive">
                    </div>
                    <div class="service-box-title">
                        <h2><?php echo translate('manufacturer');?>
</h2>
                    </div>
                    <div class="service-box-counter">
                        <h1><?php if (isset($_smarty_tpl->tpl_vars['searching']->value[2]) && count($_smarty_tpl->tpl_vars['searching']->value[2]) > 0) {
echo count($_smarty_tpl->tpl_vars['searching']->value[2]);
} else { ?>0<?php }?></h1>
                    </div>
                   </a>
                </div>
                <div class="service-box col-md-3 col-sm-6 col-xs-6">
                    <a <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> href="<?php echo site_url_multi('search/groups/');
echo $_smarty_tpl->tpl_vars['country_code']->value;?>
/3" <?php } else { ?>href="#" class="triggerSignup"<?php }?>>
                        <div class="service-box-img">
                            <img src="<?php echo base_url('templates/default/assets/img/sys/distribution.svg');?>
" alt="" class="img-responsive">
                        </div>
                        <div class="service-box-title">
                            <h2><?php echo translate('distribitor');?>
</h2>
                        </div>
                        <div class="service-box-counter">
                            <h1><?php if (isset($_smarty_tpl->tpl_vars['searching']->value[3]) && count($_smarty_tpl->tpl_vars['searching']->value[3]) > 0) {
echo count($_smarty_tpl->tpl_vars['searching']->value[3]);
} else { ?>0<?php }?></h1>
                        </div>
                    </a>
                </div>
                <div class="service-box col-md-3 col-sm-6 col-xs-6">
                    <a <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> href="<?php echo site_url_multi('search/groups/');
echo $_smarty_tpl->tpl_vars['country_code']->value;?>
/4" <?php } else { ?>href="#" class="triggerSignup"<?php }?>>
                      <div class="service-box-img">
                          <img src="<?php echo base_url('templates/default/assets/img/sys/courier.svg');?>
" alt="" class="img-responsive">
                      </div>
                      <div class="service-box-title">
                          <h2><?php echo translate('agent');?>
</h2>
                      </div>
                      <div class="service-box-counter">
                          <h1><?php if (isset($_smarty_tpl->tpl_vars['searching']->value[4]) && count($_smarty_tpl->tpl_vars['searching']->value[4]) > 0) {
echo count($_smarty_tpl->tpl_vars['searching']->value[4]);
} else { ?>0<?php }?></h1>
                      </div>
                    </a>
                </div>
                <div class="service-box col-md-3 col-sm-6 col-xs-6">
                    <a <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> href="<?php echo site_url_multi('search/groups/');
echo $_smarty_tpl->tpl_vars['country_code']->value;?>
/5" <?php } else { ?>href="#" class="triggerSignup"<?php }?>>
                      <div class="service-box-img">
                          <img src="<?php echo base_url('templates/default/assets/img/sys/commerce.svg');?>
" alt="" class="img-responsive">
                      </div>
                      <div class="service-box-title">
                          <h2><?php echo translate('manager');?>
</h2>
                      </div>
                      <div class="service-box-counter">
                          <h1><?php if (isset($_smarty_tpl->tpl_vars['searching']->value[5]) && count($_smarty_tpl->tpl_vars['searching']->value[5]) > 0) {
echo count($_smarty_tpl->tpl_vars['searching']->value[5]);
} else { ?>0<?php }?></h1>
                      </div>
                    </a>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="clearfix"></div>
    <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {?>
    <div class="wrap col-md-12">
       <div class="container">
          <div class="row">
             <div class="clearfix"></div>
             <div class="col-md-12" id="country">
                <div class="col-md-12 no-padding">
                   <h1 class="main-title"><?php echo translate('drugs');?>
</h1>

                </div>
                <div class="col-md-12 no-padding country-flag">

                   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
if (isset($_smarty_tpl->tpl_vars['countries_count']->value[$_smarty_tpl->tpl_vars['country']->value->id])) {?>

                   <div class="col-md-4 no-padding">
                      <a href="<?php echo base_url('search?search_type=3&country=');
echo $_smarty_tpl->tpl_vars['country']->value->id;?>
">
                      <div data-id="<?php echo $_smarty_tpl->tpl_vars['country']->value->id;?>
" class="country-item" style="background-image:url('<?php echo base_url("templates/default/assets/img/country2/");
echo strtolower($_smarty_tpl->tpl_vars['country']->value->code);?>
.svg');">
                            <span> <?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
 </span>
                            <?php if (isset($_smarty_tpl->tpl_vars['countries_count']->value[$_smarty_tpl->tpl_vars['country']->value->id])) {?><span class="badge-count"><?php echo $_smarty_tpl->tpl_vars['countries_count']->value[$_smarty_tpl->tpl_vars['country']->value->id]['COUNT(id)'];?>
</span><?php }?>
                        </div>
                      </a>
                   </div>

                  <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                <div class="clearfix"></div>
             </div>
          </div>
       </div>
    </div>
    </div>
    <?php }?>
    <div class="wrap col-md-12" style="min-height: 0">
      <div class="container">
        <div class="row flex-video">
          <iframe width="800" height="450" src="https://www.youtube.com/embed/6sT604EHm0o?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    
    <?php echo '<script'; ?>
 type="text/javascript">
      $(document).on('submit','.forgetPassword', function(e){
          e.preventDefault();
          $.ajax({
              type:'POST',
              url:site_url+'authentication/forget/',
              data: $(this).serialize(),
              cache:false,
              success:function(data){
                 toastr.success('The link has been sended to your mail address');
                 $('#forgetPassword').modal('hide');
              }
          });
          e.preventDefault();
          return false;
      });





    <?php echo '</script'; ?>
>
    
    <?php if ($_smarty_tpl->tpl_vars['send_email']->value == true) {?>
    <?php echo '<script'; ?>
 type="text/javascript">
      toastr.success('New password has been sended to your mail address');
    <?php echo '</script'; ?>
>
    <?php }?>
     <?php if ($_smarty_tpl->tpl_vars['confirm_account']->value == true) {?>
    <?php echo '<script'; ?>
 type="text/javascript">
      toastr.error('Server error. Your account not confirmed.');
    <?php echo '</script'; ?>
>
    <?php }?>

    <div id="termModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $_smarty_tpl->tpl_vars['terms']->value->title;?>
</h4>
      </div>
      <div class="modal-body" style="max-height: 70vh;overflow: auto;">
        <p style="font-size:16px;"><?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['terms']->value->description, ENT_QUOTES);?>
</p>
      </div>
    <div class="modal-footer">
       <button type="button" class="btn btn-success m-0" id="iagree" style="    padding: 7px 20px;" >I Agree</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php
}
}
/* {/block 'content'} */
}
