{extends file=$layout}
{block name=content}

    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
    <a href="#" id="openMenu" class="pages-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="row">
                {include file='../company/sidebar.tpl'}
                <div class="n_right_section start_with_text decrease_padding interest-page news_page">
                    <div class="with_buttons full_width">
                        <h2>Your Interests</h2>
                        {if $user.id && $user.id == $UserData->id && $permission_list[3]->add == 1}
                            <a href="#" class="add-new-interest n_green_col">Add Interest</a>
                        {/if}
                    </div>
                    <div class="full_width">
                        <div class="row">
                            <form class="userSettings userSettingsCenter" action="{site_url_multi('pages')}/{$UserData->slug}/interests" enctype="multipart/form-data" method="post">
                                <div class="right-content-inner">
                                    <div class="col-md-12 no-padding interest-inner">
                                        {$key=0}
                                        {$keyCounter=0}
                                        {if $get_your_interests}
                                            {foreach $get_your_interests as $key => $your_interests}
                                                {$keyCounter = $keyCounter+1}
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
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[{$key}][]" title="Product Type" required>
                                                            {if $product_types}{foreach from=$product_types item=product_type}
                                                                <option {if in_array($product_type->id, $product_type_array)} selected="selected" {/if} value="{$product_type->id}">{$product_type->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <label>Status</label>
                                                        {$status_array = explode(',', $your_interests['status'])}
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[{$key}][]" title="Status" required>
                                                            {if $groups}{foreach from=$groups item=group}
                                                                {if $group->id != 6}
                                                                    <option {if in_array($group->id, $status_array)} selected="selected" {/if} value="{$group->id}">{$group->name}</option>
                                                                {/if}
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
                                        {$key = $keyCounter}
                                    </div>
                                    <div class="col-md-12 no-padding btn_wrap">
                                        {if $permission_list[3]->add == 1}
                                            {* <button type="button" name="button" class="add-new-interest confirm-btn interest-add-button" style="width:auto">+ Add</button> *}
                                            <button type="submit" name="button" class="save confirm-btn n_save" style="width:100%;">Save</button>
                                        {/if}

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->

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
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="country[`+count+`][]" title="Country">
            {if $countrys}{foreach from=$countrys item=country}
            <option value="{$country->id}">{$country->name}</option>
            {/foreach}{/if}
          </select>
        </div>
        <div class="col-md-3 no-padding">
          <label>Product Type</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="product_type[`+count+`][]" title="Product Type" required>
            {if $product_types}{foreach from=$product_types item=product_type}
            <option value="{$product_type->id}">{$product_type->name}</option>
            {/foreach}{/if}
          </select>
        </div>
        <div class="col-md-2 no-padding">
          <label>Status</label>
          <select class="form-control mylos selectpicker show-menu-arrow pils"  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 1" name="status[`+count+`][]" title="Status" required>
            {if $groups}{foreach from=$groups item=group}
              {if $group->id != 6}
            <option value="{$group->id}">{$group->name}</option>
            {/if}
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
