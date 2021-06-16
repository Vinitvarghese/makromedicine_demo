<div class="clearfix"></div>
<footer class="footer col-md-12 no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-12 no-padding">
                <ul class="social">
                    <li>
                        <a target="_blank" href="{get_setting('facebook')}">
                            <img src="{base_url('templates/default/assets/img/sys/facebook.svg')}" alt="Facebook">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="{get_setting('instagram')}">
                            <img src="{base_url('templates/default/assets/img/sys/instagram.svg')}" alt="Instagram">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="{get_setting('youtube')}">
                            <img src="{base_url('templates/default/assets/img/sys/youtube.svg')}" alt="Youtube">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="copright">
                    <p>{translate('copyright', true)} {date('Y')} © <a href="{site_url_multi('/')}">MakroMedicine</a>.
                        <span class="hidden-xs">{translate('all_right_reserved', true)}</span></p>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="modal" id="suggestionModal" tabindex="-1" role="dialog" aria-labelledby="suggestionModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document" style="z-index: 9999; width: 60%;">
        <div class="modal-content" id="test-list">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title pull-left" id="suggestionModalTitle">Add your suggestion</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="suggestionForm" class="col-md-12" enctype='multipart/form-data'>
                        <input type="hidden" name="suggestion" value="1">
                        <input type="hidden" name="type" value="">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input class="form-control" type="text" name="name" required="">
                        </div>
                        <div class="form-group fr-2">
                            <label for="">Description</label>
                            <textarea maxlength="250" class="form-control" type="text" rows="4" name="text"></textarea>
                        </div>
                        <div class="form-group fr-3" style="display: none;">
                            <label for="">Molecular formula</label>
                            <textarea maxlength="250" class="form-control" type="text" rows="4" name="text2"></textarea>
                        </div>
                        <button type="submit" class="mybutton"><i class="fa fa-check"></i>&nbsp;ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{if isset($send_mail) and $send_email eq true}
    <script type="text/javascript">
        toastr.success('New password has been sent to your mail address');
    </script>
{/if}
{if isset($confirm_account) and $confirm_account eq true}
    <script type="text/javascript">
        toastr.error('Server error. Your account not confirmed.');

    </script>
{/if}
<div id="termModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{$terms->title}</h4>
            </div>
            <div class="modal-body" style="max-height: 70vh;overflow: auto;">
                <p style="font-size:16px;">{$terms->description|unescape: "html" nofilter}</p>
            </div>
            <div class="modal-footer">
				{* // TODO: HTML fromat  *}
				<button type="button" class="btn btn-success m-0" id="iagree" style="    padding: 7px 20px;">I Agree</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- -->


<div id="block_user_or_company" class="custom_modal " >

    <div class="flex direction_column align_center custom_modal_in">
        <button class="close_custom_modal hide_custom_modal_btn" type="button"></button>
        <input type="hidden" id="block_id" />
        <input type="hidden" id="block_type" />

        <h4>Block <span class="c_name"></span>?</h4>

        <p>
            If this page is in your subscriptions, then it will be removed. You will not see this page. If you want to unblock a user, go to the settings, the list of blocked users and click unblock
        </p>

        <img src="" class="custom_modal_image c_image" />

        <div class="flex direction_column modal_reason_box align_center">
            <h6>Profile <span class="c_name"></span> can no longer:</h6>
            <ul class="flex direction_column ">
                <li>• 	See your page</li>
                <li>• 	Send you messages</li>
                <li>• 	Add you to subscriptions</li>
                <li>• 	Participate in your tenders</li>
            </ul>
        </div>

        <div class="full_width flex align_center justify_center form_add_product_btns">
            <button type="button" class="close-product-btn hide_custom_modal_btn" >Cancel</button>
            <button type="button" class="submit-product-btn  danger_btn block_company_or_user_modal_btn" >Block</button>
        </div>

    </div>
    <!-- /.modal-dialog -->
</div>

<div id="complain_user_or_company" class="custom_modal " >

    <form action="" method="post" id="complain_user_or_company_form" class="flex direction_column align_center custom_modal_in">
        <button class="close_custom_modal hide_custom_modal_btn" type="button"></button>
        <input type="hidden" id="complain_id" name="complain_id" />
        <input type="hidden" id="complain_type" name="complain_type" />
        <input type="hidden" id="complain_user_or_company" name="complain_user_or_company" value="true" />

        <h4>Complain</h4>

        <p>The user will not know who exactly sent the complaint</p>

        <div class="flex direction_column modal_reason_box align_center">
            <h6>State the reason:</h6>
            <ul class="flex direction_column complain_list">

                {if isset($complain_reasons) && !empty($complain_reasons)}
                    {foreach $complain_reasons as $k => $v}
                        <li>
                            <label class="new_checkbox flex align_center">
                                <input type="checkbox" name="complain_ids[]" value="{$v->id}" class="work_place_until_now">
                                <span>{$v->name}</span>
                            </label>
                        </li>
                    {/foreach}
                {/if}

                <li class="n_like_form">
                    <div class="full_width">
                        <label>Describe the reason</label>
                        <textarea type="text" name="comment" id="comment" ></textarea>
                    </div>
                </li>
            </ul>
        </div>

        <div class="full_width flex align_center justify_center form_add_product_btns">
            <button type="button" class="close-product-btn hide_custom_modal_btn" >Cancel</button>
            <button type="button" class="submit-product-btn  danger_btn complain_company_or_user_modal_btn" >Report</button>
        </div>

    </form>
    <!-- /.modal-dialog -->
</div>
<!-- -->

<div id="remove_company" class="custom_modal " >

    <form action="" method="post" id="remove_company_form" class="flex direction_column align_center custom_modal_in">
        <input type="hidden" name="remove_company" value="true" />
        <input type="hidden" name="removed_company_id" id="removed_company_id" value="" />
        <button class="close_custom_modal hide_custom_modal_btn" type="button"></button>

        <h4>Delete Company</h4>

        <p>The user will not know who exactly sent the complaint</p>

        <div class="flex direction_column modal_reason_box align_center">
            <h6>State the reason:</h6>
            <ul class="flex direction_column complain_list">

                {if isset($complain_reasons) && !empty($complain_reasons)}
                    {foreach $complain_reasons as $k => $v}
                        <li>
                            <label class="new_checkbox flex align_center">
                                <input type="checkbox" name="complain_ids[]" value="{$v->id}" class="work_place_until_now">
                                <span>{$v->name}</span>
                            </label>
                        </li>
                    {/foreach}
                {/if}

                <li class="n_like_form">
                    <div class="full_width">
                        <label>Describe the reason</label>
                        <textarea type="text" name="comment" id="comment" ></textarea>
                    </div>
                </li>
            </ul>
        </div>

        <div class="full_width flex align_center justify_center form_add_product_btns">
            <button type="button" class="close-product-btn hide_custom_modal_btn" >Cancel</button>
            <button type="button" class="submit-product-btn  danger_btn delete_company_modal_btn" >Delete</button>
        </div>

    </form>
    <!-- /.modal-dialog -->
</div>

<!-- -->

<div id="page_notification_modal" class="custom_modal " >

    <div class="flex direction_column align_center custom_modal_in custom_modal_in_notif">
        <div class="full_width flex justify_between">
            <a href="javascript:" target="_blank" class="flex align_center news_list_company_info notif_company_info">
                <img src="" />
                <span></span>
            </a>

            <button class="close_custom_modal hide_custom_modal_btn pos_rel" type="button"></button>
        </div>


        <h4>Notifications</h4>

        <p>You Have <span class="page_notif_count">112</span> readed notifications</p>

        <div class="flex direction_column modal_reason_box align_center">
            <ul class="full_width flex notif_tab_btns justify_center">
                <li><a href="#" class="active" data-type="1" >New notifications</a> </li>
                <li><a href="#" data-type="0">Read notifications</a> </li>
            </ul>

            <div class="full_width page_popup_notif_box">
                <ul class="full_width flex direction_column page_popup_notif_list">

                </ul>
            </div>
        </div>



    </div>
    <!-- /.modal-dialog -->
</div>
<!-- -->


<!-- /.modal -->
{if isset($messages)}
    <button class="open-button" onclick="openForm()">Chat</button>
    <div class="chat-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <button type="button" class="cbtn cancel" onclick="closeForm()">Chat</button>
            <ul class="follower">
                {foreach from=$messages item=message}
                    <li><a id="sidebar-user-box" data-sent-by="{$user.id}" data-c-id="{$message.c_id}"
                           data-id="{$message.id}"
                           data-image="{if $message.images}/uploads/catalog/users/{$message.images}{else}/uploads/catalog/users/avatar-placeholder.png{/if}"
                           data-last="" data-href="{base_url('messages/index')}/{$message.id}">
                            <img src="{if $message.images}/uploads/catalog/users/{$message.images}{else}/uploads/catalog/users/avatar-placeholder.png{/if}"/>
                            {if isset($message.unread)}
                                <span class="badge alert-danger">{$message.id}</span>
                            {/if}
                            {if $message.company_name}{$message.company_name}{else}{$message.fullname}{/if}
                        </a>
                    </li>
                {/foreach}
            </ul>
        </form>
    </div>
{/if}
{literal}
    <style>
        * {
            box-sizing: border-box;
        }

        /* Button used to open the chat form - fixed at the bottom of the page */
        .open-button {
            background-color: #2196f3;
            color: white;
            padding: 10px 10px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 0px;
            right: 0;
            width: 270px;
            z-index: 9998;
        }

        #myForm {
            z-index: 9999;
        }

        .follower {
        }

        .follower li {
            width: 100%;
            list-style: none;
            border-bottom: 1px solid #dfdfdf;
        }

        .follower li a {
            color: #485e92;
            padding: 15px;
            font-weight: bold;
            display: block;
            width: 100%;
        }

        .follower li a:hover {
            background-color: #efefef;
            text-decoration: none;
        }

        .follower li a img {
            background-color: #fff;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            float: left;
            margin-right: 15px;
        }

        .ready-player-3 {
            margin: 4px 0;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 0px;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            width: 270px;
            background-color: white;
        }

        /* Set a style for the submit/send button */
        .form-container .cbtn {
            background-color: #2196f3;
            color: white;
            padding: 10px 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: #2196f3;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }
    </style>
    <script type="text/javascript">
        function openForm() {
            $('#myForm').slideToggle();
        }

        function closeForm() {
            $('#myForm').slideToggle();
        }
    </script>
{/literal}

<div id="existingCompany" class="modal fade" role="dialog" >
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

<script charset="utf-8"
        src="{base_url('templates/default/assets/plugin/inputmask/dist/min/jquery.inputmask.bundle.min.js')}"></script>
<script charset="utf-8"
        src="{base_url('templates/default/assets/plugin/inputmask/dist/min/inputmask/inputmask.phone.extensions.min.js')}"></script>
<script charset="utf-8"
        src="{base_url('templates/default/assets/plugin/jquery-validation/dist/jquery.validate.min.js')}"></script>
<script charset="utf-8" src="{base_url('templates/default/assets/plugin/ckeditor/ckeditor.js')}"></script>

<script charset="utf-8" src="{base_url('templates/default/assets/js/function.js?v=394994')}"></script>

    <script charset="utf-8" src="{base_url('templates/default/assets/js/main.js')}?v={uniqid()}"></script>


<script src="{base_url('templates/default/assets/audio-player/dist/js/green-audio-player.js')}?v={uniqid()}"></script>
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>

<script charset="utf-8" type="text/javascript" src="{base_url('templates/default/assets/js/record.js?v=')}{time()}"></script>
<script  src="{base_url('templates/default/assets/js/jquery.numeric.min.js')}"></script>
<script  src="{base_url('templates/default/assets/js/slick.js')}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if(typeof GreenAudioPlayer !== 'undefined') {
            GreenAudioPlayer.init({
                selector: '.player-with-download',
                stopOthersOnPlay: true,
                showDownloadButton: true
            });
        }
    });


    $(document).ready(function () {

        $('.choose_certifcate').change(function(){
            var bu=$(this),
                file = bu.get(0).files[0],
                show_certificate=$('.show_certificate');

            if(file){
                var file_name = file.name;

                show_certificate.addClass('active').attr({ 'href' : 'javascript:', 'target' : '_self' }).text(file_name);

            }else{
                show_certificate.removeClass('active').attr({ 'href' : 'javascript:', 'target' : '_self' }).text('');
            }
        });

        $('.open_close_block_menu_btn').click(function () {
            $('.open_close_block_menu_list').toggleClass('active');
        });

        $('.block_user_or_company_btn').click(function (e) {
            e.preventDefault();

            $('.open_close_block_menu_list').removeClass('active');

            var bu=$(this),
                id=bu.data("id"),
                name=bu.data("name"),
                image=bu.data("image"),
                type=bu.data("type");

            $('#block_id').val(id);
            $('#block_type').val(type);

            $('.c_name').text(name);

            $('.c_image').attr("src", image);

            $('#block_user_or_company').addClass('active');
        });

        /**/
        $('.block_company_or_user_modal_btn').click(function () {
            var bu=$(this);

            $.ajax({
                url :  redirect_url+'profile/blocked_users',
                type : 'POST',
                data : { id  : $('#block_id').val(), block_user_or_company : true, block_type : $('#block_type').val()},
                dataType : 'json',
                cache : false,
                success : function (res) {
                    if (res.type=="success"){

                        bu.parents('.custom_modal').find(".hide_custom_modal_btn:first").trigger("click");

                        toastr.success(res.message);
                    }else{
                        toastr.error(res.message);
                    }
                }
            });

        });

        /**/
        $('.complain_user_or_company_btn').click(function (e) {
            e.preventDefault();

            $('.open_close_block_menu_list').removeClass('active');

            var bu=$(this),
                id=bu.data("id"),
                name=bu.data("name"),
                image=bu.data("image"),
                type=bu.data("type");

            $('#complain_id').val(id);
            $('#complain_type').val(type);

            $('#complain_user_or_company').addClass('active');
        });

        $('.complain_company_or_user_modal_btn').click(function () {
            var bu=$(this);

            var form_data=new FormData($('#complain_user_or_company_form')[0]);


            $.ajax({
                url :  redirect_url+'profile/blocked_users',
                type : 'POST',
                data : form_data,
                dataType : 'json',
                cache : false,
                contentType: false,
                processData: false,
                success : function (res) {
                    if (res.type=="success"){

                        bu.parents('.custom_modal').find(".hide_custom_modal_btn:first").trigger("click");

                        toastr.success(res.message);

                        document.getElementById('complain_user_or_company_form').reset();
                    }else{
                        toastr.error(res.message);
                    }
                }
            });

        });




        /**/
        function getPageNotificationForPopup(page_id, notif_type){

            $.ajax({
                url :  redirect_url+'profile/get_page_notification',
                type : 'POST',
                data : { page_id : page_id, notif_type : notif_type },
                dataType : 'json',
                cache : false,
                success : function (res) {
                    if (res.data){
                        var li='';

                        for(item of res.data){
                            li +="<li>";
                            li +="<p>"+item.title+"</p>";
                            li +="<span>"+item.date+"</span>";
                            li +="</li>";
                        }

                        $('.page_popup_notif_list').html(li);

                    }else{
                        $('.page_popup_notif_list').html('');

                        toastr.error(res.message);
                    }
                }
            });
        }

        $(document).on('click', '.notif_tab_btns li a', function (e) {
            e.preventDefault();

            var bu=$(this),
                id=$('.notif_and_count').data('id'),
                type=bu.data('type');

            $('.notif_tab_btns li a').removeClass('active');
            bu.addClass('active');

            getPageNotificationForPopup(id, type);

        });

        $(document).ready(function () {
            $('.notif_and_count').click(function () {
                var bu=$(this),
                    id=bu.data('id'),
                    name=bu.data('name'),
                    logo=bu.data('logo'),
                    count=bu.data('count');

                $('.notif_company_info img').attr('src', logo);
                $('.notif_company_info span').text(name);

                $('.page_notif_count').text(count);

                $('#page_notification_modal').addClass('active');


                getPageNotificationForPopup(id, 1);

            });
        });



        /**/
        $('.hide_custom_modal_btn').click(function () {
            $(this).parents('.custom_modal').removeClass('active');
        });

        /**/

        function makeNumeric(){
            $('#company-ext, #phone').each(function (index, item) {
                var id=$(item).attr('id');

               $(item).removeAttr('id');

               if(id=='company-ext'){
                   $(item).addClass('company-ext');
               }
            });

            $(".company-ext, .numeric, .day_input, .year_input").numeric({ negative: false }).on('paste keyup', function () {
                var bu=$(this),
                    val=$.trim(bu.val());

                if(val.indexOf('.') != -1){
                    bu.val(val.replace('.', ''));
                }
            });

        }

        makeNumeric();

        $('.confirm-btn').click(function () {
           setTimeout(makeNumeric, 1000);
        });


        
        	/**/
        $('.edit_people_group').click(function (e) {
            e.preventDefault();
            var bu=$(this),
                buttons_lab=bu.parents('.buttons_lab'),
                people_box=bu.parents('li'),
                group_id=people_box.find('.group_id');

            buttons_lab.addClass('active');
            group_id.prop('disabled', false);

            return false;
        });

        $('.edit_people_group_done').click(function (e) {
            e.preventDefault();
            var bu=$(this),
                buttons_lab=bu.parents('.buttons_lab'),
                people_box=bu.parents('li'),
                group_id=people_box.find('.group_id'),
                role_id =group_id.val(),
                group_text=group_id.find('option:selected').text(),
                id=group_id.data('id'),
                to_user_id=group_id.data('to-user'),
                page_name=group_id.data('page-name');
                company_id=bu.data('company_id');

            buttons_lab.removeClass('active');
            group_id.prop('disabled', true);

            people_box.find('.people_position_name').text(group_text);


            $.ajax({
                url : site_url +'pages/{$UserData->slug}/people',
                type : 'POST',
                data : { role_id : role_id, group_text : group_text, id : id, to_user_id : to_user_id, page_name :
                page_name, company_id : company_id },
                dataType : 'json',
                cache : false,
                success : function (res) {

                }
            });

            return false;
        });

        $('.refuse_people_group').click(function (e) {
            e.preventDefault();
            var bu=$(this),
                buttons_lab=bu.parents('.buttons_lab'),
                people_box=bu.parents('li'),
                group_id=people_box.find('.group_id');

            buttons_lab.removeClass('active');
            group_id.prop('disabled', true);
        });

        $('.delete_people_btn').click(function (e) {
            var bu =$(this),
                name=bu.data('name'),
                image=bu.data('image'),
                href=bu.attr('href');

                $('#modal_img').attr('src', image);
                $('#modal_yes_btn').attr('href', href);
                $('#modal_title').text("Delete "+name+"?");

            $("#people_modal").modal();

            return false;
        });


    });

    /**/
    $('.has_sub_menu > a').click(function (e) {
        e.preventDefault();

        var bu=$(this),
            li=bu.parents('li'),
            sub_menu=li.find('.left_sub_menu');

        li.toggleClass('active');
    });

    /**/
    $('#menu_hide').click(function () {
        $('.news_tiles').toggleClass('active');
    });

    /**/
    $('.other_news_slider').slick({
        dots: false,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider_left').click(function(){
        $(".other_news_slider").slick('slickPrev');
    });

    $('.slider_right').click(function(){
        $(".other_news_slider").slick('slickNext');
    });



    var isSubmitting = false;

    $(document).ready(function () {

        if ($('form.userSettings').length > 0 ){

            $('form.userSettings').submit(function(){
                isSubmitting = true
            });

            $('form.userSettings').data('initial-state', $('form.userSettings').serialize());

            $(window).on('beforeunload', function() {
                if (!isSubmitting && $('form.userSettings').serialize() != $('form.userSettings').data('initial-state')){
                    return 'You have unsaved changes which will not be saved.';
                }
            });
        }

        $('.user_i_top .fa').click(function () {
            var bu=$(this),
                parent=bu.parents('li'),
                user_i_bottom=parent.find('.user_i_bottom');

            user_i_bottom.toggleClass('active');
            bu.toggleClass('fa-plus fa-minus')
        });
    });


    /**/
    $('#company_banner, #company_logo').on('change', function () { readFile(this); });

    var uploadCropCover = $('#company_cover_wrapper').croppie({
        enableExif: true,
        viewport: {
            width: 400,
            height: 170,
        },
        boundary: {
            width: 444,
            height: 187
        }
    });


    var uploadCropBanner = $('#company_logo_wrapper').croppie({
        enableExif: true,
        viewport: {
            width: 170,
            height: 170,
        },
        boundary: {
            width: 186,
            height: 187
        }
    });


    function logoAndCoverPhotoUpload() {
        $('#company_logo_wrapper, #company_cover_wrapper').each(function (index, item) {
            var img=$(item).data('image'),
                id=$(item).attr('id'),
                target_=(id=='company_logo_wrapper') ? uploadCropBanner : uploadCropCover;


            if(img.length > 0){
                $(item).addClass('ready');

                target_.croppie('bind', {
                    url: img
                }).then(function(){

                });
            }
        });
    }

    logoAndCoverPhotoUpload();

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            var item=$(input),
                target_=item.hasClass('company_logo') ? uploadCropBanner : uploadCropCover,
                div=item.hasClass('company_logo') ? 'company_logo_wrapper' : 'company_cover_wrapper';

            reader.onload = function (e) {
                $('#'+div).addClass('ready');

                target_.croppie('bind', {
                    url: e.target.result
                }).then(function(){

                });

            };

            reader.readAsDataURL(input.files[0]);
        }
        else {
            alert("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    function findStepRequiredField(step, next_step=false){
        var has_error=false,
            submit_btn=$('#submit_btn');

        $('.step'+step).find('input:required, select:required').each(function () {
           var current_input=$(this),
               input_value=$.trim(current_input.val());

           if(input_value==0 || input_value.length == 0){
               has_error=true;
           }
        });

        if (has_error){
            submit_btn.prop("disabled", true);

            alert("Please, fill all required field");
            return false;
        }else{

            var check_step=(next_step && (next_step > 0 && next_step <= 3)) ? next_step : step;

            if (check_step > 0 && check_step <= 3){
                submit_btn.prop("disabled", false);

                $('.steps').fadeOut();
                $('.step'+check_step).fadeIn();

                $('.step-selector').removeClass('active');
                $('.sel'+check_step).addClass('active');

                logoAndCoverPhotoUpload();
            }

            if(next_step > 1){
                $('#company_next').show();
            }else{
                $('#company_next').hide();
            }

            if(next_step==3){
                $('#company_prev').hide();
            }else{
                $('#company_prev').show();
            }
        }
    }

    $(document).ready(function () {
        /*$('.step-selector').on('click', function(ev){
            ev.preventDefault();
            var currentStep = $(this).attr('data-step');
            var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));

            findStepRequiredField(currentStepCount);


        });*/

        // Next Prev click
        $("#company_prev").on('click', function(ev){
            ev.preventDefault();

            var currentStep = $(".step-selector.active").attr("data-step");
            var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));
            var nextStep = currentStepCount+1;

            findStepRequiredField(currentStepCount, nextStep);

        });
        $("#company_next").on('click', function(ev){
            ev.preventDefault();
            var currentStep = $(".step-selector.active").attr("data-step");
            var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));
            var previousStep = currentStepCount-1;

            findStepRequiredField(currentStepCount, previousStep);


        });


        /**/
        $('.product_delete_btn').click(function () {

            if (confirm("Are you sure?")){
                return true;
            }

            return false;
        });

        /**/
        $('.product_gallery_images').slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: false,
            responsive: [
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        /**/
        $('#pac-input').keypress(function (e) {
            var key_code=e.which || e.keyCode;

            if(key_code==13){
                e.preventDefault();

                return false;
            }
        });

        /**/
        $('.company-input-box').keyup(function () {
            var bu=$(this),
                val=$.trim(bu.val()),
                position_div=$('.position_div');

            if(val.length > 0){
                position_div.removeClass('hidden');
            }else{
                position_div.addClass('hidden');
            }
        });

        /**/
        var steps_form=$('.steps_form');
        


        if($(".company_name").length > 0){

            $(".company_name").autocomplete({
                source: site_url+"/search-company/",
                minLength: 2,
                'open': function(e, ui) {
                    $('.ui-autocomplete');
                },
                select: function(event, ui) {

                    if(ui["item"] !== undefined) {

                        if(confirm("Are you sure?")){
                            var selected_item=ui["item"];

                            //$("#existingCompany").modal();

                            $('#apply_company').val(selected_item.id);
                            $('#company-name').val(selected_item.value);

                            $('.position_div').removeClass('hidden');

                            /**/


                            //steps_form.trigger('submit');

                            steps_form.find("input, select, textarea").not('.position_div .selectpicker, .bs-searchbox input, .company_name, #apply_company').prop("disabled", true);

                            $('#company_prev').hide();

                            $('.selectpicker').selectpicker('refresh');

                        }else{

                            setTimeout(function () {
                                $('#apply_company').val(0);
                                $('#company-name').val("");

                                $('.position_div').addClass('hidden');

                                steps_form.find("input, select, textarea").not('#submit_btn').prop("disabled", false);

                                $('#company_prev').show();

                                $('.selectpicker').selectpicker('refresh');

                            }, 100);
                        }

                    }
                }
            }).keyup(function () {

                if($(this).val().trim().length ==0){

                    setTimeout(function () {
                        $('#apply_company').val(0);
                        $('#company-name').val("");

                        $('.position_div').addClass('hidden');

                        steps_form.find("input, select, textarea").not('#submit_btn').prop("disabled", false);

                        $('#company_prev').show();

                        $('.selectpicker').selectpicker('refresh');

                    }, 100);

                }

            });

            $('.position_div .selectpicker').change(function () {

                $('#submit_btn').prop("disabled", false);

            });
        }


        $('#existingCompany').on('hidden.bs.modal', function () {
            window.location.href = "{site_url_multi('/')}profile";
        });

        /**/
        $('.append_value_onchange').change(function () {
           var bu=$(this),
               groups=bu.data('group').split(','),
               target=bu.data('target'),
               glue=bu.data('glue'),
               values=[];

           for(group of groups){
               values.push( $('.'+group).val().trim());
           }

           $('.'+target).val(values.join(glue))

        });

        /**/
        $(document).on('click', '.remove-item-phone', function () {
            if( confirm("Are you sure?") ){
                var parent=$(this).parents('.clone_line'),
                    email=parent.find("input[type='email']").val().trim(),
                    company_id=parseInt({{(isset($UserData->company_id) && !empty($UserData->company_id)) ? $UserData->company_id : 0}});

                if(email.length > 0 && company_id > 0){
                    var formData = new FormData();

                    formData.append('email', email);
                    formData.append('company_id', company_id);


                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/deleteUserFromCompany/',
                        dataType : 'json',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {

                        }
                    });
                }

                parent.remove();
            }
        });

        /**/
        $('.go_up').click(function () {

            $('html, body').stop().animate({
                scrollTop : 0
            }, 500);

        });

        /**/
        $(document).on("click", ".change_company_name_btn", function () {
            var bu=$(this),
                id=$.trim(bu.data('id')),
                changeCompanyName=$('#changeCompanyName');

            if(id.length > 0){
                changeCompanyName.find("input[name='company_id']").val(id);
            }

            changeCompanyName.modal();
        });
        $(document).on('submit', '.changeCompanyName', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: site_url + 'profile/changeCompanyName/',
                data: $(this).serialize(),
                cache: false,
                success: function (data) {
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


        /**/
        $(document).on("click", ".send_request_to_employee", function (e) {

        if (!e.handle){
        e.handle=true;

        if (confirm("Are you sure?")){
        var bu=$(this),
        id=bu.data("id"),
        li=bu.parents("li"),
        position_id=li.find('.position_id').val();

        $.ajax({
        url : redirect_url+'pages/{$UserData->slug}/add_employee',
        type : 'POST',
        data : { user_id : id, position_id : position_id, add_employee : true},
        dataType : 'json',
        cache : false,
        success : function (res) {
        if (res.type=="success"){

        li.remove();



        toastr.success(res.message);
        }else{
        toastr.error(res.message);
        }
        }
        });
        }
        }

        });


    });


    
</script>


<div id="changeCompanyName" class="modal fade" role="dialog" style="z-index:999999999999999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="changeCompanyName" action="{base_url()}profile/changeCompanyName" method="post">
                <input type="hidden" name="company_id" value="" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title data-title">Please enter new company name</h4>
                </div>
                <div class="modal-body data-response">
                    <div class="form-group">
                        <label for="company-date">New Company Name </label>
                        <input type="text" name="new_company_name" class="form-control mylos"
                               placeholder="New Company Name" required>
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


<div class="ajax_loader">
    <span class="isloading-wrapper  isloading-show  isloading-overlay" style="top: 236px;"><i
            class="fa fa-refresh glyphicon-spin"></i>
    </span>
</div>

<!--
<script>
    $(document).ready(function (){
        var ajax_loader=$('.ajax_loader');

        $(document).ajaxStar(function(){
            ajax_loader.addClass('active');
        }).ajaxSuccess(function(){
            ajax_loader.removeClass('active');
        })
    })
</script>
-->

{*<div class="s-overlay" id="s-overlay"></div>*}
</body>
</html>
