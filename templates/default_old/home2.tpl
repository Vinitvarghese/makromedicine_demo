{extends file=$layout}
{block name=content}
 <link rel="stylesheet" href="{base_url('templates/default/assets/css/home-test.css?v=')}{uniqid()}">
 <link rel="stylesheet" href="{base_url('templates/default/assets/css/jquery-ui.min.css')}">
<script type="text/javascript" src="{base_url('templates/default/assets/js/jquery-ui.min.js')}"></script>
<script type="text/javascript">
  $( function() {
    $( "#tabs" ).tabs({
      active:false,
      collapsible:true
    }).addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );


      $( "#tabs2" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs2 li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  } );
</script>
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
                <div class="col-md-12 col-xs-12 hidden-xs">
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
                        <button type="button" class="adv-search-button btn btn-default"><i class="fa fa-caret-down"></i>Advanced search</button>
                       <input type="text" name="title" value="{$keyword}" class="search-input" placeholder="Search products (brand name, ATC code, CAS no.)...">
                              <button type="submit" class="search-button" name="button">Search</button>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="product">
                             
                              <div class="adv-search-bar">
                                 <input type="hidden" name="search_type" value="3">
                        <div id="tabs">
                         
                          <ul>
                            <li><a href="#tabs-1">Product type</a></li>
                            <li><a href="#tabs-2">Company name</a></li>
                            <li><a href="#tabs-3">Continent</a></li>
                            <li><a href="#tabs-4">Content type</a></li>
                            <li><a href="#tabs-5">Status</a></li>
                            <li><a href="#tabs-6">Standart</a></li>
                            <li><a href="#tabs-7">ATC Classification</a></li>
                          </ul>
                          <div id="tabs-1">
                             <div class="col-md-12 fl-cont">
                              <div class="form-group all-ch">
                             <button type="button" class="sel-all btn btn-default">Select All</button>
                             <button type="button" class="desel-all btn btn-default">Deselect All</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="filter-s search" name="filter-s" placeholder="Filter">
                            </div>  
                            </div>
                            <div class="list col-md-12" id="checkboxFilter">
                               {if $product_types}{foreach from=$product_types item=product_type}
                              <span>
                                <input type="checkbox" name="pr_type[]" value="{$product_type->id}" id="pr_type_{$product_type->id}">
                                <label for="pr_type_{$product_type->id}" class="name">{$product_type->name}</label>
                                <br>
                              </span> 
                              {/foreach}{/if}
                            </div>  
                           
                          </div>
                          <div id="tabs-2">
                             <div class="col-md-12 fl-cont">
                              <div class="form-group all-ch">
                             <button type="button" class="sel-all btn btn-default">Select All</button>
                             <button type="button" class="desel-all btn btn-default">Deselect All</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="filter-s search" name="filter-s" placeholder="Filter">
                            </div>  
                            </div>
                           <div class="list col-md-12" id="checkboxFilter">
                             {if $companies}{foreach from=$companies item=company}
                             <span>
                              <input type="checkbox" name="user_id[]" value="{$company->id}" id="userid_{$company->id}">
                              <label for="userid_{$company->id}" class="name">{$company->company_name}</label> <br>
                              </span>
                              {/foreach}{/if}
                              </div>  
                            
                          </div>
                          <div id="tabs-3">
                             <div class="col-md-12 fl-cont">
                              <div class="form-group all-ch">
                             <button type="button" class="sel-all btn btn-default">Select All</button>
                             <button type="button" class="desel-all btn btn-default">Deselect All</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="filter-s search" name="filter-s" placeholder="Filter">
                            </div>  
                            </div>
                             <div class="list col-md-12" id="checkboxFilter">
                            {if $continents}{foreach from=$continents item=continent}
                            <span>
                              <input value="{$continent->code}" type="checkbox" name="continent[]" id="continent_{$continent->code}">
                              <label for="continent_{$continent->code}" class="name">{$continent->name}</label> <br>
                              </span>
                              {/foreach}{/if}
                              </div>  
                            
                          </div>
                          <div id="tabs-4">
                            
                             <div class="list col-md-12" id="checkboxFilter">
                              <input name="content_types[]" type="checkbox" value="0" id="content_type_0" >
                              <label for="content_type_0">Monocomponent</label> <br>
                              <input name="content_types[]" type="checkbox" value="1" id="content_type_1" >
                              <label for="content_type_1">Policomponent</label>
                              </div>  
                          
                          </div>
                          <div id="tabs-5">
                             <div class="col-md-12 fl-cont">
                              <div class="form-group all-ch">
                             <button type="button" class="sel-all btn btn-default">Select All</button>
                             <button type="button" class="desel-all btn btn-default">Deselect All</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="search filter-s" name="filter-s" placeholder="Filter">
                            </div>  
                            </div>
                             <div class="list col-md-12" id="checkboxFilter">
                             {if $groups}{foreach $groups as $key => $value}{if $value->id neq 6}
                             <span>
                             <input value="{$value->id}" type="checkbox" name="group_id[]" id="group_{$value->id}">
                              <label for="group_{$value->id}" class="name">{$value->name}</label> <br>
                              </span>
                              {/if}{/foreach}{/if}
                              </div> 
                          </div>
                          <div id="tabs-6">
                             <div class="col-md-12 fl-cont">
                              <div class="form-group all-ch">
                             <button type="button" class="sel-all btn btn-default">Select All</button>
                             <button type="button" class="desel-all btn btn-default">Deselect All</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="search filter-s" name="filter-s" placeholder="Filter">
                            </div>  
                            </div>
                             <div class="list col-md-12" id="checkboxFilter">
                             {if $standarts}{foreach $standarts as $key => $value}
                             <span>
                              <input id="standart_{$value->id}" value="{$value->id}" type="checkbox" name="standart[]">
                              <label for="standart_{$value->id}" class="name">{$value->name}</label> <br>
                              </span>
                              {/foreach}{/if}
                              </div>  
                           
                          </div>
                          <div id="tabs-7">
                             <div class="col-md-12 fl-cont">
                              <div class="form-group all-ch">
                             <button type="button" class="sel-all btn btn-default">Select All</button>
                             <button type="button" class="desel-all btn btn-default">Deselect All</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="search filter-s" name="filter-s" placeholder="Filter">
                            </div>  
                            </div>
                             <div class="col-md-12" id="checkboxFilter">
                            {if $parent_atc}
                              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                 <ul class="list list-group" style="display: none;"> 
                                     {foreach $parent_atc as $key => $parent}
                                        {foreach $list_atc[$parent->id] as $child}

                                        <li class="list-group-item">
                                         <input id="1atc_{$child->atc_code}" type="checkbox" value="{$child->atc_code}" name="atc_classifiction[]">
                                         <label for="1atc_{$child->atc_code}" class="name">{$child->atc_code} - {$child->meaning}</label> <br>
                                        </li>

                                        {/foreach}
                                        {/foreach}
                                     
                                  </ul>


                               {foreach $parent_atc as $key => $parent}
                                <div class="panel panel-default">
                                  <div class="panel-heading" role="tab" id="heading{$parent->id}" style="padding-top: 10px">
                                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{$parent->id}" aria-expanded="true" aria-controls="collapse{$parent->id}">
                                       {$parent->atc_code} - {$parent->meaning}
                                      </a>
                                  
                                  </div>
                                  <div id="collapse{$parent->id}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{$parent->id}">
                                   <ul class="list-group"> 
                                      {if $list_atc[$parent->id]}
                                        {foreach $list_atc[$parent->id] as $child}

                                        <li class="list-group-item">
                                         <input id="atc_{$child->atc_code}" type="checkbox" value="{$child->atc_code}" name="atc_classifiction[]">
                                         <label for="atc_{$child->atc_code}" >{$child->atc_code} - {$child->meaning}</label> <br>
                                        </li>

                                        {/foreach}
                                       {/if}
                                  </ul>
                                  </div>
                                </div>
                                 {/foreach}
                              </div>
                            {/if}
                            </div>  
                          </div>
                        </div>
                      </div>

                          </div>
                          <div role="tabpanel" class="tab-pane" id="event">

                       <div class="adv-search-bar">
                        <div id="tabs2">
                         
                          <ul>
                            <li><a href="#tabs-8">Event type</a></li>
                            <li><a href="#tabs-9">Continent</a></li>
                            <li><a href="#tabs-10">Country</a></li>
                            <li><a href="#tabs-11">Date</a></li>
                            
                          </ul>
                          <div id="tabs-8">
                            {if $event_types}{foreach from=$event_types item=event_type}
                              <input id="event_{$event_type->id}" type="checkbox" value="{$event_type->id}" name="event_type">
                              <label for="event_{$event_type->id}">{$event_type->name}</label> <br>
                              {/foreach}{/if}
                          </div>
                          <div id="tabs-9">
                              {if $continents}{foreach from=$continents item=continent}
                              <input id="ev_continent_{$continent->code}" type="checkbox" value="{$continent->code}" name="event_continent[]" >
                              <label for="ev_continent_{$continent->code}">{$continent->name}</label> <br>
                              {/foreach}{/if}
                          </div>
                          <div id="tabs-10">
                           
                          </div>
                          <div id="tabs-11">
                            <div class="input-daterange input-group" id="datepicker">
                             <label>Select Date From...</label>
                             <input type="text" class="input-sm mylos form-control" name="start" value="{$event_start}"/>
                          </div>
                          <div class="input-daterange input-group" id="datepicker">
                             <label>Select Date To...</label>
                             <input type="text" class="input-sm mylos form-control" name="end" value="{$event_end}"/>
                          </div>
                          <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="tender">...</div>
                          <div role="tabpanel" class="tab-pane" id="eq">...</div>
                        </div>
                      </div>
                 </form>
               </div>

             </div>
          </div>
       </div>
    </div>

    <script>
      $('.adv-search-button').on('click',function(e){
        e.preventDefault();
        if(! $('.nav-search .tab-content').hasClass('opened-adv')){
            $('.nav-search .tab-content').animate({
              height: '263px'},
              200, function() {
             $('.nav-search .tab-content').addClass('opened-adv');
            });
          }
          else{
             $('.nav-search .tab-content').animate({
              height: '0'},
              200, function() {
              $('.nav-search .tab-content').removeClass('opened-adv');
            });
          }
      })

      $('.nav-search a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var tab = e.target;
      if($(tab).attr('href') == '#product'){
        $('.main-search-bar .search-input').attr('placeholder','Search products (brand name, ATC code, CAS no.)...');
        $('[name="search_type"]').val(3);
      }
      else if($(tab).attr('href') == '#event'){
        $('.main-search-bar .search-input').attr('placeholder','Search events');
        $('[name="search_type"]').val(1);
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
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/2" {else} href="#" data-toggle="modal" data-target="#myModal" {/if}>
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
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/3" {else} href="#" data-toggle="modal" data-target="#myModal" {/if}>
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
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/4" {else} href="#" data-toggle="modal" data-target="#myModal" {/if}>
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
                    <a {if $is_loggedin} href="{site_url_multi('search/groups/')}{$country_code}/5" {else} href="#" data-toggle="modal" data-target="#myModal" {/if}>
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
