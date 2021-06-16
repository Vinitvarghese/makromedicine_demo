<?php
/* Smarty version 3.1.30, created on 2020-10-27 17:45:33
  from "/home/makromed/public_html/demo/templates/default/messages/messages.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f98247d5131a7_32708681',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '433739f948f8283cc54c92b96ea4076d2b18272d' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/messages/messages.tpl',
      1 => 1603718919,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f98247d5131a7_32708681 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19803697785f98247d5120c6_20019638', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_19803697785f98247d5120c6_20019638 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="wrap margin-top-100 col-md-12">
    <div class="container">
      <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12" id="messages">
          <div class="col-md-3 no-padding">
            <div class="messages-list">
              <div class="search-box">
                <input type="text" name="" value="" placeholder="Search">
              </div>
              <div class="messages-user-box">
                <?php if ($_smarty_tpl->tpl_vars['messages']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['message']->value) {
?>
                <div class="<?php if (isset($_smarty_tpl->tpl_vars['message']->value['isnew'])) {?>isnew<?php }?> thump-message conversation_<?php echo $_smarty_tpl->tpl_vars['message']->value['c_id'];?>
" data-sentto="<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
" data-sentby="<?php echo $_smarty_tpl->tpl_vars['sentby']->value;?>
" data-conversation="<?php echo $_smarty_tpl->tpl_vars['message']->value['c_id'];?>
">
                  <div class="thump-message-left">
                    <?php if (strpos($_smarty_tpl->tpl_vars['message']->value['images'],"http://") != false || strpos($_smarty_tpl->tpl_vars['message']->value['images'],"https://") != false) {?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['message']->value['images'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['message']->value['company_name'];?>
">
                    <?php } else { ?>
                      <?php if (!empty($_smarty_tpl->tpl_vars['message']->value['images'])) {?>
                      <img src="<?php echo base_url('uploads/catalog/users/');
echo $_smarty_tpl->tpl_vars['message']->value['images'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['message']->value['company_name'];?>
" style="object-fit: cover;height: 100%;width: 100%">
                      <?php } else { ?>
                      <img src="<?php echo base_url('uploads/catalog/users/avatar-placeholder.png');?>
" alt="<?php echo $_smarty_tpl->tpl_vars['message']->value['company_name'];?>
">
                      <?php }?>
                    <?php }?>
                  </div>
                  <div class="thump-message-right">
                    <h3><?php echo $_smarty_tpl->tpl_vars['message']->value['company_name'];?>
</h3>
                    <p><?php echo $_smarty_tpl->tpl_vars['message']->value['time'];?>
</p>
                  </div>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
              </div>
            </div>
          </div>
          <div class="col-md-9 no-padding messages-conten-right">
            <div class="messages-content">
              <div class="messages-header">
                <div class="col-md-8 col-xs-8 messages-header-main">
                  <h1 class="messages-header-name"></h1>
                </div>
                <div class="col-md-4 col-xs-4">
                  <div class="dropdown message-action">
                    <ul class="dropbtn icons showLeft" onclick="showDropdown()">
                      <li></li>
                      <li></li>
                      <li></li>
                    </ul>
                    <div id="myDropdown" class="dropdown-content">
                      <a href="#delete" class="delete-message">Delete</a>
                    </div>
                </div>
                </div>
              </div>
              <div class="messages-show">
                <div class="messages-inner"></div>
                <div class="messages-box">
                  <form class="sendMessage" action="<?php echo base_url('messages/sendMessage/');?>
" method="post">
                    <input type="hidden" name="sentby" value="<?php echo $_smarty_tpl->tpl_vars['sentby']->value;?>
" class="sentby">
                    <input type="hidden" name="sentto" value="<?php echo $_smarty_tpl->tpl_vars['sentto']->value;?>
" class="sentto">
                    <input type="hidden" name="c_id"   value="<?php echo $_smarty_tpl->tpl_vars['c_id']->value;?>
" class="c_id">
                    <input type="file" name="attachment" class="attachment" style="display:none;">
                    <textarea name="messages" class="messages" style="width:100%" placeholder="Type your message..."></textarea>
                    <button type="button" name="button" class="button-attachment"></button>
                    <button type="submit" name="button" class="button-send"></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php echo '<script'; ?>
 type="text/javascript">

    $(document).on('click','.button-attachment', function(){
        $('.attachment').click();
    });

    
    $(document).on('click','.thump-message', function(){
      var sentto    = $(this).attr('data-sentto');
      var sentby    = $(this).attr('data-sentby');
      var c_id      = $(this).attr('data-conversation');
      var username  = $(this).find('.thump-message-right h3').text();
      var limit     = 20;
      $('.messages-header-name').text(username);
      $('.message-action .dropdown-content .delete-message').attr('data-sentto' , sentto);
      $('.message-action .dropdown-content .delete-message').attr('data-sentby' , sentby);
      $('input.sentto').val(sentto);
      $('input.sentby').val(sentby);
      $('input.c_id').val(c_id);
      $('.thump-message').removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type:'POST',
          url:site_url+'messages/getMessage/',
          data: {'c_id': c_id, 'limit': limit},
          cache:false,
          success:function(data){
            var obj = jQuery.parseJSON(data);
            var component = ``;
            if (obj.length > 0) {
                $.each(obj, function(index, value){
                  if(value.id == sentby)
                  {
                    component += `
                    <div class="col-md-12 no-padding invite-messages">
                      <div class="pull-right">
                        <div class="right-rlt-messages">
                          <p>`+value.reply+`</p>
                        </div>
                        <div class="left-rlt-messages">

                        </div>
                      </div>
                    </div> `;
                  }
                  else
                  {
                    component +=
                    `<div class="col-md-12 no-padding invite-messages">
                        <div class="pull-left">
                          <div class="right-messages">

                          </div>
                          <div class="left-messages">
                            <p>`+value.reply+`</p>
                          </div>
                        </div>
                      </div>`;
                  }
                });
                $('.messages-show .messages-inner').html(component);
                $(".messages-show").animate({ scrollTop: 3000 }, 1000);
            }else{
                $('.messages-show .messages-inner').html(component);
                $(".messages-show").animate({ scrollTop: 3000 }, 1000);
            }
          }
      });
    });
    

    $('.sendMessage').submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type:'POST',
            url:site_url+'messages/sendMessage/',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
              var obj = jQuery.parseJSON(data);
              var component = ``;
              component = `
              <div class="col-md-12 no-padding invite-messages">
                <div class="pull-right">
                  <div class="right-rlt-messages">
                    <p>`+obj.messages+`</p>
                  </div>
                  <div class="left-rlt-messages">

                  </div>
                </div>
              </div> `;
              $('.messages-show .messages-inner').append(component);
              $('.messages').val('');
              $(".messages-show").animate({ scrollTop: 3000 }, 1000);
            }
        });
        e.preventDefault();
        return false;
    });

    $(document).keypress(function(e) {
        if(e.which == 13) {
            $('.sendMessage').submit();
        }
    });

    var c_id = <?php echo $_smarty_tpl->tpl_vars['c_id']->value;?>
;
    $('.conversation_'+c_id).click();
  <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
