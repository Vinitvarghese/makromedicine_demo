<?php
/* Smarty version 3.1.30, created on 2020-10-28 15:20:17
  from "/home/makromed/public_html/demo/templates/default/company/profile.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9953f11db048_06288212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e84821b1963f796f409f531e303d00919c52b2ce' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/profile.tpl',
      1 => 1603802537,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f9953f11db048_06288212 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21341280495f9953f11da230_71735147', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_21341280495f9953f11da230_71735147 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <div class="n_content_area full_width">
    <a href="#" id="openMenu" class="pages-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="row">

                <?php $_smarty_tpl->_subTemplateRender("file:../company/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section decrease_padding_20 start_with_text">
                    
                    <div class="banner_image_n img_fit full_width ">
                        <?php if ($_smarty_tpl->tpl_vars['company_banner']->value) {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['company_banner']->value;?>
" style="max-height: 220px; object-fit: cover;" alt="img"/>
                        <?php } else { ?>
                            <img src="<?php echo base_url('templates/default/assets/images/bnnr.png');?>
" style="max-height: 220px; object-fit: cover;" alt="img"/>
                        <?php }?>
                    </div><!-- /.banner_image_n -->

                    <div class="full_width need_padding_here">
                        <div class="cmother full_width pr-s-n with_buttons">
                            <h2>COMPANY INFORMATION</h2>
                            <a href="<?php echo base_url('/');?>
profile/edit-page">Edit Info</a>
                        </div>
                        <div class="full_width max-arrange">
                            <div class="drt_form full_width">
                                <div class="full_width">
                                    <div class="fst_col">
                                        <label>Company Name <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
</span></label>
                                    </div><!-- /.fst_col -->
                                    <div class="snd_col">
                                        <label>Establishment date <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->establishment_date;?>
</span></label>
                                    </div><!-- /.snd_col -->
                                </div><!-- /.full_width -->
                                <div class="full_width">
                                    <div class="fst_col">
                                        <label>Field of activity <span><?php echo $_smarty_tpl->tpl_vars['selected_product_type_names']->value;?>
</span></label>
                                    </div><!-- /.fst_col -->
                                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->website)) {?>
                                        <div class="snd_col">
                                            <label>Website <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->website;?>
</span></label>
                                        </div>
                                        <!-- /.snd_col -->
                                    <?php }?>
                                </div><!-- /.full_width -->
                                <?php if ($_smarty_tpl->tpl_vars['get_standart']->value) {?>
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Standart
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['get_standart']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                    <span><?php echo $_smarty_tpl->tpl_vars['value']->value['st_name'];?>
</span>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                            </label>
                                        </div><!-- /.fst_col -->
                                    </div>
                                    <!-- /.full_width -->
                                <?php }?>
                            </div><!-- /.drt_form -->

                            <div class="n_personal_info full_width n_personal_info2">
                                <h3>ABOUT COMPANY</h3>
                                <p><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_info;?>
</p>

                                <p>&nbsp;</p>

                                <?php if (!empty($_smarty_tpl->tpl_vars['tags']->value)) {?>
                                    <h3>Tags</h3>
                                    <div class="tags_nn full_width">
                                        <?php $_smarty_tpl->_assignInScope('tag_list', explode(',',$_smarty_tpl->tpl_vars['tags']->value));
?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tag_list']->value, 'tag');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
?>
                                            <a href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</a>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </div><!-- /.tags_nn -->
                                <?php }?>

                            </div><!-- /.personal_info -->


                            <div class="n_contact_info full_width">
                                <h3>CONTACT INFO</h3>
                                <div class="drt_form full_width">
                                    <?php if ($_smarty_tpl->tpl_vars['company_info']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['company_info']->value, 'company', false, 'secret');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['secret']->value => $_smarty_tpl->tpl_vars['company']->value) {
?>
                                        <div class="full_width">
                                            <div class="fst_col">
                                                <label>Phone Number <span><?php echo $_smarty_tpl->tpl_vars['company']->value->phone;?>

                                                    <i>
                                                        <?php if ($_smarty_tpl->tpl_vars['phone_type']->value) {?>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['phone_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                                <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['company']->value->phone_type) {?> <?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
 <?php break 1;?> <?php }?>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                        <?php }?>
                                                    </i>
                                                </span>
                                                </label>
                                            </div><!-- /.fst_col -->
                                            <div class="snd_col">
                                                <label>Contact Person Name <span
                                                            class="get_underline"><?php echo $_smarty_tpl->tpl_vars['company']->value->fullname;?>
</span></label>
                                            </div><!-- /.snd_col -->
                                        </div>
                                        <!-- /.full_width -->
                                        <div class="full_width">
                                            <div class="fst_col">
                                                <label>Ext <span><?php echo $_smarty_tpl->tpl_vars['company']->value->ext;?>
</span></label>
                                            </div><!-- /.fst_col -->
                                            <div class="snd_col">
                                                <label>Person Type<span class="get_underline">
                                                    <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {?>
                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['company']->value->person_type) {?> <?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
 <?php break 1;?> <?php }?>
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                    <?php }?>
                                                </span></label>
                                            </div><!-- /.snd_col -->
                                        </div>
                                        <!-- /.full_width -->
                                        <div class="full_width ">
                                            <div class="fst_col">
                                                <label>Country
                                                    <span><?php echo get_country_name($_smarty_tpl->tpl_vars['UserData']->value->country_id);?>
</span></label>
                                            </div><!-- /.fst_col -->
                                            <div class="snd_col">
                                                <label>E-mail <span><?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
</span></label>
                                            </div><!-- /.snd_col -->
                                        </div>
                                        <!-- /.full_width -->
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>

                                    <div class="full_width">
                                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_address)) {?>
                                            <div class="fst_col">
                                                <label>Address <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_address;?>
</span></label>
                                                <div class="map__">
                                                    <iframe width="265" height="265"  src="https://maps.google.com/maps?q=<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_address;?>
&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen frameborder="0" scrolling="no" marginheight="0" marginwidth="0" ></iframe>

                                                </div>
                                            </div>
                                            <!-- /.fst_col -->
                                        <?php }?>
                                        <div class="snd_col al_blk">
                                            <hr class="thrx">
                                            <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->full_name)) {?>
                                                <label>Contact Person Name <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->full_name;?>
</span></label>
                                            <?php }?>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->position)) {?>
                                                <label>Person Type <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->position_name;?>
</span></label>
                                            <?php }?>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->email)) {?>
                                                <label>E-mail <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->email;?>
</span></label>
                                            <?php }?>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->

                                    <div class="n_social_block full_width">
                                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_facebook)) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_facebook;?>
"><img
                                                    src="<?php echo base_url('templates/default/assets/images/icons/n_face.png');?>
"
                                                    alt="facebook"></a>
                                        <?php }?>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_twitter)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_twitter;?>
"><img
                                                        src="<?php echo base_url('templates/default/assets/images/icons/n_twit.png');?>
"
                                                        alt="facebook"></a>
                                        <?php }?>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_youtube)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_youtube;?>
"><img
                                                        src="<?php echo base_url('templates/default/assets/images/icons/n_tube.png');?>
"
                                                        alt="facebook"></a>
                                        <?php }?>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_linkedin)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_linkedin;?>
"><img
                                                        src="<?php echo base_url('templates/default/assets/images/icons/n_in.png');?>
"
                                                        alt="facebook"></a>
                                        <?php }?>
                                    </div><!-- /.social_block -->
                                </div><!-- /.contact_info -->

                            </div><!-- /.max_arrange -->
                        </div><!-- /.need_padding_here -->
                    </div><!-- /.right_section -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div><!-- /.n_content_area -->

    </div>
    
    <?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok&libraries=places&callback=initAutocomplete"
            async defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
        <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status == 0) {?>
        // $('#comfirmAccount').modal();
        $("#verify_account_modal").on('click', function () {
            $('#comfirmAccount').modal();
        });
        <?php }?>
        <?php }?>

        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_lat) || !empty($_smarty_tpl->tpl_vars['UserData']->value->company_lng)) {?>
        var json_lat = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_lat;?>
;
        var json_lng = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_lng;?>
;
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_address;?>
';
        
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('map'), {
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
                    $('.company_lat').val(place.geometry.location.lat());
                    $('.company_lng').val(place.geometry.location.lng());
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
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
';
        
        function initAutocomplete() {
            $.ajax({
                url: "https://ipinfo.io/?callback=",
                type: "GET",
                dataType: 'json',
                cache: true,
                success: function (data, status, error) {
                    var reg = data.loc.split(',');
                    var myLatLng = {lat: '', lng: ''};
                    var map = new google.maps.Map(document.getElementById('map'), {
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
                            $('.company_lat').val(place.geometry.location.lat());
                            $('.company_lng').val(place.geometry.location.lng());
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
