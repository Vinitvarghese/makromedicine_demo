{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">

            {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
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
                                            <img src="{$user_images}" alt="{$UserData->company_name}">
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
                                            <label for="company-date"> Establishment date </label>
                                            {if !empty($UserData->establishment_date)}
                                                <input type="date" name="establishment_date" id="company-date"
                                                       class="form-control mylos" placeholder="Establishment date"
                                                       value="{$UserData->establishment_date}">
                                            {else}
                                                <input type="date" name="establishment_date" id="company-date"
                                                       class="form-control mylos" placeholder="Establishment date"
                                                       value="{$UserData->brith_day}">
                                            {/if}
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
            {/if}

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

            {if $UserData->status neq 1}
                <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:10px">
                    Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a certificate.</a>
                    After the confirmation of certificate your account will be approved and your products will appear on
                    the top rank of the search list.
                </div>
            {/if}
            <form class="userphotos_form" action="{base_url()}profile/userphotos" method="post">
                <input type="file" style="display:none;" name="userphotos" class="userphotos"/>
            </form>

            <div class="row">
                {include file='../profile/sidebar.tpl'}
                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width pr-s-n">
                        <h2>COMPANY NAME CHANGE NOTIFICATIONS</h2>
                    </div><!-- /.with_buttons -->

                    <form class="userSettings" action="{base_url()}profile/accounts" enctype="multipart/form-data"
                          method="post">
                        <div class="n_checkbox full_width mbm38">
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_comp_email" value="0"/>
                                <input type="checkbox" name="ntf_comp_email" id="forget-me-change-mail" value="1"
                                       {if $account_settings['ntf_comp_email'] eq 1}checked="checked"{/if} />
                                <label for="forget-me-change-mail"></label>
                                <label for="forget-me-change-mail">Get notifications via E-mail</label>
                            </div><!-- /.check_con -->
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_comp_sms" value="0"/>
                                <input type="checkbox" name="ntf_comp_sms" id="forget-me-change-sms" value="1"
                                       {if $account_settings['ntf_comp_sms'] eq 1}checked="checked"{/if} />
                                <label for="forget-me-change-sms"></label>
                                <label for="forget-me-change-sms">Get notifications via SMS</label>
                            </div><!-- /.check_con -->
                        </div><!-- /.n_checkbox -->

                        <div class="with_buttons full_width pr-s-n">
                            <h2>CERTIFICATE CONFIRM NOTIFICATIONS</h2>
                        </div><!-- /.with_buttons -->

                        <div class="n_checkbox full_width mbm38">
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_cert_email" value="0"/>
                                <input type="checkbox" name="ntf_cert_email" id="forget-me-noty-mail" value="1"
                                       {if $account_settings['ntf_cert_email'] eq 1}checked="checked"{/if} />
                                <label for="forget-me-noty-mail"></label>
                                <label for="forget-me-noty-mail">Get notifications via E-mail</label>
                            </div><!-- /.check_con -->
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_cert_sms" value="0"/>
                                <input type="checkbox" name="ntf_cert_sms" id="forget-me-noty-sms" value="1"
                                       {if $account_settings['ntf_cert_sms'] eq 1}checked="checked"{/if} />
                                <label for="forget-me-noty-sms"></label>
                                <label for="forget-me-noty-sms">Get notifications via SMS</label>
                            </div><!-- /.check_con -->
                        </div><!-- /.n_checkbox -->

                        <div class="with_buttons full_width pr-s-n">
                            <h2>PASSWORD NOTIFICATIONS</h2>
                        </div><!-- /.with_buttons -->

                        <div class="n_checkbox full_width mbm38">
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_pass_email" value="0"/>
                                <input type="checkbox" name="ntf_pass_email" id="forget-me-pass-mail" value="1"
                                       {if $account_settings['ntf_pass_email'] eq 1}checked="checked"{/if} />
                                <label for="forget-me-pass-mail"></label>
                                <label for="forget-me-pass-mail">Get notifications via E-mail</label>
                            </div><!-- /.check_con -->
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_pass_sms" value="0"/>
                                <input type="checkbox" name="ntf_pass_sms" id="forget-me-pass-sms" value="1"
                                       {if $account_settings['ntf_pass_sms'] eq 1}checked="checked"{/if} />
                                <label for="forget-me-pass-sms"></label>
                                <label for="forget-me-pass-sms">Get notifications via SMS</label>
                            </div><!-- /.check_con -->
                        </div><!-- /.n_checkbox -->

                        <div class="btn2_ full_width">
                            {*<a href="#" class="n_save2">Save</a>*}
                            <input type="submit" class="btn-save confirm-btn" value="Save">
                        </div><!-- /.btn2_ -->
                    </form>


                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->

    {*

        <style>
            [type="checkbox"]:not(:checked) + label, [type="checkbox"]:checked + label, .confirm-btn {
                font-family: Arial, sans-serif;
            }
        </style>
    <div class="clearfix"></div>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
          {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
            {if empty($UserData->company_name) }
            <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
               <div class="modal-dialog">
                   <div class="modal-content">
                     <form class="addCompanyInformation" action="{base_url()}profile/companyInformation" method="post">
                       <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title data-title">Please enter company information</h4>
                       </div>
                       <div class="modal-body data-body" style="min-height: 500px;max-height:500px;overflow-y:auto;padding-top:35px;">
                         <div class="round-image userphotos-change" data-toggle="tooltip" data-placement="top" title="Image Upload">
                             <img src="{$user_images}" alt="{$UserData->company_name}">
                         </div>
                         <div class="form-group">
                             <label for="company-name"> Company Name </label>
                             {if !empty($UserData->company_name)}
                             <input type="text" name="company_name" id="company-name" class="form-control mylos readonly" placeholder="Company Name" value="{$UserData->company_name}">
                             {else}
                             <input type="text" name="company_name" id="company-name" class="form-control mylos readonly" placeholder="Company Name" value="{$UserData->fullname}">
                             {/if}
                         </div>
                         <div class="form-group ">
                             <label for="company-date"> Establishment date </label>
                             {if !empty($UserData->establishment_date)}
                             <input type="date" name="establishment_date" id="company-date" class="form-control mylos" placeholder="Establishment date" value="{$UserData->establishment_date}">
                             {else}
                             <input type="date" name="establishment_date" id="company-date" class="form-control mylos" placeholder="Establishment date" value="{$UserData->brith_day}">
                             {/if}
                         </div>
                         <div class="form-group ">
                             <label for="company-info">Company Info</label>
                             {if !empty($UserData->establishment_date)}
                             <textarea type="text" name="company_info" id="company-info" cols="5" rows="12" class="form-control mylos">{$UserData->company_info}</textarea>
                             {else}
                             <textarea type="text" name="company_info" id="company-info" cols="5" rows="12" class="form-control mylos">{$UserData->personal_info}</textarea>
                             {/if}
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
            <script type="text/javascript">
              $("#companyModal").modal();
            </script>
            {/if}
          {/if}

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
                         <input type="file" name="certifcate" style="display:none;" class="certifcate-input"/>
                         <button type="button" class="btn btn-danger choose-certifcate">Choose Certifcate</button>
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
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="profile">
                 {if $UserData->status neq 1}
                  <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                        Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a certificate.</a> After the confirmation of certificate your account will be approved and your products will appear on the top rank of the search list.
                    </div>
                  {/if}
                    <div class="col-md-12 no-padding" >
                        <form class="userphotos_form" action="{base_url()}profile/userphotos" method="post">
                          <input type="file" style="display:none;" name="userphotos" class="userphotos"/>
                        </form>
                        <form class="userSettings" action="{base_url()}profile/accounts" enctype="multipart/form-data" method="post">
                            <div class="col-md-3 no-padding profile-left">
                                {include file='../profile/sidebar.tpl'}
                            </div>
                      <div class="col-md-9 profile-right no-padding">
                         <div class="right-content">
                            <div class="col-md-12">
                               <h1 class="main-info-title">COMPANY NAME CHANGE NOTIFICATIONS</h1>
                            </div>
                            <div class="col-md-12 right-content-inner">
                               <div class="form-group">
                                  <p>
                                     <input type="hidden" name="ntf_comp_email" value="0"/>
                                     <input type="checkbox" name="ntf_comp_email" id="forget-me-change-mail" value="1" {if $account_settings['ntf_comp_email'] eq 1}checked="checked"{/if} />
                                     <label for="forget-me-change-mail">Get notifications via e-mail</label>
                                  </p>
                                  <p style="margin-top:15px;">
                                     <input type="hidden" name="ntf_comp_sms" value="0"/>
                                     <input type="checkbox" name="ntf_comp_sms" id="forget-me-change-sms" value="1" {if $account_settings['ntf_comp_sms'] eq 1}checked="checked"{/if} />
                                     <label for="forget-me-change-sms">Get notifications via SMS</label>
                                  </p>
                               </div>
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                         <div class="right-content">
                            <div class="col-md-12">
                               <h1 class="main-info-title">CERTIFICATE CONFIRM NOTIFICATIONS</h1>
                            </div>
                            <div class="col-md-12 right-content-inner">
                               <p>
                                  <input type="hidden" name="ntf_cert_email" value="0"/>
                                  <input type="checkbox" name="ntf_cert_email" id="forget-me-noty-mail" value="1" {if $account_settings['ntf_cert_email'] eq 1}checked="checked"{/if} />
                                  <label for="forget-me-noty-mail">Get notifications via e-mail</label>
                               </p>
                               <p style="margin-top:15px;">
                                  <input type="hidden" name="ntf_cert_sms" value="0"/>
                                  <input type="checkbox" name="ntf_cert_sms" id="forget-me-noty-sms" value="1" {if $account_settings['ntf_cert_sms'] eq 1}checked="checked"{/if} />
                                  <label for="forget-me-noty-sms">Get notifications via SMS</label>
                               </p>
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                         <div class="right-content">
                            <div class="col-md-12">
                               <h1 class="main-info-title">PASSWORD NOTIFICATIONS</h1>
                            </div>
                            <div class="col-md-12 right-content-inner">
                               <p>
                                  <input type="hidden" name="ntf_pass_email" value="0"/>
                                  <input type="checkbox" name="ntf_pass_email" id="forget-me-pass-mail" value="1" {if $account_settings['ntf_pass_email'] eq 1}checked="checked"{/if} />
                                  <label for="forget-me-pass-mail">Get notifications via e-mail</label>
                               </p>
                               <p style="margin-top:15px;">
                                  <input type="hidden" name="ntf_pass_sms" value="0"/>
                                  <input type="checkbox" name="ntf_pass_sms" id="forget-me-pass-sms" value="1" {if $account_settings['ntf_pass_sms'] eq 1}checked="checked"{/if} />
                                  <label for="forget-me-pass-sms">Get notifications via SMS</label>
                               </p>
                               <div class="form-group">
                                  <button type="submit" class="btn-save confirm-btn">Save</button>
                               </div>
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="clearfix"></div>
    *}
    <script type="text/javascript">
        $(document).ready(function () {
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
            });
        });
    </script>
{/block}
