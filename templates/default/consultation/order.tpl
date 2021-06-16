{extends file=$layout}
{block name=content}
<div class="wrap margin-top-100 col-md-12" style="background-color: #fff;border-top: 1px solid #eee;">
    <div class="container">
      <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12 no-padding" id="consultation">
          <div class="col-md-12 profile-right no-padding-right">
            <section class="about-us-page section-padding">
             <div class="container">
                 <div class="row">
                     <div class="col-md-3">
                         <div class="sidebar" id="my-affix">
                             <div class="single-sidebar">
                                 <ul>
                                     <li><a href="{site_url_multi('consultation/about')}">About Us</a></li>
                                     <li><a href="{site_url_multi('consultation/services')}">Services</a></li>
                                     <li><a href="{site_url_multi('consultation/legislation')}">Legislation</a></li>
                                     <li  class="active"><a href="{site_url_multi('consultation/order')}">Order form</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-9">
                         <div class="request-page-form">
                             <h4 class="sidebar-title">Order form</h4>
                             <form action="{base_url('consultation/form')}" method="POST" class="consultation_form">
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="single-request-input">
                                             <label for="name">Company name *</label>
                                             <input id="name" type="text" name="company_name" placeholder="Company name">
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="single-request-input">
                                             <label for="Company">Responsible person *</label>
                                             <input id="Company" type="text" name="responsible_person" placeholder="Responsible person">
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="single-request-input">
                                             <label for="Phone">Phone number*</label>
                                             <input id="Phone" type="text" name="phone_number" placeholder="Phone number">
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="single-request-input">
                                             <label for="email">Your email*</label>
                                             <input id="email" type="text" name="email_address" placeholder="Your email">
                                         </div>
                                     </div>
                                     <div class="col-lg-6" style="margin-bottom:25px;">
                                       <div class="single-request-select">
                                          <label for="drug-ingridient">Standart </label>
                                          <select name="standart[]" class="select-dev selectpicker show-menu-arrow" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Standart">
                                              {if $get_standarts}{foreach $get_standarts as $key=>$standart}
                                                  <option value="{$standart->name}">{$standart->name}</option>
                                              {/foreach}{/if}
                                          </select>
                                       </div>
                                     </div>
                                     <div class="col-lg-6" style="margin-bottom:25px;">
                                       <div class="single-request-select">
                                          <label for="drug-ingridient">Country *</label>
                                          <select name="country[]" class="select-dev selectpicker show-menu-arrow" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Country">
                                              {if $countrys}{foreach $countrys as $key=>$country}
                                                  <option value="{$country->name}">{$country->name}</option>
                                              {/foreach}{/if}
                                          </select>
                                       </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="single-request-input mb-0">
                                             <label for="information">Consulting services *</label>
                                             <div class="single-request-select">
                                                {if $get_parent_services}
                                                <select class="consulting-services" name="services" style="width:100%;">
                                                  {foreach $get_parent_services as $key=>$parent}
                                                  <option value="{$parent->name}" disabled> - {$parent->name}</option>
                                                  {if isset($child_services[$parent->id])}
                                                    {foreach $child_services[$parent->id] as $secret=>$child}
                                                      <option value="{$child->title}"> -- {$child->title}</option>
                                                    {/foreach}
                                                  {/if}
                                                  <option value="" disabled></option>
                                                  {/foreach}
                                                </select>
                                                {/if}
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row add-product-forms" style="margin-bottom:25px;">
                                     <div class="col-md-12 no-padding inner-product"></div>
                                     <div class="col-md-12">
                                         <div class="single-request-input mb-0">
                                             <button type="button" class="btn btn-info" id="falsetruenot"><span class="fa fa-plus"></span>  Add Product</button>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-lg-12">
                                       <div class="single-request-message">
                                           <label for="message">General information</label>
                                           <textarea rows="5" id="message" name="description" placeholder="Write your Inoformation here..."></textarea>
                                       </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-md-12">
                                       <div class="submit-button">
                                           <button type="submit" class="hvr-bounce-to-right"><span class="fa fa-check-circle"></span>  SEND REQUEST</button>
                                       </div>
                                   </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function addLabel(count){
        var component =`
          <div class="col-md-12 no-padding column_product_`+count+`" style="margint-top:15px;margin-bottom:15px;padding-top:15px;padding-bottom:15px;box-shadow:1px 3px 6px rgba(0,0,0,.19); border-radius: 4px;">
              <div class="col-lg-6">
                  <div class="single-request-input">
                      <label for="drug-ingridient">Content</label>
                      <input id="drug-ingridient" type="text" name="content[`+count+`]" placeholder="Content">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="single-request-select">
                   <label for="drug-ingridient">Country </label>
                   <select name="product_country[`+count+`][]" class="select-dev selectpicker show-menu-arrow" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Country">
                       {if $countrys}{foreach $countrys as $key=>$country}
                           <option value="{$country->name}" data-name="{$country->code}">{$country->name}</option>
                       {/foreach}{/if}
                   </select>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-4">
                <div class="single-request-select">
                   <label for="drug-ingridient">Product Type </label>
                   <select name="product_type[`+count+`]" class="select-dev selectpicker show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                       {if $product_types}{foreach $product_types as $key=>$type}
                       <option value="{$type->name}">{$type->name}</option>
                       {/foreach}{/if}
                   </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="single-request-select">
                   <label for="drug-ingridient">Product Type </label>
                   <select name="packing_type[`+count+`]" class="select-dev selectpicker show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                       {if $get_packing_type}{foreach $get_packing_type as $key=>$packing_type}
                       <option value="{$packing_type->name}">{$packing_type->name}</option>
                       {/foreach}{/if}
                   </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="single-request-select">
                  <div class="form-group">
                    <label for="drug-ingridient">Dossier Format</label>
                    <div class="col-md-12 no-padding" style="margin-top:15px;">
                        <input type="hidden" name="be[`+count+`]" value="0"/>
                        <input type="checkbox" id="BE_`+count+`" name="be[`+count+`]" value="1">
                        <label for="BE_`+count+`">BE</label>
                        <input type="hidden" name="ctd[`+count+`]" value="0"/>
                        <input type="checkbox" id="CTD_`+count+`" name="ctd[`+count+`]" value="1">
                        <label for="CTD_`+count+`" style="margin-left:15px;">CTD</label>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-1">
                <div class="single-request-select">
                  <div class="form-group" style="padding-top:25px;">
                     <button type="button" class="btn btn-danger column_remove" data-remove="`+count+`"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
          </div>
        `;
        return component;
    }
</script>
<script type="text/javascript">
    var count = 1;
    $(document).on('click','#falsetruenot', function(){
       var component = addLabel(count);
       $('.inner-product').append(component);
       $('.selectpicker').selectpicker();
       count += 1;
    });
    $(document).on('click','.column_remove', function(){
        var data_remove = $(this).attr('data-remove');
        $('.column_product_'+data_remove).remove();
    });
    {literal}
    $(document).on('submit','.consultation_form', function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type:'POST',
            url:site_url+'consultation/form/',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
              var obj = JSON.parse(data);
              if(obj.type == 'success')
              {
                window.location = '?success=true'
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
</script>
{if $success_message neq false}
  <script>
    var cyrpt = '{$success_message}';
    toastr.success(cyrpt);
  </script>
{/if}
{/block}
