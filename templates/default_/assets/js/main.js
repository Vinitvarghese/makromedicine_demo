$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

function getAllUrlParams(url) {
  var queryString = url ? url.split("?")[1] : window.location.search.slice(1);

  var obj = {};

  if (queryString) {
    queryString = queryString.split("#")[0];

    var arr = queryString.split("&");

    for (var i = 0; i < arr.length; i++) {
      var a = arr[i].split("=");

      var paramName = a[0];
      var paramValue = typeof a[1] === "undefined" ? true : a[1];

      paramName = paramName.toLowerCase();
      if (typeof paramValue === "string") paramValue = paramValue.toLowerCase();

      if (paramName.match(/\[(\d+)?\]$/)) {
        var key = paramName.replace(/\[(\d+)?\]/, "");
        if (!obj[key]) obj[key] = [];

        if (paramName.match(/\[\d+\]$/)) {
          var index = /\[(\d+)\]/.exec(paramName)[1];
          obj[key][index] = paramValue;
        } else {
          obj[key].push(paramValue);
        }
      } else {
        if (!obj[paramName]) {
          obj[paramName] = paramValue;
        } else if (obj[paramName] && typeof obj[paramName] === "string") {
          obj[paramName] = [obj[paramName]];
          obj[paramName].push(paramValue);
        } else {
          obj[paramName].push(paramValue);
        }
      }
    }
  }

  return obj;
}

$(document).ready(function() {
  var user_arr = []; // List of users

  $(document).on("click", ".msg_head", function() {
    let chatbox = $(this)
        .parents()
        .parents()
        .attr("rel");
    $('[rel="' + chatbox + '"] .msg_wrap').slideToggle("slow");
    return false;
  });

  $(document).on("click", "#close", function() {
    let chatbox = $(this)
        .parents()
        .parents()
        .parents()
        .parents()
        .attr("rel");
    $('[rel="' + chatbox + '"]').hide();
    user_arr.splice($.inArray(chatbox, user_arr), 1);
    displayChatBox();
    return false;
  });

  $(document).on("click", "#sidebar-user-box", function() {
    let userID = $(this).attr("data-id");
    let userImage = $(this).attr("data-image");
    let userLast = $(this).attr("data-last");
    let username = $(this).text();
    let limit = 20;
    let c_id = $(this).data("c-id");
    let sentby = $(this).attr("data-sent-by");

    if ($.inArray(userID, user_arr) != -1) {
      user_arr.splice($.inArray(userID, user_arr), 1);
    }

    user_arr.unshift(userID);

    chatPopup =
        '<div class="msg_box" style="right:270px" rel="' +
        userID +
        '">' +
        '<div class="card chat-room small-chat wide" id="myForm">' +
        '<div class="msg_head card-header white d-flex justify-content-between p-2" id="toggle" style="cursor: pointer;">' +
        '<div class="d-flex justify-content-start">' +
        '<div class="profile-photo">' +
        '<img src="' +
        userImage +
        '" class="avatar rounded-circle mr-2 ml-0">' +
        '<span class="state"></span>' +
        "</div>" +
        '<div class="data">' +
        '<p class="name mb-0"><strong>' +
        username +
        "</strong></p>" +
        '<p class="activity text-muted mb-0">' +
        userLast +
        "</p>" +
        "</div>" +
        "</div>" +
        '<div class="icons grey-text">' +
        '<a id="close"><i class="fa fa-times mr-2"></i></a>' +
        "</div>" +
        "</div>" +
        '<div class="msg_wrap">' +
        '<div class="my-custom-scrollbar" id="message">' +
        '<div class="card-body p-3">' +
        '<div id="tab-' +
        c_id +
        '" class="chat-message">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="mic-control">' +
        '<div class="second-timer"></div>' +
        '<span id="seconds-counter"></span>' +
        '<button type="button" id="recordButton" data-c-id="' +
        c_id +
        '">Record</button>' +
        '<button type="button" id="stopButton" style="display: none">Stop</button>' +
        "</div>" +
        '<div class="card-footer text-muted white pt-1 pb-2 px-3">' +
        '<input type="text" id="messages-' +
        c_id +
        '" class="form-control tab-chat-input" placeholder="Type a message...">' +
        "<div>" +
        '<a><i class="fa fa-image mr-2"></i></a>' +
        '<input type="file" name="image_popup" id="image_popup" class="image_popup" style="display:none;">' +
        '<input type="hidden" name="image_popup_url" value="">' +
        '<input type="hidden" name="voice_popup_url" value="">' +
        '<a><i class="fa fa-microphone mr-2"></i></a>' +
        '<a><i class="fa fa-paperclip mr-2"></i></a>' +
        '<input type="file" name="attachment_popup" id="attachment_popup" class="attachment_popup" style="display:none;">' +
        '<input type="hidden" name="attachment_popup_url" value="">' +
        '<a class="send-button" data-c-id="' +
        c_id +
        '" data-user-id="' +
        userID +
        '"><i class="fa fa-paper-plane float-right"></i></a>' +
        "</div>" +
        "</div>" +
        "</div>";

    $("body").append(chatPopup);
    $("#messages-" + c_id + "").emojioneArea({
      autoHideFilters: false,
      pickerPosition: "top",
      shortnames: true,
      saveEmojisAs: "image",
      tones: true,
      placeholder: "Type something here",
      search: true
    });

    displayChatBox();

    $.ajax({
      type: "POST",
      url: site_url + "messages/getMessage/",
      data: { c_id: c_id, limit: limit },
      cache: false,
      success: function(data) {
        var obj = jQuery.parseJSON(data);
        var component = ``;
        if (obj.length > 0) {
          $.each(obj, function(index, value) {
            if (value.id == sentby) {
              component +=
                  `
							<div class="card bg-default rounded w-75 float-right z-depth-0 mb-1 last">
								<div class="card-body p-2">
								<p class="card-text text-white">` +
                  value.reply +
                  `</p>`;
              if (value.type == "image") {
                component +=
                    `<a href="/` +
                    value.attachment +
                    `" data-fancybox="gallery" ><img class="img-responsive chat-image" src="/` +
                    value.attachment +
                    `"></a>`;
              } else if (value.type == "voice") {
                component +=
                    `<div class="ready-player-3 player-with-download"><audio crossorigin> <source src="/` +
                    value.attachment +
                    `" type="audio/wav"></audio></div>`;
              } else if (value.type == "attachment") {
                component +=
                    `<a href="/` +
                    value.attachment +
                    `">` +
                    `<i class="fa fa-file"></i> ` +
                    value.attachment.replace(
                        "uploads/messages/attachments/",
                        ""
                    ) +
                    `</a>`;
              }
              component += `<span class="seen">`;
              if (value.seen == 1) {
                component += `<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15" width="16" height="15"><path fill="#4FC3F7" d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg>`;
              } else {
                component += `<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15" width="16" height="15"><path fill="#92A58C" d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg>`;
              }
              component +=
                  `
									</span>
									<span class="message_date">` +
                  value.time +
                  `</span>`;
              component += `</div>
								</div>`;
            } else {
              component +=
                  `<div class="d-flex justify-content-start">
								<div class="profile-photo message-photo">
									<img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="avatar" class="avatar rounded-circle mr-2 ml-0">
									<span class="state"></span>
								</div>
								<div class="card bg-light rounded w-75 z-depth-0 mb-2">
									<div class="card-body p-2">
										<p class="card-text black-text">` +
                  value.reply +
                  `</p>`;
              if (value.type == "image") {
                component +=
                    `<a href="/` +
                    value.attachment +
                    `" data-fancybox="gallery" ><img class="img-responsive chat-image" src="/` +
                    value.attachment +
                    `"></a>`;
              } else if (value.type == "voice") {
                component += `VOICE`;
              } else if (value.type == "attachment") {
                component +=
                    `<a href="` +
                    value.attachment +
                    `">` +
                    value.attachment +
                    `</a>`;
              }
              component += `</div>
								</div>`;
            }
          });
          $("#tab-" + c_id).html(component);
          $(".my-custom-scrollbar").animate({ scrollTop: 3000 }, 1000);
          GreenAudioPlayer.init({
            selector: ".player-with-download",
            stopOthersOnPlay: true,
            showDownloadButton: false
          });
        } else {
          $("#tab-" + c_id).html(component);
          $(".my-custom-scrollbar").animate({ scrollTop: 3000 }, 1000);
          GreenAudioPlayer.init({
            selector: ".player-with-download",
            stopOthersOnPlay: true,
            showDownloadButton: false
          });
        }
      }
    });
  });

  //Smile əlavə etmək
  $(".emoji").on("click", function() {
    let smile = $(this).data("c-id");
    let text = $(".messages").val();
    text = text + " " + smile + " ";
    $(".messages").val(text);
    $(".smile").fadeToggle("fast");
  });

  $(document).on("keyup", ".tab-chat-input", function(e) {
    if (e.keyCode == 13) {
      $(".send-button").trigger("click");
    }
  });

  $("body").delegate(".send-button", "click", function(e) {
    let c_id = $(this).data("c-id");
    let image_popup_url = $("input[name=image_popup_url]").val();
    let attachment_popup_url = $("input[name=attachment_popup_url]").val();
    let voice_popup_url = $("input[name=voice_popup_url]").val();
    let sentto = $(this).data("user-id");
    //let to_token = $('input[name="sentto_token"]').val();
    e.preventDefault();
    //let message = $('input[id=messages-'+c_id+']').val();
    $("#messages-" + c_id + "").emojioneArea();
    let message = $("#messages-" + c_id + "")[0].emojioneArea.getText();
    $("#messages-" + c_id + "")[0].emojioneArea.hidePicker();

    // socket.emit('chat_message',{
    // 	to : to_token,
    // 	message : message
    // });

    if (
        message != "" ||
        image_popup_url != "" ||
        attachment_popup_url != "" ||
        voice_popup_url != ""
    ) {
      form_data = new FormData();
      form_data.append("c_id", c_id);
      form_data.append("messages", message);
      form_data.append("sentto", sentto);
      form_data.append("image_link", image_popup_url);
      form_data.append("attachment_link", attachment_popup_url);
      form_data.append("voice_link", voice_popup_url);
      $.ajax({
        type: "POST",
        url: site_url + "messages/sendMessage/",
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          var obj = jQuery.parseJSON(data);
          var component =
              `<div class="card bg-default rounded w-75 float-right z-depth-0 mb-1 last">
						<div class="card-body p-2">
						<p class="card-text text-white">` +
              obj.messages +
              `</p>`;
          if (obj.type == "image") {
            component +=
                `<a href="/` +
                obj.attachment +
                `" data-fancybox="gallery" ><img class="img-responsive chat-image" src="/` +
                obj.attachment +
                `"></a>`;
          } else if (obj.type == "voice") {
            component +=
                `<div class="ready-player-3 player-with-download"><audio crossorigin> <source src="/` +
                obj.attachment +
                `" type="audio/wav"></audio></div>`;
          } else if (obj.type == "attachment") {
            component +=
                `<a href="/` +
                obj.attachment +
                `">` +
                `<i class="fa fa-file"></i> ` +
                obj.attachment.replace("uploads/messages/attachments/", "") +
                `</a>`;
          }
          `<span class="seen">`;
          if (obj.seen == 1) {
            component += `<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15" width="16" height="15"><path fill="#4FC3F7" d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg>`;
          } else {
            component += `<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15" width="16" height="15"><path fill="#92A58C" d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg>`;
          }
          component +=
              `</span>
						
						<span class="message_date">` +
              obj.time +
              `</span>`;
          component += `</div>
					</div>`;
          $("#tab-" + c_id).append(component);
          //$('input[id=messages-'+c_id+']').val('');

          $("#messages-" + c_id + "").emojioneArea();
          $("#messages-" + c_id + "")[0].emojioneArea.setText("");
          GreenAudioPlayer.init({
            selector: ".player-with-download",
            stopOthersOnPlay: true,
            showDownloadButton: true
          });
          $(".my-custom-scrollbar").animate({ scrollTop: 3000 }, 1000);
        }
      });
      e.preventDefault();
      return false;
    }
  });

  $(document).on("click", ".fa-image", function() {
    $(".image_popup").click();
  });

  $(document).on("click", ".fa-microphone", function() {
    console.log("Microphone clicked");
    $(".mic-control").fadeIn();
  });

  $(document).on("click", ".fa-paperclip", function() {
    $(".attachment_popup").click();
  });
  //Upload Image
  $("body").delegate("input[name=image_popup]", "change", function(e) {
    //$("input[name=image_popup]").change(function() {
    //readURL(this);
    //$('.image-area').fadeIn();
    let image_data = new FormData();
    let files = $("#image_popup")[0].files[0];
    image_data.append("image", files);
    $.ajax({
      // beforeSend: function() {
      // 	$('.loader').fadeIn();
      // },
      // complete: function() {
      // 	$('.loader').fadeOut();
      // },
      type: "POST",
      url: site_url + "messages/uploadImage/",
      data: image_data,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      enctype: "multipart/form-data",
      success: function(data) {
        if (data.success) {
          $("input[name=image_popup_url]").val(data.file_name);
          $(".send-button").trigger("click");
        } else {
          alert(data.message);
        }
      }
    });
  });

  $("body").delegate("input[name=attachment_popup]", "change", function(e) {
    //$("input[name=image_popup]").change(function() {
    //readURL(this);
    //$('.image-area').fadeIn();
    let image_data = new FormData();
    let files = $("#attachment_popup")[0].files[0];
    image_data.append("attachment", files);
    $.ajax({
      // beforeSend: function() {
      // 	$('.loader').fadeIn();
      // },
      // complete: function() {
      // 	$('.loader').fadeOut();
      // },
      type: "POST",
      url: site_url + "messages/uploadAttachment/",
      data: image_data,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      enctype: "multipart/form-data",
      success: function(data) {
        if (data.success) {
          $("input[name=attachment_popup_url]").val(data.file_name);
          $(".send-button").trigger("click");
        } else {
          alert(data.message);
        }
      }
    });
  });

  // Chat penceresini goster
  function displayChatBox() {
    i = 280;
    j = 310;

    $.each(user_arr, function(index, value) {
      if (index < 4) {
        $('[rel="' + value + '"]').css("right", i);
        $('[rel="' + value + '"]').show();
        i = i + j;
      } else {
        $('[rel="' + value + '"]').hide();
      }
    });
  }

  var gumStream; //stream from getUserMedia()
  var rec; //Recorder.js object
  var inputz; //MediaStreamAudioSourceNode we'll be recording
  var cancel;

  var AudioContext = window.AudioContext || window.webkitAudioContext;
  var audioContext;
  var constraints = { audio: true, video: false };

  var seconds = 0;
  var el = $("#seconds-counter");

  $(document).on("click", "#recordButton", function() {
    $(this).hide();
    $("#stopButton").show();

    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function(stream) {
          cancel = setInterval(incrementSeconds, 1000);

          audioContext = new AudioContext();
          gumStream = stream;
          inputz = audioContext.createMediaStreamSource(stream);
          rec = new Recorder(inputz, { numChannels: 1 });
          rec.record();
        })
        .catch(function(err) {
          recordButton.disabled = false;
          stopButton.disabled = true;
        });
  });

  $(document).on("click", "#stopButton", function() {
    clearInterval(cancel);
    $(el).hide();
    $("#stopButton").hide();
    $("#controls").hide();
    rec.stop();
    gumStream.getAudioTracks()[0].stop();
    rec.exportWAV(createAudioLink);
  });

  function createAudioLink(blob) {
    var url = URL.createObjectURL(blob);
    var au = document.createElement("audio");
    var li = document.createElement("li");
    var link = document.createElement("a");

    var filename = new Date().toISOString();

    au.controls = true;
    au.src = url;
    $(li).append(
        '<div class="ready-player-3 player-with-download"><audio crossorigin> <source src="' +
        url +
        '" type="audio/wav"></audio></div>'
    );
    li.appendChild(link);

    var xhr = new XMLHttpRequest();
    xhr.onload = function(e) {
      if (this.readyState === 4) {
        let json = JSON.parse(e.target.responseText);
        $("input[name=voice_popup_url]").val(json.file_name);
        $(".send-button").trigger("click");
      }
      if (this.status == 200) {
        console.log("response", this.response);
      }
    };

    var fd = new FormData();
    fd.append("voice", blob, filename);
    xhr.open("POST", "/messages/uploadVoice", true);
    xhr.send(fd);
    li.appendChild(document.createTextNode(" "));

    $(".mic-control").append(li);
    GreenAudioPlayer.init({
      selector: ".player-with-download",
      stopOthersOnPlay: true,
      showDownloadButton: false
    });
  }

  function incrementSeconds() {
    if (seconds < 60) {
      seconds += 1;
      if (seconds < 10) {
        $("#seconds-counter").text("00:0" + seconds);
      } else {
        $("#seconds-counter").text("00:" + seconds);
      }
    } else {
      $("#stopButton").trigger("clicik");
    }
  }

  var count = 0;
  var counted = 0;
  var body = $("html, body");
  $.isLoading({
    text: ""
  });

  $(document).on("click", ".notify-list a.notify_href", function() {
    $(this)
        .parent()
        .find("div.simple_counter")
        .text("0");
    var list = $(this)
        .parent()
        .find("ul.dropdown-menu li");
    if (list.length > 0) {
      $.each(list, function(index, value) {
        var data_target = $(this).data("target");
        var that = $(this);
        $.ajax({
          type: "POST",
          url: site_url + "notify/read/",
          data: {
            id: data_target
          },
          cache: false
        }).done(function() {
          that.removeClass("actives");
        });

        if ($(this).attr("data-sender") == 0) {
          $(this).attr("data-sender", 1);
          $(this)
              .find("a i")
              .removeClass("fa-star");
          $(this)
              .find("a i")
              .addClass("fa-star");
        } else {
        }
      });
    }
  });

  $(document).on("click", ".notify-list ul.dropdown-menu li", function(e) {
    e.preventDefault();
    var data_target = $(this).attr("data-target");
    var data_type = $(this).attr("data-type");
    if (data_type == 1 || data_type == 2) {
      $.isLoading({
        text: ""
      });
      $.ajax({
        type: "POST",
        url: site_url + "notify/view/",
        data: {
          data_target: data_target,
          data_type: data_type
        },
        cache: false,
        success: function(data) {
          if (data != false) {
            var obj = JSON.parse(data);
            console.log(obj.send_name);

            var user_img = "";
            var send_img = "";

            if (obj.user_name.images != "") {
              if (isUrlValid(obj.user_name.images)) {
                user_img = obj.user_name.images;
              } else {
                user_img =
                    site_url + "uploads/catalog/users/" + obj.user_name.images;
              }
            } else {
              user_img =
                  site_url + "uploads/catalog/users/avatar-placeholder.png";
            }

            if (obj.send_name.images != "") {
              if (isUrlValid(obj.send_name.images)) {
                send_img = obj.send_name.images;
              } else {
                send_img =
                    site_url + "uploads/catalog/users/" + obj.send_name.images;
              }
            } else {
              send_img =
                  site_url + "uploads/catalog/users/avatar-placeholder.png";
            }
            console.log(testImage(obj.user_name.images));

            $(
                "#datamodal .modal-dialog .modal-content .modal-header .modal-title"
            ).text(obj.title);
            var component =
                `
              <div class="col-md-4">
                 <div class="user">
                   <img class="profile-img" src="` +
                user_img +
                `" alt="">
                   <a href="` +
                site_url +
                `company/` +
                obj.user_name.slug +
                `"><h3 class="lead" align='center'>` +
                obj.user_name.company_name +
                `</h3></a>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="user">
                   <img class="profile-img" src="`+ci_custom_home_url+`templates/default/assets/img/sys/follow.png" alt="">
                   <p align='center'>` +
                obj.title +
                `</p>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="user">
                   <img class="profile-img" src="` +
                send_img +
                `" alt="">
                   <a href="` +
                site_url +
                `company/` +
                obj.send_name.slug +
                `"><h3 class="lead" align='center'>` +
                obj.send_name.company_name +
                `</h3></a>
                 </div>
              </div>
              `;
            $("#datamodal .modal-dialog .modal-content .modal-body").html(
                component
            );
            $("#datamodal .modal-dialog .modal-content .modal-body").css(
                "min-height",
                "180px"
            );
            $("#datamodal .modal-dialog .modal-content .modal-body").css(
                "max-height",
                "180px"
            );
            if ($("#datamodal").modal()) {
              $.isLoading("hide");
            }
          }
        }
      });
    }
    e.preventDefault();
    return false;
  });

  $(document).on("click", ".btn-more-info-product", function() {
    $("#moreInfo").isLoading({
      text: ""
    });
    var data_id = $(this).attr("data-target");
    var data_url = $(this).attr("data-url");
    $.ajax({
      type: "POST",
      url: site_url + "product/more/",
      data: {
        product_id: data_id
      },
      cache: false,
      success: function(data) {
        var chemical = jQuery.parseJSON(data.atc_code);
        var herbal = jQuery.parseJSON(data.herbal);
        var animal = jQuery.parseJSON(data.animal);
        var casNumber = jQuery.parseJSON(data.cas);
        var packing_type = jQuery.parseJSON(data.packing_type);
        var type_name = getProductType(data.pr_type).done(function(result) {
          return result;
        });

        $(".product_url").attr("href", data_url);
        $("#moreInfo").modal();
        setTimeout(function() {
          $("#moreInfo").isLoading("hide");
        }, 1000);
      }
    });
  });

  /* CHANGE */
  $(document).on("change", ".interest-inner .continent", function(e) {
    e.stopPropagation();
    var value = $(this).val();
    var that = $(this);
    $.ajax({
      type: "POST",
      url: site_url + "home/get_country/",
      data: {
        value: value
      },
      cache: false,
      success: function(data) {
        if (data != "danger") {
          var obj = jQuery.parseJSON(data);
          var component = "";
          $.each(obj, function(index, value) {
            component +=
                '<option value="' +
                value.id +
                '" selected="selected">' +
                value.name +
                "</option>";
          });
          console.log(component);
          console.log(
              that
                  .parent()
                  .parent()
                  .next()
          );
          var country_sel = that
              .parent()
              .parent()
              .next()
              .find("select");
          country_sel.empty().html(component);
          country_sel.selectpicker("destroy");
          country_sel.selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
        } else {
          that
              .parents(".form-group")
              .find('[name="country"]')
              .html("");
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
        }
      }
    });
  });

  $(".company_continent").change(function() {
    var value = $(this).val();
    $.ajax({
      type: "POST",
      url: site_url + "home/get_country/",
      data: {
        value: value
      },
      cache: false,
      success: function(data) {
        if (data != "danger") {
          var obj = jQuery.parseJSON(data);
          var component =
              '<select name="country[]" class="selectpicker show-menu-arrow company-country" data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 1" title="Country"> ';
          $.each(obj, function(index, value) {
            component +=
                '<option value="' +
                value.id +
                '" selected="selected">' +
                value.name +
                "</option>";
          });
          component += "</select>";
          $(".country-inner").html(component);
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
        } else {
          $(".country-inner").empty();
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
        }
      }
    });
  });

  $("#company_search_att_continent").change(function() {
    var value = $(this).val();
    $.ajax({
      type: "POST",
      url: site_url + "home/get_country/",
      data: {
        value: value
      },
      cache: false,
      success: function(data) {
        if (data != "danger") {
          var obj = jQuery.parseJSON(data);
          var component =
              '<select name="event_country[]" class="selectpicker show-menu-arrow company-country" data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 1" title="Country"> ';
          $.each(obj, function(index, value) {
            component +=
                '<option value="' +
                value.id +
                '" selected="selected">' +
                value.name +
                "</option>";
          });
          component += "</select>";
          $(".country-inner-company-search").html(component);
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
          $(".main-search-bar .selectpicker").on(
            "loaded.bs.select",
            function() {
              $(".bs-select-all").each(function(index, el) {
                $(this).replaceWith(
                  
                    '<input type="checkbox" checked id="selall' +
                    index +
                    '"><label for="selall' +
                    index +
                    '" class="sel-toggle">Select All</label>'
                );
                
              });
              $(this).closest('.btn-group').addClass('all-sl')
              $(".bs-deselect-all").remove();
            }
        );
        } else {
          $(".country-inner-company-search").empty();
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
        }
      }
    });
  });

  $(".show-menu-arrow.main_event_continent").change(function() {
    var value = $(this).val();
    $.ajax({
      type: "POST",
      url: site_url + "home/get_country/",
      data: {
        value: value
      },
      cache: false,
      success: function(data) {
        if (data != "danger") {
          var obj = jQuery.parseJSON(data);
          var component =
              '<select name="event_country[]" class="selectpicker show-menu-arrow company-country main_event_country" data-live-search="true" multiple data-actions-box="true"  data-selected-text-format="count > 1" title="Country"> ';
          $.each(obj, function(index, value) {
            component +=
                '<option value="' +
                value.id +
                '" selected="selected">' +
                value.name +
                "</option>";
          });
          component += "</select>";
          $(".country-inner-event").html(component);
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });

          $(".main-search-bar .selectpicker").on(
              "loaded.bs.select",
              function() {
                console.log("agagag");
                $(".bs-select-all").each(function(index, el) {
                  $(this).replaceWith(
                      '<input type="checkbox" id="selall' +
                      index +
                      '"><label for="selall' +
                      index +
                      '" class="sel-toggle">Select All</label>'
                  );
                });
                $(".bs-deselect-all").remove();
              }
          );
        } else {
          $(".country-inner").empty();
          $(".selectpicker").selectpicker({
            countSelectedText: function(num) {
              var title = $(this).attr("title");
              if (num > 0) {
                return title + "(" + num + ")";
              }
            }
          });
        }
      }
    });
  });

  $('#tabs-9 [name="event_continent[]"]').change(function() {
    var value = [];
    $("#tabs-9 input:checked").each(function(index, el) {
      value.push($(this).val());
    });
    $.ajax({
      type: "POST",
      url: site_url + "home/get_country/",
      data: {
        value: value
      },
      cache: false,
      success: function(data) {
        if (data != "danger") {
          var obj = jQuery.parseJSON(data);
          var component = "";
          $.each(obj, function(index, value) {
            component +=
                '<input type="checkbox" id="event_country' +
                value.id +
                '" value="' +
                value.id +
                '" checked="checked"><label for="event_country' +
                value.id +
                '">' +
                value.name +
                "</label><br>";
          });
          $("#tabs-10").html(component);
        } else {
          $("#tabs-10").empty();
        }
      }
    });
  });

  $(".advanced-pag .show-menu-arrow.main_search_type").change(function() {
    var value = $(this).val();
    if (value == 1) {
      search_type_event();
    } else if (value == 2) {
      search_type_tender();
    } else if (value == 3) {
      search_type_chemical();
    } else if (value == 4) {
      search_type_equipment();
    } else if (value == 5) {
      search_type_company();
    }
    $(".selectpicker").each(function(index, value) {
      $(this).selectpicker({
        countSelectedText: function(num) {
          var title = $(this).attr("title");
          if (num > 0) {
            return title + "(" + num + ")";
          }
        }
      });
    });
  });

  $(document).on("change", ".icon-input.type", function() {
    var value = $(this).val();
    if (value == "2" || value == "3" || value == "4") {
      $(".company_name").show();
    } else {
      $(".company_name").hide();
    }
  });

  /* KEYUP & KEYDOWN */
  $(document).on("keyup", ".module-search", function() {
    let _this, value;
    _this = $(this);
    value = _this.val().toLowerCase();
    var types = $(".discom ul.in").attr("id");
    var clone = "";
    $.ajax({
      type: "POST",
      url: site_url + "product/search/",
      data: {
        value: value,
        types: types
      },
      cache: false,
      success: function(data) {
        $.each(data, function(key, value) {
          if (types == "chemical") {
            clone +=
                '<li data-txt="' +
                value.meaning +
                '" data-no="' +
                value.atc_code +
                '" data-formula="" data-target="' +
                types +
                '" data-id="' +
                value.id +
                '">';
            clone += '<span class="ischeck"></span><a href="#">';
            clone +=
                '<div class="lib-span" data-toggle="tooltip" data-placement="right" title="' +
                value.meaning +
                '">' +
                value.atc_code +
                "</div>";
            clone += '<div class="lib-span2"> | ' + value.meaning + "</div>";
            clone += "</a>";
            clone += '<div class="clearfix"></div>';
            clone += "</li>";
          } else if (types == "herbal") {
            clone +=
                '<li data-txt="' +
                value.name +
                '" data-no="" data-formula="" data-target="' +
                types +
                '" data-id="' +
                value.id +
                '"><span class="ischeck"></span> <a href="#" title="' +
                value.name +
                '">' +
                value.name +
                "</a> </li>";
          } else if (types == "animal") {
            clone +=
                '<li data-txt="' +
                value.name +
                '" data-no="" data-formula="" data-target="' +
                types +
                '" data-id="' +
                value.id +
                '"><span class="ischeck"></span> <a href="#" data-toggle="tooltip" data-placement="right" title="' +
                value.name +
                '">' +
                value.name +
                "</a> </li>";
          } else if (types == "casNumber") {
            clone +=
                '<li data-txt="' +
                htmlEntities(value.chemical_name) +
                '" data-no="' +
                value.cas_no +
                '" data-formula="' +
                value.molecular_formula +
                '" data-target="' +
                types +
                '" data-id="' +
                value.id +
                '"> ';
            clone += '<span class="ischeck"></span><a href="#">';
            clone +=
                '<div class="lib-span3" data-toggle="tooltip" data-placement="right" title="' +
                htmlEntities(value.chemical_name) +
                '">' +
                value.cas_no +
                "</div>";
            clone +=
                '<div class="lib-span4"> | ' +
                value.chemical_name.substr(0, 14) +
                "</div>";
            clone += "</a>";
            clone += '<div class="clearfix"></div>';
            clone += "</li>";
          } else if (types == "dossageForm") {
            clone +=
                '<li data-txt="' +
                value.name +
                '" data-no="" data-formula="" data-target="' +
                types +
                '" data-id="' +
                value.id +
                '"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="' +
                value.name +
                '">' +
                value.name +
                "</a> </li>";
          } else if (types == "medicalClassification") {
            clone +=
                '<li data-txt="' +
                value.name +
                '" data-no="" data-formula="" data-target="' +
                types +
                '" data-id="' +
                value.id +
                '"><span class="ischeck"></span> <a href="#" data-toggle="tooltip" data-placement="right" title="' +
                value.name +
                '">' +
                value.name +
                "</a> </li>";
          } else {
            return false;
          }
        });
        if (data === false) {
          clone +=
              '<button type="button" class="btn btn-default show-sug mt-10" data-toggle="modal" data-type="' +
              types +
              '" data-target="#suggestionModal" style="display:block">+ Add your suggestion</button>';
        }
        $(".discom ul.in").html(clone);
        $(".discom ul.in li[data-target='chemical']").each(function(index, el) {
          $(".chemicalRow").each(function(index2, el2) {
            if (
                $(el).data("id") ==
                $(el2)
                    .find(".remove-item")
                    .data("cid")
            ) {
              $(el).addClass("selected");
            }
          });
        });

        $(".discom ul.in li[data-target='casNumber']").each(function(
            index,
            el
        ) {
          $(".cas-add-row").each(function(index2, el2) {
            if (
                $(el).data("id") ==
                $(el2)
                    .find(".remove-item")
                    .data("cid")
            ) {
              $(el).addClass("selected");
            }
          });
        });

        $(".discom ul.in li[data-target='herbal']").each(function(index, el) {
          $(".herbalRow").each(function(index2, el2) {
            if (
                $(el).data("id") ==
                $(el2)
                    .find(".remove-item")
                    .data("cid")
            ) {
              $(el).addClass("selected");
            }
          });
        });

        $(".discom ul.in li[data-target='animal']").each(function(index, el) {
          $(".animalRow").each(function(index2, el2) {
            if (
                $(el).data("id") ==
                $(el2)
                    .find(".remove-item")
                    .data("cid")
            ) {
              $(el).addClass("selected");
            }
          });
        });
      }
    });
  });
  $(document).on("keyup", function(e) {
    if (e.keyCode === 27) {
      $(".search-tool").removeClass("col-md-3");
      $(".search-tool").hide();
      $(".specilation").addClass("col-md-12");
      $(".specilation").removeClass("col-md-9");
      $(".blackstack").remove();
      $("html, body")
          .stop()
          .animate(
              {
                scrollTop: 120
              },
              500,
              function() {}
          );
    }
  });
  $(document).on("keydown", ".module-search", function(e) {
    count += 1;
    if (count == 1) {
      $(".discom ul.in li:first-child").addClass("selected");
    }
    switch (e.which) {
      case 40:
        e.preventDefault();
        $(".discom ul.in li:not(:last-child).selected")
            .removeClass("selected")
            .next()
            .addClass("selected");
        break;
      case 38:
        e.preventDefault();
        $(".discom ul.in li:not(:first-child).selected")
            .removeClass("selected")
            .prev()
            .addClass("selected");
        break;
    }
  });

  /* SCROOL */
  $(document).on("scroll", ".discom", function() {
    var types = $(".discom ul.in").attr("id");
    if (
        $(".discom").scrollTop() ==
        $(".discom ul.in").height() - $(".discom").height()
    ) {
      counted++;
      var periodic = $(".periodic.in").attr("id");
      var limit = 50;
      var key = $(".module-search").val();
      appendData(limit, counted, key, periodic, types);
    }
  });
  $(window).on("scroll", function(e) {
    var body = $(document).scrollTop();
    if (body >= 160) {
      $("#my-affix").css("position", "fixed");
      $("#my-affix").css("width", "270px");
      $("#my-affix").css("top", "0px");
      $("#my-affix").css("z-index", "1080");
    } else {
      $("#my-affix").removeAttr("style");
    }
  });

  /* SUBMIT */
  $(document).on("submit", "#validateForm", function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: site_url + "authentication/login/",
      data: $(this).serialize(),
      cache: false,
      success: function(data) {
        console.log(data);
        var obj = $.parseJSON(data);

        if (obj[0].login == "success") {
          if (obj[0].type == "success") {
            $.each(obj, function(key, value) {
              toastr.success(value.message);
            });
            window.location = site_url + "profile/";
          } else {
            $.each(obj, function(key, value) {
              toastr.error(value.message);
            });
          }
        } else {
          if (obj[0].type == "error") {
            $.each(obj, function(key, value) {
              toastr.error(value.message);
            });
          } else {
            $.each(obj, function(key, value) {
              toastr.success(value.message);
            });
          }
        }
      }
    });
    e.preventDefault();
    return false;
  });
  $(document).on("submit", "#validateRegister", function(e) {
    e.preventDefault();
    $("#validateRegister")
        .find('button[type="submit"]')
        .prop("disabled", true)
        .addClass("disabled");

    $.ajax({
      type: "POST",
      url: site_url + "authentication/register/",
      data: $(this).serialize(),
      cache: false,
      success: function(data) {
        console.log(data);
        var obj = jQuery.parseJSON(data);
        if (obj[0].login == "success") {
          if (obj[0].type == "success") {
            $.each(obj, function(key, value) {
              toastr.success(value.message);
            });
            window.location = site_url + "profile/settings/";
          } else {
            $("#validateRegister")
                .find('button[type="submit"]')
                .removeAttr("disabled")
                .removeClass("disabled");

            $.each(obj, function(key, value) {
              toastr.error(value.message);
            });
          }
        } else if (obj[0].login == "confirm") {
          if (obj[0].type == "success") {
            $.each(obj, function(key, value) {
              toastr.success(value.message);
            });
          } else {
            $("#validateRegister")
                .find('button[type="submit"]')
                .removeAttr("disabled")
                .removeClass("disabled");

            $.each(obj, function(key, value) {
              toastr.error(value.message);
            });
          }
        } else {
          if (obj[0].type == "error") {
            $("#validateRegister")
                .find('button[type="submit"]')
                .removeAttr("disabled")
                .removeClass("disabled");
            $.each(obj, function(key, value) {
              toastr.error(value.message);
            });
          } else {
            $.each(obj, function(key, value) {
              toastr.success(value.message);
            });
            setTimeout(function() {
              window.location.reload(false);
            }, 3000);
          }
        }
      }
    });
    e.preventDefault();
    return false;
  });

  /* CLICK */
  $(document).on("click", ".my_followers", function(e) {
    e.preventDefault();
    var user_id = $(this).attr("data-user-id");
    $.ajax({
      type: "POST",
      url: site_url + "follow/followers/",
      data: {
        user_id: user_id
      },
      cache: true,
      success: function(data) {
        console.log(data);
        var obj = jQuery.parseJSON(data);
        if (typeof obj == "object") {
          if (obj.length > 0) {
            var field = '<ul class="user_list_popup">';
            obj.forEach(function(element) {
              field += "<li>";
              field +=
                  '<a href="' + site_url + "company/" + element.slug + '">';
              if (element.company_name == "undefined") {
                field += "<h3>" + element.fullname + "</h3>";
              } else {
                field += "<h3>" + element.company_name + "</h3>";
              }
              field +=
                  "<p>" +
                  element.adress +
                  " <br/> <span>" +
                  element.website +
                  "</span></p>";
              field += "</a>";
              field += "</li>";
            });
            field += "</ul>";
            $(".data-title").text("Followers User");
            $(".data-body").html(field);
            $("#datamodal").modal();
          } else {
            var field = '<ul class="user_list_popup">';
            field += "<li>";
            field += '<a href="#">';
            field += "Followers not found";
            field += "</a>";
            field += "</li>";
            field += "</ul>";
            $(".data-title").text("Followers User");
            $(".data-body").html(field);
            $("#datamodal").modal();
          }
        } else {
          var field = '<ul class="user_list_popup">';
          field += "<li>";
          field += '<a href="#">';
          field += "Followers not found";
          field += "</a>";
          field += "</li>";
          field += "</ul>";
          $(".data-title").text("Followers User");
          $(".data-body").html(field);
          $("#datamodal").modal();
        }
      }
    });
    e.preventDefault();
    return false;
  });
  $(document).on("click", ".my_following", function() {
    var user_id = $(this).attr("data-user-id");
    $.ajax({
      type: "POST",
      url: site_url + "follow/following/",
      data: {
        user_id: user_id
      },
      cache: true,
      success: function(data) {
        console.log(data);
        var obj = jQuery.parseJSON(data);
        if (typeof obj == "object") {
          if (obj.length > 0) {
            var field = '<ul class="user_list_popup">';
            obj.forEach(function(element) {
              field += "<li>";
              field +=
                  '<a href="' + site_url + "company/" + element.slug + '">';
              if (element.company_name == "undefined") {
                field += "<h3>" + element.fullname + "</h3>";
              } else {
                field += "<h3>" + element.company_name + "</h3>";
              }
              field +=
                  "<p>" +
                  element.adress +
                  " <br/> <span>" +
                  element.website +
                  "</span></p>";
              field += "</a>";
              field += "</li>";
            });
            field += "</ul>";
            $(".data-title").text("Following User");
            $(".data-body").html(field);
            $("#datamodal").modal();
          } else {
            var field = '<ul class="user_list_popup">';
            field += "<li>";
            field += '<a href="#">';
            field += "Following not found";
            field += "</a>";
            field += "</li>";
            field += "</ul>";
            $(".data-title").text("Following User");
            $(".data-body").html(field);
            $("#datamodal").modal();
          }
        } else {
          var field = '<ul class="user_list_popup">';
          field += "<li>";
          field += '<a href="#">';
          field += "Following not found";
          field += "</a>";
          field += "</li>";
          field += "</ul>";
          $(".data-title").text("Following User");
          $(".data-body").html(field);
          $("#datamodal").modal();
        }
      }
    });
  });

  $(document).on(
      "click",
      ".copiered_person .intl-tel-input .country-list li.country",
      function() {
        var code = $(this).attr("data-country-code");
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .find(".dial-code")
            .val(code);
      }
  );
  $(document).on(
      "click",
      ".copiered_company .intl-tel-input .country-list li.country",
      function() {
        var code = $(this).attr("data-country-code");
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .find(".dial-code")
            .val(code);
      }
  );
  $(document).on(
      "click",
      ".copiered_person .intl-tel-input .country-list li.country",
      function() {
        var code = $(this).attr("data-country-code");
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .find(".dial-codes")
            .val(code);
      }
  );
  $(document).on(
      "click",
      ".copiered_company .intl-tel-input .country-list li.country",
      function() {
        var code = $(this).attr("data-country-code");
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .find(".dial-codes")
            .val(code);
      }
  );

  $(document).on("click", ".register_list_open", function() {
    $("#register_list a").trigger("click");
    $("html, body")
        .stop()
        .animate(
            {
              scrollTop: 0
            },
            500,
            function() {}
        );
  });
  $(document).on("click", ".open_table", function() {
    if ($(this).hasClass("fa-plus")) {
      $(this).removeClass("fa-plus");
      $(this).addClass("fa-minus");
      $(this)
          .parent()
          .parent()
          .find("td")
          .removeClass("closed_tb");
      $(this)
          .parent()
          .parent()
          .find("td")
          .addClass("opened_tb");
    } else {
      $(this).removeClass("fa-minus");
      $(this).addClass("fa-plus");
      $(this)
          .parent()
          .parent()
          .find("td")
          .addClass("closed_tb");
      $(this)
          .parent()
          .parent()
          .find("td")
          .removeClass("opened_tb");
    }
  });
  $(document).on("click", ".data-event button", function() {
    $(this)
        .parent()
        .find(".dropdown-menu.open")
        .toggle();
  });
  $(document).on(
      "click",
      ".atc_classifiction .btn.dropdown-toggle",
      function() {
        $(this)
            .parent()
            .find("div.dropdown-menu ul.dropdown-menu.inner li")
            .hide();
        $(this)
            .parent()
            .find("div.dropdown-menu ul.dropdown-menu.inner li.dropdown-header")
            .addClass("closed");
        $(this)
            .parent()
            .find("div.dropdown-menu ul.dropdown-menu.inner li.dropdown-header")
            .show();
      }
  );
  $(document).on("click", ".btn.dropdown-toggle", function() {
    zIndex();
    $(this)
        .parent()
        .css("z-index", "999999999");
  });
  $(document).on(
      "click",
      ".btn-group.bootstrap-select.show-menu-arrow.search-type",
      function() {
        zIndex();
        $(this)
            .parent()
            .css("z-index", "999999999");
      }
  );
  $(document).on("click", ".advanced-serach-icon", function() {
    $(".advanced-menu").toggle();
    $(".advanced-menu").toggleClass("is-shown");

    if ($(".wrap").hasClass("margin-top-135")) {
      $(".wrap").removeClass("margin-top-135");
      $(".tables-data thead.is-fixed").css("top", "35px");
    } else {
      $(".wrap").addClass("margin-top-135");
      $(".tables-data thead.is-fixed").css("top", "70px");
    }
  });
  $(document).on("click", ".blackstack", function() {
    $(".search-tool").removeClass("col-md-3");
    $(".search-tool").hide();
    $(".specilation").addClass("col-md-12");
    $(".specilation").removeClass("col-md-9");
    $(this).remove();
  });
  $(document).on("click", ".remove-item:not(.remove-c-row)", function() {
    var id = $(this).data("id");
    var that = $(this);
    if (confirm("Are you sure?")) {
      $.ajax({
        url: "/profile/delete_interest/",
        type: "POST",
        data: {
          id: id
        }
      }).done(function() {
        that
            .parent()
            .parent()
            .remove();
      });
    }
  });
  $(document).on("click", ".remove-item-dossage", function() {
    $(".dossage-limit").show();
    $(this)
        .parent()
        .parent()
        .remove();
  });
  $(document).on("click", ".remove-item-classifiction", function() {
    var id = $(this).data("cid");
    $(this)
        .parent()
        .parent()
        .parent()
        .remove();

    $('.search-tool li[data-id="' + id + '"]').removeClass("selected");
  });
  $(document).on("click", ".remove-trash", function() {
    $(this)
        .parents("tr")
        .remove();
  });
  $(document).on("click", ".exit-pop", function() {
    $(this)
        .parent(".feature-popup")
        .fadeOut();
  });
  $(document).on("click", ".events-overlay a", function(e) {
    e.preventDefault();
    $(this)
        .parents(".feature-events-content")
        .find(".feature-popup")
        .fadeIn();
    let parents, specialty, venue, type, from, tο, title, time, image;
    parents = $(this).parents(".events-item");
    title = parents.find(".events-title").text();
    time = parents.find(".events-time").text();
    specialty = parents.find(".events-special").text();
    venue = parents.find(".events-venue").text();
    href = $(this).attr("href");
    type = parents.find(".events-type").text();
    from = parents.find(".events-from").text();
    tο = parents.find(".events-to").text();
    image = parents.find(".events-img img").attr("src");
    $(".feature-popup .pop-title").text(title);
    $(".feature-popup .pop-time").text(time);
    $(".feature-popup .pop-special").text(specialty);
    $(".feature-popup .pop-venue").text(venue);
    $(".feature-popup .pop-type").text(type);
    $(".feature-popup .pop-from").text(from);
    $(".feature-popup .pop-to").text(tο);
    $(".feature-popup .pop-link a").attr("href", href);
    $(".feature-popup .pop-image img").attr("src", image);
    $(".feature-events-content")
        .stop()
        .animate(
            {
              scrollTop: 0
            },
            500,
            function() {}
        );
  });
  $(document).on("click", ".add-product-btn", function() {
    body.stop().animate(
        {
          scrollTop: 0
        },
        500,
        function() {}
    );
    $(this).hide();
    $(".close-product-btn").show();
  });
  $(document).on("click", ".close-product-btn", function() {
    body.stop().animate(
        {
          scrollTop: 0
        },
        500,
        function() {}
    );
    $(this).hide();
    $(".add-product-btn").show();
  });
  $(document).on("click", ".search-lending", function() {
    $(".search-tool").removeClass("col-md-3");
    $(".search-tool").hide();
    $(".specilation").addClass("col-md-12");
    $(".specilation").removeClass("col-md-9");
    $(".blackstack").remove();
    $("html, body")
        .stop()
        .animate(
            {
              scrollTop: 180
            },
            500,
            function() {}
        );
  });
  $(document).on(
      "click",
      "#validateRegister .col-md-6 .form-group .intl-tel-input .country-list li.country",
      function() {
        var code = $(this).attr("data-country-code");
        $(".dial-code").val(code);
      }
  );

  /* EACH */
  $("td.content > span").each(function() {
    if (
        checkOverflow($(this)) &&
        $(this)
            .parent()
            .siblings("td:first-child")
            .find(".fa-plus").length == 0
    ) {
      console.log(25);
      $(this)
          .parent()
          .siblings("td:first-child")
          .prepend('<i class="fa fa-plus open_table"></i>');
    }
  });
  $("td.three > span").each(function() {
    if (
        checkOverflow($(this)) &&
        $(this)
            .parent()
            .siblings("td:first-child")
            .find(".fa-plus").length == 0
    ) {
      $(this)
          .parent()
          .siblings("td:first-child")
          .append('<i class="fa fa-plus open_table"></i>');
    }
  });

  /* PLUGIN */
  $("#ev_start").datepicker({
    daysOfWeekDisabled: "0",
    autoclose: true,
    todayHighlight: true,
    toggleActive: true
  });

  $("#ev_end").datepicker({
    daysOfWeekDisabled: "0",
    autoclose: true,
    todayHighlight: true,
    toggleActive: true
  });

  $("#ev_start .input-group-addon").on("click", function(e) {
    e.preventDefault();
    $("#ev_start")
        .data("DateTimePicker")
        .show();
  });

  $("#ev_end .input-group-addon").on("click", function(e) {
    e.preventDefault();
    $("#ev_end")
        .data("DateTimePicker")
        .show();
  });

  $('[data-toggle="tooltip"]').tooltip();
  $("#validateForm").validate({
    rules: {
      email: "required",
      password: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      email: "Enter your email address",
      password: {
        required: "Enter your password",
        minlength: "The password must be at least 8 characters long"
      }
    }
  });
  $("#validateRegister").validate({
    rules: {
      fristname: "required",
      lastname: "required",
      phone: "required",
      email: "required",
      reemail: "required",
      type: "required",
      password: {
        required: true,
        minlength: 5
      },
      repassword: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      fristname: "Enter your name",
      lastname: "Enter your last name",
      phone: "Enter your phone number",
      email: "Enter your email address",
      reemail: "Enter your Retype Email Address",
      type: "Select the user type",
      password: {
        required: "Enter your password",
        minlength: "The password must be at least 8 characters long"
      },
      repassword: {
        required: "Enter your Recipient Password again",
        minlength: "Repeat password must be at least 8 characters long"
      }
    }
  });

  $(document).ready(function() {
    var dial_codes = $(".dial-code").val();
    var dial_up = $(".dial-up").val();
    $(".phone").intlTelInput({
      initialCountry: dial_codes
    });
    $(".phones").intlTelInput({
      initialCountry: dial_up
    });
  });

  /* CUSTOM FUNCTION */
  setTimeout(function() {
    typeWriter();
  }, 2000);
  mini_upload();
  bigUpload();
  $.isLoading("hide");
});
/* TRIGGER */
$(document).ready(function() {
  $(".icon-input.type").trigger("change");
  $(".show-menu-arrow.main_search_type").trigger("change");
  $(".selectpicker").selectpicker({
    countSelectedText: function(num) {
      var title = $(this).attr("title");
      if (num > 0) {
        return title + "(" + num + ")";
      }
    }
  });
});

function strip(html) {
  var tmp = document.createElement("DIV");
  tmp.innerHTML = html;
  return tmp.textContent || tmp.innerText || "";
}

var sr_results;
var targ;
var isSel;

$(document).ready(function() {
  if ($(".search-table-wrp").length) {
    var table = $("#example").DataTable({
      dom: "lrtip",
      bPaginate: true,
      bLengthChange: false,
      pageLength: 20,
      bFilter: true,
      bInfo: false,
      ordering: false,
      bAutoWidth: false,
      processing: true,
      serverSide: true,
      ajax: {
        url: ci_custom_home_url+"search/get_formatted_results",
        dataFilter: function(data) {
          var json = jQuery.parseJSON(data);
          sr_data = json;

          //console.log(sr_data);

          if (
              (targ != undefined &&
                  !targ.hasClass("product_type") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("pr_type");
            var pr_types1 = sr_data.filterOptions.pr_types;
            var pr_types = Object.keys(pr_types1).map(function(key) {
              return pr_types1[key];
            });

            $(".product_type option").show();
            if (pr_types != undefined) {
              $(".product_type option").each(function(index, el) {
                if (pr_types.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".product_type").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_content") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("content");
            var content1 = sr_data.filterOptions.content;
            var content = Object.keys(content1).map(function(key) {
              return content1[key];
            });

            $(".select_content option").show();
            if (content != undefined) {
              $(".select_content option").each(function(index, el) {
                if (content.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_content").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_dossage") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("dosage");
            var dosage1 = sr_data.filterOptions.dosage;
            var dosage = Object.keys(dosage1).map(function(key) {
              return dosage1[key];
            });

            $(".select_dossage option").show();
            if (dosage != undefined) {
              console.log(1);
              $(".select_dossage option").each(function(index, el) {
                if (dosage.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_dossage").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_country") &&
                  !targ.parent().hasClass("select_country") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("country");
            var country1 = sr_data.filterOptions.country;
            var country = Object.keys(country1).map(function(key) {
              return country1[key];
            });

            $(".select_country option").show();
            if (country != undefined) {
              $(".select_country option").each(function(index, el) {
                if (country.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_country").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_medical") &&
                  !targ.parent().hasClass("select_medical") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("medical");
            var medical1 = sr_data.filterOptions.medical;
            var medical = Object.keys(medical1).map(function(key) {
              return medical1[key];
            });

            $(".select_medical option").show();
            if (medical != undefined) {
              $(".select_medical option").each(function(index, el) {
                if (medical.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_medical").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_company") &&
                  !targ.parent().hasClass("select_company") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("company");
            var company1 = sr_data.filterOptions.company;
            var company = Object.keys(company1).map(function(key) {
              return company1[key];
            });

            $(".select_company option").show();
            if (medical != undefined) {
              $(".select_company option").each(function(index, el) {
                if (company.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_company").selectpicker("refresh");
          }

          return data;
        }
        /* "data":{
           "query":"<?php echo $srquery ?>"
         }*/
      },
      dom: "frtipB",
      columns: [
        {
          className: "closed_tb one"
        },
        {
          className: "closed_tb two"
        },
        {
          className: "closed_tb three"
        },
        {
          className: "closed_tb four content"
        },
        {
          className: "closed_tb five"
        },
        {
          className: "closed_tb six"
        },
        {
          className: "closed_tb seven"
        },
        {
          className: "closed_tb eight"
        },
        {
          className: "closed_tb nine"
        }
      ],
      columnDefs: [
        {
          targets: "no-sort",
          orderable: false,
          className: "mdl-data-table__cell--non-numeric"
        }
      ],
      fnDrawCallback: function(oSettings) {
        $("td.content > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });

        $("td.three > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
        $("td.seven > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
      },

      initComplete: function() {
        $('#example [data-toggle="tooltip"]').tooltip();

        $("td.content > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
        $("td.three > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
        $("td.seven > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });

        // Product Type
        this.api()
            .columns([1])
            .every(function() {
              var element = [];
              var column = this;
              var select = $("select.product_type");
              $.ajax({
                url: ci_custom_home_url+"search/get_product_type",
                dataType: "json"
              }).done(function(data) {
                // console.log(data);

                $.each(data, function(index, value) {
                  select.append(
                      '<option value="' + value.id + '">' + value.name + "</option>"
                  );
                });
                $("select.product_type").selectpicker("refresh");
              });
            });

        function ArrNoDupe(a) {
          var temp = {};
          for (var i = 0; i < a.length; i++) temp[a[i]] = true;
          var r = [];
          for (var k in temp) r.push(k);
          return r;
        }

        // Content
        this.api()
            .columns([3])
            .every(function() {
              var element = [];
              var column = this;
              var select = $("select.select_content");
              $.ajax({
                url: ci_custom_home_url+"search/get_product_atc",
                dataType: "json"
              }).done(function(data) {
                // console.log(data);

                $.each(data, function(index, value) {
                  select.append(
                      '<option value="' +
                      value.meaning +
                      '">' +
                      value.meaning +
                      "</option>"
                  );
                });
                $("select.select_content").selectpicker("refresh");
              });
            });

        this.api()
            .columns([4])
            .every(function() {
              var element = [];
              var column = this;
              var select = $("select.select_dossage");
              $.ajax({
                url: ci_custom_home_url+"search/get_product_packing",
                dataType: "json"
              }).done(function(data) {
                $.each(data, function(index, value) {
                  select.append(
                      '<option value="' +
                      value.name +
                      '">' +
                      value.name +
                      "</option>"
                  );
                });
                $("select.select_dossage").selectpicker("refresh");
              });
            });
        this.api()
            .columns([5])
            .every(function() {
              var element = [];
              var column = this;
              var select = $("select.select_country");

              $.ajax({
                url: ci_custom_home_url+"search/get_product_country",
                dataType: "json"
              }).done(function(data) {
                $.each(data, function(index, value) {
                  select.append(
                      '<option value="' + value.id + '">' + value.name + "</option>"
                  );
                });
                $("select.select_country").selectpicker("refresh");
              });
            });
        this.api()
            .columns([6])
            .every(function() {
              var element = [];
              var column = this;
              var select = $("select.select_medical");

              $.ajax({
                url: ci_custom_home_url+"search/get_product_medical",
                dataType: "json"
              }).done(function(data) {
                $.each(data, function(index, value) {
                  select.append(
                      '<option value="' + value.id + '">' + value.name + "</option>"
                  );
                });
                $("select.select_medical").selectpicker("refresh");
              });
            });
        this.api()
            .columns([7])
            .every(function() {
              var element = [];
              var column = this;
              var select = $("select.select_company");

              $.ajax({
                url: ci_custom_home_url+"search/get_product_company",
                dataType: "json"
              }).done(function(data) {
                $.each(data, function(index, value) {
                  select.append(
                      '<option value="' +
                      value.id +
                      '">' +
                      value.company_name +
                      "</option>"
                  );
                });
                $("select.select_company").selectpicker("refresh");
              });
            });
        // $(".selectpicker").selectpicker();

        $("thead th").removeClass("closed_tb");
        //   $('thead th').removeClass('');
      }
    });

    $(".product_type").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".product_type option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(1)
          .search(search, true, false)
          .draw();
    });

    $(".select_content").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_content option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(3)
          .search(search, true, false)
          .draw();
    });
    $(".select_dossage").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_dossage option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      var sr_data = table
          .column(4)
          .search(search, true, false)
          .draw();
    });
    $(".select_country").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_country option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(5)
          .search(search, true, false)
          .draw();
    });
    $(".select_medical").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_medical option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(6)
          .search(search, true, false)
          .draw();
    });
    $(".select_company").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_company option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(7)
          .search(search, true, false)
          .draw();
    });
    $(".brand_name").on("change", function() {
      var search = $(this).val();
      table
          .column(2)
          .search(search, true, false)
          .draw();
    });
  }
});

$(document).ready(function() {
  if ($(".search-table-wrp2").length) {
    var table = $("#example2").DataTable({
      dom: "lrtip",
      bPaginate: true,
      bLengthChange: false,
      pageLength: 20,
      bFilter: true,
      bInfo: false,
      ordering: false,
      bAutoWidth: false,
      processing: true,
      serverSide: true,
      ajax: {
        url: ci_custom_home_url+"search/get_formatted_results2",
        dataFilter: function(data) {
          var json = jQuery.parseJSON(data);

          sr_data = json;

          console.log(sr_data);

          if (
              (targ != undefined &&
                  !targ.hasClass("product_type") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("pr_type");
            var pr_types1 = sr_data.filterOptions.pr_types;
            var pr_types = Object.keys(pr_types1).map(function(key) {
              return pr_types1[key];
            });

            $(".product_type option").show();
            if (pr_types != undefined) {
              $(".product_type option").each(function(index, el) {
                if (pr_types.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".product_type").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_content") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("content");
            var content1 = sr_data.filterOptions.content;
            var content = Object.keys(content1).map(function(key) {
              return content1[key];
            });

            $(".select_content option").show();
            if (content != undefined) {
              $(".select_content option").each(function(index, el) {
                if (content.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_content").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_dossage") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("dosage");
            var dosage1 = sr_data.filterOptions.dosage;
            var dosage = Object.keys(dosage1).map(function(key) {
              return dosage1[key];
            });

            $(".select_dossage option").show();
            if (dosage != undefined) {
              console.log(1);
              $(".select_dossage option").each(function(index, el) {
                if (dosage.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_dossage").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_country") &&
                  !targ.parent().hasClass("select_country") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("country");
            var country1 = sr_data.filterOptions.country;
            var country = Object.keys(country1).map(function(key) {
              return country1[key];
            });

            $(".select_country option").show();
            if (country != undefined) {
              $(".select_country option").each(function(index, el) {
                if (country.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_country").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_continent") &&
                  !targ.parent().hasClass("select_continent") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("continent");
            var continent1 = sr_data.filterOptions.continent;
            var continent = Object.keys(continent1).map(function(key) {
              return continent1[key];
            });

            $(".select_continent option").show();
            if (continent != undefined) {
              $(".select_continent option").each(function(index, el) {
                if (continent.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_continent").selectpicker("refresh");
          }

          if (
              (targ != undefined &&
                  !targ.hasClass("select_trade_term") &&
                  !targ.parent().hasClass("select_trade_term") &&
                  sr_data != undefined) ||
              !isSel
          ) {
            console.log("trade_term");
            var trade_term1 = sr_data.filterOptions.trade_term;
            var trade_term = Object.keys(trade_term1).map(function(key) {
              return trade_term1[key];
            });

            $(".select_trade_term option").show();
            if (trade_term != undefined) {
              $(".select_trade_term option").each(function(index, el) {
                if (trade_term.indexOf($(this).attr("value")) == -1) {
                  $(this).hide();
                }
              });
            }
            $(".select_trade_term").selectpicker("refresh");
          }

          return data;
        }
        /* "data":{
           "query":"<?php echo $srquery ?>"
         }*/
      },
      dom: "frtipB",
      columns: [
        {
          className: "closed_tb one"
        },
        {
          className: "closed_tb two"
        },
        {
          className: "closed_tb three"
        },
        {
          className: "closed_tb four content"
        },
        {
          className: "closed_tb five"
        },
        {
          className: "closed_tb six"
        },
        {
          className: "closed_tb seven"
        },
        {
          className: "closed_tb eight"
        },
        {
          className: "closed_tb nine"
        }
      ],
      columnDefs: [
        {
          targets: "no-sort",
          orderable: false,
          className: "mdl-data-table__cell--non-numeric"
        }
      ],
      fnDrawCallback: function(oSettings) {
        $("td.content > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });

        $("td.three > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
        $("td.seven > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
      },

      initComplete: function() {
        $('#example2 [data-toggle="tooltip"]').tooltip();

        $("td.content > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
        $("td.three > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });
        $("td.seven > span").each(function() {
          if (
              checkOverflow($(this)) &&
              $(this)
                  .parent()
                  .siblings("td:first-child")
                  .find(".fa-plus").length == 0
          ) {
            $(this)
                .parent()
                .siblings("td:first-child")
                .append('<i class="fa fa-plus open_table"></i>');
          }
        });

        function ArrNoDupe(a) {
          var temp = {};
          for (var i = 0; i < a.length; i++) temp[a[i]] = true;
          var r = [];
          for (var k in temp) r.push(k);
          return r;
        }

        // Product Type
        /*this.api().columns([1]).every(function() {
          var element = [];
          var column = this;
          var select = $("select.product_type");
          $.ajax({
              url: ci_custom_home_url+'search/get_tender_product_type',
              dataType: 'json'
            })
            .done(function(data) {
              // console.log(data);

              $.each(data, function(index, value) {
                select.append('<option value="' + value.id + '">' + value.name + '</option>');
              });
              $("select.product_type").selectpicker('refresh');

            })
        });*/

        // Content
        /*this.api().columns([3]).every(function() {
          var element = [];
          var column = this;
          var select = $("select.select_content");
          $.ajax({
              url: ci_custom_home_url+'search/get_product_atc',
              dataType: 'json'
            })
            .done(function(data) {
              // console.log(data);

              $.each(data, function(index, value) {
                select.append('<option value="' + value.meaning + '">' + value.meaning + '</option>');
              });
              $("select.select_content").selectpicker('refresh');

            })


        });*/

        /*this.api().columns([4]).every(function() {
          var element = [];
          var column = this;
          var select = $("select.select_dossage");
          $.ajax({
              url: ci_custom_home_url+'search/get_product_packing',
              dataType: 'json'
            })
            .done(function(data) {

              $.each(data, function(index, value) {
                select.append('<option value="' + value.name + '">' + value.name + '</option>');
              });
              $("select.select_dossage").selectpicker('refresh');

            })

        });*/

        /*this.api().columns([5]).every(function() {
          var element = [];
          var column = this;
          var select = $("select.select_country");

          $.ajax({
              url: ci_custom_home_url+'search/get_tender_country',
              dataType: 'json'
            })
            .done(function(data) {
              $.each(data, function(index, value) {
                select.append('<option value="' + value.id + '">' + value.name + '</option>');
              });
              $("select.select_country").selectpicker('refresh');
            })

        });*/

        /*this.api().columns([6]).every(function() {
          var element = [];
          var column = this;
          var select = $("select.select_continent");

          $.ajax({
              url: ci_custom_home_url+'search/get_tender_continent',
              dataType: 'json'
            })
            .done(function(data) {
              $.each(data, function(index, value) {
                select.append('<option value="' + value.id + '">' + value.name + '</option>');
              });
              $("select.select_continent").selectpicker('refresh');
            })

        });*/

        /*this.api().columns([7]).every(function() {
          var element = [];
          var column = this;
          var select = $("select.select_trade_term");

          $.ajax({
              url: ci_custom_home_url+'search/get_tender_trade_term',
              dataType: 'json'
            })
            .done(function(data) {
              $.each(data, function(index, value) {
                select.append('<option value="' + value.id + '">' + value.name + '</option>');
              });
              $("select.select_trade_term").selectpicker('refresh');
            })

        });*/
        // $(".selectpicker").selectpicker();

        $("thead th").removeClass("closed_tb");
        //   $('thead th').removeClass('');
      }
    });

    $(".product_type").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".product_type option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(1)
          .search(search, true, false)
          .draw();
    });

    $(".select_content").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_content option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(3)
          .search(search, true, false)
          .draw();
    });
    $(".select_dossage").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_dossage option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      var sr_data = table
          .column(4)
          .search(search, true, false)
          .draw();
    });
    $(".select_country").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_country option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(5)
          .search(search, true, false)
          .draw();
    });
    $(".select_continent").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_continent option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(6)
          .search(search, true, false)
          .draw();
    });
    $(".select_trade_term").on("changed.bs.select", function(
        e,
        clickedIndex,
        isSelected,
        previousValue
    ) {
      var search = [];
      targ = $(e.target);
      isSel = isSelected;
      $.each($(".select_trade_term option:selected"), function() {
        search.push($(this).val());
      });
      search = search.join("|");
      regExSearch = "^\\s" + search + "\\s*$";
      table
          .column(7)
          .search(search, true, false)
          .draw();
    });
    $(".tender_name").on("change", function() {
      var search = $(this).val();
      table
          .column(2)
          .search(search, true, false)
          .draw();
    });
  }
});

/*
$('#country .country-item').on('click',function(e){
  e.preventDefault();
  var country_id = $(this).data('id');
  var form = $('.header form');
  form.append('<input type="hidden" name="country" value="'+country_id+'">');
   form[0].submit();
})
*/
$(document).on("click", "#iagree", function(e) {
  e.preventDefault();
  $("#sing-term").prop("checked", "true");
  $("#termModal").modal("hide");
});
$(document).on("click", "#signInToggle", function(e) {
  e.preventDefault();
  e.stopPropagation();
  $("#signInBox").toggle();
  $("#signUpBox").hide();
});

$(document).on("click", "#signUpToggle", function(e) {
  e.preventDefault();
  e.stopPropagation();
  $("#signUpBox").toggle();
  $("#signInBox").hide();
});

$(document).on("click", "#advSearch", function(e) {
  e.preventDefault();
  console.log(
      $(this)
          .parent()
          .siblings()
  );
  console.log($(this));
  $(this)
      .parent()
      .siblings()
      .show();
});

$(document).on("submit", "#suggestionForm", function(e) {
  e.preventDefault();
  var suggestInfo = $(this).serialize();
  var button = $(this).find('button[type="submit"]');
  var btntext = button.html();
  $(this)
      .find("button")
      .prop("disabled", true)
      .html('<i class="fa fa-spinner fa-pulse"></i>');
  console.log(suggestInfo);
  $.ajax({
    url: site_url + "home/suggestion/",
    type: "POST",
    data: suggestInfo
  }).done(function(data) {
    if (data.indexOf("ok") != -1) {
      button
          .removeClass("disabled")
          .removeAttr("disabled")
          .html(btntext);
      // $("#suggestionModal .modal-body").prepend('<div class="alert alert-success">'+Words.suggadded+'</div>');
      $("#suggestionModal").modal("hide");
      toastr.success("Thank you! Your suggestion is submitted for approval.");
    } else {
      toastr.error("Server error. Please try again later");
    }
  });
});

$("#suggestionModal").on("shown.bs.modal", function(event) {
  $(this)
      .find('[name="name"]')
      .val("");
  $(this)
      .find('[name="text"]')
      .val("");
  $(this)
      .find('[name="text2"]')
      .val("");
  $(this)
      .find(".alert")
      .remove();
  var datat = $(event.relatedTarget)
      .parent()
      .parent()
      .parent()
      .next()
      .attr("name");
  if (datat == undefined) {
    datat = $(event.relatedTarget).data("type");
  }
  $(this)
      .find("input[name='type']")
      .val(datat.replace("[]", ""));
  var suggestion = $(event.relatedTarget)
      .parent()
      .parent()
      .prev()
      .find("input")
      .val();
  $(this)
      .find("input[name='name']")
      .val(suggestion);
  $(event.relatedTarget)
      .parents(".btn-group")
      .css("z-index", "10");
  if (datat == "casNumber") {
    $(".fr-3").show();
    $(".fr-2 label").text("Cas no");
  } else {
    $(".fr-3").hide();
    $(".fr-2 label").text("Description");
  }
});

/*$(document).on('click','.show-sug',function(e){
  e.preventDefault();
  e.stopPropagation();
  $('#suggestionModal').modal('show');
})
*/

$(".sel-all").on("click", function(e) {
  e.preventDefault();
  $(this)
      .parents(".ui-tabs-panel")
      .find(".col-md-12")
      .find('input[type="checkbox"]')
      .prop("checked", true);
});

$(".desel-all").on("click", function(e) {
  e.preventDefault();
  $(this)
      .parents(".ui-tabs-panel")
      .find(".col-md-12")
      .find('input[type="checkbox"]')
      .prop("checked", false);
});

if ($("#tabs-1").length) {
  var options = {
    valueNames: ["name"]
  };

  var srList1 = new List("tabs-1", options);
  var srList2 = new List("tabs-2", options);
  var srList3 = new List("tabs-3", options);
  var srList5 = new List("tabs-5", options);
  var srList6 = new List("tabs-6", options);
  var srList7 = new List("tabs-7", options);

  srList7.on("updated", function(e) {
    var val = $("#tabs-7 .search").val();
    if (val !== "") {
      $("#tabs-7 .panel").hide();
      $("#tabs-7 .list.list-group").show();
    } else {
      $("#tabs-7 .panel").show();
      $("#tabs-7 .list.list-group").hide();
    }
  });
}

$(document).on("submit", ".forgetPassword", function(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: site_url + "authentication/forget/",
    data: $(this).serialize(),
    cache: false,
    success: function(data) {
      toastr.success("The link has been sended to your mail address");
      $("#forgot_password_messge").text("The link has been sended to your mail address");
      $("#forgetPassword").modal("hide");
    }
  });
  e.preventDefault();
  return false;
});

$("*").on("click", function(e) {
  if ($(window).width() > 768)
    if (
        $(".login-box-cont").has(e.target).length == 0 &&
        $(".loginbox").has(e.target).length == 0 &&
        $("#iagree").has(e.target).length == 0
    ) {
      $(".login-box-cont").hide();
      $(".s-overlay").hide();
    }
});

$(document).ready(function() {
  if ($("#autoCompSr").length) {
    $("#autoCompSr")
        .autocomplete({
          source: site_url + "getProductList",
          minLength: 2,
          select: function(event, ui) {
            var alias = ui.item.alias;
            window.location = alias;
          }
        })
        .data("ui-autocomplete")._renderItem = function(ul, item) {
      var st = item.type !== undefined ? "hasborder" : "";
      return $('<li class="' + st + '"></li>')
          .data("item.autocomplete", item)
          .append("<div>" + item.label + "</div>")
          .appendTo(ul);
    };
  }
});

$(document).ready(function() {
  setTimeout(function() {
    $(".main_atc_classifiction .dropdown-header").each(function(index, el) {
      $(this).addClass("closed");
      $(this)
          .siblings("li:not(.divider):not(.dropdown-header)")
          .hide();
    });
  }, 3000);
});

$(".main-search-bar #event .selectpicker").on("show.bs.select", function() {
  console.log(1212);
  if (
      !$(this)
          .parent()
          .hasClass("data-event")
  ) {
    $(".data-event .dropdown-menu.open").css("display", "none");
    //   $('.data-event .dropdown-menu').hide();
  }
});

if ($(window).width() < 768) {
  $(".mobile-advsearch-outer .adv-search-button").click(function() {
    $(".tab-content").slideToggle();
  });
}

if ($(window).width() > 767) {
  $(document).on("click", ".triggerSignup", function(e) {
    e.preventDefault();

    $("#signUpBox")
        .addClass("in-middle")
        .show();
    $(".s-overlay").show();
  });

  $(".in-middle .fa-times").on("click", function() {
    $(".s-overlay").hide();
  });
} else {
  $(document).on("click", ".triggerSignup", function(e) {
    e.preventDefault();
    $("html, body")
        .stop()
        .animate(
            {
              scrollTop: 0
            },
            500,
            function() {
              $("#signUpBox").show();
            }
        );
  });
}

$(document).on(
    "click",
    "#add-product .plus_item span, #add-product .minus_item span",
    function() {
      $("#plusModal").modal("show");
    }
);

$(document).ready(function(){
  var boxWidth = $(".n_side_section").width(); 
  $("#menu_hide").on('click', function(){
      $(".n_side_section").animate({ 
        width: 0 
    }); 
    $('.userSettings').fadeOut();
    $('.n_right_section').css("padding-left", boxWidth)
      $('.n_right_section').addClass('n_right_section_full_width');
      $('#openMenu').fadeIn();
  });

  $('#openMenu').on('click', function(){
    $(".n_side_section").animate({ 
      width: boxWidth
  }); 
    $('.n_right_section').removeClass('n_right_section_full_width');
    $('.userSettings').fadeIn("slow");
    $('.n_right_section').removeAttr('style');
    $('#openMenu').fadeOut();
  });
});