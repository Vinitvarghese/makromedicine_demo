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
        toastr.success('New password has been sended to your mail address');
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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
        function makeNumeric(){
            $('#company-ext, #phone').each(function (index, item) {
                var id=$(item).attr('id');

               $(item).removeAttr('id');

               if(id=='company-ext'){
                   $(item).addClass('company-ext');
               }
            });

            $(".company-ext").numeric({ negative: false }).on('paste keyup', function () {
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
                people_box=bu.parents('.people_box'),
                group_id=people_box.find('.group_id');

            buttons_lab.addClass('active');
            group_id.prop('disabled', false);

            return false;
        });

        $('.edit_people_group_done').click(function (e) {
            e.preventDefault();
            var bu=$(this),
                buttons_lab=bu.parents('.buttons_lab'),
                people_box=bu.parents('.people_box'),
                group_id=people_box.find('.group_id'),
                role_id =group_id.val(),
                group_text=group_id.find('option:selected').text(),
                id=group_id.data('id'),
                to_user_id=group_id.data('to-user'),
                page_name=group_id.data('page-name');

            buttons_lab.removeClass('active');
            group_id.prop('disabled', true);

            people_box.find('.people_position_name').text(group_text);


            $.ajax({
                url : site_url +'pages/{$UserData->slug}/people',
                type : 'POST',
                data : { role_id  : role_id, group_text : group_text,  id : id, to_user_id : to_user_id, page_name : page_name },
                dataType : 'json',
                cache : false,
                success : function (res) {

                }
            });

            return false;
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
        $(".company-input-box, #company-name").autocomplete({
            source: site_url+"/search-company/",
            minLength: 2,
            'open': function(e, ui) {
                $('.ui-autocomplete');
            },
            select: function(event, ui) {

                if(ui["item"] !== undefined) {
                    var ask=confirm("Are you sure?");



                    if(ask){
                        var selected_item=ui["item"];


                        $("#existingCompany").modal();

                        $('#apply_company').val(selected_item.id);
                        $('#company-name').val(selected_item.value);

                        $('.position_div').hide();

                        /**/
                        var steps_form=$('.steps_form');

                        steps_form.trigger('submit');

                        steps_form.find("input, select, textarea").prop("disabled", true);

                    }else{

                        setTimeout(function () {
                            $('#apply_company').val(0);
                            $('#company-name').val("");
                        }, 100);
                    }

                }
            }
        });


        $('#existingCompany').on('hidden.bs.modal', function () {
            window.location.href = "{site_url_multi('/')}profile";
        })

    });
</script>


{if $is_loggedin }
    <script>
        $('.give_rating_btn').click(function () {
            var bu=$(this),
                id=bu.data('id'),
                rate_only=bu.parents('.rate_only'),
                action=1;

            if(id >= 1 && id <=5){

                if(id==1){
                    $('.give_rating_btn').not(bu).removeClass('active');

                    bu.toggleClass('active');

                    if(!bu.hasClass('active')){

                        action=0;

                        rate_only.removeClass('rated').addClass('not_rated');

                    }else{
                        rate_only.addClass('rated').removeClass('not_rated');
                    }


                }else{
                    $('.give_rating_btn').removeClass('active');

                    for(let i=1; i<=id; i++){
                        $('.give_rating_btn_'+i).addClass('active');
                    }


                    rate_only.addClass('rated').removeClass('not_rated');
                }



                $.ajax({
                    url : site_url + 'company/give_rating',
                    method : 'post',
                    data : { profile_id : {(isset($UserData->company_id)) ? $UserData->company_id : 0}, user_id : {$user['id']}, rate : id, action : action },
                    dataType : 'json',
                    cache : false,
                    success : function (res) {

                    }
                });
            }


        }).hover(function(){
            var bu=$(this),
                id=bu.data('id'),
                rate_only=bu.parents('.rate_only');

            if(rate_only.hasClass('not_rated')){
                $('.give_rating_btn').removeClass('active');

                for(let i=1; i<=id; i++){
                    $('.give_rating_btn_'+i).addClass('active');
                }
            }


        }, function(){
            var bu=$(this),
                id=bu.data('id'),
                rate_only=bu.parents('.rate_only');

            if(rate_only.hasClass('not_rated')){
                $('.give_rating_btn').removeClass('active');
            }

        });

        /**/

    </script>
{/if}

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


</body>
</html>
