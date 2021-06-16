{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="blog">
                    <div class="col-md-12 no-padding">
                        <div class="row">
                          <section style="margin-top:60px;">
                              <div class="container">
                                  <div class="row row1">
                                      <div class="col-md-12">
                                          <h3 class="center capital f1 wow fadeInLeft" data-wow-duration="2s">Something went Wrong!</h3>
                                          <h1 id="error" class="center wow fadeInRight" data-wow-duration="2s">404</h1>
                                          <p class="center wow bounceIn" data-wow-delay="2s">Page not Found!</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div id="cflask-holder" class="wow fadeIn" data-wow-delay="2800ms">
                                              <span class="wow tada " data-wow-delay="3000ms"><i class="fa fa-flask fa-5x flask wow flip" data-wow-delay="3300ms"></i>
                                                  <i id="b1" class="bubble"></i>
                                                  <i id="b2" class="bubble"></i>
                                                  <i id="b3" class="bubble"></i>
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="col-md-6 col-md-offset-3 search-form wow fadeInUp" data-wow-delay="4000ms">
                                              <form action="#" method="get">
                                                  <input type="text" placeholder="Search" class="col-md-9 col-xs-12 input_404"/>
                                                  <input type="submit" value="Search" class="col-md-3 col-xs-12 submit_404"/>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="links-wrapper col-md-6 col-md-offset-3">
                                              <ul class="links col-md-9">
                                                  <li class="wow fadeInRight" data-wow-delay="4400ms"><a href="{base_url()}"><i class="fa fa-home fa-2x"></i></a></li>
                                                  <li class="wow fadeInRight" data-wow-delay="4300ms"><a href="{get_setting('facebook')}"><i class="fa fa-facebook fa-2x"></i></a></li>
                                                  <li class="wow fadeInRight" data-wow-delay="4200ms"><a href="{get_setting('twitter')}"><i class="fa fa-twitter fa-2x"></i></a></li>
                                                  <li class="wow fadeInLeft" data-wow-delay="4200ms"><a href="{get_setting('google')}"><i class="fa fa-google-plus fa-2x"></i></a></li>
                                                  <li class="wow fadeInLeft" data-wow-delay="4300ms"><a href="{get_setting('pinterest')}"><i class="fa fa-pinterest fa-2x"></i></a></li>
                                                  <li class="wow fadeInLeft" data-wow-delay="4400ms"><a href="{get_setting('linkedin')}"><i class="fa fa-linkedin fa-2x"></i></a></li>
                                              </ul>
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
    </div>
{/block}
