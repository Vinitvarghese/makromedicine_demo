<?php
/* Smarty version 3.1.30, created on 2020-10-19 18:00:20
  from "/home/makromed/public_html/demo/templates/admin/default/_partial/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9bf48550c3_23383788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '352b41bdb75425d5e71604291c57ad49179bce1a' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/_partial/footer.tpl',
      1 => 1591649998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f8d9bf48550c3_23383788 (Smarty_Internal_Template $_smarty_tpl) {
?>
	<!-- Footer -->
	<div class="navbar navbar-default navbar-fixed-bottom">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i class="icon-circle-up2"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second">
			<div class="navbar-text">
				<?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>

			</div>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li><a><?php echo translate('footer_memory_usage',true);?>
 <?php echo $_smarty_tpl->tpl_vars['memory_usage']->value;?>
</a></li>
					<li><a><?php echo translate('footer_elapsed_time',true);?>
 <?php echo $_smarty_tpl->tpl_vars['elapsed_time']->value;?>
</a></li>
					<li><a id="back-to-top"><i class="icon-arrow-up16"></i><span class="visible-xs-inline-block position-right"><?php echo translate('footer_backtotop',true);?>
</span></a></li>
				</ul>
			</div>
			
		</div>
	</div>
	<!-- /footer -->
	<?php echo '<script'; ?>
 type="text/javascript">
		
		$(document).on('click','.btn-copy-link', function(e){
			e.preventDefault();
			$(this).parents('tr').siblings('tr').find('.btn-copy-link').removeClass('btn-success').addClass('btn-default').text('Copy Url');
			$(this).removeClass('btn-default').addClass('btn-success').text('Copied');
			var $temp = $("<input>");
		  $("body").append($temp);
		  $temp.val($(this).attr('href')).select();
		  document.execCommand("copy");
		  $temp.remove();

		var pr_id = $(this).data('id');
		$.ajax({
				url: ci_custom_home_url+'en/admin/changeprocess',
				dataType: 'json',
				data: {pr_id : pr_id, pr_process : 1},
			})

		});


		

		
		
	<?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
