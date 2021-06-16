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
                           data-last="{$message.last_seen}" data-href={base_url('messages/index')}/{$message.id}><img
                                src="{if $message.images}/uploads/catalog/users/{$message.images}{else}/uploads/catalog/users/avatar-placeholder.png{/if}"/> {if isset($message.unread)}
                        <span class="badge alert-danger">{$message.id}</span> {/if}{if $message.company_name}{$message.company_name}{else}{$message.fullname}{/if}</a>
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
</body>
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
<script charset="utf-8" type="text/javascript"
        src="{base_url('templates/default/assets/js/record.js?v=')}{time()}"></script>
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
</script>
</html>