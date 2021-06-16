{extends file=$layout}
{block name=content}
<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
<div class="n_content_area full_width" >
    <a href="#" id="openMenu" class="public-menu-float">Menu</a>

    <div class="container-fluid">
        <div class="row">
            {include file='../company/public-company-sidebar.tpl'}
            <div class="n_right_section decrease_padding_20 start_with_text">
                <div class="banner_image_n img_fit full_width">
                    {if $company_banner}
                        <img src="{$company_banner}" alt="{$user->company_name}" style="max-height: 220px; object-fit: cover;" />
                    {else}
                        <img src="{base_url('templates/default/assets/images/bnnr.png')}" style="max-height: 220px; object-fit: cover;" alt="{$user->company_name}" />
                    {/if}
                </div><!-- /.banner_image_n -->

                <div class="full_width need_padding_here">
                    <div class="cmother full_width pr-s-n">
                        <h2>COMPANY INFORMATION</h2>
                        {* <a href="#" class="write_message_n">Write Message</a> *}
                    </div>
                    <div class="full_width max-arrange">
                        <div class="drt_form full_width">
                            <div class="full_width">
                                <div class="fst_col">
                                    <label>Company Name <span>{$user->company_name}</span></label>
                                </div><!-- /.fst_col -->
                                <div class="snd_col">
                                    <label>Establishment date <span>{$user->establishment_date}</span></label>
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                            <div class="full_width">
                                <div class="fst_col">
                                    <label>Field of activity <span>{$selected_product_type_names}</span></label>
                                </div><!-- /.fst_col -->
                                <div class="snd_col">
                                    <label>Website <span>{$user->website}</span></label>
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                            {if $get_standart}
                                <div class="full_width">
                                    <div class="fst_col">
                                        <label>Standart
                                            {foreach $get_standart as $key=>$value}
                                                <span>{$value.st_name}</span>
                                                ,
                                            {/foreach}
                                        </label>
                                    </div><!-- /.fst_col -->

                                </div><!-- /.full_width -->
                            {/if}
                        </div><!-- /.drt_form -->

                        <div class="n_personal_info full_width">
                            {if !empty($user->company_info)}
                                <h3>ABOUT COMPANY</h3>
                                {$user->company_info}
                            {/if}
                            {if !empty(trim($tags))}
                                <div class="tags_nn full_width">
                                    {*                                <a href="#">Tag1</a>*}
                                    {$tags}
                                </div><!-- /.tags_nn -->
                            {/if}
                        </div><!-- /.personal_info -->



                        <div class="n_contact_info full_width">
                            <h3>CONTACT INFO</h3>
                            {if $company_info}{foreach $company_info as $company}
                                <div class="drt_form full_width">
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Phone Number <span>{$company->phone} <i>
                                                    {if $phone_type}
                                                        {foreach $phone_type as $key => $value}
                                                            {if $value->id == $company->phone_type } {$value->name} {break} {/if}
                                                        {/foreach}
                                                    {/if}
                                                </i></span> </label>
                                        </div><!-- /.fst_col -->
                                        <div class="snd_col">
                                            <label>Contact Person Name <span class="get_underline">{$company->fullname}</span></label>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Ext <span>{$company->ext}</span></label>
                                        </div><!-- /.fst_col -->
                                        <div class="snd_col">
                                            <label>Person Type
                                                {if $person_type}
                                                    {foreach $person_type as $key => $value}
                                                        {if $value->id == $company->person_type } {$value->name} {break} {/if}
                                                    {/foreach}
                                                {/if}
                                            </span></label>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>City, Country <span>{get_country_name($user->country_id)}</span></label>
                                        </div><!-- /.fst_col -->
                                        <div class="snd_col">
                                            <label>E-mail <span>{$company->email}</span></label>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        {if !empty($user->company_adress)}
                                            <div class="fst_col">
                                                <label>Address <span>{$user->company_adress}</span></label>
                                                <div class="map__">
                                                    <img src="{base_url('templates/default/assets/images/map__.png')}" />
                                                </div>
                                            </div><!-- /.fst_col -->
                                        {/if}
                                    </div><!-- /.full_width -->
                                </div><!-- /.contact_info -->
                                <hr style="background-color: rgba(33, 135, 197, 0.6);"/>
                            {/foreach}{/if}
                            <div class="drt_form full_width">
                                <div class="n_social_block full_width">
                                    {if !empty($user->company_facebook)}
                                        <a href="{$user->company_facebook}"><img src="{base_url('templates/default/assets/images/icons/n_face.png')}" alt="facebook"></a>
                                    {/if}
                                    {if !empty($user->company_twitter)}
                                        <a href="{$user->company_twitter}"><img src="{base_url('templates/default/assets/images/icons/n_twit.png')}" alt="twitter"></a>
                                    {/if}
                                    {if !empty($user->company_linkedin)}
                                        <a href="{$user->company_linkedin}"><img src="{base_url('templates/default/assets/images/icons/n_in.png')}" alt="linkedin"></a>
                                    {/if}
                                    {if !empty($user->company_youtube)}
                                        <a href="{$user->company_youtube}"><img src="{base_url('templates/default/assets/images/icons/n_tube.png')}" alt="youtube"></a>
                                    {/if}
                                </div><!-- /.social_block -->
                            </div>
                        </div><!-- /.max_arrange -->
                    </div><!-- /.need_padding_here -->
                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->
</div>
    <div class="clearfix"></div>



    {*
    <style>
        #map {
            top: 0 !important;
        }
    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <div class="clearfix"></div>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="profile">
                    <div class="col-md-12 no-padding">
                            <!--main info start-->
                            <div class="col-md-12 profile-right no-padding">
                                <div class="right-content">
                                    <div class="container main-secction">
                                        <div class="row">
                                            <div
                                                    class="col-md-12 col-sm-12 col-xs-12 image-section"
                                            >
                                                {if $company_banner}
                                                    <img src="{$company_banner}" />
                                                {else}
                                                    <img src="https://picsum.photos/1170/250"/>
                                                {/if}
                                            </div>
                                            <div class="row user-left-part">
                                                {include file='../company/public-company-sidebar.tpl'}
                                                <div
                                                        class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section"
                                                        style="height:520px; overflow:hidden; overflow-y:scroll;"
                                                >
                                                    <div class="row profile-right-section-row">
                                                        <div
                                                                class="col-md-12 col-sm-10 col-xs-10 profile-header"
                                                        >
                                                            <div class="row">
                                                                <h1>{$user->company_name}</h1>
                                                                <br/>
                                                                <button
                                                                        type="submit"
                                                                        name="submit"
                                                                        class=""
                                                                        style="background-color:#DCDCDC; font-size:12px; color:black;"
                                                                >
                                                                    Follow ({$user_following})
                                                                </button>

                                                                <hr/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        <h1 class="main-info-title">
                                                                            <u>Company Information</u>
                                                                        </h1>
                                                                    </div>
                                                                    <!-- Tab panes -->
                                                                    <div
                                                                            class="tab-content"
                                                                            style="margin-top:10px;"
                                                                    >
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label>Field of Activity</label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <p>{$selected_product_type_names}</p>
                                                                            </div>
                                                                        </div>
                                                                        {if $get_standart}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Standard</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>
                                                                                        {foreach $get_standart as $key=>$value}
                                                                                            <span>{$value.st_name}</span>
                                                                                            ,
                                                                                        {/foreach}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                        {if !empty(trim($tags))}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Tags</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>{$tags}</p>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label>Establishment Date</label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <p>{$user->establishment_date}</p>
                                                                            </div>
                                                                        </div>
                                                                        {if !empty($user->company_adress)}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Address</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>{$user->company_adress}</p>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label>Country</label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <p>{get_country_name($user->country_id)}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label></label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div style="height: 213px;top: 21px;" id="map"></div>
                                                                            </div>
                                                                        </div>
                                                                        {if !empty($user->website)}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Website</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>
                                                                                        <a href="{$user->website}"
                                                                                        >{$user->website}</a
                                                                                        >
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        {/if}

                                                                        {if !empty($user->company_info)}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Company Info</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>
                                                                                        {$user->company_info}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        <h1
                                                                                class="main-info-title"
                                                                                style="margin-top:20px;"
                                                                        >
                                                                            <u>Company Contact Information</u>
                                                                        </h1>
                                                                    </div>
                                                                    <!-- Tab panes -->
                                                                    <div
                                                                            class="tab-content"
                                                                            style="margin-top:10px;"
                                                                    >

                                                                        {if $company_info}{foreach $company_info as $company}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Full Name</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>{$company->fullname}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Email</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>{$company->email}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Phone</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>{$company->phone}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Type</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>{$company->phone_type}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Person Type</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>{$company->person_type}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Extention</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>{$company->ext}</label>
                                                                                </div>
                                                                            </div>
                                                                        {/foreach}{/if}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        <h1
                                                                                class="main-info-title"
                                                                                style="margin-top:20px;"
                                                                        >
                                                                            <u>Company Media Details</u>
                                                                        </h1>
                                                                    </div>
                                                                    <!-- Tab panes -->
                                                                    <div
                                                                            class="tab-content"
                                                                            style="margin-top:10px;"
                                                                    >
                                                                        <div class="row">
                                                                            {if !empty($user->company_facebook)}
                                                                            <a href="{$user->company_facebook}"
                                                                            ><img src="{base_url('templates/default/assets/img/sys/social-media/facebook.png')}"
                                                                                  width="30" height="30"/></a
                                                                            >
                                                                            {/if}&nbsp;&nbsp;&nbsp;
                                                                            {if !empty($user->company_twitter)}
                                                                                <a href="{$user->company_twitter}"
                                                                                ><img src="{base_url('templates/default/assets/img/sys/social-media/twitter.png')}"
                                                                                      width="30" height="30"
                                                                                    /></a>
                                                                            {/if}
                                                                            {if !empty($user->company_linkedin)}
                                                                                <a href="{$user->company_linkedin}"
                                                                                ><img src="{base_url('templates/default/assets/img/sys/social-media/linkedin.png')}"
                                                                                      width="60" height="30"
                                                                                    /></a>
                                                                            {/if}
                                                                            {if !empty($user->company_youtube)}
                                                                                <a href="{$user->company_youtube}"
                                                                                ><img src="{base_url('templates/default/assets/img/sys/social-media/youtube.png')}"
                                                                                      width="30" height="30"
                                                                                    /></a>
                                                                            {/if}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>

                                <!--main info end-->
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if !empty($user->company_lat) || !empty($user->company_lng)}
        var json_lat = {$user->company_lat};
        var json_lng = {$user->company_lng};
        var json_title = '{$user->company_address}';
        {literal}
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15,
                mapTypeId: 'roadmap'
            });
            var image = {
                url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            searchBox.addListener('places_changed', function () {

                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });

                markers = [];
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('.company_lat').val(place.geometry.location.lat());
                    $('.company_lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        {/literal}
        {else}
        var json_title = '{$user->company_name}';
        {literal}
        function initAutocomplete() {
            $.ajax({
                url: "https://ipinfo.io/?callback=",
                type: "GET",
                dataType: 'json',
                cache: true,
                success: function (data, status, error) {
                    var reg = data.loc.split(',');
                    var myLatLng = {lat: '', lng: ''};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: myLatLng,
                        zoom: 15,
                        mapTypeId: 'roadmap'
                    });
                    var image = {
                        url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    var beachMarker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        icon: image
                    });
                    var input = document.getElementById('pac-input');
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.addListener('bounds_changed', function () {
                        searchBox.setBounds(map.getBounds());
                    });
                    var markers = [];
                    searchBox.addListener('places_changed', function () {
                        var places = searchBox.getPlaces();
                        if (places.length == 0) {
                            return;
                        }
                        markers.forEach(function (marker) {
                            marker.setMap(null);
                        });
                        markers = [];
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function (place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }
                            var icon = {
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                            };
                            markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));
                            $('.company_lat').val(place.geometry.location.lat());
                            $('.company_lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }
            });
        }
        {/literal}
        {/if}

            {literal}
            {/literal}
    </script>
       *}
    {/block}
