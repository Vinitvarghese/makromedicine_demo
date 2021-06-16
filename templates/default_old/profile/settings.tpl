{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <style>
    .intl-tel-input.allow-dropdown {
        width: 265px !important;
        float: left;
        height: 34px;
        border: 1px solid rgba(177, 177, 177, 1);
        border-radius: 6px;
        padding: 0 15px;
        margin-bottom: 20px;
        font-size: 14px;
        color: rgba(70, 70, 70, 1);
    }
    .phone, .phones { border: 0; outline: none; }
    .phone:focus, .phones:focus { outline: none !important; box-shadow: none !important; }
    </style>

    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="all_modals full_width">






                <div id="changePassword" class="modal fade" role="dialog" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>CHANGE PASSWORD</h3>
                                <form class="changePassword" action="{base_url()}profile/changePassword" method="post">
                                <div class="mod_center_inp change_pss">
                                    <div class="full_width relative">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password"/>
                                        <span class="eye_im"><img src="{base_url('templates/default/assets/images/icons/eye_bar.png')}"/></span>
                                    </div>
                                    <div class="full_width relative">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" />
                                        <span class="eye_im"><img src="{base_url('templates/default/assets/images/icons/eye.png')}"/></span>
                                    </div>
                                    <div class="full_width relative">
                                        <label>Confirm Password</label>
                                        <input type="password" name="re_password" />
                                        <span class="eye_im"><img src="{base_url('templates/default/assets/images/icons/eye.png')}"/></span>
                                    </div>

                                    <a href="#" class="fr_pass"  data-dismiss="modal" onclick="$('#forgetPasswordAuth').modal();">Forgot your password?</a>
                                </div><!-- /.mod_center_inp -->


                                <div class="like_btn_n fnt_normal full_width">
                                    <button type="submit" class="send_n">Save</button>
                                    <button type="button" class="back_n" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>


            </div>
            {* {if (($UserData->status neq 1  && $user['group_id'] eq 2 ) && (  $user['group_id'] eq 3 ||  $user['group_id'] eq 4))}
                <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                    Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a
                        certificate.</a> After the confirmation of certificate your account will be approved and
                    your products will appear on the top rank of the search list.
                </div>
            {/if} *}

            <form class="userphotos_form" action="{base_url()}profile/userphotos" method="post">
                <input type="file" style="display:none;" name="userphotos" class="userphotos"/>
            </form>

            <div class="row">

                    {include file='../profile/sidebar.tpl'}

                    <div class="n_right_section start_with_text">
                        <div class="with_buttons full_width">
                            <h2>PROFILE INFORMATION</h2>
                            <a href="#" onclick="$('#changePassword').modal();">Change password</a>
                            <a href="#" class="active">Edit Info</a>
                        </div><!-- /.with_buttons -->

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
                        {*{foreach $UserData as $key=>$value}
                            {if $value == NULL}
                                {$c=$c+1}
                            {/if}
                        {/foreach}
                        {$percent = ($c/58)*100}*}
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
                        </style>{*{math equation="(x/y)*100" x=$c y=58 format="%.0f"}*}
                        {*<div
                                class="progress-bar"
                                role="progressbar"
                                aria-valuenow="{math equation="(x/y)*100" x=$c y=58 format="%.0f"}"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                style="width:{math equation="(x/y)*100" x=$c y=58 format="%.0f"}%"
                        >
                            <span>{math equation="(x/y)*100" x=$c y=58 format="%.0f"}% Complete</span>
                        </div>*}
                        {*<div class="n_diagram_detail full_width">
                            <div class="n_diagram">
                                <div class="progress blue">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                                    <div class="progress-value">{$percent|round:0}%</div>
                                </div>
                            </div><!-- /.n_diagram -->
                            <div class="n_list_sys">
                                <ul>
                                    {if !empty($UserData->fullname)}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/gren.png')}"/></span><span>Full Name is available</span>
                                        </li>
                                    {else}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/redd.png')}"/></span><span>Full Name is not available</span>
                                        </li>
                                    {/if}
                                    {if !empty($UserData->brith_day)}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/gren.png')}"/></span><span>Birthday is available</span>
                                        </li>
                                    {else}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/redd.png')}"/></span><span>Birthday is not available</span>
                                        </li>
                                    {/if}

                                    {if !empty($UserData->adress)}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/gren.png')}"/></span><span>Address is available</span>
                                        </li>
                                    {else}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/redd.png')}"/></span><span>Address is not available</span>
                                        </li>
                                    {/if}

                                    {if !empty($UserData->phone)}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/gren.png')}"/></span><span>Phone is available</span>
                                        </li>
                                    {else}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/redd.png')}"/></span><span>Phone is not available</span>
                                        </li>
                                    {/if}

                                    {if !empty($UserData->email)}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/gren.png')}"/></span><span>Email is available</span>
                                        </li>
                                    {else}
                                        <li>
                                            <span><img src="{base_url('templates/default/assets/images/icons/redd.png')}"/></span><span>Email is not available</span>
                                        </li>
                                    {/if}
                                </ul>
                            </div><!-- /.n_list_sys -->
                            <hr>
                        </div><!-- /.n_diagram_detail -->*}

                        <div class="full_width max-arrange">
                            <form class="userSettings userSettingsCenter" action="{base_url()}profile/save" enctype="multipart/form-data"
                                  method="post">

                                <input type="hidden" name="apply_company" id="apply_company" value="0" />

                            <div class="n_like_form full_width">
                                <div class="n_first_block">
                                    {if !empty($UserData->fullname)}
                                        <div class="full_width">
                                            <label>Full Name <sup>*</sup></label>
                                            <input type="text" name="fullname" value="{$UserData->fullname}" required/>
                                            <input type="hidden" name="group_id" value="{$UserData->user_groups_id}">
                                        </div>
                                        <!-- /.full_width -->
                                    {/if}
                                    {*                                <div class="full_width">*}
                                    {*                                    <label>Surname <sup>*</sup></label>*}
                                    {*                                    <input type="text" value="Buffett" />*}
                                    {*                                </div><!-- /.full_width -->*}

                                    <div class="full_width date_of_brth">
                                        <label>Date of Birth</label>
                                        <input type="text" name="brith_day" id="company-date"
                                               class="form-control mylos" placeholder=""
                                               style="width: 265px !important;"
                                               value="{$UserData->brith_day}">
                                        <div class="drop_cstm adj" style="width: 38px;margin-left: 10px;">
                                            <input type="hidden" value="{$UserData->display_dob}" name="display_dob" id="datesetValInput">
                                            <button type="button" id="datesetVal" class="setVal"><span>
                                                    {if $UserData->display_dob == 1}
                                                    <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                         alt="Public">
                                                {else}
                                                <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                alt="Private">
                                                {/if}
                                                    </span>
                                                <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}"/>
                                            </button>
                                            <div class="drop_down_select_ getVal" id="dategetVal">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                             alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                             alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- /.full_width -->


                                    <hr>


                                    <div class="full_width" style="margin-bottom: 20px">
                                    <label>Country <sup>*</sup></label>

                                    <select class="selectpicker form-control show-menu-arrow mylos company-country"
                                            name="country_id" data-live-search="true"
                                            data-selected-text-format="count > 1" title="Country" required>
                                        {if $countrys}{foreach $countrys as $key => $value}
                                            <option value="{$value->id}" data-name="{$value->code}"
                                                    {if $value->id eq $UserData->country_id || ($UserData->country_id==0 && $value->code==$countryCode) }selected="selected"{/if}>{$value->name}</option>
                                        {/foreach}{/if}
                                    </select>
                                </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Your Address</label>
                                        <input id="pac-input" type="text" name="address" value="{$UserData->adress}" />
                                    </div><!-- /.full_width -->

                                    <div class="full_width map__">
                                        <div style="height: 213px;top: 21px; width:265px;" id="map"></div>
                                    </div><!-- map__-->

                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Phone Number <sup>*</sup></label>
                                        <input type="hidden" name="country_code" class="dial-up"
                                            value="{if empty($company->code)}{$UserData->country_code}{else}{$UserData->country_code}{/if}">
                                        <input type="phone" name="phone" id="phone"
                                            class="form-control inputmask mylos {if empty($UserData->phone)} phones {else} phones {/if}"
                                            value="{$UserData->phone}"
                                            data-co="{$UserData->country_code}" required>


                                        <input type="hidden" value="{$UserData->display_phone}" name="display_phone" id="phonesetValInput">

                                        <div class="drop_cstm adj">
                                            <button type="button" id="phonesetVal2" class="setVal"><span>
                                                    <img
                                                            {if $UserData->display_phone == 1}
                                                                src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                alt="Public"
                                                            {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Private"
                                                            {/if}
                                                         alt="Public">
                                                </span>
                                                <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}" />
                                            </button>
                                            <div class="drop_down_select_ getVal" id="phonegetVal2">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="{base_url('templates/default/assets/images/icons/lock_.png')}" alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="{base_url('templates/default/assets/images/icons/earth_.png')}" alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>




                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>E-mail <sup>*</sup></label>
                                        <input type="text" value="{$UserData->email}" name="email" id="company-mail" readonly/>
                                        <input type="hidden" value="{$UserData->display_email}" name="display_email" id="emailsetValInput">
                                        <div class="drop_cstm adj">
                                            <button type="button" id="emailsetVal2" class="setVal"><span>
                                                    <img class="emailsetValIcon"
                                                            {if $UserData->display_email == 1}
                                                                src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                alt="Public"
                                                            {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Private"
                                                            {/if}
                                                            alt="Public"></span>
                                                <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}" />
                                            </button>
                                            <div class="drop_down_select_ getVal" id="emailgetVal2">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="{base_url('templates/default/assets/images/icons/lock_.png')}" alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="{base_url('templates/default/assets/images/icons/earth_.png')}" alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>



                                    </div><!-- /.full_width -->

                                    <hr>

                                    <div class="full_width" style="margin-bottom: 13px">
                                        <label>Company</label>
                                        <input type="text" name="company_name" value="{$UserData->company_name}"  class="company-input-box"/>
                                        <label class="alert alert-warning company-warning-box" style="margin-bottom: 0 !important;">
                                            <i class="fa fa-exclamation-circle"></i> If you have company please add company.
                                        </label>
                                    </div><!-- /.full_width -->

                                    <div class="full_width position_div {if empty($UserData->company_name)} hidden {/if}"    >
                                        <label>Your Position <sup>*</sup></label>
                                        <select class="selectpicker form-control show-menu-arrow mylos"
                                                name="position" data-live-search="true"
                                                data-selected-text-format="count > 1" title="Position" >
                                                <option value="0" >Choose</option>
                                            {if $person_type}{foreach $person_type as $key => $value}
                                                <option value="{$value->id}" {if $UserData->position eq $value->id} selected {/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </div><!-- /.full_width -->


                                </div><!-- /.n_second_block -->
                            </div><!-- /.n_like_form -->

                            <hr class="thrx">

                            <div class="full_width n_txt">
                                <label>Personal Info</label>
                                <textarea name="personal_info" id="personal_info">{$UserData->personal_info}</textarea>
                            </div>

                            <div class="comon_h3 full_width m30s">
                                <h3>SOCIAL INFORMATION</h3>
                            </div><!-- /.personal_info -->
                            <div class="full_width n_like_form">
                                <div class="n_first_block">
                                    <div class="full_width">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="{$UserData->facebook}" />
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Youtube</label>
                                        <input type="text" name="youtube" value="{$UserData->youtube}"/>
                                    </div><!-- /.full_width -->
                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Twitter</label>
                                        <input type="text" name="twitter" value="{$UserData->twitter}"/>
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Linkedin</label>
                                        <input type="text" name="linkedin" value="{$UserData->linkedin}"/>
                                    </div><!-- /.full_width -->
                                </div><!-- /.n_first_block -->
                            </div><!-- /.full_width -->

                            <div class="btn_wrap full_width">
                                <a href="#" class="n_cancel">Cancel</a>
                                <input type="submit" value="Save" class="n_save">
                            </div><!-- /.btn_wrap -->
                            </form>
                        </div><!-- /.max_arrange -->

                    </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->


    <script type="text/javascript">
        function addPhone(count, target) {
            var component = `<div class="form-group label_"` + count + ` style="border-top:1px solid #ddd;padding-top: 20px;">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="company-status" class="round"> Full Name </label>
                    <input type="text" name="` + target + `[fullname][` + count + `][]" id="company-status" class="form-control mylos" >
                </div>
                <div class="form-group copiered_` + target + `">
                    <label for="company-phone" class="round"> Phone </label>
                    <input type="hidden" name="` + target + `[code][` + count + `][]" class="dial-code" value="{$UserData->country_code}">
                    <input type="phone" name="` + target + `[phone][` + count + `][]" id="phone" class="form-control inputmask phone mylos"  value="">
                </div>
            </div>
            <div class="col-md-4 no-padding">
                <div class="form-group">
                    <label for="company-status" class="round"> Email </label>
                    <input type="text" name="` + target + `[email][` + count + `][]" id="company-status" class="form-control mylos" >
                </div>
                <div class="form-group">
                    <label for="company-ext" class="fill"> Type </label>
                    <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[phone_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Type">
                        {if $phone_type}{foreach $phone_type as $key => $value}
                        <option value="{$value->id}">{$value->name}</option>
                        {/foreach}{/if}
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group has-suggestion">
                        <label for="company-ext" class="fill">Person Type </label>
                        <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[person_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Person Type">
                            {if $person_type}{foreach $person_type as $key => $value}
                            <option value="{$value->id}">{$value->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 no-padding">
                        <label for="company-ext" class="fill"> Ext </label>
                        <input type="text" name="` + target + `[ext][` + count + `][]" id="company-ext" class="form-control mylos">
                    </div>
                    <div class="col-md-3 no-padding" style="padding-top:20px;padding-right:10px;">
                        <button type="button" style="height: 31px;" class="btn btn-danger btn-bix pull-right remove-item-phone" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>`;
            return component;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if $get_confirm_status eq false}
        {if $UserData->status eq 0}
            // $('#comfirmAccount').modal();
        {/if}
        {/if}
        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
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
                    /* markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    })); */
                    $('.lat').val(place.geometry.location.lat());
                    $('.lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                // map.fitBounds(bounds);
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
                            /*markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));*/
                            $('.lat').val(place.geometry.location.lat());
                            $('.lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        // map.fitBounds(bounds);
                    });
                }
            });
        }
        {/literal}
        {/if}

        var social1 = true;
        var social2 = true;
        var social3 = true;
        var social4 = true;
        var web = true;
        $(document).ready(function () {
            {literal}
            $(document).on('click', '.send-us-certifcate', function () {
                toastr.info('Your information has been sent successfully. We will send your information but after checking.');
            });
            $(document).on('click', '.remove-image', function (e) {
                e.preventDefault();
                var attr = $(this).attr('data-id');
                var user_id = $(this).attr('user-id');
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/deleteimg/',
                    data: {'value': attr, 'user_id': user_id},
                    cache: false,
                    success: function (data) {
                        if (data == 'true') {
                            $('.bitrix.block_' + attr).remove();
                            $('.standart option[value="' + attr + '"]').removeAttr('selected');
                            $('.selectpicker').selectpicker();
                            toastr.success('This image delete successful !');
                        } else {
                            toastr.danger('Can not delete this image !');
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.upload-btn-box', function (e) {
                e.preventDefault();
                $(this).parent().find('input[type="file"]').trigger('click');
                e.preventDefault();
                return false;
            });
            var count = 0;
            $(document).on('click', '.responsible-btn', function () {
                count = count + 1;
                var target = $(this).attr('data-target');
                var component = addPhone(count, target);
                var dial_codes = $('.dial-codes').val();
                $('.responsible-' + target + '-inner').append(component);
                $('.selectpicker').selectpicker();
                //    $('.inputmask.phone').inputmask({"mask": "99 999-99-99"});
                $('.phone').intlTelInput({
                    {/literal}
                    {if isset($UserData->country_code) && $UserData->country_code!=''}
                    initialCountry: '{$UserData->country_code}',
                    {else}
                    {literal}
                    initialCountry: "auto",
                    geoIpLookup: function (callback) {
                        $.get("https://ipinfo.io", function () {
                        }, "jsonp").always(function (resp) {
                            var countryCode = resp.country;
                            callback(countryCode);
                        });
                    }
                    {/literal}
                    {/if}
                    {literal}
                });
            });
            {/literal}
            $(document).on('click', '.remove-item-phone', function () {
                $(this).parent().parent().parent().parent().remove();
            });
            var general = {$tag_maps};
            var citynames = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: $.map(general, function (city) {
                    return {
                        value: city.value,
                        name: city.name
                    };
                })
            });
            $('input.tagsinput').tagsinput({
                typeaheadjs: {
                    name: 'citynames',
                    displayKey: 'name',
                    valueKey: 'name',
                    source: citynames.ttAdapter()
                }
            });
            $('.standart').change(function (e) {
                var standart = $(this).val();
                // var st_text = $(this).find('option:selected').text();
                $.each(standart, function (index, value) {
                    if (!$('.img_forece .bitrix').hasClass("block_" + value)) {
                        var st_text = $('.standart').find('option[value="' + value + '"]').text();
                        var comp = `<div class="img-upload-group bitrix block_` + value + `" var-attr="` + value + `">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="userfile[` + value + `]" accept="image/gif, image/jpg, image/png, image/jpeg">
                                <button type="button" class="mini-upload upload-button" data-id="{$UserData->id}" data-target="standart"></button>
                            </label>
                        </div>
                        <span title="` + st_text + `"> ` + st_text + `</span>
                    </div>`;
                        $('.img_forece').append(comp);
                    }
                });
                var valid = [];
                $('.bitrix').each(function (index, value) {
                    valid.push($(value).attr('var-attr'));
                });
                var difference = [];
                $.grep(valid, function (el) {
                    if (jQuery.inArray(el, standart) == -1) difference.push(el);
                });
                difference.forEach(function (element) {
                    $('.bitrix.block_' + element).remove();
                });
            });

            $(document).on('submit', '.userSettings', function (e) {
                e.preventDefault();


                if (social1 && social2 && social3 && social4 && web) {
                    var formData = new FormData($(this)[0]);
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/save/',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            toastr.success('Profile update successful !');
                            window.location.href = window.location.href;
                        }
                    });
                } else {
                    toastr.error('Form has errors');
                }
            });
            $(document).on('submit', '.changeCompanyName', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/changeCompanyName/',
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'true') {
                            $('#changeCompanyName').modal('hide');
                            toastr.success('Your succestion send successfuly');
                        } else if (data == 'same') {
                            var err = 'Account already exists on the system with that company name.  Please enter a different company name.';
                            toastr.error(err);
                        } else {
                            $('#changeCompanyName').modal('hide');
                            toastr.error('You are not permision change company name');
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('submit', '.changePassword', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/changePassword/',
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        $('#changePassword').modal('hide');
                        if (obj.type == 'success') {
                            $('#changePassword').modal('hide');
                            toastr.success(obj.message);
                        } else {
                            toastr.error(obj.message);
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
                            $('#comfirmAccount').modal('hide');
                            $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
                            toastr.success(obj.message);
                        } else {
                            toastr.error(obj.message);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.userphotos-change', function () {
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
                            $('#n_profile_img_uploaded').attr('src', site_url + 'uploads/catalog/users/' + data);
                            if ($('.round-image img').attr('src', site_url + 'uploads/catalog/users/' + data)) {
                                $.isLoading("hide");
                            }
                        }
                    }
                });
                e.preventDefault();
                return false;
            });

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

        $(document).on("change", 'input[name="facebook"]', function () {
            var value = $(this).val();
            if (value.substring(0, 24) != 'https://www.facebook.com' && value != '' && value.substring(0, 18) != 'https://www.fb.com') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social1 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social1 = true;
            }

        });
        $(document).on("change", 'input[name="twitter"]', function () {
            var value = $(this).val();
            if (value.substring(0, 19) != 'https://twitter.com' && value != '' && value.substring(0, 23) != 'https://www.twitter.com') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social2 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social2 = true;
            }

        });

        $(document).on("change", 'input[name="youtube"]', function () {
            var value = $(this).val();
            if (value.substring(0, 23) != 'https://www.youtube.com' && value != '' && value.substring(0, 16) != 'https://youtu.be') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social3 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social3 = true;
            }

        });
        $(document).on("change", 'input[name="linkedin"]', function () {
            var value = $(this).val();
            if (value.substring(0, 24) != 'https://www.linkedin.com' && value != '') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social4 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social4 = true;
            }

        });


        function validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(str);
        }

        $(document).on("change", 'input[name="website"]', function () {
            var value = $(this).val();
            if (!validURL(value) && value != '') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                web = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                web = true;
            }

        });


        var somethingChanged = false;
        $('#profile .btn-group> select').on('change', function () {
            somethingChanged = true;
        });
        $('#profile input[type="text"]').on('keyup', function () {
            somethingChanged = true;
        });
        $('#profile textarea').on('keyup', function () {
            somethingChanged = true;
        });
        $(window).bind('beforeunload', function (e) {
            if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged) {
                return 'You have unsaved changes; are you sure you want to leave this page?';
            }
        });

        {/literal}
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(ev) {
            var comName = $('.company-input-box').val();
            if(comName.length < 2) {
                $('.company-warning-box').fadeIn();
            } else { 
                $('.company-warning-box').fadeOut();
            }

            $('.company-input-box').on('change', function(ev) {
                var comName_1 = $('.company-input-box').val();
                    if(comName.length > 2) {
                    $('.company-warning-box').fadeOut();
                }
            });




            $("#company-date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: '1940:2020',
            });
        });

        $(function(){
            $('#setVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#getVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');

            });
            $('#getVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#setVal').find('img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#setValInput').val(data)
            });

            $('#phonesetVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#phonegetVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#phonegetVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#phonesetVal').find('img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#phonesetValInput').val(data)
            });

            $('#emailsetVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#emailgetVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#emailgetVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#emailsetVal').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#emailsetValInput').val(data)
            });

            $('#datesetVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#dategetVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#dategetVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#datesetVal').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#datesetValInput').val(data)
            });

            $('#phonesetVal2').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#phonegetVal2').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#phonegetVal2 ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#phonesetVal2').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#phonesetValInput').val(data)
            });

            $('#emailsetVal2').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#emailgetVal2').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#emailgetVal2 ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#emailsetVal2').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#emailsetValInput').val(data)
            });

            $(document).on('click',function(e){
                $('#getVal').removeClass('active');
                $('#phonegetVal').removeClass('active');
                $('#emailgetVal').removeClass('active');
                $('#phonegetVal2').removeClass('active');
                $('#emailgetVal2').removeClass('active');
                $('#dategetVal').removeClass('active');
                $('.drop_cstm').removeClass('top_index');
            });

            $('#advan_n').on('click', function(e){
                if( $(this).hasClass('active') ){
                    $(this).removeClass('active');
                    $('#show_content_n').slideUp(300);
                }
                else {
                    $(this).addClass('active');
                    $('#show_content_n').slideDown(300);
                }
            });
            $('.rm_items').on('click', function(e){
                e.preventDefault();
                $(this).closest('.upl_items').remove();
            });
            $(window).on('load',function(){
                $('#acntVerfication').modal('show');
            });
        });
    </script>
{/block}
