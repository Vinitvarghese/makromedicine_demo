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
                           <div class="request-page-form">
                             <h4 class="sidebar-title">Services</h4>
                             {if $get_services}
                             <div class="approch-area section">
                               <div class="row">
                                  {foreach $get_services as $value}
                                  <div class="col-lg-4 col-md-6 col-sm-12">
                                     <div class="single-approch text-center">
                                        <div class="approch-inner">
                                           <div class="approcho-info">
                                              <div class="approch-icon">
                                                 <i class="flaticon-group text-gradient2"></i>
                                              </div>
                                              <div class="approch-title">
                                                 <h3>{short_title($value->title, '...', 8)}</h3>
                                              </div>
                                              <div class="approch-content">
                                                 <p>{mb_substr(strip_tags($value->description),0,200, 'UTF-8')} ...</p>
                                              </div>
                                              <div class="approch-btn">
                                                 <a href="{site_url_multi('consultation/view/')}{$value->slug}"><i class="fa fa-angle-double-right"></i></a>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  {/foreach}
                               </div>
                               <div class="row">
                                   <div class="col-md-12">
                                       {$pagination}
                                   </div>
                               </div>
                             </div>
                             {/if}
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
