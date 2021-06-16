<?php
/* Smarty version 3.1.30, created on 2020-09-06 08:47:23
  from "/home/makromed/public_html/demo/templates/default/company/public-user-profile.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f5469db966621_47404725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da32bd1bc84740c69d176ce2caa4082f79614cac' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-user-profile.tpl',
      1 => 1599367640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f5469db966621_47404725 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20938552075f5469db965682_06911503', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_20938552075f5469db965682_06911503 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <?php echo '<script'; ?>
 src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"><?php echo '</script'; ?>
>
    <div class="n_content_area full_width">
        <div class="container-fluid">
            <div class="row">


            <div class="n_side_section">
            <div class="userSettings">
                <div class="n_top_data">
                <a href="#" id="menu_hide">Hide</a>
                    <div class="n_profile_img img_fit">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['user_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->fullname;?>
" id="n_profile_img_uploaded" />
                    </div><!-- /.n_profile_img -->
                    <h2>
                        <?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->fullname;?>

                        <span>
                        <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->position)) {
echo $_smarty_tpl->tpl_vars['publicprofile']->value->position_name;
}?>
                    </span>
                    </h2>
                    <hr>
                    <?php if (isset($_smarty_tpl->tpl_vars['settings']->value) && $_smarty_tpl->tpl_vars['settings']->value == 1) {?>
                        <h6><?php echo $_smarty_tpl->tpl_vars['user_followers']->value;?>
<span>Followers</span></h6>
                        <h6><?php echo $_smarty_tpl->tpl_vars['user_following']->value;?>
<span>Following</span></h6>
                    <?php } else { ?>
                        <h6><?php echo $_smarty_tpl->tpl_vars['user_followers']->value;?>
<span>Followers</span></h6>
                        <h6><?php echo $_smarty_tpl->tpl_vars['user_following']->value;?>
<span>Following</span></h6>
                        
                    <?php }?>
                </div><!-- /.n_top_data -->
        
                <div class="n_navigation">
                    <ul>
                        <li>
                            <a href="<?php echo site_url_multi('/');?>
profile/" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 1) {?> class="active" <?php }?>><img
                                        src="<?php echo base_url('templates/default/assets/images/icons/pf_icon.png');?>
"/><span>Profile View</span></a>
                        </li>
                    </ul>
                </div><!-- /.n_navigation -->
            </div>
        </div><!-- /.n_side_section -->


                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width">
                        <h2>PROFILE INFORMATION</h2>
                       
                    </div><!-- /.with_buttons -->
                    

                    

                    <div class="full_width max-arrange">
                        <div class="drt_form full_width">
                            <div class="full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->fullname)) {?>
                                    <div class="fst_col">
                                        <label>Full Name <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->fullname;?>
</span></label>
                                        
                                    </div>
                                    <!-- /.fst_col -->
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->company_name)) {?>
                                    <div class="snd_col">
                                        <label>Company <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->company_name;?>
</span></label>
                                    </div>
                                    <!-- /.snd_col -->
                                <?php }?>
                            </div><!-- /.full_width -->
                            <div class="full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->position)) {?>
                                    <div class="fst_col">
                                        <label>Your Position <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->position_name;?>
</span></label>
                                    </div>
                                    <!-- /.fst_col -->
                                <?php }?>
                                <div class="snd_col">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->brith_day)) {?>
                                        <label>Date of Birth
                                            <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->brith_day;?>

                                                <div class="drop_cstm" style="right: -25px">
                                                    <button disabled type="button" id="setVal" class="setVal">
                                                        <img
                                                                <?php if ($_smarty_tpl->tpl_vars['publicprofile']->value->display_dob == 1) {?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                                alt="Public"
                                                                <?php } else { ?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                                alt="Public"
                                                                <?php }?>
                                                        />
                                                    </button>
                                                </div>
                                            </span>
                                        </label>
                                    <?php }?>
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                        </div><!-- /.drt_form -->

                        <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->personal_info)) {?>
                            <div class="n_personal_info full_width">
                                <h3>PERSONAL INFO</h3>
                                <p><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->personal_info;?>
</p>
                            </div>
                            <!-- /.personal_info -->
                        <?php }?>

                        <div class="n_contact_info full_width">
                            <h3>CONTACT INFO</h3>
                            <div class="drt_form full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->phone)) {?>
                                    <div class="full_width">
                                        <label>Phone Number
                                            <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->phone;?>

                            				<div class="drop_cstm" style="right: -25px;">
                                                <button disabled type="button" id="phonesetVal" class="setVal">
                                                    <img
                                                            <?php if ($_smarty_tpl->tpl_vars['publicprofile']->value->display_phone == 1) {?>
                                                            src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                            alt="Public"
                                                            <?php } else { ?>
                                                            src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                            alt="Public"
                                                            <?php }?>
                                                    />
                                                </button>
                                            </div>
                                        </span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->email)) {?>
                                    <div class="full_width">
                                        <label>E-mail
                                            <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->email;?>

                            				<div class="drop_cstm"style="right: -25px;">
                                                <button disabled type="button" id="emailsetVal" class="setVal">
                                                    <img
                                                            <?php if ($_smarty_tpl->tpl_vars['publicprofile']->value->display_email == 1) {?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                                alt="Public"
                                                                <?php } else { ?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                                alt="Public"
                                                                <?php }?>
                                                    />
                                                </button>
                                            </div>
                                        </span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                <?php }?>

                                <div class="full_width">
                                    <label>City, Country <span><?php echo get_country_name($_smarty_tpl->tpl_vars['publicprofile']->value->country_id);?>
</span></label>
                                </div><!-- /.full_width -->

                                <div class="full_width">
                                    <label>Address <span><?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->adress;?>
</span></label>
                                </div><!-- /.full_width -->
                            </div><!-- /.drt_form -->
                            <div class="full_width map__" id="maps">
                                
                            </div><!-- map__-->

                            <div class="n_social_block full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->facebook)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->facebook;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_face.png');?>
"
                                                alt="Facebook"/></a>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->twitter)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->twitter;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_twit.png');?>
"
                                                alt="Twitter"/></a>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->youtube)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->youtube;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_tube.png');?>
"
                                                alt="YouTube"/></a>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->linkedin)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->linkedin;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_in.png');?>
"
                                                alt="Linkedin"/></a>
                                <?php }?>
                            </div><!-- /.social_block -->
                        </div><!-- /.contact_info -->
                    </div><!-- /.max_arrange -->
                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.n_content_area -->

    <?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        <?php if (!empty($_smarty_tpl->tpl_vars['publicprofile']->value->lat) || !empty($_smarty_tpl->tpl_vars['publicprofile']->value->lng)) {?>
        var json_lat = <?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->lat;?>
;
        var json_lng = <?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->lng;?>
;
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->adress;?>
';
        
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('maps'), {
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
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('.lat').val(place.geometry.location.lat());
                    $('.lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        
        <?php } else { ?>
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['publicprofile']->value->company_name;?>
';
        
        function initAutocomplete() {
            $.ajax({
                url: "https://ipinfo.io/?callback=",
                type: "GET",
                dataType: 'json',
                cache: true,
                success: function (data, status, error) {
                    var reg = data.loc.split(',');
                    var myLatLng = {lat: parseFloat(reg[0]), lng: parseFloat(reg[1])};
                    var map = new google.maps.Map(document.getElementById('maps'), {
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
                            markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));
                            $('.lat').val(place.geometry.location.lat());
                            $('.lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }
            });
        }
        
        <?php }?>
        $(document).ready(function () {

            if ($('a.image-link').length) {
                $('a.image-link').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true
                    }
                });
            }

            $(document).on('mouseenter', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 1);
            })
            $(document).on('mouseleave', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 0);
            })

            $(document).on('click', '.userphotos-change,.camera-icon', function () {
                $('input.userphotos').click();
            })
            
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
                            $('.modal').modal('hide');

                            toastr.success(obj.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(obj.message);
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
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
