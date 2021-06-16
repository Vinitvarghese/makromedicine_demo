{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="contact">
                    <div class="col-md-12 no-padding" style="margin-bottom:25px;">
                        <div class="row">
                            <!-- <div class="col-md-12 col-xs-12 map">
                             <div id="map"></div> 
                            </div> -->
                            <div class="col-md-7 col-xs-12" style="margin-top: 30px;">
                                <div class="col-md-12 no-padding">
                                    <h1 class="contact-title"> {translate('form_title')} </h1>
                                </div>
                                <div class="col-md-12 no-padding contact-us">
                                    {if isset($error_message) and !empty($error_message)}
                        <div class="alert alert-danger">{$error_message}</div>
                        {/if}

                        {if isset($success_message) and !empty($success_message)}
                        {$success_message}
                        {/if}

                                    <form class="" action="" method="post">
                                      <div class="col-md-6 no-padding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="fullname" value="" placeholder="{translate('form_placeholder_fullname')}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" value="" placeholder="{translate('form_placeholder_phone')}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding-right">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" value="" placeholder="{translate('form_placeholder_email')}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" value="" placeholder="{translate('form_placeholder_subject')}">
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-12 no-padding">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" rows="20"></textarea>
                                            </div>
                                              <div class="col-md-12 no-padding" style="margin-bottom: 20px">
                                         <div class="comment-form-recaptcha ">
                                            <div class="g-recaptcha" data-sitekey="6LdXR5wUAAAAAPa-kl_jFsiYJDAelSj7wo-P56q8"></div>
                                        </div>
                                        </div>
                                            <div class="form-group">
                                                <button type="submit" name="button">{translate('form_button_send')}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 col-xs-12" style="margin-top: 30px;">
                                <div class="col-md-12 no-padding">
                                    <h1 class="contact-title"> CONTACT US </h1>
                                </div>
                                <div class="col-md-12 no-padding contact-us">
                                    <p>{get_setting('contact_address','en')}</p>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 no-padding contact-item">
                                        <div class="icon-contact phonex"></div>
                                        <div class="contact-info">
                                            <h4 class="">{translate('info_phone')}</h4>
                                            <p>{get_setting('contact_phone','en')}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 no-padding contact-item">
                                        <div class="icon-contact email"></div>
                                        <div class="contact-info">
                                            <h4 class="">{translate('info_email')}</h4>
                                            <p>{get_setting('email')}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <ul class="contact-social">
                                        <li> <a href="{get_setting('facebook')}"> <i class="fa fa-facebook"></i> </a> </li>
                                        <li> <a href="{get_setting('twitter')}"> <i class="fa fa-twitter"></i> </a> </li>
                                        <li> <a href="{get_setting('google')}"> <i class="fa fa-google-plus"></i> </a> </li>
                                        <li> <a href="{get_setting('linkedin')}"> <i class="fa fa-linkedin"></i> </a> </li>
                                        <li> <a href="{get_setting('pinterest')}"> <i class="fa fa-pinterest"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {literal}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok" type="text/javascript"></script>
    <script>
        function initMap(getId)
        {
            if(document.getElementById(getId))
            {
                let locations = [
                  ["Makromedicine.com", 40.434979, 49.867603, 1 ]
                ];
                let map = new google.maps.Map(document.getElementById(getId), {
                    zoom: 12,
                    center: {lat: locations[0][1], lng: locations[0][2]}
                });
                for(let i = 0; i < locations.length ; i++)
                {
                    let marker = new google.maps.Marker({
                        position:{lat: locations[i][1], lng: locations[i][2]},
                        map:map,
                        animation: google.maps.Animation.DROP
                    });
                    marker.addListener('click', toggleBounce);
                }
            }
        }
        function toggleBounce() {
            if (marker.getAnimation() !== null)
            {
                marker.setAnimation(null);
            }
            else
            {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
        initMap("map");
        google.maps.event.addDomListener(window, "load", initMap);
    </script>


    {/literal}
{/block}
