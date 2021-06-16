<?php
/* Smarty version 3.1.30, created on 2020-10-29 10:42:00
  from "/home/makromed/public_html/demo/templates/default/company/news.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9a64386737f1_00678242',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c13f3e3d4be4bec1bd57a9e1a22ecb1128e9ffe0' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/news.tpl',
      1 => 1603802536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f9a64386737f1_00678242 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/makromed/public_html/demo/application/libraries/Smarty/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) require_once '/home/makromed/public_html/demo/application/libraries/Smarty/libs/plugins/modifier.truncate.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3501534905f9a6438672953_41168093', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_3501534905f9a6438672953_41168093 extends Smarty_Internal_Block
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

            <div class="n_right_section start_with_text news_page">
                <div class="with_buttons full_width">
                    <h2>news</h2>
                    <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] && $_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['UserData']->value->id) {?>
                        <a href="<?php echo site_url_multi('/');?>
profile/pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/add-news" class="n_green_col">Add News</a>
                    <?php }?>
                    
                    <span class="news_number"><?php echo $_smarty_tpl->tpl_vars['total_news']->value;?>
 news</span>
                </div>
                <div class="full_width news_tiles">
                    <div class="row">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['news']->value, 'newsitem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['newsitem']->value) {
?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y") == date("d/m/y")) {?>
                                    <span class="day_n">Today</span>
                                <?php } elseif (smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y") == date('d/m/y',strtotime("-1 day"))) {?>
                                    <span class="day_n">Yesterday</span>
                                <?php } else { ?>
                                    <span class="day_n"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y");?>
</span>
                                <?php }?>

                                <div class="full_width news_img">
                                    <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y") == date("d/m/y")) {?>
                                        <span class="abs_right_n">new</span>
                                    <?php }?>
                                    <a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['slug']->value;?>
/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['id'];?>
" >
                                        <img src="<?php echo base_url('uploads/news/');
echo $_smarty_tpl->tpl_vars['newsitem']->value['image'];?>
" alt="news" />
                                    </a>
                                </div> 
                                <a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['slug']->value;?>
/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['id'];?>
" class="heading_nn"><?php echo $_smarty_tpl->tpl_vars['newsitem']->value['title'];?>
</a>
                                <p style="width: 100%;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['newsitem']->value['description'],220);?>
</p>
                                <a href="<?php echo site_url_multi('/');?>
profile/pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/edit-news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['id'];?>
" class="nbtn">
                                    <img src="<?php echo base_url('templates/default/assets/images/icons/green_pen.png');?>
" alt="Edit news">
                                </a>
                                <a class="delete-news-item nbtn" href="<?php echo site_url_multi('/');?>
profile/pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/delete-news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['id'];?>
">
                                    <img src="<?php echo base_url('templates/default/assets/images/icons/del_n.png');?>
" alt="delete news" />
                                </a>
                            </div>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </div>

                    <div class="n_pagination full_width">

                        <?php if ($_smarty_tpl->tpl_vars['prev_page']->value < $_smarty_tpl->tpl_vars['num_pages']->value && $_smarty_tpl->tpl_vars['prev_page']->value > 0) {?>
                            <a href="<?php echo base_url('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/news?page=<?php echo $_smarty_tpl->tpl_vars['prev_page']->value;?>
" class="prev"><img src="<?php echo base_url('templates/default/assets/images/icons/page_prev.png');?>
"></a>
                        <?php }?>
                        <?php
$_smarty_tpl->tpl_vars['page_item'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['page_item']->step = 1;$_smarty_tpl->tpl_vars['page_item']->total = (int) ceil(($_smarty_tpl->tpl_vars['page_item']->step > 0 ? $_smarty_tpl->tpl_vars['num_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['num_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['page_item']->step));
if ($_smarty_tpl->tpl_vars['page_item']->total > 0) {
for ($_smarty_tpl->tpl_vars['page_item']->value = 1, $_smarty_tpl->tpl_vars['page_item']->iteration = 1;$_smarty_tpl->tpl_vars['page_item']->iteration <= $_smarty_tpl->tpl_vars['page_item']->total;$_smarty_tpl->tpl_vars['page_item']->value += $_smarty_tpl->tpl_vars['page_item']->step, $_smarty_tpl->tpl_vars['page_item']->iteration++) {
$_smarty_tpl->tpl_vars['page_item']->first = $_smarty_tpl->tpl_vars['page_item']->iteration == 1;$_smarty_tpl->tpl_vars['page_item']->last = $_smarty_tpl->tpl_vars['page_item']->iteration == $_smarty_tpl->tpl_vars['page_item']->total;?>
                            <a class=" <?php if ($_smarty_tpl->tpl_vars['curr_page']->value == $_smarty_tpl->tpl_vars['page_item']->value) {?> active <?php }?> " href="<?php echo base_url('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/news?page=<?php echo $_smarty_tpl->tpl_vars['page_item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page_item']->value;?>
</a>
                        <?php }
}
?>

                        <?php if ($_smarty_tpl->tpl_vars['next_page']->value <= $_smarty_tpl->tpl_vars['num_pages']->value) {?>
                            <a href="<?php echo base_url('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/news?page=<?php echo $_smarty_tpl->tpl_vars['next_page']->value;?>
" class="next"><img src="<?php echo base_url('templates/default/assets/images/icons/page_next.png');?>
"></a>
                        <?php }?>
                        
                    </div>
                </div>

            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
<?php echo '<script'; ?>
>
    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->lat) || !empty($_smarty_tpl->tpl_vars['UserData']->value->lng)) {?>
    var json_lat = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lat;?>
;
    var json_lng = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lng;?>
;
    var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
';
    

    
    <?php } else { ?>
    var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
';
    
    
    <?php }?>

    $(document).on("click", ".remove-item1", function() {
        var news = $(this).data("news");
        var that = $(this);
        if (confirm("Are you sure?")) {
            $.ajax({
                url: "<?php echo site_url_multi('/');?>
profile/pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/delete-news/"+news,
            }).done(function() {
                window.location = '';
            });
        }
    });

    $(document).ready(function() {

        
            $('.delete-news-item').on('click', function(ev){
                ev.preventDefault();
                var deleteConfirm = confirm("Press a button!");
                if (deleteConfirm == true) {
                    window.location.href = $(this).attr('href');
                } else {
                }
            })
        
    });
<?php echo '</script'; ?>
>


    <?php
}
}
/* {/block 'content'} */
}
