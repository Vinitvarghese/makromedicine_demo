{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">




            <div class="row">
                {include file='../profile/sidebar.tpl'}
                <div class="n_right_section start_with_text">
                    {if isset($message)}
                        {if $message.type=='success'}
                            <script> toastr.success(`{$message.message}`); </script>
                        {else}
                            <script> toastr.error(`{$message.message}`); </script>
                        {/if}

                        <script>
                            setTimeout(function () {
                                window.location.href=window.location.href;
                            }, 5000);
                        </script>
                    {/if}

                    <div class="with_buttons full_width pr-s-n">
                        <h2>Account Confirmation</h2>
                    </div><!-- /.with_buttons -->

                    <div class="full_width account_confirm_desc">
                        <p>
                            A sign confirming the authenticity of the account is displayed next to the username. Submitting a confirmation request is not a guarantee that your account will be verified.
                        </p>

                        <p>
                            To consider your request, you must provide a government-issued ID with a photo, which indicates your name, surname and date of birth
                        </p>
                    </div>

                    <form class="userSettings userSettingsFlex full_width" action="{site_url_multi('/')}profile/account_confirmation" enctype="multipart/form-data" method="post">

                        <div class="n_like_form full_width">
                            <div class="n_first_block">

                                <div class="full_width">
                                    <label>Name <sup>*</sup></label>
                                    <input type="text" name="name" class="name onlyalphabet" required minlength="3"
                {if isset($confirm_data->name)} value="{$confirm_data->name}" readonly {/if} />
                                </div>
                                <!-- /.full_width -->

                                <div class="full_width">
                                    <label>Surname <sup>*</sup></label>
                                    <input type="text" name="surname" class="surname onlyalphabet" minlength="3"
                                        {if isset($confirm_data->surname)} value="{$confirm_data->surname}" readonly {/if} required/>
                                </div><!-- /.full_width -->

                            </div>

                            <div class="n_second_block">
                                <ul class="full_width flex add_edit_p_top add_edit_p_top2 add_edit_p_top222 ">
                                    <li>
                                        <label>&nbsp;</label>
                                        <div class="full_width pr_upload">
                                            <div class="new_upload_btn flex align_center">
                                                <button type="button" class="upload_file_btn">
                                                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.5 18C2.46694 18 0 15.477 0 12.375V4.5C0 4.08595 0.328577 3.75005 0.733289 3.75005C1.13813 3.75005 1.46671 4.08595 1.46671 4.5V12.375C1.46671 14.6497 3.27583 16.5 5.5 16.5C7.72417 16.5 9.53329 14.6497 9.53329 12.375V4.12495C9.53329 2.67751 8.38199 1.50005 6.96671 1.50005C5.55129 1.50005 4.4 2.67751 4.4 4.12495V11.625C4.4 12.2452 4.89347 12.75 5.5 12.75C6.10653 12.75 6.6 12.2452 6.6 11.625V4.5C6.6 4.08595 6.92858 3.75005 7.33329 3.75005C7.73813 3.75005 8.06671 4.08595 8.06671 4.5V11.625C8.06671 13.0725 6.91528 14.25 5.5 14.25C4.08472 14.25 2.93329 13.0725 2.93329 11.625V4.12495C2.93329 1.85023 4.74241 0 6.96671 0C9.19088 0 11 1.85023 11 4.12495V12.375C11 15.477 8.53306 18 5.5 18Z" fill="white"></path>
                                                    </svg>
                                                </button>
                                                <label>Add identity card photo</label>
                                            </div>

                                            <div class="col-md-12 no-padding img-full-right-block img_forece">

                                                <div class="inner-img flex flex_wrap">

                                                    


                                                    {if isset($confirm_data->id)}
                                                        {if !empty($confirm_data->files)}
                                                            {$files=json_decode($confirm_data->files)}

                                                            {foreach $files as $k => $v}
                                                                {$v=str_replace('home/makromed/public_html/demo/', '', $v)}
                                                                {$src=(preg_match('/pdf/', $v)) ? 'templates/default/assets/img/sys/pdf.png' : $v}
                                                                <a href="{base_url($v)}" target="_blank" class="img-upload-group add bitrix">
                                                                    
                                                                    <div class="reload-form-cover-mini">
                                                                        <img src="{base_url($src)}" alt=""
                                                            class=" {if preg_match('/pdf/', $v)} pdf-icon-st {/if} ">
                                                                    </div>
                                                                </a>

                                                            {/foreach}
                                                        {/if}
                                                    {else}
                                                        <div class="img-upload-group add bitrix" var-attr="lab_2">
                                                            <div class="reload-form-upload">
                                                                <label>
                                                                    <input type="file" name="files[]" class="userfile"
                                                                        accept="image/gif,image/jpg,image/png,image/jpeg,application/pdf,image/x-eps"
                                                                        required="">
                                                                    <button type="button"
                                                                        class="mini-upload upload-button" data-id=""
                                                                        data-target="">UPLOAD</button>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="img-upload-group add bitrix add_more_img"
                                                            var-attr="">
                                                            <div class="reload-form-upload">
                                                                <label>
                                                                    <button type="button" class="add-button-photos"
                                                                        data-target="">Add More</button>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    {/if}


                                                </div>


                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>


                        </div>


                        {if !isset($confirm_data->id)}
                            <div class="btn_wrap flex justify_center align_center full_width">
                                <input type="submit" class="n_save"
                                    value="Send">
                            </div>
                        {/if}

                        {if isset($confirm_data->admin_msg) && !empty($confirm_data->admin_msg)}
                            <div class="full_width account_confirm_desc account_cofirm_alert">
                                <p>{$confirm_data->admin_msg}</p>
                            </div>
                        {/if}
                    </form>


                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->


    <script type="text/javascript">
        $(document).ready(function () {
            var fore = 1;

            $(document).on('click', '.add-button-photos', function(e) {
                e.preventDefault();
                fore = fore +1;
                
                if( $('.bitrix').length < 10 ){
                    comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="files[]" class="userfile"
                                    accept="image/gif,image/jpg,image/png,image/jpeg,application/pdf,image/x-eps"
                                    required />
                                <button type="button" class="mini-upload upload-button" data-id=""
                                    data-target="">UPLOAD</button>
                            </label>
                        </div>
                    </div>`;

                    $(comp).insertBefore('.add_more_img');
                }

                e.preventDefault();
                return false;
            });

        });
    </script>
{/block}
