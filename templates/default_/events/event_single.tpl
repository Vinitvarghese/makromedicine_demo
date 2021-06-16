{extends file=$layout}
{block name=content}
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="blog">
                <div class="col-md-12 no-padding">
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="events-detail">
                                <div class="events-det-header">
                                    <div class="events-det-title">
                                        <h3>{$events->name}</h3>
                                    </div>
                                    <div class="events-det-specs">{$events->address} | <a href="#" class="place">{get_event_continent($events->continent_id)} , {get_event_country($events->country_id)}</a></div>
                                </div>
                            </div>
                            <div class="events-header">
                                <h3><i class="fa fa-hotel" aria-hidden="true"></i> Event </h3>
                            </div>
                            <div class="events-det-img" style="margin-top: -15px;">
                                <img src="{base_url('uploads/')}{{$events->image}}" alt="{$events->name} - {$events->address}" />
                            </div>

                            <div class="events-det-content">
                              <div class="events-det-table">
                                  <div class="pop-content">
                                      <div class="pop-field">
                                          <span> Start Date: </span>
                                          <span class="pop-venue"> {date('d.m.Y',strtotime($events->start_date))} </span>
                                      </div>
                                      <div class="pop-field">
                                          <span> End Date: </span>
                                          <span class="pop-venue"> {date('d.m.Y',strtotime($events->end_date))} </span>
                                      </div>
                                      <div class="pop-field">
                                          <span> Type : </span>
                                          <span class="pop-type"> {get_event_type_name($events->type_id)} </span>
                                      </div>
                                      {if $events->price_from neq 0}
                                      <div class="pop-field">
                                          <span> From : </span>
                                          <span class="pop-from"> {$events->price_from}{get_event_currency($events->currency)}</span>
                                      </div>
                                      {/if}
                                      {if $events->price_to neq 0}
                                      <div class="pop-field">
                                          <span> Το : </span>
                                          <span class="pop-to"> {$events->price_to}{get_event_currency($events->currency)}</span>
                                      </div>
                                      {/if}
                                  </div>
                              </div>
                              <div class="events-det-table">
                                <p>{$events->description}</P>
                              </div>
                            </div>
                            <div  class="map-events" id="eventMap"></div>
                            <div class="map-events events-det-map" id="eventMap"></div>
                        </div>
                        <div class="col-md-4">
                            {if $last_events}
                            <div class="events-block">
                                <div class="events-header">
                                    <h3><i class="fa fa-list" aria-hidden="true"></i> Event List </h3>
                                </div>
                                <div class="events-content">
                                    <ul class="events-content-ul" style="height: 700px;">
                                        {foreach $last_events as $key=>$value}
                                        <li>
                                            <a href="{site_url_multi('events/')}{$value->slug}">
                                                <span class="text">{$value->name}</span>
                                                <span class="title">{get_event_continent($value->continent_id)} , {get_event_country($value->country_id)}</span>
                                                  <span class="title">{date('M d, Y',strtotime($value->start_date))}</span>
                                            </a>
                                        </li>
                                        {/foreach}
                                    </ul>
                                </div>
                            </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok" type="text/javascript"></script>
<script>

    var title = '';
    var lat = {$events->lat};
    var lng = {$events->lng};
    {literal}
    $('select[name=event_type]').val(1);
    $('.selectpicker').selectpicker('refresh');
    function initMap (getId)
    {
        if(document.getElementById(getId))
        {
            let locations = [
                [title, lat, lng, 1 ]
            ]
            let map = new google.maps.Map(document.getElementById(getId), {
                zoom: 14,
                center: {lat: locations[0][1], lng: locations[0][2]}
            });
            for(let i = 0; i < locations.length ; i++)
            {
                let marker = new google.maps.Marker({
                    position:{lat: locations[i][1], lng: locations[i][2]},
                    map:map,
                    animation: google.maps.Animation.DROP
                });
                marker.addListener('click', toggleBounce);
            }
        }
    }
    function toggleBounce() {
        if (marker.getAnimation() !== null)
        {
            marker.setAnimation(null);
        }
        else
        {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
    initMap("eventMap");
    google.maps.event.addDomListener(window, "load", initMap);
    {/literal}
</script>
{/block}
