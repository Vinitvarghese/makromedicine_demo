<?php
/* Smarty version 3.1.30, created on 2020-10-27 17:52:23
  from "/home/makromed/public_html/demo/templates/default/company/product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f982617a85278_16981467',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db844f806b13e7af5872f49eeeb61d3601dafc9b' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/product.tpl',
      1 => 1603802535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f982617a85278_16981467 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16013248475f982617a83f48_84967335', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_16013248475f982617a83f48_84967335 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12">
                <form class="searchTable" action="<?php echo base_url('home/search_table');?>
" method="post">
                  <div class="col-md-12 no-padding tables-data">
                      <div class="col-md-12">
                        <h2 style="padding-left:30px;"><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
 company products</h2>
                      </div>
                      <table class="table table-striped no-padding display table-search-not"  id="example" >
                          <thead>
                              <tr>
                                  <th class="one"></th>
                                  <th class="two">
                                    <select class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Product Type"></select>
                                  </th>
                                  <th class="three">
                                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name">
                                  </th>
                                  <th class="four">
                                    <select class="form-control selectpicker show-menu-arrow select_content" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content"></select>
                                  </th>
                                  <th class="five">
                                    <select class="form-control selectpicker show-menu-arrow select_dossage" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Dosage form"></select>
                                  </th>
                                  <th class="six">
                                    <select class="form-control selectpicker show-menu-arrow select_country" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country"></select>
                                  </th>
                                  <th class="seven">
                                    <select class="form-control selectpicker show-menu-arrow select_medical" multiple data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Medical Classification"></select>
                                  </th>
                                  <th class="eight">
                                    <select class="form-control selectpicker show-menu-arrow select_company" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company"></select>
                                  </th>
                                  <th class="nine" style="min-width:70px!important"><a href="#" style="margin-left:8px">Actions </a></th>
                                  <th class="ten" style="min-width:108px!important"><a href="#" style="margin-left:8px">Operations</a></th>
                              </tr>
                          </thead>
                          <tbody>
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
                                      <td class="closed_tb one"></td>
                                      <td class="closed_tb two">
                                        <p><?php echo get_product_type_name($_smarty_tpl->tpl_vars['product']->value->pr_type);?>
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
                                      <td class="closed_tb six">
                                          <center>
                                              <a href="#" title="<?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
">
                                                  <img src="<?php echo base_url('templates/default/assets/img/country/');
echo get_country_code($_smarty_tpl->tpl_vars['product']->value->country);?>
.png" alt="<?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
" class="table-img">
                                                  <p style="font-size:10px;color:#555;"><?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
</p>
                                              </a>
                                          </center>
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
                                      <td class="closed_tb eight">
                                        <span>
                                        <?php if (isset($_smarty_tpl->tpl_vars['company']->value->company_name)) {
echo $_smarty_tpl->tpl_vars['company']->value->company_name;
}?>
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
                                      <td class="closed_tb ten">
                                          <div class="btn-group" style="width:100px;margin-left:8px;">
                                              <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->email)) {?><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
" class="btn btn-success btn-bix"> <i class="fa fa-envelope-o"></i> </a><?php }?>
                                              <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->website)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['company']->value->website;?>
" target="_blank" class="btn btn-info btn-bix"> <i class="fa fa-globe"></i></a><?php }?>
                                              <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->slug)) {?><a href="<?php echo base_url("company/");
echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
" class="btn btn-danger btn-bix" ><i class="fa fa-user"></i></a><?php }?>
                                          </div>
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
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function (){
  var table = $('#example').DataTable({
      dom: 'lrtip',
      bPaginate: true,
      bLengthChange: false,
      pageLength: 100,
      bFilter: true,
      bInfo: false,
      ordering: false,
      bAutoWidth: false,
      columnDefs: [ {
        targets  : 'no-sort',
        orderable:  false,
        className: 'mdl-data-table__cell--non-numeric'
      }],
      fnDrawCallback: function( oSettings ) {
        $("td.content > span").each(function() {
            if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length==0) {
                $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
            }
        });
        $("td.three > span").each(function() {
            if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length==0) {
                $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
            }
        });
      },
      initComplete: function () {
        // Product Type
        this.api().columns([1]).every( function () {
          var element = [];
          var column = this;
          var select = $(".product_type");
          column.data().unique().sort().each( function ( d, j ) {
            var mar = $(d).text();
            element.push($.trim(mar));
          });
          element = $.uniqueSort(element);
          $.each( element, function ( index, value ) {
             select.append( '<option value="'+value+'">'+value+'</option>' )
          });
        });

        // Content
        this.api().columns([3]).every( function () {
          var element = [];
          var column = this;
          var select = $(".select_content");
          column.data().unique().sort().each( function ( d, j ) {
            var mar = $(d).find('b');
            $.each(mar, function(res,req){
              var pass = $.trim($(req).text());
              element.push($.trim(pass));
            });
          });
          element = $.uniqueSort(element);
          $.each( element, function ( index, value ) {
             select.append( '<option value="'+value+'">'+value+'</option>' )
          });
        });

        this.api().columns([4]).every( function () {
          var element = [];
          var column = this;
          var select = $(".select_dossage");
          column.data().unique().sort().each( function ( d, j ) {
            var mar = $(d).find('b');
            $.each(mar, function(res,req){
              var pass = $.trim($(req).text());
              element.push($.trim(pass));
            });
          });
          element = $.uniqueSort(element);
          $.each( element, function ( index, value ) {
             select.append( '<option value="'+value+'">'+value+'</option>' )
          });
        });

        this.api().columns([5]).every( function () {
          var element = [];
          var column = this;
          var select = $(".select_country");
          column.data().unique().sort().each( function ( d, j ) {
            var mar = $(d).find('p');
            $.each(mar, function(res,req){
              var pass = $.trim($(req).text());
              element.push($.trim(pass));
            });
          });
          element = $.uniqueSort(element);
          $.each( element, function ( index, value ) {
             select.append( '<option value="'+value+'">'+value+'</option>' )
          });
        });

        this.api().columns([6]).every( function () {
          var element = [];
          var column = this;
          var select = $(".select_medical");
          column.data().unique().sort().each( function ( d, j ) {
            var mar = $(d).find('b');
            $.each(mar, function(res,req){
              var pass = $.trim($(req).text());
              element.push($.trim(pass));
            });
          });
          element = $.uniqueSort(element);
          $.each( element, function ( index, value ) {
             select.append( '<option value="'+value+'">'+value+'</option>' )
          });
        });
        this.api().columns([7]).every( function () {
          var element = [];
          var column = this;
          var select = $(".select_company");
          column.data().unique().sort().each( function ( d, j ) {
            var f = $.trim(d);
            var mar = $(f);
            $.each(mar, function(res,req){
              var pass = $(req).text();
              element.push($.trim(pass));
            });
          });
          element = $.uniqueSort(element);
          $.each( element, function ( index, value ) {
             select.append( '<option value="'+value+'">'+value+'</option>' )
          });
        });
        $(".selectpicker").selectpicker();
     }
  });

  $('.product_type').on('change', function(){
    var search = [];
    $.each($('.product_type option:selected'), function(){
          search.push($(this).val());
    });
    search = search.join('|');
    regExSearch = '^\\s' + search +'\\s*$';
    table.column(1).search(search, true, false).draw();
  });

  $('.select_content').on('change', function(){
    var search = [];
    $.each($('.select_content option:selected'), function(){
          search.push($(this).val());
    });
    search = search.join('|');
    regExSearch = '^\\s' + search +'\\s*$';
    table.column(3).search(search, true, false).draw();
  });
  $('.select_dossage').on('change', function(){
    var search = [];
    $.each($('.select_dossage option:selected'), function(){
          search.push($(this).val());
    });
    search = search.join('|');
    regExSearch = '^\\s' + search +'\\s*$';
    table.column(4).search(search, true, false).draw();
  });
  $('.select_country').on('change', function(){
    var search = [];
    $.each($('.select_country option:selected'), function(){
          search.push($(this).val());
    });
    search = search.join('|');
    regExSearch = '^\\s' + search +'\\s*$';
    table.column(5).search(search, true, false).draw();
  });
  $('.select_medical').on('change', function(){
    var search = [];
    $.each($('.select_medical option:selected'), function(){
          search.push($(this).val());
    });
    search = search.join('|');
    regExSearch = '^\\s' + search +'\\s*$';
    table.column(6).search(search, true, false).draw();
  });
  $('.select_company').on('change', function(){
    var search = [];
    $.each($('.select_company option:selected'), function(){
          search.push($(this).val());
    });
    search = search.join('|');
    regExSearch = '^\\s' + search +'\\s*$';
    table.column(7).search(search, true, false).draw();
  });
  $('.brand_name').on('change', function(){
    var  search = $(this).val();
    table.column(2).search(search, true, false).draw();
  });
});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
