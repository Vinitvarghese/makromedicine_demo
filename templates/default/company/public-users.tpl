{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
    <div class="clearfix"></div>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="profile">
                    <div class="col-md-12">
                            <table class="table responsive table-striped no-padding display table-search-not dataTable no-footer dtr-inline collapsed">
                               <thead>
                               <tr>
                                   <td>Name</td>
                                   <td>Action</td>
                               </tr>
                               </thead>
                                <tbody>
                                {foreach $users as $user}
                                    <tr>
                                       <td>{$user->fullname}</td>
                                       <td><a href="{site_url_multi('/')}users/{$user->slug_user}" class="">View Profile</a></td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if !empty($publicprofile->lat) || !empty($publicprofile->lng)}
        var json_lat = {$publicprofile->lat};
        var json_lng = {$publicprofile->lng};
        var json_title = '{$publicprofile->adress}';
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
        var json_title = '{$publicprofile->company_name}';
        {literal}
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
        {/literal}
        {/if}
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
            {literal}
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
            {/literal}
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
    </script>
{/block}
