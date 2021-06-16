{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="accounts-menu-float">Menu</a>
        <div class="container-fluid">
            <div CHANGE PASSWORDid="changePassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="changePassword" action="{base_url()}profile/changePassword" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title data-title">Change Password</h4>
                            </div>
                            <div class="modal-body data-response">
                                <div class="form-group">
                                    <label for="company-date">New passowrd </label>
                                    <input type="password" name="new_password" class="form-control mylos"
                                           placeholder="New password" required>
                                </div>
                                <div class="form-group">
                                    <label for="company-date">Re new passowrd </label>
                                    <input type="password" name="re_password" class="form-control mylos"
                                           placeholder="Repeat new password" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           {* {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                {if empty($UserData->company_name) }
                    <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="addCompanyInformation" action="{base_url()}profile/companyInformation"
                                      method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title data-title">Please enter company information</h4>
                                    </div>
                                    <div class="modal-body data-body"
                                         style="min-height: 500px;max-height:500px;overflow-y:auto;padding-top:35px;">
                                        <div class="round-image userphotos-change" data-toggle="tooltip"
                                             data-placement="top" title="Image Upload">
                                            <img src="{$user_images}" alt="{$UserData->company_name}"
                                                 class="avatar img-circle img-thumbnail">
                                        </div>
                                        <div class="form-group">
                                            <label for="company-name"> Company Name </label>
                                            {if !empty($UserData->company_name)}
                                                <input type="text" name="company_name" id="company-name"
                                                       class="form-control mylos readonly" placeholder="Company Name"
                                                       value="{$UserData->company_name}">
                                            {else}
                                                <input type="text" name="company_name" id="company-name"
                                                       class="form-control mylos readonly" placeholder="Company Name"
                                                       value="{$UserData->fullname}">
                                            {/if}
                                        </div>
                                        <div class="form-group ">
                                            <div class="flex direction_column">
                                                <label for="company-date"> Establishment date </label>
                                                <div class="flex">

                                                    <input type="hidden" class="bith_day_input" name="establishment_date" value="{$UserData->establishment_date}" />
                                                    {$bithday=explode('-', $UserData->establishment_date)}


                                                    <input type="text" name=""
                                                           class="form_input day_input append_value_onchange" data-group="day_input,month_input,year_input" data-target="bith_day_input" data-glue="-"
                                                           value="{$bithday[0]}" required placeholder="Day">

                                                    <select class="form_input month_input append_value_onchange" data-group="day_input,month_input,year_input" data-target="bith_day_input" data-glue="-">
                                                         <option value="" >Month</option>
                                                        {foreach $month_list as $k => $v}

                                                            <option value="{{$k}}" {if $k==$bithday[1]}selected{/if} >{{$v}}</option>
                                                        {/foreach}

                                                    </select>

                                                    <input type="text"
                                                           class="form_input year_input append_value_onchange" data-group="day_input,month_input,year_input" data-target="bith_day_input" data-glue="-"
                                                           value="{$bithday[2]}" required placeholder="Year">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="company-info">Company Info</label>
                                            {if !empty($UserData->establishment_date)}
                                                <textarea type="text" name="company_info" id="company-info" cols="5"
                                                          rows="12"
                                                          class="form-control mylos">{$UserData->company_info}</textarea>
                                            {else}
                                                <textarea type="text" name="company_info" id="company-info" cols="5"
                                                          rows="12"
                                                          class="form-control mylos">{$UserData->personal_info}</textarea>
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $("#companyModal").modal();
                    </script>
                {/if}
            {/if}*}

            {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                <div id="comfirmAccount" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="comfirmAccount" action="{base_url()}profile/comfirmAccount" method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title data-title">Comfirm Account</h4>
                                </div>
                                <div class="modal-body data-response">
                                    <div class="form-group">
                                        <input type="file" name="certifcate" style="display:none;"
                                               class="certifcate-input"/>
                                        <button type="button" class="btn btn-danger choose-certifcate">Choose
                                            Certifcate
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label for="company-date">Information</label>
                                        <textarea type="text" name="info" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {/if}

            {*{if $UserData->status neq 1 && ($user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4)}
                <div class="row" style="margin-bottom: 1em">
                    <div class="col-sm-12">
                        <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                            Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a
                                certificate.</a> After the confirmation of certificate your account will be approved and
                            your products will appear on the top rank of the search list.
                        </div>
                    </div>
                </div>
            {/if}*}
            <div class="row">
                {include file='../profile/sidebar.tpl'}
                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width">
                        <h2>PROFILE INFORMATION</h2>
                        {*                        <a href="#" onclick="$('#changePassword').modal();">Change password</a>*}
                        <a href="{site_url_multi('/')}profile/settings/">Edit Info</a>
                    </div><!-- /.with_buttons -->
                    {*<h3 class="french">ЗАПОЛНЕННОСТЬ ПРОФИЛЯ</h3>
                    <div class="n_gray_box full_width">
                        <ul>
                            <li><span>1. Заполните профиль информацией,</span><span>2. Добавьте продукты</span></li>
                            <li>От степени заполнения профиля зависит количество доступных вам функций сайта</li>
                        </ul>
                    </div><!-- /.n_gray_box -->*}

                    {$percent=0}
                    {if !empty($UserData->fullname)}
                        {$percent=$percent+20}
                    {/if}
                    {if !empty($UserData->brith_day)}
                        {$percent=$percent+20}
                    {/if}
                    {if !empty($UserData->adress)}
                        {$percent=$percent+20}
                    {/if}
                    {if !empty($UserData->phone)}
                        {$percent=$percent+20}
                    {/if}
                    {if !empty($UserData->email)}
                        {$percent=$percent+20}
                    {/if}

                    {$c=$percent}
                    {$c=$percent}
                    {$val1 = 0}
                    {$val2 = 0}
                    {if $percent <= 50}
                        {$val1 = (180*($percent*2))/100}
                    {elseif $percent > 50}
                        {$val1 = 180}
                        {$val2 = (180*(($percent-50)*2))/100}
                    {/if}
                    <style>
                        @keyframes loading-1 {
                            0% {
                                -webkit-transform: rotate(0deg);
                                transform: rotate(0deg);
                            }
                            100% {
                                -webkit-transform: rotate(180deg);
                                transform: rotate({$val1}deg);
                            }
                        }

                        @keyframes loading-2 {
                            0% {
                                -webkit-transform: rotate(0deg);
                                transform: rotate(0deg);
                            }
                            100% {
                                -webkit-transform: rotate(144deg);
                                transform: rotate({$val2}deg);
                            }
                        }
                    </style>


                    <div class="full_width max-arrange">
                        <div class="drt_form full_width">
                            <div class="full_width">
                                {if !empty($UserData->fullname)}
                                    <div class="fst_col">
                                        <label>Full Name <span>{$UserData->fullname}</span></label>
                                    </div>
                                    <!-- /.fst_col -->
                                {/if}
                                {if !empty($UserData->company_name)}
                                    <div class="snd_col">
                                        <label>Company <span><a href="{site_url_multi('/')}pages/{$UserData->slug}" ><u>{$UserData->company_name}</u></a> </span></label>
                                    </div>
                                    <!-- /.snd_col -->
                                {/if}
                            </div><!-- /.full_width -->
                            <div class="full_width">
                                {if !empty($UserData->position)}
                                    <div class="fst_col">
                                        <label>Your Position <span>{$UserData->position_name}</span></label>
                                    </div>
                                    <!-- /.fst_col -->
                                {/if}
                                <div class="snd_col">
                                    {if !empty($UserData->brith_day) }
                                        <label>Date of Birth
                                            <span>{$UserData->brith_day}
                                                <div class="drop_cstm" style="right: -25px">
                                                    <button disabled type="button" id="setVal" class="setVal">
                                                        <img
                                                                {if $UserData->display_dob == 1}
                                                                src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                alt="Public"
                                                                {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Public"
                                                                {/if}
                                                        />
                                                    </button>
                                                </div>
                                            </span>
                                        </label>
                                    {/if}
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                        </div><!-- /.drt_form -->

                        {if !empty($UserData->personal_info)}
                            <div class="n_personal_info full_width">
                                <h3>PERSONAL INFO</h3>
                                <p>{$UserData->personal_info}</p>
                            </div>
                            <!-- /.personal_info -->
                        {/if}

                        <div class="n_contact_info full_width">
                            <h3>CONTACT INFO</h3>
                            <div class="drt_form full_width">
                                {if !empty($UserData->phone)}
                                    <div class="full_width">
                                        <label>Phone Number
                                            <span>{$UserData->phone}
                            				<div class="drop_cstm" style="right: -25px;">
                                                <button disabled type="button" id="phonesetVal" class="setVal">
                                                    <img
                                                            {if $UserData->display_phone == 1}
                                                            src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                            alt="Public"
                                                            {else}
                                                            src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                            alt="Public"
                                                            {/if}
                                                    />
                                                </button>
                                            </div>
                                        </span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                {/if}

                                {if !empty($UserData->email)}
                                    <div class="full_width">
                                        <label>E-mail
                                            <span>{$UserData->email}
                            				<div class="drop_cstm"style="right: -25px;">
                                                <button disabled type="button" id="emailsetVal" class="setVal">
                                                    <img
                                                            {if $UserData->display_email == 1}
                                                                src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                alt="Public"
                                                                {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Public"
                                                                {/if}
                                                    />
                                                </button>
                                            </div>
                                        </span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                {/if}

                                <div class="full_width">
                                    <label>Country <span>{get_country_name($UserData->country_id)}</span></label>
                                </div><!-- /.full_width -->

                                <div class="full_width">
                                    <label>Address<span>{$UserData->adress}</span></label>
                                </div><!-- /.full_width -->
                            </div><!-- /.drt_form -->
                            <div class="full_width map__" id="maps">
                                <iframe width="265" height="150"  src="https://maps.google.com/maps?q={$UserData->adress}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                            </div><!-- map__-->

                            <div class="n_social_block full_width">
                                {if !empty($UserData->facebook)}
                                    <a href="{$UserData->facebook}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_face.png')}"
                                                alt="Facebook"/></a>
                                {/if}
                                {if !empty($UserData->twitter)}
                                    <a href="{$UserData->twitter}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_twit.png')}"
                                                alt="Twitter"/></a>
                                {/if}
                                {if !empty($UserData->youtube)}
                                    <a href="{$UserData->youtube}"><img
                                                src="{base_url('templates/default/assets/images/icons/n_tube.png')}"
                                                alt="YouTube"/></a>
                                {/if}
                                {if !empty($UserData->linkedin)}
                                    <a href="{$UserData->linkedin}"><img
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
        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
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
        var json_title = '{$UserData->company_name}';
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
