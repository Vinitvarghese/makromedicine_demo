<?php
/* Smarty version 3.1.30, created on 2020-10-29 06:08:10
  from "/home/makromed/public_html/demo/templates/default/error/404.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9a240a359112_16293326',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2c262c8065e1b6cbb650693d741a8011d69377d' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/error/404.tpl',
      1 => 1603718944,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9a240a359112_16293326 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11801882385f9a240a358721_26159836', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_11801882385f9a240a358721_26159836 extends Smarty_Internal_Block
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
                          <section style="margin-top:60px;">
                              <div class="container">
                                  <div class="row row1">
                                      <div class="col-md-12">
                                          <h3 class="center capital f1 wow fadeInLeft" data-wow-duration="2s">Something went Wrong!</h3>
                                          <h1 id="error" class="center wow fadeInRight" data-wow-duration="2s">404</h1>
                                          <p class="center wow bounceIn" data-wow-delay="2s">Page not Found!</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div id="cflask-holder" class="wow fadeIn" data-wow-delay="2800ms">
                                              <span class="wow tada " data-wow-delay="3000ms"><i class="fa fa-flask fa-5x flask wow flip" data-wow-delay="3300ms"></i>
                                                  <i id="b1" class="bubble"></i>
                                                  <i id="b2" class="bubble"></i>
                                                  <i id="b3" class="bubble"></i>
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="col-md-6 col-md-offset-3 search-form wow fadeInUp" data-wow-delay="4000ms">
                                              <form action="#" method="get">
                                                  <input type="text" placeholder="Search" class="col-md-9 col-xs-12 input_404"/>
                                                  <input type="submit" value="Search" class="col-md-3 col-xs-12 submit_404"/>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="links-wrapper col-md-6 col-md-offset-3">
                                              <ul class="links col-md-9">
                                                  <li class="wow fadeInRight" data-wow-delay="4400ms"><a href="<?php echo base_url();?>
"><i class="fa fa-home fa-2x"></i></a></li>
                                                  <li class="wow fadeInRight" data-wow-delay="4300ms"><a href="<?php echo get_setting('facebook');?>
"><i class="fa fa-facebook fa-2x"></i></a></li>
                                                  <li class="wow fadeInRight" data-wow-delay="4200ms"><a href="<?php echo get_setting('twitter');?>
"><i class="fa fa-twitter fa-2x"></i></a></li>
                                                  <li class="wow fadeInLeft" data-wow-delay="4200ms"><a href="<?php echo get_setting('google');?>
"><i class="fa fa-google-plus fa-2x"></i></a></li>
                                                  <li class="wow fadeInLeft" data-wow-delay="4300ms"><a href="<?php echo get_setting('pinterest');?>
"><i class="fa fa-pinterest fa-2x"></i></a></li>
                                                  <li class="wow fadeInLeft" data-wow-delay="4400ms"><a href="<?php echo get_setting('linkedin');?>
"><i class="fa fa-linkedin fa-2x"></i></a></li>
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'content'} */
}
