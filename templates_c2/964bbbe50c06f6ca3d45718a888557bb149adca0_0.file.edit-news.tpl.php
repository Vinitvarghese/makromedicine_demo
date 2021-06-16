<?php
/* Smarty version 3.1.30, created on 2020-10-19 17:46:06
  from "/home/makromed/public_html/demo/templates/default/company/edit-news.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d989ef08ae5_07753970',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '964bbbe50c06f6ca3d45718a888557bb149adca0' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/edit-news.tpl',
      1 => 1603111928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f8d989ef08ae5_07753970 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13892569785f8d989ef080c2_47395091', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_13892569785f8d989ef080c2_47395091 extends Smarty_Internal_Block
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
                    <h2>Edit news <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
                </div>
                <div class="news_adding_section full_width">
                <form method="post" enctype="multipart/form-data">
                    
                <h4 class="title_1">Arcticle Title</h4>
                <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
" required>
                
                <hr>
                
                <div class="upload_img full_width img_fit">
                    <div id="my-file-preview" style="background-image: url(<?php echo base_url('uploads/news/');
echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
);"></div>
                    <div class="input-file-container">  
                        <input class="input-file" id="my-file" name="news_image" type="file">
                        <label tabindex="0" for="my-file" class="input-file-trigger">Add Photo</label>
                    </div>
                </div><!-- /.upload_img -->
                
                <label class="text_label">Text</label>
                
                <textarea name="description" class="big_area"><?php echo $_smarty_tpl->tpl_vars['news']->value['description'];?>
</textarea>
                
                

                
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
