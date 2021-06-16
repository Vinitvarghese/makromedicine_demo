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
                           <div class="sidebar" id="my-affix">
                               <div class="single-sidebar">
                                   <ul>
                                       <li><a href="{site_url_multi('consultation/about')}">About Us</a></li>
                                       <li class="active"><a href="{site_url_multi('consultation/services')}">Services</a></li>
                                       <li><a href="{site_url_multi('consultation/legislation')}">Legislation</a></li>
                                       <li><a href="{site_url_multi('consultation/order')}">Order form</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-8 col-lg-9">
                           {if $get_services}
                           <div class="row">
                             <div class="col-md-12">
                               <h4 class="sidebar-title" style="margin-bottom:5px;">Services ({$get_country->name})</h4>
                               <div class="display-faq-section margin-30">
                                  {foreach $get_services as $value}
                                  <div class="collapsible-panels theme-faq-cat-pg col-md-12" id="{$value->id}">
                                     <h5 class="title-faq-cat pull-left">
                                         <span> <i class="fa fa-long-arrow-right"></i> </span> {$value->title}
                                     </h5>
                                  </div>
                                  {/foreach}
                               </div>
                             </div>
                           </div>
                           {/if}
                           {if $get_legislation}
                           <div class="row">
                             <div class="col-md-12">
                               <h4 class="sidebar-title" style="margin-bottom:5px;margin-top:50px;">Legislation ({$get_country->name})</h4>
                               <div class="display-faq-section margin-30">
                                  {foreach $get_legislation as $legislation}
                                  <div class="collapsible-panels theme-faq-cat-pg col-md-12" id="{$legislation->id}">
                                     <h5 class="title-faq-cat pull-left">
                                         <span> <i class="fa fa-file-pdf-o"></i> </span> {$legislation->name}.pdf
                                     </h5>
                                     <button type="button" class="hvr-bounce-to-right minion-btn pull-right" onclick="window.location='{base_url('uploads/')}{urldecode($legislation->file)}'"><span class="fa fa-check-circle"></span>  Download Now</button>
                                  </div>
                                  {/foreach}
                               </div>
                             </div>
                           </div>
                           {/if}
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
