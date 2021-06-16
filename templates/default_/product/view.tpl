{extends file=$layout}
{block name=content}
<div class="clearfix"></div>
<style>
    .not-active,.not-active td{
        background-color: #FFCDD2!important;
    }
    #example_wrapper{
    max-width: 1326px;
    margin: 0 auto;
    }
    .dataTables_paginate{
    float:right!important;
    }
    .tables-data .table-search-not{
    width:100%;
    }
</style>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
                <div class="col-md-12 no-padding">
                    <div class="col-md-3 no-padding profile-left"  style="padding-bottom:0px;">
                        <div class="left-sidebar" style="min-height:308px;">
                          {if count($product_images) > 0}

                          {else}
                            <img src="{base_url('templates/default/assets/img/download.png')}" style="width: 100%;" alt="">
                          {/if}
                        </div>
                    </div>
                    <div class="col-md-9 profile-right no-padding-right" style="padding-bottom:0px;">
                      <div class="right-content">
                          <div class="col-md-12">
                              <h1 class="main-info-title">Product information</h1>
                          </div>
                          <div class="col-md-12 no-padding right-content-inner">
                            <div class="col-md-6">
                              <div class="profile-information bug-fixed" style="padding-left: 21px;">
                                <div class="form-group">
                                    <p>Product Name</p>
                                    <span>{$product->title}</span>
                                </div>
                                <div class="form-group">
                                    <p>Product Type</p>
                                    <span>{get_product_type_name($product->pr_type)}</span>
                                </div>
                                <div class="form-group">
                                    <p>Content Type</p>
                                    {if $product->poly eq 0}
                                    <span>Monocomponent</span>
                                    {else}
                                    <span>Policomponent</span>
                                    {/if}
                                </div>
                                <div class="form-group">
                                    <p>Country</p>
                                     <span><a href="{site_url('search?search_type=3&country=')}{$product->country}" target="_blank">{get_country_name($product->country)}</a></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="profile-information bug-fixed" style="padding-left: 21px;">
                                <div class="form-group">
                                    {$atc_code = json_decode($product->atc_code)}
                                    {$herbal = json_decode($product->herbal)}
                                    {$animals = json_decode($product->animal)}
                                    {$casNumbers = json_decode($product->cas)}
                                    <p>Content</p>
                                    <span>
                                    {if count($atc_code) > 0}
                                        {foreach $atc_code as $atc}
                                            {get_atc_code_no($atc->id)} {$atc->mdoza} {get_unit_name($atc->vdoza)}
                                        {/foreach}
                                    {/if}
                                    {if count($herbal) > 0}
                                        {foreach $herbal as $herb}
                                            {get_herbal_name($herb->id)} {$herb->mdoza} {get_unit_name($herb->vdoza)}
                                        {/foreach}
                                    {/if}
                                    {if count($animals) > 0}
                                        {foreach $animals as $animal}
                                            {get_animal_name($animal->id)} {$animal->mdoza} {get_unit_name($animal->vdoza)}
                                        {/foreach}
                                    {/if}
                                    {if count($casNumbers) > 0}
                                        {foreach $casNumbers as $casss}
                                            {get_cas_name($casss->id)} {$casss->mdoza} {get_unit_name($casss->vdoza)}
                                        {/foreach}
                                    {/if}
                                  </span>
                                </div>
                                <div class="form-group">
                                    <p>Dossage form</p>
                                    <span>
                                      {$var = json_decode($product->packing_type)}
                                      {if count($var) > 0}
                                          {$f = json_decode(json_encode($var[0]))}
                                          {get_packing_type_name($f->id)} {if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)}
                                      {/if}
                                    </span>
                                </div>
                                <div class="form-group">
                                    <p>Medical Classification</p>
                                    <span>
                                      <span>
                                        {if !empty($product->medical_cl)} {foreach get_selected_medical($product->medical_cl) as $key=>$value} {$value->name}, {/foreach} {else} {/if}
                                      </span>
                                    </span>
                                </div>
                              </div>
                            </div>
                            {if !empty($product->description)}
                            <div class="col-md-12">
                              <div class="profile-information bug-fixed" style="padding-left: 21px;">
                                <div class="form-group">
                                    <p>Description</p>
                                    <span>{$product->description}</span>
                                </div>
                              </div>
                            </div>
                            {/if}
                            <div class="clearfix"> </div>
                          </div>
                          <div class="clearfix"> </div>
                      </div>
                    </div>
                    <div class="col-md-12 no-padding">
                      <div class="right-content">
                          <div class="col-md-12">
                              <h1 class="main-info-title">Company information</h1>
                              
                              {$company = get_company_name($product->user_id)}
                          </div>
                          <div class="col-md-12 no-padding right-content-inner">
                            <div class="profile-information bug-fixed" style="padding-left: 21px;">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <div class="bio-image">
                                    <img src="{$company_images}" alt="{$company->company_name}" style="width: 70%;"/>
                                  </div>
                                  <div class="form-group">
                                      <center>
                                        <div class="btn-group">
                                          <a href="{base_url('company/')}{$company->slug}" target="_blank" class="btn btn-info" style="margin-top:25px;font-size:13px;"> <i class="fa fa-info-circle"></i> Get Company</a>
                                          <a href="{base_url('company/product/')}{$company->slug}" target="_blank" class="btn btn-warning" style="margin-top:25px;font-size:13px;"> <i class="fa fa-list"></i> Get Company Product</a>
                                        </div>
                                      </center>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                    <p>Company name</p>
                                    <span>{$company->company_name}</span>
                                </div>
                                {if $is_loggedin}
                                <div class="form-group">
                                    <p>Company email</p>
                                    <span>{$company->email}</span>
                                </div>
                                {/if}
                                <div class="form-group">
                                    <p>Company info</p>
                                    <p>{$company->company_info}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"> </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
{/block}
