{extends file=$layout}
{block name=content}
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
                {if $messages} {foreach $messages as $key=>$message}
                <div class="{if isset($message['isnew'])}isnew{/if} thump-message conversation_{$message['c_id']}" data-sentto="{$message['id']}" data-sentby="{$sentby}" data-conversation="{$message['c_id']}">
                  <div class="thump-message-left">
                    {if strpos($message['images'], "http://") neq false || strpos($message['images'], "https://") neq false }
                    <img src="{$message['images']}" alt="{$message['company_name']}">
                    {else}
                      {if !empty($message['images'])}
                      <img src="{base_url('uploads/catalog/users/')}{$message['images']}" alt="{$message['company_name']}" style="object-fit: cover;height: 100%;width: 100%">
                      {else}
                      <img src="{base_url('uploads/catalog/users/avatar-placeholder.png')}" alt="{$message['company_name']}">
                      {/if}
                    {/if}
                  </div>
                  <div class="thump-message-right">
                    <h3>{$message['company_name']}</h3>
                    <p>{$message['time']}</p>
                  </div>
                </div>
                {/foreach}{/if}
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
                  <form class="sendMessage" action="{base_url('messages/sendMessage/')}" method="post">
                    <input type="hidden" name="sentby" value="{$sentby}" class="sentby">
                    <input type="hidden" name="sentto" value="{$sentto}" class="sentto">
                    <input type="hidden" name="c_id"   value="{$c_id}" class="c_id">
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
  <script type="text/javascript">

    $(document).on('click','.button-attachment', function(){
        $('.attachment').click();
    });

    {literal}
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
    {/literal}

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

    var c_id = {$c_id};
    $('.conversation_'+c_id).click();
  </script>
{/block}
