<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:42:02
  from "/home/makromed/public_html/demo/templates/default/statistics-country.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f992eda933588_18098703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a47b6a85bfd2208c468c2df9ca614240473ebdec' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/statistics-country.tpl',
      1 => 1603718916,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f992eda933588_18098703 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['statistics_sections']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statistics_sections']->value, 'section', false, 'sc_key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc_key']->value => $_smarty_tpl->tpl_vars['section']->value) {
?>
		<h2><?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
</h2>

	<div class="col-md-6 st-param" data-section="<?php echo $_smarty_tpl->tpl_vars['section']->value->section;?>
">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value->statistics, 'st_val', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['st_val']->value) {
?>
			<?php if ($_smarty_tpl->tpl_vars['st_val']->value->type != '') {?>
			<p <?php if (strlen($_smarty_tpl->tpl_vars['st_val']->value->type) > 40) {?>title="<?php echo $_smarty_tpl->tpl_vars['st_val']->value->type;?>
"<?php }?>><?php if (strlen($_smarty_tpl->tpl_vars['st_val']->value->type) > 40) {
echo substr($_smarty_tpl->tpl_vars['st_val']->value->type,0,40);?>
..<?php } else {
echo $_smarty_tpl->tpl_vars['st_val']->value->type;
}?> <span class="st-badge green"><?php echo $_smarty_tpl->tpl_vars['st_val']->value->percent;?>
%</span></p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['k']->value == 20) {?>
				<?php break 1;?>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</div>
	<div class="col-md-6">
		<div class="chartdiv-st chartdiv<?php echo $_smarty_tpl->tpl_vars['sc_key']->value;?>
" data-section="<?php echo $_smarty_tpl->tpl_vars['section']->value->section;?>
"></div>
	</div>
	<div class="clearfix"></div>



			<?php echo '<script'; ?>
>

			// Themes begin
			am4core.useTheme(am4themes_animated);
			// Themes end

			

			// Create chart instance
			var chart = am4core.create("chartdiv<?php echo $_smarty_tpl->tpl_vars['sc_key']->value;?>
", am4charts.PieChart);

			// Add data
			chart.data = [ 
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value->statistics, 'st_val', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['st_val']->value) {
?>
			{
			  "country": "<?php echo $_smarty_tpl->tpl_vars['st_val']->value->type;?>
",
			  "litres": <?php echo $_smarty_tpl->tpl_vars['st_val']->value->percent;?>

			},

			<?php if ($_smarty_tpl->tpl_vars['k']->value == 20) {?>
				<?php break 1;?>
			<?php }?>

			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			 ];
			

			// Add and configure Series
			var pieSeries = chart.series.push(new am4charts.PieSeries());
			pieSeries.dataFields.value = "litres";
			pieSeries.dataFields.category = "country";
			pieSeries.slices.template.stroke = am4core.color("#fff");
			pieSeries.slices.template.strokeWidth = 2;
			pieSeries.slices.template.strokeOpacity = 1;

			// This creates initial animation
			pieSeries.hiddenState.properties.opacity = 1;
			pieSeries.hiddenState.properties.endAngle = -90;
			pieSeries.hiddenState.properties.startAngle = -90;
			pieSeries.labels.template.disabled = true;
			pieSeries.ticks.template.disabled = true;

		<?php echo '</script'; ?>
>


		
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php } else { ?>
	<div class="alert alert-warning">
		No results
	</div>
<?php }
}
}
