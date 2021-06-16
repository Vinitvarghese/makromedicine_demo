<?php
/* Smarty version 3.1.30, created on 2020-10-27 14:57:18
  from "/home/makromed/public_html/demo/templates/default/company/interests.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f97fd0e2bafc7_15714097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2fa3cccb83ad0d7aaa4c75423e995a6adf114b6a' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/interests.tpl',
      1 => 1603718949,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f97fd0e2bafc7_15714097 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17121193255f97fd0e2b98d8_56019177', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_17121193255f97fd0e2b98d8_56019177 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <div class="n_content_area full_width">
    <a href="#" id="openMenu" class="pages-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../company/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section start_with_text decrease_padding interest-page news_page">
                    <div class="with_buttons full_width">
                        <h2>Your Interests</h2>
                        <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] && $_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['UserData']->value->id) {?>
                            <a href="#" class="add-new-interest n_green_col">Add Interest</a>
                        <?php }?>
                    </div>
                    <div class="full_width">
                        <div class="row">
                            <form class="userSettings" action="<?php echo base_url('pages');?>
/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/interests" enctype="multipart/form-data" method="post">
                                <div class="right-content-inner">
                                    <div class="col-md-12 no-padding interest-inner">
                                        <?php $_smarty_tpl->_assignInScope('key', 0);
?>
                                        <?php $_smarty_tpl->_assignInScope('keyCounter', 0);
?>
                                        <?php if ($_smarty_tpl->tpl_vars['get_your_interests']->value) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['get_your_interests']->value, 'your_interests', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['your_interests']->value) {
?>
                                                <?php $_smarty_tpl->_assignInScope('keyCounter', $_smarty_tpl->tpl_vars['keyCounter']->value+1);
?>
                                                <div class="form-group label_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
                                                    <div class="col-md-2 no-padding">
                                                        <label>Continent</label>
                                                        <?php $_smarty_tpl->_assignInScope('continent_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['continent']));
?>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils continent" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="continent[<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][]" title="Continent" required>
                                                            <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                                                                <option <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['continent_array']->value)) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
"><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Country</label>
                                                        <?php $_smarty_tpl->_assignInScope('country_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['country']));
?>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="country[<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][]" title="Country">
                                                            <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
?>
                                                                <option <?php if (in_array($_smarty_tpl->tpl_vars['country']->value->id,$_smarty_tpl->tpl_vars['country_array']->value)) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['country']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <label>Product Type</label>
                                                        <?php $_smarty_tpl->_assignInScope('product_type_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['product_type']));
?>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][]" title="Product Type" required>
                                                            <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                                                <option <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['product_type_array']->value)) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Status</label>
                                                        <?php $_smarty_tpl->_assignInScope('status_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['status']));
?>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][]" title="Status" required>
                                                            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
                                                                <?php if ($_smarty_tpl->tpl_vars['group']->value->id != 6) {?>
                                                                    <option <?php if (in_array($_smarty_tpl->tpl_vars['group']->value->id,$_smarty_tpl->tpl_vars['status_array']->value)) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
</option>
                                                                <?php }?>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Standart</label>
                                                        <?php $_smarty_tpl->_assignInScope('standart_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['standart']));
?>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="standart[<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][]" title="Standard">
                                                            <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'standart');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['standart']->value) {
?>
                                                                <option <?php if (in_array($_smarty_tpl->tpl_vars['standart']->value->id,$_smarty_tpl->tpl_vars['standart_array']->value)) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['standart']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['standart']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 no-padding">
                                                        <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-id="<?php echo $_smarty_tpl->tpl_vars['your_interests']->value['id'];?>
" style="margin-top:20px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                        <?php }?>
                                        <?php $_smarty_tpl->_assignInScope('key', $_smarty_tpl->tpl_vars['keyCounter']->value);
?>
                                    </div>
                                    <div class="col-md-12 no-padding btn_wrap">
                                        
                                        <button type="submit" name="button" class="save confirm-btn n_save" style="width:100%;">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->

<?php echo '<script'; ?>
 type="text/javascript">
    function addInterest(count) {
      var companent = `<div class="form-group label_`+count+`">
        <div class="col-md-2 no-padding">
          <label>Continent</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils continent" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="continent[`+count+`][]" title="Continent" required>
            <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
"><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Country</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="country[`+count+`][]" title="Country">
            <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
          </select>
        </div>
        <div class="col-md-3 no-padding">
          <label>Product Type</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[`+count+`][]" title="Product_type" required>
            <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Status</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[`+count+`][]" title="Status" required>
            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
              <?php if ($_smarty_tpl->tpl_vars['group']->value->id != 6) {?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
</option>
            <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Standard</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="standart[`+count+`][]" title="Standart">
            <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key1');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key1']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
          </select>
        </div>
        <div class="col-md-1 no-padding">
          <button type="button" class="btn btn-danger btn-bix pull-right remove-item" style="margin-top:20px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
        </div>
        <div class="clearfix"></div>
      </div>`;
      return companent;
    }
    $(document).ready(function() {
        var count = <?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
;
     
         $(document).on('click', '.add-new-interest', function() {
            count = count + 1;
            var component = addInterest(count);
            $('.interest-inner').append(component);
            $('.selectpicker').selectpicker();
           
       
        });
        
        

        
        $(document).on('click','.userphotos-change', function(){
          $('input.userphotos').click();
        })
        
        $(document).on('submit','.userphotos_form',function(e){
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $.isLoading({text:""});
          $.ajax({
              type:'POST',
              url:site_url+'profile/userphotos/',
              data: formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                  console.log(data);
                  if (data == 'false') {
                    toastr.warning('This profile image not upload. Please refresh page or <a target="_blank" href="'+site_url+'contact">Contact us</a>');
                  }
                  else{
                    toastr.success('Profile update successful !');
                    if($('.round-image img').attr('src', site_url+'uploads/catalog/users/'+data)){
                      $.isLoading("hide");
                    }
                  }
              }
          });
          e.preventDefault();
          return false;
        });
        $(document).on('submit','.comfirmAccount', function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type:'POST',
                url:site_url+'profile/comfirmAccount/',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                  var obj = JSON.parse(data);
                  if(obj.type == 'success')
                  {
                    $('#comfirmAccount').modal('hide');
                    $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
                    toastr.success(obj.message);
                  }
                  else
                  {
                    toastr.error(obj.message);
                  }
                }
            });
            e.preventDefault();
            return false;
        });
        
        $(document).on('change','.userphotos', function(e){
            e.preventDefault();
            $('.userphotos_form').submit();
            e.preventDefault();
            return false;
        });
        $(document).on('click','.choose-certifcate', function(){
          $('.certifcate-input').click();
        });
        $(document).on('change','.certifcate-input', function(){
          var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
          $('.choose-certifcate').removeClass('btn-danger').addClass('btn-success').text('Selected - '+filename);
        });
    });
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
