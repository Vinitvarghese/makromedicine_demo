{extends file=$layout}
{block name=content}
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="blog">
                <div class="col-md-12 no-padding">
                    <div class="row">
                        <div class="col-md-8 pg-left ">
                            <div  class="map-events" id="eventMap"></div>
                            <div class="feature-events">
                                <div class="events-header">
                                    <h3> <i class="fa fa-star"></i>  Popular Events</h3>
                                </div>
                                <div class="feature-events-content">
                                    <div class="feature-popup">
                                        <span class="exit-pop" > X </span>
                                        <div class="pop-time-block">
                                            <h4 class="pop-title"> </h4>
                                        </div>
                                        <div class="pop-image">
                                            <img src="" alt=""/>
                                        </div>
                                        <div class="col-md-8 pop-content">
                                            <div class="pop-field">
                                                <span> Start :  </span>
                                                <span class="pop-time"></span>
                                            </div>
                                            <div class="pop-field">
                                                <span> End : </span>
                                                <span class="pop-venue"> </span>
                                            </div>
                                            <div class="pop-field">
                                                <span> Type : </span>
                                                <span class="pop-type"> </span>
                                            </div>
                                            <div class="pop-field">
                                                <span> Fee : </span>
                                                <span class="pop-from"></span>
                                            </div>
                                            <div class="pop-field">
                                                <span> Το : </span>
                                                <span class="pop-to"> </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pop-link">
                                            <a href=""> Go to Event Page </a>
                                        </div>
                                    </div>
                                    {if $mostview_events}
                                        {foreach $mostview_events as $value}

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="events-item">
                                                
                                                <h3> 
                                                    {get_event_continent($value->continent_id)} , {get_event_country($value->country_id)} </h3>
                                                <h4 class="events-title">{$value->name}</h4>
                                                <div class="events-img">
                                                    <div class="events-overlay">
                                                        <a href="{site_url_multi('events/')}{$value->slug}"> View Details </a>
                                                    </div>
                                                    <img src="{base_url('uploads/')}{$value->image}" alt="{$value->name}" />
                                                </div>
                                                <div class="events-pop-info">
                                                    <span class="events-time">{date('d.m.Y',strtotime($value->start_date))}</span>
                                                    <span class="events-venue">{date('d.m.Y',strtotime($value->end_date))}</span>
                                                    <span class="events-type">{get_event_type_name($value->type_id)}</span>
                                                    <span class="events-from">{$value->price_from}{get_event_currency($value->currency)}</span>
                                                    <span class="events-to">{$value->price_to}{get_event_currency($value->currency)}</span>
                                                </div>
                                            </div>
                                        </div>
                                        {/foreach}
                                    {/if}

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pg-right ">
                            {if $last_events}

                            <div class="events-block">
                                <div class="events-header">
                                    <h3> <i class="fa fa-heart"></i> Event List ({$last_events_c})</h3>
                                </div>
                                <div class="events-content">
                                    <ul class="events-content-ul">
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
                            {if $end_events}

                            <div class="events-block">
                                <div class="events-header">
                                    <h3><i class="fa fa-list" aria-hidden="true"></i> Recent Events ({$end_events_c})</h3>
                                </div>
                                <div class="events-content">
                                    <ul class="events-content-ul">
                                        {foreach $end_events as $key=>$value}

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
{if $papular_events}

<script type="text/javascript">
var sam = [];
{foreach $papular_events as $value}
sam.push(["{$value->name}", {$value->lat}, {$value->lng}, 1 ,"{date('d.m.Y',strtotime($value->start_date))}","{date('d.m.Y',strtotime($value->end_date))}","{get_event_type_name($value->type_id)}","{$value->price_from}{get_event_currency($value->currency)}","{$value->price_to}{get_event_currency($value->currency)}", "{site_url_multi('events/')}{$value->slug}"]);
{/foreach}
</script>
{literal}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok" type="text/javascript"></script>
<script>
    $('select[name=event_type]').val(1);
    $('.selectpicker').selectpicker('refresh');
    function initMap(getId)
    {
        if(document.getElementById(getId))
        {
            let locations = sam;
            console.log(sam);
            let map = new google.maps.Map(document.getElementById(getId), {
                zoom: 2,
                center: {lat: locations[0][1], lng: locations[0][2]}
            });
            var infowindow = [];
            var marker     = [];
            for(let i = 0; i < locations.length ; i++)
            {
                console.log(locations[i][5]);
                var contentMix = `
                <div style="min-width:300px;">
                  <table class='table-bordered'>
                    <tbody>
                      <tr>
                        <th style="width:100px;padding:8px;">Name</th>
                        <td style="min-width:200px;padding:8px;">`+locations[i][0]+`</td>
                      </tr>
                      <tr>
                        <th style="width:100px;padding:8px;">Start</th>
                        <td style="min-width:200px;padding:8px;">`+locations[i][4]+`</td>
                      </tr>
                      <tr>
                        <th style="width:100px;padding:8px;">End</th>
                        <td style="min-width:200px;padding:8px;">`+locations[i][5]+`</td>
                      </tr>
                      <tr>
                        <th style="width:100px;padding:8px;">Type</th>
                        <td style="min-width:200px;padding:8px;">`+locations[i][6]+`</td>
                      </tr>
                      <tr>
                        <th style="width:100px;padding:8px;">Price from</th>
                        <td style="min-width:200px;padding:8px;">`+locations[i][7]+`</td>
                      </tr>
                      <tr>
                        <th style="width:100px;padding:8px;">Price to</th>
                        <td style="min-width:200px;padding:8px;">`+locations[i][8]+`</td>
                      </tr>
                      <tr>
                        <th style="width:100px;padding:8px;">Link </th>
                        <td style="min-width:200px;padding:8px;"><a href="`+locations[i][9]+`" target="_blank">Go to Event</a></td>
                      </tr>
                    </tbody>
                  </table>
                <div>`;
                infowindow[i] = new google.maps.InfoWindow({
                  content: contentMix
                });

                marker[i] = new google.maps.Marker({
                    position:{lat: locations[i][1], lng: locations[i][2]},
                    map:map,
                    title: locations[i][0],
                    animation: google.maps.Animation.DROP
                });

                marker[i].addListener('click', function() {
                  for(let k = 0; k < locations.length; k++)
                  {
                    infowindow[k].close();
                  }

                  infowindow[i].open(map, marker[i]);
                });
            }
        }
    }
    initMap("eventMap");
    google.maps.event.addDomListener(window, "load", initMap);
</script>
{/literal}
{/if}
{/block}
