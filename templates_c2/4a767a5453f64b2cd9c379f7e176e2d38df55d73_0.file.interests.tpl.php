<?php
/* Smarty version 3.1.30, created on 2020-09-06 11:37:12
  from "/home/makromed/public_html/demo/templates/default/profile/interests.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f5491a8e8e229_97549175',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a767a5453f64b2cd9c379f7e176e2d38df55d73' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/profile/interests.tpl',
      1 => 1595833996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../profile/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f5491a8e8e229_97549175 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12800506555f5491a8e8c3f8_62062508', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_12800506555f5491a8e8c3f8_62062508 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
<div class="clearfix"></div>
<div class="col-md-12">
    <div class="container">
      <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?>
        <?php if (empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
        <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
           <div class="modal-dialog">
               <div class="modal-content">
                 <form class="addCompanyInformation" action="<?php echo base_url();?>
profile/companyInformation" method="post">
                   <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title data-title">Please enter company information</h4>
                   </div>
                   <div class="modal-body data-body" style="min-height: 500px;max-height:500px;overflow-y:auto;padding-top:35px;">
                     <div class="round-image userphotos-change" data-toggle="tooltip" data-placement="top" title="Image Upload">
                         <img src="<?php echo $_smarty_tpl->tpl_vars['user_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                     </div>
                     <div class="form-group">
                         <label for="company-name"> Company Name </label>
                         <input type="text" name="company_name" id="company-name" class="form-control mylos readonly" placeholder="Company Name" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                     </div>
                     <div class="form-group ">
                         <label for="company-date"> Establishment date </label>
                         <input type="date" name="establishment_date" id="company-date" class="form-control mylos" placeholder="Establishment date" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->establishment_date;?>
">
                     </div>
                     <div class="form-group ">
                         <label for="company-info">Company Info</label>
                         <textarea type="text" name="company_info" id="company-info" cols="5" rows="12" class="form-control mylos"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_info;?>
</textarea>
                     </div>
                   </div>
                   <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </div>
                 </form>
               </div>
           </div>
        </div>
        <?php echo '<script'; ?>
 type="text/javascript">
          $("#companyModal").modal();
        <?php echo '</script'; ?>
>
        <?php }?>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?>
      <div id="comfirmAccount" class="modal fade" role="dialog" style="z-index:999999999999999;">
         <div class="modal-dialog">
             <div class="modal-content">
               <form class="comfirmAccount" action="<?php echo base_url();?>
profile/comfirmAccount" method="post">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title data-title">Comfirm Account</h4>
                 </div>
                 <div class="modal-body data-response">
                   <div class="form-group">
                     <input type="file" name="certifcate" style="display:none;" class="certifcate-input"/>
                     <button type="button" class="btn btn-danger choose-certifcate">Choose Certifcate</button>
                   </div>
                   <div class="clearfix"></div>
                   <div class="form-group">
                       <label for="company-date">Information</label>
                       <textarea type="text" name="info" class="form-control"></textarea>
                   </div>
                 </div>
                 <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
               </form>
             </div>
         </div>
      </div>
      <?php }?>
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
             <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status != 1 && ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4)) {?>
               <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                    Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a certificate.</a> After the confirmation of certificate your account will be approved and your products will appear on the top rank of the search list.
                </div>
              <?php }?>
            </div>
        </div>
    </div>
</div>

    <div class="n_content_area full_width">
        <div class="container-fluid">
            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../profile/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section start_with_text decrease_padding interest-page news_page">
                    <div class="with_buttons full_width">
                        <h2>INTERESTS</h2>
                    </div>
                    <div class="full_width sel_item_adj">
                        <div class="row">
                            <form class="userSettings" action="<?php echo base_url('profile/');?>
interests" enctype="multipart/form-data" method="post">
                                <div class="right-content-inner">
                                    <div class="col-md-12 no-padding interest-inner">
                                        <?php $_smarty_tpl->_assignInScope('key', 0);
?>
                                        <?php if ($_smarty_tpl->tpl_vars['get_your_interests']->value) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['get_your_interests']->value, 'your_interests', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['your_interests']->value) {
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
][]" title="Product Type">
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
][]" title="Status">
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
                                    </div>
                                    <div class="col-md-12 no-padding btn_wrap" style="min-width: 100% !important;">
                                        <button type="button" name="button" class="add-new-interest confirm-btn interest-add-button" style="width:auto; display: block;">+ Add</button>
                                        <button type="submit" name="button" class="save confirm-btn n_save" style="width:100%;">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            </div>
        </div>

<div class="clearfix"></div> 
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
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="country[`+count+`][]" title="Country" required>
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
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[`+count+`][]" title="Product_type">
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
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[`+count+`][]" title="Status">
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
