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
    #phone.form-control.inputmask.mylos { border: 0; outline: none; } 
    #phone.form-control.inputmask.mylos:focus { outline: none; }
    </style>

    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="all_modals full_width">
                <div id="createCompany" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="min-height: 300px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>ADD NEW COMPANY</h3>
                                <div class="mod_center_inp change_pss" style="width: 90%;">
                                    <div class="full_width relative">
                                        <p class="text-center">Please add Company name in the field. Later you will be redirected to company details page.</p>
                                    </div>
                                </div><!-- /.mod_center_inp -->
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div id="existingCompany" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="min-height: 300px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>NOTICE</h3>
                                <div class="mod_center_inp change_pss" style="width: 90%;">
                                    <div class="full_width relative">
                                        <p class="text-center">After registration a request will be send administrator of the page for approval.</p>
                                    </div>
                                </div><!-- /.mod_center_inp -->
                            </div>
                        </div>
                    </div>
                    
                </div>                
                {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                    {if empty($UserData->company_name) }
                        <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="addCompanyInformation" action="{base_url()}profile/companyInformation"
                                          method="post" autocomplete="off">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title data-title">Please enter company information</h4>
                                        </div>
                                        <div class="modal-body data-body"
                                             style="min-height: 500px;max-height:500px;overflow-y:auto;padding-top:35px;">
                                            <div class="round-image userphotos-change" data-toggle="tooltip"
                                                 data-placement="top" title="Image Upload">
                                                <img src="{$user_images}" alt="{$UserData->company_name}">
                                            </div>

                                            <div class="form-group">
                                                <label for="company-name"> Company Name </label>
                                                {if !empty($UserData->company_name)}
                                                    <input type="text" name="company_name" id="company-name"
                                                           class="form-control mylos readonly"
                                                           placeholder="Company Name"
                                                           value="{$UserData->company_name}">
                                                {else}
                                                    <input type="text" name="company_name" id="company-name"
                                                           class="form-control mylos readonly"
                                                           placeholder="Company Name"
                                                           value="{$UserData->fullname}">
                                                {/if}
                                            </div>
                                            <div class="form-group ">
                                                <label for="company-date"> Establishment date </label>
                                                {if !empty($UserData->establishment_date)}
                                                    <input type="text" name="establishment_date" id="company-date"
                                                           class="form-control mylos" placeholder="Establishment date"
                                                           value="{$UserData->establishment_date}">
                                                {else}
                                                    <input type="text" name="establishment_date" id="company-date"
                                                           class="form-control mylos" placeholder="Establishment date"
                                                           value="{$UserData->brith_day}">
                                                {/if}
                                            </div>
                                            <div class="form-group ">
                                                <label for="company-info">Company Info</label>
                                                {if !empty($UserData->company_info)}
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
                {/if}
                <div id="changePassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
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

                {* {if $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {/if} *}
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
                        <h3 class="french">ЗАПОЛНЕННОСТЬ ПРОФИЛЯ</h3>
                        <div class="n_gray_box full_width">
                            <ul>
                                <li><span>1. Заполните профиль информацией,</span><span>2. Добавьте продукты</span></li>
                                <li>От степени заполнения профиля зависит количество доступных вам функций сайта</li>
                            </ul>
                        </div><!-- /.n_gray_box -->
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
                        <div class="n_diagram_detail full_width">
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
                        </div><!-- /.n_diagram_detail -->

                        <div class="full_width max-arrange">
                            <form class="userSettings" action="{base_url()}profile/save" enctype="multipart/form-data"
                                  method="post">

                            <div class="n_like_form full_width">
                                <div class="n_first_block">
                                    {if !empty($UserData->fullname)}
                                        <div class="full_width">
                                            <label>Full Name <sup>*</sup></label>
                                            <input type="text" name="fullname" value="{$UserData->fullname}"/>
                                            <input type="hidden" name="group_id" value="{$UserData->user_groups_id}">
                                        </div>
                                        <!-- /.full_width -->
                                    {/if}
                                    {*                                <div class="full_width">*}
                                    {*                                    <label>Surname <sup>*</sup></label>*}
                                    {*                                    <input type="text" value="Buffett" />*}
                                    {*                                </div><!-- /.full_width -->*}

                                    <div class="full_width date_of_brth">
                                        <label>Date of Birth <sup>*</sup></label>
                                        <input type="text" name="brith_day" id="company-date"
                                               class="form-control mylos" placeholder=""
                                               style="width: 265px !important;"
                                               value="{$UserData->brith_day}">
                                        {*<input type="text" class="n_date" value="30" />
                                        <select class="n_select">
                                            <option>January</option>
                                            <option>February</option>
                                            <option>March</option>
                                            <option>April</option>
                                            <option>May</option>
                                            <option>June</option>
                                            <option>July</option>
                                            <option>August</option>
                                        </select>
                                        <input type="text" class="n_year" value="30" />*}
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

                                    {*                                <div class="full_width">*}
                                    {*                                    <label>City, Country <sup>*</sup></label>*}
                                    {*                                    <input type="text" name="address" value="{$UserData->adress}" />*}
                                    {*                                </div><!-- /.full_width -->*}

                                    <div class="full_width" style="margin-bottom: 20px">
                                    <label>Country <sup>*</sup></label>
                                    <select class="selectpicker form-control show-menu-arrow mylos company-country"
                                            name="country_id" data-live-search="true"
                                            data-selected-text-format="count > 1" title="Country" required>
                                        {if $countrys}{foreach $countrys as $key => $value}
                                            <option value="{$value->id}" data-name="{$value->code}"
                                                    {if $value->id eq $UserData->country_id}selected="selected"{/if}>{$value->name}</option>
                                        {/foreach}{/if}
                                    </select>
                                </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Your Address</label>
                                        <input id="pac-input" type="text" name="address" value="{$UserData->adress}" required/>
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
                                            data-co="{$UserData->country_code}">

                                        {* <select class="n_phone_code" name="country_code">
                                        {if $UserData->display_phone == 1}
                                            <option selected value="{$UserData->country_code}">+{$UserData->country_code}</option>
                                            <option data-countryCode="AZ" value="994">+994</option>
                                        {else}
                                            <option selected data-countryCode="AZ" value="994">+994</option>
                                        {/if}
                                            <option data-countryCode="AZ" value="994">+994</option>
                                            <option data-countryCode="DZ" value="213">+213</option>
                                            <option data-countryCode="AD" value="376">+376</option>
                                            <option data-countryCode="AO" value="244">+244</option>
                                            <option data-countryCode="AI" value="1264">+1264</option>
                                            <option data-countryCode="AG" value="1268">+1268</option>
                                            <option data-countryCode="AR" value="54">+54</option>
                                            <option data-countryCode="AM" value="374">+374</option>
                                            <option data-countryCode="AW" value="297">+297</option>
                                            <option data-countryCode="AU" value="61">+61</option>
                                            <option data-countryCode="AT" value="43">+43</option>
                                            <option data-countryCode="BS" value="1242">+1242</option>
                                            <option data-countryCode="BH" value="973">+973</option>
                                            <option data-countryCode="BD" value="880">+880</option>
                                            <option data-countryCode="BB" value="1246">+1246</option>
                                            <option data-countryCode="BY" value="375">+375</option>
                                            <option data-countryCode="BE" value="32">+32</option>
                                            <option data-countryCode="BZ" value="501">+501</option>
                                            <option data-countryCode="BJ" value="229">+229</option>
                                            <option data-countryCode="BM" value="1441">+1441</option>
                                            <option data-countryCode="BT" value="975">+975</option>
                                            <option data-countryCode="BO" value="591">+591</option>
                                            <option data-countryCode="BA" value="387">+387</option>
                                            <option data-countryCode="BW" value="267">+267</option>
                                            <option data-countryCode="BR" value="55">+55</option>
                                            <option data-countryCode="BN" value="673">+673</option>
                                            <option data-countryCode="BG" value="359">+359</option>
                                            <option data-countryCode="BF" value="226">+226</option>
                                            <option data-countryCode="BI" value="257">+257</option>
                                            <option data-countryCode="KH" value="855">+855</option>
                                            <option data-countryCode="CM" value="237">+237</option>
                                            <option data-countryCode="CA" value="1">+1</option>
                                            <option data-countryCode="CV" value="238">+238</option>
                                            <option data-countryCode="KY" value="1345">+1345</option>
                                            <option data-countryCode="CF" value="236">+236</option>
                                            <option data-countryCode="CL" value="56">+56</option>
                                            <option data-countryCode="CN" value="86">+86</option>
                                            <option data-countryCode="CO" value="57">+57</option>
                                            <option data-countryCode="KM" value="269">+269</option>
                                            <option data-countryCode="CG" value="242">+242</option>
                                            <option data-countryCode="CK" value="682">+682</option>
                                            <option data-countryCode="CR" value="506">+506</option>
                                            <option data-countryCode="HR" value="385">+385</option>
                                            <option data-countryCode="CU" value="53">+53</option>
                                            <option data-countryCode="CY" value="90392">+90392</option>
                                            <option data-countryCode="CY" value="357">+357</option>
                                            <option data-countryCode="CZ" value="42">+42</option>
                                            <option data-countryCode="DK" value="45">+45</option>
                                            <option data-countryCode="DJ" value="253">+253</option>
                                            <option data-countryCode="DM" value="1809">+1809</option>
                                            <option data-countryCode="DO" value="1809">+1809</option>
                                            <option data-countryCode="EC" value="593">+593</option>
                                            <option data-countryCode="EG" value="20">+20</option>
                                            <option data-countryCode="SV" value="503">+503</option>
                                            <option data-countryCode="GQ" value="240">+240</option>
                                            <option data-countryCode="ER" value="291">+291</option>
                                            <option data-countryCode="EE" value="372">+372</option>
                                            <option data-countryCode="ET" value="251">+251</option>
                                            <option data-countryCode="FK" value="500">+500</option>
                                            <option data-countryCode="FO" value="298">+298</option>
                                            <option data-countryCode="FJ" value="679">+679</option>
                                            <option data-countryCode="FI" value="358">+358</option>
                                            <option data-countryCode="FR" value="33">+33</option>
                                            <option data-countryCode="GF" value="594">+594</option>
                                            <option data-countryCode="PF" value="689">+689</option>
                                            <option data-countryCode="GA" value="241">+241</option>
                                            <option data-countryCode="GM" value="220">+220</option>
                                            <option data-countryCode="GE" value="7880">+7880</option>
                                            <option data-countryCode="DE" value="49">+49</option>
                                            <option data-countryCode="GH" value="233">+233</option>
                                            <option data-countryCode="GI" value="350">+350</option>
                                            <option data-countryCode="GR" value="30">+30</option>
                                            <option data-countryCode="GL" value="299">+299</option>
                                            <option data-countryCode="GD" value="1473">+1473</option>
                                            <option data-countryCode="GP" value="590">+590</option>
                                            <option data-countryCode="GU" value="671">+671</option>
                                            <option data-countryCode="GT" value="502">+502</option>
                                            <option data-countryCode="GN" value="224">+224</option>
                                            <option data-countryCode="GW" value="245">+245</option>
                                            <option data-countryCode="GY" value="592">+592</option>
                                            <option data-countryCode="HT" value="509">+509</option>
                                            <option data-countryCode="HN" value="504">+504</option>
                                            <option data-countryCode="HK" value="852">+852</option>
                                            <option data-countryCode="HU" value="36">+36</option>
                                            <option data-countryCode="IS" value="354">+354</option>
                                            <option data-countryCode="IN" value="91">+91</option>
                                            <option data-countryCode="ID" value="62">+62</option>
                                            <option data-countryCode="IR" value="98">+98</option>
                                            <option data-countryCode="IQ" value="964">+964</option>
                                            <option data-countryCode="IE" value="353">+353</option>
                                            <option data-countryCode="IL" value="972">+972</option>
                                            <option data-countryCode="IT" value="39">+39</option>
                                            <option data-countryCode="JM" value="1876">+1876</option>
                                            <option data-countryCode="JP" value="81">+81</option>
                                            <option data-countryCode="JO" value="962">+962</option>
                                            <option data-countryCode="KZ" value="7">+7</option>
                                            <option data-countryCode="KE" value="254">+254</option>
                                            <option data-countryCode="KI" value="686">+686</option>
                                            <option data-countryCode="KP" value="850">+850</option>
                                            <option data-countryCode="KR" value="82">+82</option>
                                            <option data-countryCode="KW" value="965">+965</option>
                                            <option data-countryCode="KG" value="996">+996</option>
                                            <option data-countryCode="LA" value="856">+856</option>
                                            <option data-countryCode="LV" value="371">+371</option>
                                            <option data-countryCode="LB" value="961">+961</option>
                                            <option data-countryCode="LS" value="266">+266</option>
                                            <option data-countryCode="LR" value="231">+231</option>
                                            <option data-countryCode="LY" value="218">+218</option>
                                            <option data-countryCode="LI" value="417">+417</option>
                                            <option data-countryCode="LT" value="370">+370</option>
                                            <option data-countryCode="LU" value="352">+352</option>
                                            <option data-countryCode="MO" value="853">+853</option>
                                            <option data-countryCode="MK" value="389">+389</option>
                                            <option data-countryCode="MG" value="261">+261</option>
                                            <option data-countryCode="MW" value="265">+265</option>
                                            <option data-countryCode="MY" value="60">+60</option>
                                            <option data-countryCode="MV" value="960">+960</option>
                                            <option data-countryCode="ML" value="223">+223</option>
                                            <option data-countryCode="MT" value="356">+356</option>
                                            <option data-countryCode="MH" value="692">+692</option>
                                            <option data-countryCode="MQ" value="596">+596</option>
                                            <option data-countryCode="MR" value="222">+222</option>
                                            <option data-countryCode="YT" value="269">+269</option>
                                            <option data-countryCode="MX" value="52">+52</option>
                                            <option data-countryCode="FM" value="691">+691</option>
                                            <option data-countryCode="MD" value="373">+373</option>
                                            <option data-countryCode="MC" value="377">+377</option>
                                            <option data-countryCode="MN" value="976">+976</option>
                                            <option data-countryCode="MS" value="1664">+1664</option>
                                            <option data-countryCode="MA" value="212">+212</option>
                                            <option data-countryCode="MZ" value="258">+258</option>
                                            <option data-countryCode="MN" value="95">+95</option>
                                            <option data-countryCode="NA" value="264">+264</option>
                                            <option data-countryCode="NR" value="674">+674</option>
                                            <option data-countryCode="NP" value="977">+977</option>
                                            <option data-countryCode="NL" value="31">+31</option>
                                            <option data-countryCode="NC" value="687">+687</option>
                                            <option data-countryCode="NZ" value="64">+64</option>
                                            <option data-countryCode="NI" value="505">+505</option>
                                            <option data-countryCode="NE" value="227">+227</option>
                                            <option data-countryCode="NG" value="234">+234</option>
                                            <option data-countryCode="NU" value="683">+683</option>
                                            <option data-countryCode="NF" value="672">+672</option>
                                            <option data-countryCode="NP" value="670">+670</option>
                                            <option data-countryCode="NO" value="47">+47</option>
                                            <option data-countryCode="OM" value="968">+968</option>
                                            <option data-countryCode="PW" value="680">+680</option>
                                            <option data-countryCode="PA" value="507">+507</option>
                                            <option data-countryCode="PG" value="675">+675</option>
                                            <option data-countryCode="PY" value="595">+595</option>
                                            <option data-countryCode="PE" value="51">+51</option>
                                            <option data-countryCode="PH" value="63">+63</option>
                                            <option data-countryCode="PL" value="48">+48</option>
                                            <option data-countryCode="PT" value="351">+351</option>
                                            <option data-countryCode="PR" value="1787">+1787</option>
                                            <option data-countryCode="QA" value="974">+974</option>
                                            <option data-countryCode="RE" value="262">+262</option>
                                            <option data-countryCode="RO" value="40">+40</option>
                                            <option data-countryCode="RU" value="7">+7</option>
                                            <option data-countryCode="RW" value="250">+250</option>
                                            <option data-countryCode="SM" value="378">+378</option>
                                            <option data-countryCode="ST" value="239">+239</option>
                                            <option data-countryCode="SA" value="966">+966</option>
                                            <option data-countryCode="SN" value="221">+221</option>
                                            <option data-countryCode="CS" value="381">+381</option>
                                            <option data-countryCode="SC" value="248">+248</option>
                                            <option data-countryCode="SL" value="232">+232</option>
                                            <option data-countryCode="SG" value="65">+65</option>
                                            <option data-countryCode="SK" value="421">+421</option>
                                            <option data-countryCode="SI" value="386">+386</option>
                                            <option data-countryCode="SB" value="677">+677</option>
                                            <option data-countryCode="SO" value="252">+252</option>
                                            <option data-countryCode="ZA" value="27">+27</option>
                                            <option data-countryCode="ES" value="34">+34</option>
                                            <option data-countryCode="LK" value="94">+94</option>
                                            <option data-countryCode="SH" value="290">+290</option>
                                            <option data-countryCode="KN" value="1869">+1869</option>
                                            <option data-countryCode="SC" value="1758">+1758</option>
                                            <option data-countryCode="SD" value="249">+249</option>
                                            <option data-countryCode="SR" value="597">+597</option>
                                            <option data-countryCode="SZ" value="268">+268</option>
                                            <option data-countryCode="SE" value="46">+46</option>
                                            <option data-countryCode="CH" value="41">+41</option>
                                            <option data-countryCode="SI" value="963">+963</option>
                                            <option data-countryCode="TW" value="886">+886</option>
                                            <option data-countryCode="TJ" value="7">+7</option>
                                            <option data-countryCode="TH" value="66">+66</option>
                                            <option data-countryCode="TG" value="228">+228</option>
                                            <option data-countryCode="TO" value="676">+676</option>
                                            <option data-countryCode="TT" value="1868">+1868</option>
                                            <option data-countryCode="TN" value="216">+216</option>
                                            <option data-countryCode="TR" value="90">+90</option>
                                            <option data-countryCode="TM" value="7">+7</option>
                                            <option data-countryCode="TM" value="993">+993</option>
                                            <option data-countryCode="TC" value="1649">+1649</option>
                                            <option data-countryCode="TV" value="688">+688</option>
                                            <option data-countryCode="UG" value="256">+256</option>
                                            <option data-countryCode="GB" value="44">+44</option>
                                            <option data-countryCode="UA" value="380">+380</option>
                                            <option data-countryCode="AE" value="971">+971</option>
                                            <option data-countryCode="UY" value="598">+598</option>
                                            <option data-countryCode="US" value="1">+1</option>
                                            <option data-countryCode="UZ" value="7">+7</option>
                                            <option data-countryCode="VU" value="678">+678</option>
                                            <option data-countryCode="VA" value="379">+379</option>
                                            <option data-countryCode="VE" value="58">+58</option>
                                            <option data-countryCode="VN" value="84">+84</option>
                                            <option data-countryCode="VG" value="84">+1284</option>
                                            <option data-countryCode="VI" value="84">+1340</option>
                                            <option data-countryCode="WF" value="681">+681</option>
                                            <option data-countryCode="YE" value="969">+969</option>
                                            <option data-countryCode="YE" value="967">+967</option>
                                            <option data-countryCode="ZM" value="260">+260</option>
                                            <option data-countryCode="ZW" value="263">+263</option>
                                        </select> 

                                        <input type="text" class="n_phone_num" name="phone" value="{$UserData->phone}" required/>
                                        *}
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



                                        {*<div class="drop_cstm adj">
                                            <button type="button" id="setValPhone" class="setVal"><span>
                                                    <img
                                                            {if $UserData->display_phone == 1}
                                                            src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                         alt="Public"
                                                            {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Private"
                                                            {/if}
                                                    ></span>
                                                <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}"/>
                                            </button>
                                            <div class="drop_down_select_ getVal" id="getValPhone">
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
                                        </div>*}
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


                                       {* <div class="drop_cstm adj">
                                            <button type="button" id="emailsetVal" class="setVal">
                                                <span>
                                                <img
                                                        {if $UserData->display_email == 1}
                                                            src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                            alt="Public"
                                                        {else}
                                                            src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                            alt="Private"
                                                        {/if}
                                                        alt="Public">
                                                    </span>
                                                <i class="fa fa-caret-down"></i>
                                            </button>
                                            <div class="drop_down_select getVal" id="emailgetVal">
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
                                        </div>*}

                                        {*<div class="drop_cstm adj">
                                            <input type="hidden" value="{$UserData->display_email}" name="display_email" id="setValEmailInput">
                                            <button type="button" id="setValEmail" class="setVal"><span>
                                                    <img
                                                            src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                         alt="Public"
                                                            {if $UserData->display_email == 1}
                                                                src="{base_url('templates/default/assets/img/sys/earth.png')}"
                                                                alt="Public"
                                                            {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Private"
                                                            {/if}
                                                    ></span>
                                                <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}"/>
                                            </button>
                                            <div class="drop_down_select_ getVal" id="phonegetVal2">
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
                                        </div>*}
                                    </div><!-- /.full_width -->
                                    {*<hr>*}
                                    {* <div class="full_width" style="margin-bottom: 20px">
                                        <label>Country</label>
                                        <select class="selectpicker form-control show-menu-arrow mylos company-country"
                                                name="country_id" data-live-search="true"
                                                data-selected-text-format="count > 1" title="Country" required>
                                            {if $countrys}{foreach $countrys as $key => $value}
                                                <option value="{$value->id}" data-name="{$value->code}"
                                                        {if $value->id eq $UserData->country_id}selected="selected"{/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </div><!-- /.full_width --> *}
                                    <hr>
                                    <div class="full_width" style="margin-bottom: 20px">
                                        <label>Your Position <sup>*</sup></label>
                                        {*                                    <input type="text" value="Business Magnate" />*}
                                        <select class="selectpicker form-control show-menu-arrow mylos"
                                                name="position" data-live-search="true" required
                                                data-selected-text-format="count > 1" title="Position">
                                            {if $person_type}{foreach $person_type as $key => $value}
                                                <option value="{$value->id}" {if $UserData->position eq $value->id} selected {/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        <label>Company</label>
                                        <input type="text" name="company_name" value="{$UserData->company_name}" class="company-input-box"/>
                                        <label class="alert alert-warning company-warning-box">
                                            <i class="fa fa-exclamation-circle"></i> If you have company please add company.
                                        </label>
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

    {if isset($smarty.get.same_comp)}
        <script>
            var err = 'Account already exists on the system with that company name.  Please enter a different company name.';
            $(document).ready(function () {
                toastr.error(err);
            });
        </script>
    {/if}
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
                                <input type="file" name="userfile[` + value + `]">
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
                            window.location = '';
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


            $(".company-input-box").autocomplete({
                source: "https://demo.makromedicine.com/search-company/",
                // source: availableTags,
                minLength: 2,
                'open': function(e, ui) {
                    $('.ui-autocomplete').append("<li class='ui-menu-item'><div id='ui-id-xxx' class='ui-menu-item-wrapper'><a href='#' data-toggle='modal' data-target='#createCompany'>Add New Company</a></div></li>");
                },
                select: function(event, ui) {
                    if(ui["item"] !== undefined) {
                        $("#existingCompany").modal();
                    }
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
