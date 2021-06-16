<?php
/* Smarty version 3.1.30, created on 2020-10-27 17:46:20
  from "/home/makromed/public_html/demo/templates/default/contact.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9824ac453432_00884281',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32d4e5bc63ecca666e77488e933176883641150c' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/contact.tpl',
      1 => 1603718916,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9824ac453432_00884281 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7735821225f9824ac452b85_34869834', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_7735821225f9824ac452b85_34869834 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="contact">
                    <div class="col-md-12 no-padding" style="margin-bottom:25px;">
                        <div class="row">
                            <!-- <div class="col-md-12 col-xs-12 map">
                             <div id="map"></div> 
                            </div> -->
                            <div class="col-md-7 col-xs-12" style="margin-top: 30px;">
                                <div class="col-md-12 no-padding">
                                    <h1 class="contact-title"> <?php echo translate('form_title');?>
 </h1>
                                </div>
                                <div class="col-md-12 no-padding contact-us">
                                    <?php if (isset($_smarty_tpl->tpl_vars['error_message']->value) && !empty($_smarty_tpl->tpl_vars['error_message']->value)) {?>
                        <div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>
</div>
                        <?php }?>

                        <?php if (isset($_smarty_tpl->tpl_vars['success_message']->value) && !empty($_smarty_tpl->tpl_vars['success_message']->value)) {?>
                        <?php echo $_smarty_tpl->tpl_vars['success_message']->value;?>

                        <?php }?>

                                    <form class="" action="" method="post">
                                      <div class="col-md-6 no-padding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="fullname" value="" placeholder="<?php echo translate('form_placeholder_fullname');?>
">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" value="" placeholder="<?php echo translate('form_placeholder_phone');?>
">
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding-right">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo translate('form_placeholder_email');?>
">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" value="" placeholder="<?php echo translate('form_placeholder_subject');?>
">
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-12 no-padding">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" rows="20"></textarea>
                                            </div>
                                              <div class="col-md-12 no-padding" style="margin-bottom: 20px">
                                         <div class="comment-form-recaptcha ">
                                            <div class="g-recaptcha" data-sitekey="6LdXR5wUAAAAAPa-kl_jFsiYJDAelSj7wo-P56q8"></div>
                                        </div>
                                        </div>
                                            <div class="form-group">
                                                <button type="submit" name="button"><?php echo translate('form_button_send');?>
</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 col-xs-12" style="margin-top: 30px;">
                                <div class="col-md-12 no-padding">
                                    <h1 class="contact-title"> CONTACT US </h1>
                                </div>
                                <div class="col-md-12 no-padding contact-us">
                                    <p><?php echo get_setting('contact_address','en');?>
</p>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 no-padding contact-item">
                                        <div class="icon-contact phonex"></div>
                                        <div class="contact-info">
                                            <h4 class=""><?php echo translate('info_phone');?>
</h4>
                                            <p><?php echo get_setting('contact_phone','en');?>
</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 no-padding contact-item">
                                        <div class="icon-contact email"></div>
                                        <div class="contact-info">
                                            <h4 class=""><?php echo translate('info_email');?>
</h4>
                                            <p><?php echo get_setting('email');?>
</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <ul class="contact-social">
                                        <li> <a href="<?php echo get_setting('facebook');?>
"> <i class="fa fa-facebook"></i> </a> </li>
                                        <li> <a href="<?php echo get_setting('twitter');?>
"> <i class="fa fa-twitter"></i> </a> </li>
                                        <li> <a href="<?php echo get_setting('google');?>
"> <i class="fa fa-google-plus"></i> </a> </li>
                                        <li> <a href="<?php echo get_setting('linkedin');?>
"> <i class="fa fa-linkedin"></i> </a> </li>
                                        <li> <a href="<?php echo get_setting('pinterest');?>
"> <i class="fa fa-pinterest"></i> </a> </li>
                                    </ul>
                                </div>
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
        function initMap(getId)
        {
            if(document.getElementById(getId))
            {
                let locations = [
                  ["Makromedicine.com", 40.434979, 49.867603, 1 ]
                ];
                let map = new google.maps.Map(document.getElementById(getId), {
                    zoom: 12,
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
        initMap("map");
        google.maps.event.addDomListener(window, "load", initMap);
    <?php echo '</script'; ?>
>


    
<?php
}
}
/* {/block 'content'} */
}
