<?php
/* Smarty version 3.1.30, created on 2020-10-29 15:24:54
  from "/home/makromed/public_html/demo/templates/default/_partial/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9aa6867514a1_58400705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13f7cfd475a283ce9e0d3b1ad0626259880f1e1a' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/_partial/footer.tpl',
      1 => 1603970679,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9aa6867514a1_58400705 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="clearfix"></div>
<footer class="footer col-md-12 no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-12 no-padding">
                <ul class="social">
                    <li>
                        <a target="_blank" href="<?php echo get_setting('facebook');?>
">
                            <img src="<?php echo base_url('templates/default/assets/img/sys/facebook.svg');?>
" alt="Facebook">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo get_setting('instagram');?>
">
                            <img src="<?php echo base_url('templates/default/assets/img/sys/instagram.svg');?>
" alt="Instagram">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo get_setting('youtube');?>
">
                            <img src="<?php echo base_url('templates/default/assets/img/sys/youtube.svg');?>
" alt="Youtube">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="copright">
                    <p><?php echo translate('copyright',true);?>
 <?php echo date('Y');?>
 © <a href="<?php echo site_url_multi('/');?>
">MakroMedicine</a>.
                        <span class="hidden-xs"><?php echo translate('all_right_reserved',true);?>
</span></p>
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
<?php if (isset($_smarty_tpl->tpl_vars['send_mail']->value) && $_smarty_tpl->tpl_vars['send_email']->value == true) {?>
    <?php echo '<script'; ?>
 type="text/javascript">
        toastr.success('New password has been sended to your mail address');
    <?php echo '</script'; ?>
>
<?php }
if (isset($_smarty_tpl->tpl_vars['confirm_account']->value) && $_smarty_tpl->tpl_vars['confirm_account']->value == true) {?>
    <?php echo '<script'; ?>
 type="text/javascript">
        toastr.error('Server error. Your account not confirmed.');

    <?php echo '</script'; ?>
>
<?php }?>
<div id="termModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo $_smarty_tpl->tpl_vars['terms']->value->title;?>
</h4>
            </div>
            <div class="modal-body" style="max-height: 70vh;overflow: auto;">
                <p style="font-size:16px;"><?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['terms']->value->description, ENT_QUOTES);?>
</p>
            </div>
            <div class="modal-footer">
				
				<button type="button" class="btn btn-success m-0" id="iagree" style="    padding: 7px 20px;">I Agree</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php if (isset($_smarty_tpl->tpl_vars['messages']->value)) {?>
    <button class="open-button" onclick="openForm()">Chat</button>
    <div class="chat-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <button type="button" class="cbtn cancel" onclick="closeForm()">Chat</button>
            <ul class="follower">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
                    <li><a id="sidebar-user-box" data-sent-by="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" data-c-id="<?php echo $_smarty_tpl->tpl_vars['message']->value['c_id'];?>
"
                           data-id="<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
"
                           data-image="<?php if ($_smarty_tpl->tpl_vars['message']->value['images']) {?>/uploads/catalog/users/<?php echo $_smarty_tpl->tpl_vars['message']->value['images'];
} else { ?>/uploads/catalog/users/avatar-placeholder.png<?php }?>"
                           data-last="<?php echo $_smarty_tpl->tpl_vars['message']->value['last_seen'];?>
" data-href=<?php echo base_url('messages/index');?>
/<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
><img
                                src="<?php if ($_smarty_tpl->tpl_vars['message']->value['images']) {?>/uploads/catalog/users/<?php echo $_smarty_tpl->tpl_vars['message']->value['images'];
} else { ?>/uploads/catalog/users/avatar-placeholder.png<?php }?>"/> <?php if (isset($_smarty_tpl->tpl_vars['message']->value['unread'])) {?>
                        <span class="badge alert-danger"><?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
</span> <?php }
if ($_smarty_tpl->tpl_vars['message']->value['company_name']) {
echo $_smarty_tpl->tpl_vars['message']->value['company_name'];
} else {
echo $_smarty_tpl->tpl_vars['message']->value['fullname'];
}?></a>
                    </li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </ul>
        </form>
    </div>
<?php }?>

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
    <?php echo '<script'; ?>
 type="text/javascript">
        function openForm() {
            $('#myForm').slideToggle();
        }

        function closeForm() {
            $('#myForm').slideToggle();
        }
    <?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 charset="utf-8"
        src="<?php echo base_url('templates/default/assets/plugin/inputmask/dist/min/jquery.inputmask.bundle.min.js');?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8"
        src="<?php echo base_url('templates/default/assets/plugin/inputmask/dist/min/inputmask/inputmask.phone.extensions.min.js');?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8"
        src="<?php echo base_url('templates/default/assets/plugin/jquery-validation/dist/jquery.validate.min.js');?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8" src="<?php echo base_url('templates/default/assets/plugin/ckeditor/ckeditor.js');?>
"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 charset="utf-8" src="<?php echo base_url('templates/default/assets/js/function.js?v=394994');?>
"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 charset="utf-8" src="<?php echo base_url('templates/default/assets/js/main.js');?>
?v=<?php echo uniqid();?>
"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 src="<?php echo base_url('templates/default/assets/audio-player/dist/js/green-audio-player.js');?>
?v=<?php echo uniqid();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 charset="utf-8" type="text/javascript" src="<?php echo base_url('templates/default/assets/js/record.js?v=');
echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
  src="<?php echo base_url('templates/default/assets/js/jquery.numeric.min.js');?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
  src="<?php echo base_url('templates/default/assets/js/slick.js');?>
"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>
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
                group_id_val=group_id.val(),
                group_text=group_id.find('option:selected').text(),
                user_id=group_id.data('user');

            buttons_lab.removeClass('active');
            group_id.prop('disabled', true);


            $.ajax({
                url : site_url +'pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/people',
                type : 'POST',
                data : { group_id : group_id_val, group_text : group_text,  user_id : user_id },
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

        if ($('form').length > 0 ){

            $('form').submit(function(){
                isSubmitting = true
            });

            $('form').data('initial-state', $('form').serialize());

            $(window).on('beforeunload', function() {
                if (!isSubmitting && $('form').serialize() != $('form').data('initial-state')){
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





<?php echo '</script'; ?>
>

</body>
</html><?php }
}
