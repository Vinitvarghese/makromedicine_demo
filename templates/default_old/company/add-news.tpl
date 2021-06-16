{extends file=$layout}
{block name=content}
<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
<div class="n_content_area full_width">
<a href="#" id="openMenu" class="pages-menu-float">Menu</a>
    <div class="container-fluid">
        <div class="row">
            {include file='../company/sidebar.tpl'}
            <div class="n_right_section start_with_text news_page">
                <div class="with_buttons full_width">
                    <h2>add news</h2>
                </div>
                <div class="news_adding_section full_width">


                    <form method="post" enctype="multipart/form-data">
                    
                    <h4 class="title_1">Arcticle Title</h4>
                    <input type="text" name="title" required>
                    
                    <hr>
                    
                    <div class="upload_img full_width img_fit">
                        <div id="my-file-preview"></div>
                        <div class="input-file-container">  
                            <input class="input-file" id="my-file" name="news_image" accept="image/gif, image/jpg, image/png, image/jpeg" type="file">
                            <label tabindex="0" for="my-file" class="input-file-trigger">Add Photo</label>
                        </div>
                    </div><!-- /.upload_img -->
                    
                    <label class="text_label">Text</label>
                    
                    <textarea name="description" class="big_area"></textarea>
                    
                    

                    
                    <div class="btn_wrap hasfull full_width">
                        <button type="submit" name="submit" class="n_save">Save</button>
                    </div>
        

                    </form>
                </div>

            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
{literal}
    <script>

        // File preview on upload
        document.getElementById("my-file").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                console.log(e.target);
                // get loaded data and render thumbnail.
                document.getElementById("my-file-preview").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

        document.getElementById("my-file2").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("my-file2-preview").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

    </script>
{/literal}}

{*
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
<div class="clearfix"></div>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
                <div class="col-md-12 no-padding">
                    <div class="col-md-12 profile-right no-padding">
                        <div class="right-content">

                            <div class="container main-secction">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 image-section">
                                        {if $UserData->company_banner}
                                            <img src="{$company_banner}" />
                                        {else}
                                            <img src="https://picsum.photos/1170/250"/>
                                        {/if}
                                    </div>
                                    <div class="row user-left-part">
                                        {include file='../company/sidebar.tpl'}
                                        <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
                                            <div class="row profile-right-section-row">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel-group" id="accordion">
                                                            <div class="panel panel-primary">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">ADD NEWS
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne"
                                                                     class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <form method="post"
                                                                              enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                               name="title"
                                                                                               class="form-control"
                                                                                               placeholder="Title"
                                                                                               required/>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <textarea class="form-control"
                                                                                                  name="description"
                                                                                                  placeholder="Content"
                                                                                                  rows="20"
                                                                                                  required></textarea>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="file"
                                                                                               name="news_image"
                                                                                               class="form-control"
                                                                                               placeholder="Image"
                                                                                               required/>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <button type="submit"
                                                                                                name="submit"
                                                                                                class="new-phone-btn pull-left">
                                                                                            Publish
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                            <!--main info end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
        {literal}
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
        {/literal}
        {else}
        var json_title = '{$UserData->company_name}';
        {literal}
        {/literal}
        {/if}
        $(document).ready(function () {

            {literal}
            {/literal}
        });
    </script>*}
    {/block}
