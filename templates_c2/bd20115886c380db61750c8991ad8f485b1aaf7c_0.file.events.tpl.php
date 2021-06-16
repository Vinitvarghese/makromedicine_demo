<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:37:37
  from "/home/makromed/public_html/demo/templates/default/events/events.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f992dd1f3fe45_97301085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd20115886c380db61750c8991ad8f485b1aaf7c' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/events/events.tpl',
      1 => 1603718938,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f992dd1f3fe45_97301085 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9037693615f992dd1f3ece3_03235962', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_9037693615f992dd1f3ece3_03235962 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

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
                                    <?php if ($_smarty_tpl->tpl_vars['mostview_events']->value) {?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mostview_events']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="events-item">
                                                
                                                <h3> 
                                                    <?php echo get_event_continent($_smarty_tpl->tpl_vars['value']->value->continent_id);?>
 , <?php echo get_event_country($_smarty_tpl->tpl_vars['value']->value->country_id);?>
 </h3>
                                                <h4 class="events-title"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</h4>
                                                <div class="events-img">
                                                    <div class="events-overlay">
                                                        <a href="<?php echo site_url_multi('events/');
echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
"> View Details </a>
                                                    </div>
                                                    <img src="<?php echo base_url('uploads/');
echo $_smarty_tpl->tpl_vars['value']->value->image;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
" />
                                                </div>
                                                <div class="events-pop-info">
                                                    <span class="events-time"><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['value']->value->start_date));?>
</span>
                                                    <span class="events-venue"><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['value']->value->end_date));?>
</span>
                                                    <span class="events-type"><?php echo get_event_type_name($_smarty_tpl->tpl_vars['value']->value->type_id);?>
</span>
                                                    <span class="events-from"><?php echo $_smarty_tpl->tpl_vars['value']->value->price_from;
echo get_event_currency($_smarty_tpl->tpl_vars['value']->value->currency);?>
</span>
                                                    <span class="events-to"><?php echo $_smarty_tpl->tpl_vars['value']->value->price_to;
echo get_event_currency($_smarty_tpl->tpl_vars['value']->value->currency);?>
</span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    <?php }?>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pg-right ">
                            <?php if ($_smarty_tpl->tpl_vars['last_events']->value) {?>

                            <div class="events-block">
                                <div class="events-header">
                                    <h3> <i class="fa fa-heart"></i> Event List (<?php echo $_smarty_tpl->tpl_vars['last_events_c']->value;?>
)</h3>
                                </div>
                                <div class="events-content">
                                    <ul class="events-content-ul">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['last_events']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>

                                        <li>
                                            <a href="<?php echo site_url_multi('events/');
echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
">
                                                <span class="text"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</span>
                                                <span class="title"><?php echo get_event_continent($_smarty_tpl->tpl_vars['value']->value->continent_id);?>
 , <?php echo get_event_country($_smarty_tpl->tpl_vars['value']->value->country_id);?>
</span>
                                                <span class="title"><?php echo date('M d, Y',strtotime($_smarty_tpl->tpl_vars['value']->value->start_date));?>
</span>
                                            </a>
                                        </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                                    </ul>
                                </div>
                            </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['end_events']->value) {?>

                            <div class="events-block">
                                <div class="events-header">
                                    <h3><i class="fa fa-list" aria-hidden="true"></i> Recent Events (<?php echo $_smarty_tpl->tpl_vars['end_events_c']->value;?>
)</h3>
                                </div>
                                <div class="events-content">
                                    <ul class="events-content-ul">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['end_events']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>

                                        <li>
                                            <a href="<?php echo site_url_multi('events/');
echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
">
                                                <span class="text"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</span>
                                                <span class="title"><?php echo get_event_continent($_smarty_tpl->tpl_vars['value']->value->continent_id);?>
 , <?php echo get_event_country($_smarty_tpl->tpl_vars['value']->value->country_id);?>
</span>
                                                  <span class="title"><?php echo date('M d, Y',strtotime($_smarty_tpl->tpl_vars['value']->value->start_date));?>
</span>
                                            </a>
                                        </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                                    </ul>
                                </div>
                            </div>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($_smarty_tpl->tpl_vars['papular_events']->value) {?>

<?php echo '<script'; ?>
 type="text/javascript">
var sam = [];
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['papular_events']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
sam.push(["<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
", <?php echo $_smarty_tpl->tpl_vars['value']->value->lat;?>
, <?php echo $_smarty_tpl->tpl_vars['value']->value->lng;?>
, 1 ,"<?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['value']->value->start_date));?>
","<?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['value']->value->end_date));?>
","<?php echo get_event_type_name($_smarty_tpl->tpl_vars['value']->value->type_id);?>
","<?php echo $_smarty_tpl->tpl_vars['value']->value->price_from;
echo get_event_currency($_smarty_tpl->tpl_vars['value']->value->currency);?>
","<?php echo $_smarty_tpl->tpl_vars['value']->value->price_to;
echo get_event_currency($_smarty_tpl->tpl_vars['value']->value->currency);?>
", "<?php echo site_url_multi('events/');
echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
"]);
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>

<?php }
}
}
/* {/block 'content'} */
}
