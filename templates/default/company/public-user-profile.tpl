{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    {include file='../_partial/approve_waiting_line.tpl'}

    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="row">


            <div class="n_side_section color_change_green">
            <div class="userSettings">
                <div class="n_top_data">
                <a href="#" id="menu_hide">Hide</a>
                    <div class="n_profile_img img_fit">
                        <img src="{$publicprofile->images}" alt="{$publicprofile->fullname}" id="n_profile_img_uploaded" />

                        {if $is_loggedin && $logged_user_id!=$publicprofile->id}
                            <button type="button" class="open_close_block_menu_btn"></button>
                            <ul class="flex direction_column open_close_block_menu_list">
                                <li><a href="#" class="block_user_or_company_btn" data-id="{$publicprofile->id}" data-image="{$publicprofile->images}" data-name="{$publicprofile->fullname}" data-type="profile">Block profile</a> </li>
                                <li><a href="#" class="complain_user_or_company_btn" data-id="{$publicprofile->id}" data-image="{$publicprofile->images}" data-name="{$publicprofile->fullname}" data-type="profile">Report profile</a> </li>
                            </ul>
                        {/if}
                    </div><!-- /.n_profile_img -->
                    <h2>
                        {$publicprofile->fullname}
                        <span>
                        {if !empty($publicprofile->position)}{$publicprofile->position_name}{/if}
                    </span>
                    </h2>
                    <hr>



                    {if isset($settings) && $settings == 1}
                        {*<h6>{$user_followers}<span>Followers</span></h6>*}
                        <h6>{$user_following}<span>Following</span></h6>
                    {else}
                        {*<h6>{$user_followers}<span>Followers</span></h6>*}
                        <h6>{$user_following}<span>Following</span></h6>
                        {* Add Like button *}
                    {/if}
                </div><!-- /.n_top_data -->

        
                {if isset($user) && $publicprofile->id==$user['id']}
                    <div class="n_navigation">
                        <ul>
                            <li>
                                <a href="{site_url_multi('/')}profile/" {if isset($active_menu) and $active_menu == 1} class="active" {/if}><img
                                            src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Profile View</span></a>
                            </li>
                        </ul>
                    </div><!-- /.n_navigation -->
                {/if}

            </div>
        </div><!-- /.n_side_section -->


                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width">
                        <h2>PROFILE INFORMATION</h2>
                       
                    </div><!-- /.with_buttons -->
                    

                    

                    <div class="full_width max-arrange">
                        <div class="drt_form full_width">
                            <div class="full_width">
                                {if !empty($publicprofile->fullname)}
                                    <div class="fst_col">
                                        <label>Full Name <span>{$publicprofile->fullname}</span></label>
                                    </div>
                                    <!-- /.fst_col -->
                                {/if}
                                {if !empty($publicprofile->company_name)}
                                    <div class="snd_col">
                                        <label>Company <span><a href="{site_url_multi('/')}companies/{$publicprofile->slug}" target="_blank"><u>{$publicprofile->company_name}</u></a></span> </label>
                                    </div>
                                    <!-- /.snd_col -->
                                {/if}
                            </div><!-- /.full_width -->
                            <div class="full_width">
                                {if !empty($publicprofile->position)}
                                    <div class="fst_col">
                                        <label>Your Position <span>{$publicprofile->position_name}</span></label>
                                    </div>
                                    <!-- /.fst_col -->
                                {/if}
                                <div class="snd_col">
                                    {if !empty($publicprofile->brith_day) && $publicprofile->display_dob == 1 }
                                        <label>Date of Birth
                                            <span>{$publicprofile->brith_day}</span>
                                        </label>
                                    {/if}
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                        </div><!-- /.drt_form -->

                        {if !empty($publicprofile->personal_info)}
                            <div class="n_personal_info full_width">
                                <h3>PERSONAL INFO</h3>
                                <p>{$publicprofile->personal_info}</p>
                            </div>
                            <!-- /.personal_info -->
                        {/if}

                        <div class="n_contact_info full_width">
                            <h3>CONTACT INFO</h3>
                            <div class="drt_form full_width">
                                {if !empty($publicprofile->phone) && $publicprofile->display_phone == 1}
                                    <div class="full_width">
                                        <label>Phone Number
                                            <span>{$publicprofile->phone}</span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                {/if}

                                {if !empty($publicprofile->email) && $publicprofile->display_email == 1}
                                    <div class="full_width">
                                        <label>E-mail
                                            <span>{$publicprofile->email}</span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                {/if}

                                <div class="full_width">
                                    <label>Country <span>{get_country_name($publicprofile->country_id)}</span></label>
                                </div><!-- /.full_width -->

                                {if !empty($publicprofile->adress)}
                                    <div class="full_width">
                                        <label>Address <span>{$publicprofile->adress}</span></label>
                                    </div><!-- /.full_width -->
                                {/if}

                            </div><!-- /.drt_form -->

                            {if !empty($publicprofile->adress)}
                                <div class="full_width map__" id="maps">
                                    <iframe width="265" height="265"  src="https://maps.google.com/maps?q={$publicprofile->adress}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div><!-- map__-->
                            {/if}

                            <div class="n_social_block full_width">
                                {if !empty($publicprofile->facebook)}
                                    <a href="{$publicprofile->facebook}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_face.png')}"
                                                alt="Facebook"/></a>
                                {/if}
                                {if !empty($publicprofile->twitter)}
                                    <a href="{$publicprofile->twitter}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_twit.png')}"
                                                alt="Twitter"/></a>
                                {/if}
                                {if !empty($publicprofile->youtube)}
                                    <a href="{$publicprofile->youtube}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_tube.png')}"
                                                alt="YouTube"/></a>
                                {/if}
                                {if !empty($publicprofile->linkedin)}
                                    <a href="{$publicprofile->linkedin}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_in.png')}"
                                                alt="Linkedin"/></a>
                                {/if}
                            </div><!-- /.social_block -->
                        </div><!-- /.contact_info -->
                    </div><!-- /.max_arrange -->
                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.n_content_area -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if !empty($publicprofile->lat) || !empty($publicprofile->lng)}
        var json_lat = {$publicprofile->lat};
        var json_lng = {$publicprofile->lng};
        var json_title = '{$publicprofile->adress}';
        {literal}
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('maps'), {
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
                    $('.lat').val(place.geometry.location.lat());
                    $('.lng').val(place.geometry.location.lng());
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
        var json_title = '{$publicprofile->company_name}';
        {literal}
        function initAutocomplete() {
            $.ajax({
                url: "https://ipinfo.io/?callback=",
                type: "GET",
                dataType: 'json',
                cache: true,
                success: function (data, status, error) {
                    var reg = data.loc.split(',');
                    var myLatLng = {lat: parseFloat(reg[0]), lng: parseFloat(reg[1])};
                    var map = new google.maps.Map(document.getElementById('maps'), {
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
                            $('.lat').val(place.geometry.location.lat());
                            $('.lng').val(place.geometry.location.lng());
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
        $(document).ready(function () {

            if ($('a.image-link').length) {
                $('a.image-link').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true
                    }
                });
            }

            $(document).on('mouseenter', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 1);
            })
            $(document).on('mouseleave', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 0);
            })

            $(document).on('click', '.userphotos-change,.camera-icon', function () {
                $('input.userphotos').click();
            })
            {literal}
            $(document).on('submit', '.userphotos_form', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.isLoading({text: ""});
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/userphotos/',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'false') {
                            toastr.warning('This profile image not upload. Please refresh page or <a target="_blank" href="' + site_url + 'contact">Contact us</a>');
                        } else {
                            toastr.success('Profile update successful !');
                            if ($('.round-image img').attr('src', site_url + 'uploads/catalog/users/' + data)) {
                                $.isLoading("hide");
                            }
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('submit', '.comfirmAccount', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/comfirmAccount/',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        if (obj.type == 'success') {
                            $('.modal').modal('hide');

                            toastr.success(obj.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(obj.message);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            {/literal}
            $(document).on('change', '.userphotos', function (e) {
                e.preventDefault();
                $('.userphotos_form').submit();
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.choose-certifcate', function () {
                $('.certifcate-input').click();
            });
            $(document).on('change', '.certifcate-input', function () {
                var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
                $('.choose-certifcate').removeClass('btn-danger').addClass('btn-success').text('Selected - ' + filename);

            })
        }); 
    </script>
{/block}
