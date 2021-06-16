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
                       <div class="col-md-4 col-lg-3">
                           <div class="sidebar"  id="my-affix">
                               <div class="single-sidebar">
                                   <ul>
                                       <li><a href="{site_url_multi('consultation/about')}">About Us</a></li>
                                       <li><a href="{site_url_multi('consultation/services')}">Services</a></li>
                                       <li  class="active"><a href="{site_url_multi('consultation/legislation')}">Legislation</a></li>
                                       <li><a href="{site_url_multi('consultation/order')}">Order form</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-8 col-lg-9">
                           <div class="request-page-form">
                             <h4 class="sidebar-title">Legislation</h4>
                             <div class="col-md-12 no-padding country-flag" style="margin-top:0px;">
                                    {foreach from=$countrys item=country}{if isset($countries_count[$country->id])}
                                    <div class="col-md-4 no-padding">
                                       <a href="{site_url_multi('consultation/legislation/')}{$country->id}/1">
                                         <div class="country-item" style="background-image:url('{base_url("templates/default/assets/img/country/")}{$country->code}.png');">
                                             <span> {$country->name} {if isset($countries_count[$country->id])}({$countries_count[$country->id]['COUNT(id)']}){/if}</span>
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
             </section>
          </div>
        </div>
    </div>
  </div>
</div>
{/block}
