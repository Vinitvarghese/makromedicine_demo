{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12 profile-right no-padding-right">
                    <div class="right-content" style="padding:0px;">
                        <div class="col-md-12 no-padding right-content-inner" style="padding:0px;">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#profile-information" data-toggle="tab">Product Information</a></li>
                                    <li><a href="#contact-information" data-toggle="tab">Product Content</a></li>
                                    <li><a href="#certifcate-and-license" data-toggle="tab">Product Photos</a></li>
                                    <li><a href="#recent-product" data-toggle="tab">Company Information</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile-information">
                                        <div class="profile-information bug-fixed">
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
                                              <span>{get_country_name($product->country)}</span>
                                          </div>
                                          {if !empty($product->description)}
                                          <div class="form-group">
                                              <p>Description</p>
                                              <span>{$product->description}</span>
                                          </div>
                                          {/if}
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="contact-information">
                                        <div class="contact-information bug-fixed">

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="certifcate-and-license">
                                        <div class="certifcate-and-license bug-fixed">
                                          {if count($product_images) > 0}
                                          <div class="col-md-12 no-padding img-full-right-block img_forece">
                                              <div class="inner-img">
                                                  {if $product_images} {foreach from=$product_images item=$product_image}
                                                  <div class="img-upload-group bitrix add lab_{$product_image.image_id}" var-attr="lab_{$product_image.image_id}">
                                                      <div class="reload-form-cover-mini">
                                                          <img src="{base_url('uploads')}/catalog/product/{$product_image.image}" title="" alt="" />
                                                          <button type="button" class="remove-image product" data-id="{$product_image.image_id}"> </button>
                                                      </div>
                                                  </div>
                                                  {/foreach} {/if}
                                              </div>
                                          </div>
                                          {else}
                                          <div class="alert alert-info">
                                            No images found for this product.
                                          </div>
                                          {/if}
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="recent-product">
                                        {$company = get_company_name($product->user_id)}
                                        <div class="recent-product bug-fixed">
                                          <div class="portfolio">
                                          		<div class="col-md-12 no-padding">
                                          			<div class="heading">
                                          				<img src="https://image.ibb.co/cbCMvA/logo.png" />
                                          			</div>
                                          		</div>
                                              <div class="col-md-12 no-padding">
                                                <div class="bio-info">
                                                  <div class="col-md-6">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                        <div class="bio-image">
                                                          <img src="https://image.ibb.co/f5Kehq/bio-image.jpg" alt="image" />
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="bio-content">
                                                      <h1>{$company->company_name}</h1>
                                                      <p>{$company->email}</p>
                                                      <h6>{$company->company_info}</h6>
                                                      <a href="{base_url('company/')}{$company->slug}" target="_blank" class="btn btn-xs btn-info" style="margin-top:25px;"> <i class="fa fa-info"></i> Get Company</a>
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              	</div>
                                              </div>
                                          </div>
                                        </div>
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
{/block}
