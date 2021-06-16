<?php
/* Smarty version 3.1.30, created on 2020-10-27 14:43:18
  from "/home/makromed/public_html/demo/templates/default/company/add-news.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f97f9c63351f5_71946333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c13741a63e01f2789e697c52de7a56b8c1474789' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/add-news.tpl',
      1 => 1603718952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f97f9c63351f5_71946333 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9819549745f97f9c6334835_27264850', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_9819549745f97f9c6334835_27264850 extends Smarty_Internal_Block
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

    <?php echo '<script'; ?>
>

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

    <?php echo '</script'; ?>
>
}


    <?php
}
}
/* {/block 'content'} */
}
