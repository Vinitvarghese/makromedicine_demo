<?php
/* Smarty version 3.1.30, created on 2020-10-28 14:38:03
  from "/home/makromed/public_html/demo/templates/default/events/event_single.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f994a0b5edd67_11910605',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e09fcdf0e1dc3df5470debe167564e44a9a5efc' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/events/event_single.tpl',
      1 => 1603718938,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f994a0b5edd67_11910605 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19087049435f994a0b5ece21_15532066', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_19087049435f994a0b5ece21_15532066 extends Smarty_Internal_Block
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
                        <div class="col-md-8 ">
                            <div class="events-detail">
                                <div class="events-det-header">
                                    <div class="events-det-title">
                                        <h3><?php echo $_smarty_tpl->tpl_vars['events']->value->name;?>
</h3>
                                    </div>
                                    <div class="events-det-specs"><?php echo $_smarty_tpl->tpl_vars['events']->value->address;?>
 | <a href="#" class="place"><?php echo get_event_continent($_smarty_tpl->tpl_vars['events']->value->continent_id);?>
 , <?php echo get_event_country($_smarty_tpl->tpl_vars['events']->value->country_id);?>
</a></div>
                                </div>
                            </div>
                            <div class="events-header">
                                <h3><i class="fa fa-hotel" aria-hidden="true"></i> Event </h3>
                            </div>
                            <div class="events-det-img" style="margin-top: -15px;">
                                <img src="<?php echo base_url('uploads/');
ob_start();
echo $_smarty_tpl->tpl_vars['events']->value->image;
$_prefixVariable1=ob_get_clean();
echo $_prefixVariable1;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['events']->value->name;?>
 - <?php echo $_smarty_tpl->tpl_vars['events']->value->address;?>
" />
                            </div>

                            <div class="events-det-content">
                              <div class="events-det-table">
                                  <div class="pop-content">
                                      <div class="pop-field">
                                          <span> Start Date: </span>
                                          <span class="pop-venue"> <?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['events']->value->start_date));?>
 </span>
                                      </div>
                                      <div class="pop-field">
                                          <span> End Date: </span>
                                          <span class="pop-venue"> <?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['events']->value->end_date));?>
 </span>
                                      </div>
                                      <div class="pop-field">
                                          <span> Type : </span>
                                          <span class="pop-type"> <?php echo get_event_type_name($_smarty_tpl->tpl_vars['events']->value->type_id);?>
 </span>
                                      </div>
                                      <?php if ($_smarty_tpl->tpl_vars['events']->value->price_from != 0) {?>
                                      <div class="pop-field">
                                          <span> From : </span>
                                          <span class="pop-from"> <?php echo $_smarty_tpl->tpl_vars['events']->value->price_from;
echo get_event_currency($_smarty_tpl->tpl_vars['events']->value->currency);?>
</span>
                                      </div>
                                      <?php }?>
                                      <?php if ($_smarty_tpl->tpl_vars['events']->value->price_to != 0) {?>
                                      <div class="pop-field">
                                          <span> Το : </span>
                                          <span class="pop-to"> <?php echo $_smarty_tpl->tpl_vars['events']->value->price_to;
echo get_event_currency($_smarty_tpl->tpl_vars['events']->value->currency);?>
</span>
                                      </div>
                                      <?php }?>
                                  </div>
                              </div>
                              <div class="events-det-table">
                                <p><?php echo $_smarty_tpl->tpl_vars['events']->value->description;?>
</P>
                              </div>
                            </div>
                            <div  class="map-events" id="eventMap"></div>
                            <div class="map-events events-det-map" id="eventMap"></div>
                        </div>
                        <div class="col-md-4">
                            <?php if ($_smarty_tpl->tpl_vars['last_events']->value) {?>
                            <div class="events-block">
                                <div class="events-header">
                                    <h3><i class="fa fa-list" aria-hidden="true"></i> Event List </h3>
                                </div>
                                <div class="events-content">
                                    <ul class="events-content-ul" style="height: 700px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>

    var title = '';
    var lat = <?php echo $_smarty_tpl->tpl_vars['events']->value->lat;?>
;
    var lng = <?php echo $_smarty_tpl->tpl_vars['events']->value->lng;?>
;
    
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
    
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
