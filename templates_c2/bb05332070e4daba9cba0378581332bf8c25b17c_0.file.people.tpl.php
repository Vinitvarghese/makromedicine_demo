<?php
/* Smarty version 3.1.30, created on 2020-10-19 17:57:03
  from "/home/makromed/public_html/demo/templates/default/company/people.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9b2f61d7a9_44888673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb05332070e4daba9cba0378581332bf8c25b17c' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/people.tpl',
      1 => 1603111928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f8d9b2f61d7a9_44888673 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11439040935f8d9b2f61cde7_91325197', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_11439040935f8d9b2f61cde7_91325197 extends Smarty_Internal_Block
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

                
                <div class="n_right_section start_with_text employee_l">
                    <div class="with_buttons full_width">
                        <h2>employees</h2>
                    </div>
                    <div class="full_width employes_page">
                        <div class="row">

                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['owner']->value['photo'];?>
" alt="img">
                                <h5 class="people_name people_name2 full_width"><?php echo $_smarty_tpl->tpl_vars['owner']->value['name'];?>
</h5>
                                <span class="people_position_name people_position_name2"><?php echo $_smarty_tpl->tpl_vars['owner']->value['position'];?>
</span>

                                <select class="gray_anch peop_group" name="group_id" disabled>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" <?php echo $_smarty_tpl->tpl_vars['owner']->value['user_groups_id'] == $_smarty_tpl->tpl_vars['group']->value['id'] ? 'selected' : '';?>
 ><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                </select>
                            </div>


                            <?php if (count($_smarty_tpl->tpl_vars['approved_users']->value) > 0) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['approved_users']->value, 'approved_user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['approved_user']->value) {
?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center people_box">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['approved_user']->value['photo'];?>
" alt="img">
                                        <h5 class="people_name people_name2 full_width"><?php echo $_smarty_tpl->tpl_vars['approved_user']->value['name'];?>
</h5>
                                        <span class="people_position_name people_position_name2"><?php echo $_smarty_tpl->tpl_vars['approved_user']->value['position'];?>
</span>

                                        <select class="gray_anch peop_group group_id" name="group_id" disabled data-user="<?php echo $_smarty_tpl->tpl_vars['approved_user']->value['id'];?>
">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" <?php echo $_smarty_tpl->tpl_vars['approved_user']->value['user_groups_id'] == $_smarty_tpl->tpl_vars['group']->value['id'] ? 'selected' : '';?>
 ><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                        </select>


                                        <div class="buttons_lab full_width">
                                            <a href="javascript:" class="done_ edit_people_group">
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/edit_icon_white.svg');?>
">
                                            </a>

                                            <a href="javascript:" class="done_ edit_people_group_done">
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/check_white.png');?>
">
                                                <span>done</span>
                                            </a>

                                            <a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/people/approve/<?php echo $_smarty_tpl->tpl_vars['approved_user']->value['id'];?>
/2" class="delete_people_btn" data-name="<?php echo $_smarty_tpl->tpl_vars['approved_user']->value['name'];?>
" data-image="<?php echo $_smarty_tpl->tpl_vars['approved_user']->value['photo'];?>
">
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/del_n.png');?>
" alt="delete">
                                            </a>
                                        </div>

                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>

                        </div>
                    </div>
                    <?php if (count($_smarty_tpl->tpl_vars['approval_waiting_users']->value) > 0) {?>
                        <div class="with_buttons full_width">
                            <h2>Approval Waiting</h2>
                        </div>
                        <div class="full_width news_tiles">
                            <div class="row">

                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['approval_waiting_users']->value, 'waiting_user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['waiting_user']->value) {
?>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['photo'];?>
" alt="img">
                                        <h5 class="people_name people_name2 full_width"><?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['name'];?>
</h5>

                                        <span class="people_position_name"><?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['position'];?>
</span>

                                        <div class="buttons_lab full_width">
                                            <a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/people/approve/<?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['id'];?>
/1" class="done_">
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/check_white.png');?>
"> <span>approve</span>
                                            </a>

                                            <a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/people/approve/<?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['id'];?>
/2" class="delete_people_btn"  data-name="<?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['name'];?>
" data-image="<?php echo $_smarty_tpl->tpl_vars['waiting_user']->value['photo'];?>
">
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/del_n.png');?>
" alt="delete">
                                            </a>
                                        </div>
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                            </div>
                        </div>
                    <?php }?>
                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->



        <div id="people_modal" class="modal fade " role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content people_modal">
                    <div class="modal-header" style="background: none;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
"/></span></button>
                    </div>
                    <div class="modal-body">

                        <div class=" for_small img_fit ">
                            <img id="modal_img" src="" alt="img">
                        </div>

                        <h3 id="modal_title"></h3>
                        <p></p>
                        <div class="mod_center_inp_textarea">
                            <button type="button" class="close close_modal_btn" data-dismiss="modal" aria-label="Close" >No</button>
                            <a href="" id="modal_yes_btn" class="yes_modal_btn">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
