{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
<div class="clearfix"></div>
<div class="col-md-12">
    <div class="container">
      {*{if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
        {if empty($UserData->company_name)}
        <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
           <div class="modal-dialog">
               <div class="modal-content">
                 <form class="addCompanyInformation" action="{base_url()}profile/companyInformation" method="post">
                   <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title data-title">Please enter company information</h4>
                   </div>
                   <div class="modal-body data-body" style="min-height: 500px;max-height:500px;overflow-y:auto;padding-top:35px;">
                     <div class="round-image userphotos-change" data-toggle="tooltip" data-placement="top" title="Image Upload">
                         <img src="{$user_images}" alt="{$UserData->company_name}">
                     </div>
                     <div class="form-group">
                         <label for="company-name"> Company Name </label>
                         <input type="text" name="company_name" id="company-name" class="form-control mylos readonly" placeholder="Company Name" value="{$UserData->company_name}">
                     </div>
                     <div class="form-group ">
                         <label for="company-date"> Establishment date </label>
                         <input type="date" name="establishment_date" id="company-date" class="form-control mylos" placeholder="Establishment date" value="{$UserData->establishment_date}">
                     </div>
                     <div class="form-group ">
                         <label for="company-info">Company Info</label>
                         <textarea type="text" name="company_info" id="company-info" cols="5" rows="12" class="form-control mylos">{$UserData->company_info}</textarea>
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
        <script type="text/javascript">
          $("#companyModal").modal();
        </script>
        {/if}
      {/if}*}

      {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
      <div id="comfirmAccount" class="modal fade" role="dialog" style="z-index:999999999999999;">
         <div class="modal-dialog">
             <div class="modal-content">
               <form class="comfirmAccount" action="{base_url()}profile/comfirmAccount" method="post">
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
      {/if}
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
             {if $UserData->status neq 1 && ($user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4)}
               <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                    Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a certificate.</a> After the confirmation of certificate your account will be approved and your products will appear on the top rank of the search list.
                </div>
              {/if}
            </div>
        </div>
    </div>
</div>

    <div class="n_content_area full_width">
        <div class="container-fluid">
            <div class="row">
                {include file='../profile/sidebar.tpl'}
                <div class="n_right_section start_with_text decrease_padding interest-page news_page">
                    <div class="with_buttons full_width">
                        <h2>INTERESTS</h2>
                    </div>
                    <div class="full_width sel_item_adj">
                        <div class="row">
                            <form class="userSettings" action="{base_url('profile/')}interests" enctype="multipart/form-data" method="post">
                                <div class="right-content-inner">
                                    <div class="col-md-12 no-padding interest-inner">
                                        {$key=0}
                                        {if $get_your_interests}
                                            {foreach $get_your_interests as $key => $your_interests}
                                                <div class="form-group label_{$key}">
                                                    <div class="col-md-2 no-padding">
                                                        <label>Continent</label>
                                                        {$continent_array = explode(',', $your_interests['continent'])}
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils continent" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="continent[{$key}][]" title="Continent" required>
                                                            {if $continents}{foreach from=$continents item=continent}
                                                                <option {if in_array($continent->code, $continent_array)} selected="selected" {/if} value="{$continent->code}">{$continent->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Country</label>
                                                        {$country_array = explode(',', $your_interests['country'])}
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="country[{$key}][]" title="Country">
                                                            {if $countrys}{foreach from=$countrys item=country}
                                                                <option {if in_array($country->id, $country_array)} selected="selected" {/if} value="{$country->id}">{$country->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <label>Product Type</label>
                                                        {$product_type_array = explode(',', $your_interests['product_type'])}
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[{$key}][]" title="Product Type">
                                                            {if $product_types}{foreach from=$product_types item=product_type}
                                                                <option {if in_array($product_type->id, $product_type_array)} selected="selected" {/if} value="{$product_type->id}">{$product_type->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Status</label>
                                                        {$status_array = explode(',', $your_interests['status'])}
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[{$key}][]" title="Status">
                                                            {if $groups}{foreach from=$groups item=group}
                                                                    <option {if in_array($group->id, $status_array)} selected="selected" {/if} value="{$group->id}">{$group->name}</option>
                                                                
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Standart</label>
                                                        {$standart_array = explode(',', $your_interests['standart'])}
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="standart[{$key}][]" title="Standard">
                                                            {if $standarts}{foreach from=$standarts item=standart}
                                                                <option {if in_array($standart->id, $standart_array)} selected="selected" {/if} value="{$standart->id}">{$standart->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 no-padding">
                                                        <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-id="{$your_interests['id']}" style="margin-top:20px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            {/foreach}
                                        {/if}
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

{*                <div class="col-md-12 no-padding" >
                        <div class="col-md-3 no-padding profile-left">

                        </div>
                </div>*}


            </div>
        </div>
{*    </div>
</div>*}
<div class="clearfix"></div> 
<script type="text/javascript">
    function addInterest(count) {
      var companent = `<div class="form-group label_`+count+`">
        <div class="col-md-2 no-padding">
          <label>Continent</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils continent" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="continent[`+count+`][]" title="Continent" required>
            {if $continents}{foreach from=$continents item=continent}
            <option value="{$continent->code}">{$continent->name}</option>
            {/foreach}{/if}
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Country</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="country[`+count+`][]" title="Country" required>
            {if $countrys}{foreach from=$countrys item=country}
            <option value="{$country->id}">{$country->name}</option>
            {/foreach}{/if}
          </select>
        </div>
        <div class="col-md-3 no-padding">
          <label>Product Type</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[`+count+`][]" title="Product_type">
            {if $product_types}{foreach from=$product_types item=product_type}
            <option value="{$product_type->id}">{$product_type->name}</option>
            {/foreach}{/if}
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Status</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[`+count+`][]" title="Status">
            {if $groups}{foreach from=$groups item=group}
            <option value="{$group->id}">{$group->name}</option>
            {/foreach}{/if}
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Standard</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="standart[`+count+`][]" title="Standart">
            {if $standarts}{foreach $standarts as $key1 => $value}
            <option value="{$value->id}">{$value->name}</option>
            {/foreach}{/if}
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
        var count = {$key+1};
     
         $(document).on('click', '.add-new-interest', function() {
            count = count + 1;
            var component = addInterest(count);
            $('.interest-inner').append(component);
            $('.selectpicker').selectpicker();
           
       
        });
        {literal}
        

        {/literal}
        $(document).on('click','.userphotos-change', function(){
          $('input.userphotos').click();
        })
        {literal}
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
        {/literal}
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
</script>
{/block}
