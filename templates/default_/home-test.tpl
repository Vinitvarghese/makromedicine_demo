{extends file=$layout}
{block name=content}
 <link rel="stylesheet" href="{base_url('templates/default/assets/css/jquery-ui.min.css?v=2')}">
<script type="text/javascript" src="{base_url('templates/default/assets/js/jquery-ui.min.js?v=2')}"></script> 



<link rel="stylesheet" href="{base_url('templates/default/assets/css/home-test.css?v=')}{uniqid()}">

    <div id="forgetPassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
       <div class="modal-dialog">
           <div class="modal-content">
               <form class="forgetPassword" action="{base_url()}/authentication/forget/" method="post">
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
    <div class="slider col-md-12 no-padding margin-top-100" {if $banners} style="background-image: url('{base_url('uploads/')}{$banners->images}');" {/if}>
       <div class="opacity-background">
          <div class="container">
             <div class="row">
                <div class="col-md-12 col-xs-12">
                   {if $banners}

                   <h2 class="slider-title" style="text-align:center; width: 100%;" >{$banners->name}</h2>
                   <h3 class="slider-content" style="text-align:center; width: 100%;"  > {$banners->description}</h3>
                   <h2 class="slider-end" style="text-align:center; width: 100%;"  >  {$banners->button_name}</h2>
                   {/if}

                </div>
               <div class="col-md-8 col-md-offset-2 col-xs-12 main-search-bar">
                 <form action="{base_url('search/')}" method="GET">
                     <div class="nav-search">

                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Product</a></li>
                          <li role="presentation"><a href="#event" aria-controls="event" role="tab" data-toggle="tab">Event</a></li>
                        <!--   <li role="presentation"><a href="javascript:;" disabled>Tender (Coming Soon)</a></li>
                        <li role="presentation"><a href="javascript:;" disabled>Equipment (Coming Soon)</a></li> -->
                        </ul>
                      
                        <div class="adv-bottom-part">
                          <input type="text" name="title" value="{$keyword}" class="search-input" placeholder="Search products (brand name, ATC code, CAS no.)..." id="autoCompSr" autocomplete="off">
                          <button type="submit" class="search-button" name="button"><span class="hidden-xs">Search</span></button>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="product">
                           <input type="hidden" name="search_type" value="3">
                          
                           <select name="pr_type[]" class="selectpicker show-menu-arrow main_product_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Product Type">
                              {if $product_types}{foreach from=$product_types item=product_type}
                              <option value="{$product_type->id}" {if in_array($product_type->id, $pr_type)} selected="selected" {/if}>{$product_type->name}</option>
                              {/foreach}{/if}
                           </select>
                           <select name="user_id[]" class="selectpicker show-menu-arrow main_company_name" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company Name">
                              {if $companies}{foreach from=$companies item=company}
                              <option value="{$company->id}" {if in_array($company->id, $company_id)} selected="selected" {/if}>{$company->company_name}</option>
                              {/foreach}{/if}
                           </select>
                           <select name="continent[]" class="selectpicker show-menu-arrow main_company_continent" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent">
                              {if $continents}{foreach from=$continents item=continent}
                              <option value="{$continent->code}" {if in_array($continent->code, $search_continent)} selected="selected" {/if}>{$continent->name}</option>
                              {/foreach}{/if}
                           </select>
                           <select name="content_type[]" class="selectpicker show-menu-arrow main_content_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content Type">
                              <option value="0" {if in_array(0, $content_types)} selected="selected" {/if}>Monocomponent</option>
                              <option value="1" {if in_array(1, $content_types)} selected="selected" {/if}>Policomponent</option>
                           </select>
                           <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Status">
                              {if $groups}{foreach $groups as $key => $value}{if $value->id neq 6}
                              <option value="{$value->id}" {if in_array($value->id, $search_status)} selected="selected" {/if}>{$value->name}</option>
                              {/if}{/foreach}{/if}
                           </select>
                           <select name="standart[]" class="selectpicker show-menu-arrow main_standart-type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Standart">
                              {if $standarts}{foreach $standarts as $key => $value}
                              <option value="{$value->id}" {if in_array($value->id, $search_standart)} selected="selected" {/if}>{$value->name}</option>
                              {/foreach}{/if}
                           </select>
                           <select name="atc_classifiction[]" class="selectpicker show-menu-arrow main_atc_classifiction" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="ATC Classification">
                              {if $parent_atc} {foreach $parent_atc as $key => $parent}
                              <optgroup label="{$parent->atc_code} - {$parent->meaning}" data-collapsible-optgroup="true" data-load-collapse-optgroup="true">
                                 {if $list_atc[$parent->id]}{foreach $list_atc[$parent->id] as $child}
                                 <option value="{$child->atc_code}" {if in_array($child->atc_code, $atc_classifiction)} selected="selected" {/if}>{$child->atc_code} - {$child->meaning}</option>
                                 {/foreach}{/if}
                              </optgroup>
                              {/foreach}{/if}
                           </select>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="event">
                            <select name="event_type" class="selectpicker show-menu-arrow main_event_type" data-selected-text-format="count > 0" title="Event Type">
                              <option value="0">Event Type</option>
                              {if $event_types}{foreach from=$event_types item=event_type}
                              <option value="{$event_type->id}" {if $event_type_con eq $event_type->id} selected="selected" {/if}>{$event_type->name}</option>
                              {/foreach}{/if}
                           </select>
                           <select name="event_continent[]" class="selectpicker show-menu-arrow main_event_continent" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent">
                              {if $continents}{foreach from=$continents item=continent}
                              <option value="{$continent->code}" {if in_array($continent->code, $event_continent)} selected="selected" {/if}>{$continent->name}</option>
                              {/foreach}{/if}
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
                                          <input type="text" class="form-control" name="start" value="{$event_start}" autocomplete="off" >
                                          <div class="input-group-addon" >
                                            <img src="{base_url('templates/default/assets/img/sys/calendar.png')}" alt="">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="input-daterange input-group" >
                                      <label>Select Date To...</label>
                                      <div class="input-group date" id="ev_end" >
                                          <input type="text" class="form-control" name="end" value="{$event_end}" autocomplete="off">
                                          <div class="input-group-addon">
                                              <img src="{base_url('templates/default/assets/img/sys/calendar.png')}" alt="">
                                          </div>
                                      </div>
                                    </div>
                                    <a href="#" class="clear-dates"><i class="fa fa-times fa-fw" style="color: red"></i>Clear Date</a>
                                    <div class="clearfix"></div>
                                 </ul>
                              </div>
                           </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="tender">...</div>
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

    <script>
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
        $('#autoCompSr').autocomplete("destroy");
        $('#autoCompSr').removeData('autocomplete');
        $('.main-search-bar .search-input').attr('placeholder','Search events');
        $('[name="search_type"]').val(1);
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
        
    </script>
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
       <div class="what_is_of_interest">{translate('whats_interest')}</div>
       <div class="container">
          <div class="row">
             <div class="col-md-12 main-flex">

                <div class="service-box col-md-3">
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/2" {else}href="#" id="triggerSignup"{/if}>
                    <div class="service-box-img">
                        <img src="{base_url('templates/default/assets/img/sys/company1.svg')}" alt="" class="img-responsive">
                    </div>
                    <div class="service-box-title">
                        <h2>{translate('manufacturer')}</h2>
                    </div>
                    <div class="service-box-counter">
                        <h1>{if isset($searching.2) && count($searching.2) > 0}{count($searching.2)}{else}0{/if}</h1>
                    </div>
                   </a>
                </div>
                <div class="service-box col-md-3">
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/3" {else}href="#" id="triggerSignup"{/if}>
                        <div class="service-box-img">
                            <img src="{base_url('templates/default/assets/img/sys/distribution.svg')}" alt="" class="img-responsive">
                        </div>
                        <div class="service-box-title">
                            <h2>{translate('distribitor')}</h2>
                        </div>
                        <div class="service-box-counter">
                            <h1>{if isset($searching.3) && count($searching.3) > 0}{count($searching.3)}{else}0{/if}</h1>
                        </div>
                    </a>
                </div>
                <div class="service-box col-md-3">
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/4" {else}href="#" id="triggerSignup"{/if}>
                      <div class="service-box-img">
                          <img src="{base_url('templates/default/assets/img/sys/courier.svg')}" alt="" class="img-responsive">
                      </div>
                      <div class="service-box-title">
                          <h2>{translate('agent')}</h2>
                      </div>
                      <div class="service-box-counter">
                          <h1>{if isset($searching.4) && count($searching.4) > 0}{count($searching.4)}{else}0{/if}</h1>
                      </div>
                    </a>
                </div>
                <div class="service-box col-md-3">
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/5" {else}href="#" id="triggerSignup"{/if}>
                      <div class="service-box-img">
                          <img src="{base_url('templates/default/assets/img/sys/commerce.svg')}" alt="" class="img-responsive">
                      </div>
                      <div class="service-box-title">
                          <h2>{translate('manager')}</h2>
                      </div>
                      <div class="service-box-counter">
                          <h1>{if isset($searching.5) && count($searching.5) > 0}{count($searching.5)}{else}0{/if}</h1>
                      </div>
                    </a>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="clearfix"></div>
    {if $countrys}
    <div class="wrap col-md-12">
       <div class="container">
          <div class="row">
             <div class="clearfix"></div>
             <div class="col-md-12" id="country">
                <div class="col-md-12 no-padding">
                   <h1 class="main-title">{translate('drugs')}</h1>
                  
                </div>
                <div class="col-md-12 no-padding country-flag">

                   {foreach from=$countrys item=country}{if isset($countries_count[$country->id])}

                   <div class="col-md-4 no-padding">
                      <a href="{base_url('search?search_type=3&country=')}{$country->id}">
                      <div data-id="{$country->id}" class="country-item" style="background-image:url('{base_url("templates/default/assets/img/country2/")}{strtolower($country->code)}.svg');">
                            <span> {$country->name} </span>
                            {if isset($countries_count[$country->id])}<span class="badge-count">{$countries_count[$country->id]['COUNT(id)']}</span>{/if}
                        </div>
                      </a>
                   </div>

                  {/if}{/foreach}

                <div class="clearfix"></div>
             </div>
          </div>
       </div>
    </div>
    </div>
    {/if}
    <script type="text/javascript">
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

      if($(window).width()>767){
      
            $(document).on("click","#triggerSignup", function(e){
              e.preventDefault();
             
              $('#signUpBox').addClass('in-middle').show();
              $('.s-overlay').show();
            })
      
            $('.in-middle .fa-times').on('click',function(){
                $('.s-overlay').hide();
            })
      
      }
      else{
           $(document).on("click","#triggerSignup", function(e){
  e.preventDefault();
 $('html, body').stop().animate({
                scrollTop: 0
  }, 500, function() {$('#signUpBox').show();});
})

      }


  
    </script>
    {if $send_email eq true}
    <script type="text/javascript">
      toastr.success('New password has been sended to your mail address');
    </script>
    {/if}
     {if $confirm_account eq true}
    <script type="text/javascript">
      toastr.error('Server error. Your account not confirmed.');
    </script>
    {/if}

    <div id="termModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{$terms->title}</h4>
      </div>
      <div class="modal-body" style="max-height: 70vh;overflow: auto;">
        <p style="font-size:16px;">{$terms->description|unescape: "html" nofilter}</p>
      </div>
    <div class="modal-footer">
       <button type="button" class="btn btn-success m-0" id="iagree" style="    padding: 7px 20px;" >I Agree</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

   

{/block}
