{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
    <div class="clearfix"></div>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="profile">
                    <div class="col-md-12 no-padding">
                            <div class="col-md-3 no-padding profile-left">
                                <div class="left-sidebar" id="my-affix">
                                    <div class="round-image userphotos-change" data-toggle="tooltip" data-placement="top" title="Image Upload">
                                        <img src="{$user_images}" alt="{$publicprofile->fullname}" class="avatar img-circle img-thumbnail">
                                    </div>
                                    <img src="{base_url('templates/default/assets/img/sys/photo-camera.svg')}" class="camera-icon" style="opacity:0;">
                                    <h4 class="usr-company-name">{$publicprofile->fullname}</h4>
                                    <h4 class="usr-company-name">{$publicprofile->company_name}</h4>
                                    {*<h6 class="usr-group-name">{$UserGroup->name}</h6>*}
                                    <div class="followers">
                                        <h4>FOLLOWING: <a href="#" data-user-id="{$publicprofile->id}" class="my_followers"><span>{$user_following}</span></a> </h4>
                                        <button type="button" name="follow" class="" style="background-color:#DCDCDC; font-size:12px; color:black;">Follow ({$user_followers})</button>
                                    </div>
                                    <div class="profile-menu">
                                        <ul>
                                            <li class="active">
                                            <a href="#">
                                                <img src="{base_url('templates/default/assets/img/sys/user.svg')}" alt="PROFILE VIEW">
                                                PROFILE VIEW
                                            </a>
                                            </li>
                                            <li>
                                                <a href="{base_url('/')}profile/chat">
                                                    <img src="{base_url('templates/default/assets/img/sys/chat.svg')}" alt="CHAT">CHAT
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 profile-right no-padding">
                                <div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-top: 10px;">
                                            <h4 class="panel-title" style="font-size: 14px;">Personal Details</h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table profile__table">
                                                <tbody>
                                                {if !empty($publicprofile->fullname)}
                                                    <tr>
                                                        <td style="width: 200px;"><strong>Full Name</strong></td>
                                                        <td>{$publicprofile->fullname}</td>
                                                    </tr>
                                                {/if}
                                                {if !empty($publicprofile->brith_day) && $publicprofile->display_dob == 1 }
                                                    <tr>
                                                        <td><strong>Date of Birth</strong></td>
                                                        <td>
                                                            {$publicprofile->brith_day}
                                                        </td>
                                                    </tr>
                                                {/if}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Contact info -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-top: 10px;">
                                            <h4 class="panel-title" style="font-size: 14px;">Contact Info</h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table profile__table">
                                                <tbody>
                                                {if !empty($publicprofile->email) && $publicprofile->display_email == 1 }
                                                    <tr>
                                                        <td style="width: 200px;"><strong>Email</strong></td>
                                                        <td>{$publicprofile->email}</td>
                                                    </tr>
                                                {/if}

                                                {if !empty($publicprofile->phone) && $publicprofile->display_phone == 1}
                                                    <tr>
                                                        <td><strong>Phone</strong></td>
                                                        <td>{$publicprofile->phone}</td>
                                                    </tr>
                                                {/if}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- location -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-top: 10px;">
                                            <h4 class="panel-title" style="font-size: 14px;">Location</h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table profile__table">
                                                <tbody>
                                                {if !empty($publicprofile->country_id)}
                                                    <tr>
                                                        <td style="width: 200px;"><strong>Country</strong></td>
                                                        <td>{get_country_name($publicprofile->country_id)}</td>
                                                    </tr>
                                                {/if}

                                                {if !empty($publicprofile->adress)}
                                                    <tr>
                                                        <td><strong>Lives in</strong></td>
                                                        <td>{$publicprofile->adress}</td>
                                                    </tr>
                                                {/if}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- job description-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-top: 10px;">
                                            <h4 class="panel-title" style="font-size: 14px;">Job Description</h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table profile__table">
                                                <tbody>
                                                {if !empty($publicprofile->company_name)}
                                                    <tr>
                                                        <td style="width: 200px;"><strong>Company</strong></td>
                                                        <td>{$publicprofile->company_name}</td>
                                                    </tr>
                                                {/if}
                                                {if !empty($publicprofile->position)}
                                                    <tr>
                                                        <td><strong>Position</strong></td>
                                                        <td>{$publicprofile->position_name}</td>
                                                    </tr>
                                                {/if}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- personal info-->
                                    {if !empty($publicprofile->personal_info)}
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="padding-top: 10px;">
                                                <h4 class="panel-title" style="font-size: 14px;">Personal Info</h4>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table profile__table">
                                                    <tbody>
                                                    <tr>
                                                        <td>{$publicprofile->personal_info}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    {/if}

                                    <!-- Social information-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-top: 10px;">
                                            <h4 class="panel-title" style="font-size: 14px;">Social Media Details</h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table profile__table">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        {if !empty($publicprofile->facebook)}
                                                            <a href="{$publicprofile->facebook}"
                                                            ><img src="{base_url('templates/default/assets/img/sys/social-media/facebook.png')}"
                                                                  width="30" height="30"/></a
                                                            >
                                                        {/if}
                                                        {if !empty($publicprofile->twitter)}
                                                            <a href="{$publicprofile->twitter}"
                                                            ><img src="{base_url('templates/default/assets/img/sys/social-media/twitter.png')}"
                                                                  width="30" height="30"
                                                                /></a>
                                                        {/if}
                                                        {if !empty($publicprofile->youtube)}
                                                            <a href="{$publicprofile->youtube}"
                                                            ><img src="{base_url('templates/default/assets/img/sys/social-media/youtube.png')}"
                                                                  width="30" height="30"
                                                                /></a>
                                                        {/if}
                                                        {if !empty($publicprofile->linkedin)}
                                                            <a href="{$publicprofile->linkedin}"
                                                            ><img src="{base_url('templates/default/assets/img/sys/social-media/linkedin.png')}"
                                                                  width="60" height="30"
                                                                /></a>
                                                        {/if}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                {*
                                <div class="right-content" style="padding:0px;">
                                    <div class="col-md-12 no-padding right-content-inner" style="padding:0px;">
                                        <div class="tabbable tabs-left">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#profile-information" data-toggle="tab">Profile Information</a></li>
                                                <li><a href="#contact-information" data-toggle="tab">Contact Information</a></li>
                                                <li><a href="#responsible-person" data-toggle="tab">Responsible Person</a></li>
                                                  {if  $user['group_id'] != 6}
                                                <li><a href="#responsible-company" data-toggle="tab">Responsible Company</a></li>
                                                <li><a href="#certifcate-and-license" data-toggle="tab">Certificate and License</a></li>

                                                 {/if}
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="profile-information">
                                                    <div class="profile-information bug-fixed">
                                                        {if !empty($publicprofile->company_name)}
                                                        <div class="form-group">
                                                            <p>COMPANY NAME</p>
                                                            <span>{$publicprofile->company_name}</span>
                                                        </div>
                                                        {elseif !empty($publicprofile->fullname)}
                                                        <div class="form-group">
                                                            <p>FULL NAME</p>
                                                            <span>{$publicprofile->fullname}</span>
                                                        </div>
                                                        {/if}
                                                        {if !empty($publicprofile->name)}
                                                        <div class="form-group">
                                                            <p>STATUS</p>
                                                            <span>{$UserGroup->name}</span>
                                                        </div>
                                                        {/if}
                                                         {if !empty($selected_product_type_names)}
                                                        <div class="form-group">
                                                            <p>FIELD OF ACTIVITY</p>
                                                            <span>{$selected_product_type_names}</span>

                                                        </div>
                                                        {/if}
                                                         {if !empty($publicprofile->establishment_date)}
                                                        <div class="form-group">
                                                            <p>ESTABLISHMENT DATE</p>
                                                            <span>{$publicprofile->establishment_date}</span>
                                                        </div>
                                                         {else if !empty($publicprofile->brith_day)}
                                                        <div class="form-group">
                                                            <p>BIRTH DATE</p>
                                                            <span>{$publicprofile->brith_day}</span>
                                                        </div>
                                                        {/if}
                                                        {if !empty($publicprofile->company_info)}
                                                        <div class="form-group">
                                                            <p>COMPANY INFORMATIONS</p>
                                                            <span>{$publicprofile->company_info}</span>
                                                        </div>

                                                         {else if !empty($publicprofile->personal_info)}
                                                        <div class="form-group">
                                                            <p>PERSONAL INFORMATIONS</p>
                                                            <span>{$publicprofile->personal_info}</span>
                                                        </div>
                                                        {/if}
                                                        {if !empty(trim($tags))}
                                                        <div class="form-group">
                                                            <p>TAGS</p>
                                                            <span>{$tags}</span>
                                                        </div>
                                                        {/if}
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="contact-information">
                                                    <div class="contact-information bug-fixed">
                                                        <div class="form-group">
                                                            <p>COUNTRY</p>
                                                            <span>{get_country_name($publicprofile->country_id)}</span>
                                                        </div>
                                                        {if !empty($publicprofile->adress)}
                                                        <div class="form-group">
                                                            <p>ADDRESS</p>
                                                            <span>{$publicprofile->adress}</span>
                                                        </div>
                                                        {/if}

                                                        {if !empty($publicprofile->email)}
                                                        <div class="form-group">
                                                            <p>E-MAIL</p>
                                                            <span>{$publicprofile->email}</span>
                                                        </div>
                                                        {/if}
                                                        {if !empty($publicprofile->website)}
                                                        <div class="form-group">
                                                            <p>WEB</p>
                                                            <span>{$publicprofile->website}</span>
                                                        </div>
                                                        {/if}
                                                        <div class="form-group">

                                                            <div id="maps" style="width:100; height:350px;margin-top:10px"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="responsible-person">
                                                    <div class="responsible-person bug-fixed">
                                                        <div class="form-group">
                                                            <p>RESPONSIBLE PERSON</p>
                                                        </div>
                                                        {if $person_info}{foreach $person_info as $pericade=>$person}
                                                        <div class="form-group">
                                                            <b>{$person->fullname}</b><br/>
                                                            <span>Office: {$person->phone}</span><br/>
                                                            <span>E-mail: {$person->email}</span>
                                                        </div>
                                                        {/foreach}{/if}
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="responsible-company">
                                                    <div class="responsible-company bug-fixed">
                                                        <div class="form-group">
                                                            <p>RESPONSIBLE COMPANY</p>
                                                        </div>
                                                        {if $company_info}{foreach $company_info as $secret=>$company}
                                                        <div class="form-group">
                                                            <b>{$company->fullname}</b><br/>
                                                            <span>Office: {$company->phone}</span><br/>
                                                            <span>E-mail: {$company->email}</span>
                                                        </div>
                                                        {/foreach}{/if}
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="certifcate-and-license">
                                                    <div class="certifcate-and-license bug-fixed">
                                                     {if isset($publicprofile->certificate)}
                                                      <div class="form-group">
                                                            <p>CERTIFICATE</p>
                                                        </div>
                                                         <div class="form-group">
                                                          <div class="img-st-profil" style="width:30%">
                                                          <a href="{base_url('uploads')}/catalog/certifcate/{$publicprofile->certificate}" class="image-link">
                                                           <img src="{base_url('uploads')}/catalog/certifcate/{$publicprofile->certificate}">
                                                           </a>
                                                           </div>
                                                        </div>
                                                      {/if}
                                                       {if $get_standart}

                                                       <div class="form-group">
                                                            <p>STANDARTS</p>
                                                        </div>
                                                        <div class="form-group" style="display:flex">
                                                       {foreach $get_standart as $key=>$value}


                                                 {if !$value.isPdf}
                                              <div class="img-st-profil">
                                                <a href="{base_url('uploads')}/catalog/standart/{$value.name}" class="image-link"> <img src="{base_url('uploads')}/catalog/standart/{$value.name}" title="" alt="" /> </a>

                                                  <span>{$value.st_name}</span>
                                                </div>
                                            {else}
                                             <div class="img-st-profil">
                                              <a target="_blank" href="{base_url('uploads')}/catalog/standart/{$value.name}">
                                                <img src="{base_url('templates/default/assets/img/sys/pdf.png?v=2')}" class="pdf-icon-st" alt="" style="object-fit: contain;">
                                                 <span>{$value.st_name}</span>
                                              </a>
                                            </div>
                                            {/if}


                                                {/foreach}
                                                </div>{/if}

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="recent-product">
                                                    <div class="recent-product bug-fixed">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                *}
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



