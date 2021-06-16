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
                                       <li class="active"><a href="{site_url_multi('consultation/about')}">About Us</a></li>
                                       <li><a href="{site_url_multi('consultation/services')}">Services</a></li>
                                       <li><a href="{site_url_multi('consultation/legislation')}">Legislation</a></li>
                                       <li><a href="{site_url_multi('consultation/order')}">Order form</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-8 col-lg-9">
                           <div class="request-page-form">
                             <h4 class="sidebar-title">About Us</h4>
                             <div class="col-md-12 no-padding">
                               <img src="{base_url('uploads/')}{$get_about->image}" alt="{$get_about->title}" class="img-responsive"/>
                             </div>
                             <div class="col-md-12 no-padding">
                                <br/>
                                {$get_about->description}
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
