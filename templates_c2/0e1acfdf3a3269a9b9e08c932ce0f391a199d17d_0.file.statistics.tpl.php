<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:41:30
  from "/home/makromed/public_html/demo/templates/default/statistics.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f992eba35cd77_06782979',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e1acfdf3a3269a9b9e08c932ce0f391a199d17d' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/statistics.tpl',
      1 => 1603718917,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f992eba35cd77_06782979 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14408529365f992eba35bdc3_27718028', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_14408529365f992eba35bdc3_27718028 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<style>
	.chartdiv-st{
		height: 390px;
		width: 100%;
	}
	.filter-by-date{
		position: absolute;
	    right: 0;
	    top: 90px;
	    width: 15%;
	}
</style>
<div class="wrap margin-top-100 col-md-12">

	
		<div class="row chart-container">
			<div class="container">
			<div id="chartdiv"></div> 
		</div>
		</div>

			
		<div class="clearfix"></div>


<!-- Resources -->
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
templates/default/assets/plugin/amcharts4/core.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
templates/default/assets/plugin/amcharts4/maps.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
templates/default/assets/plugin/amcharts4/charts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
templates/default/assets/plugin/amcharts4/geodata/worldHigh.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
templates/default/assets/plugin/amcharts4/themes/animated.js"><?php echo '</script'; ?>
>




		<div class="container" style="position: relative;">
			<h1 class="st-title">Statistics</h1>
			<p class="sr-subtitle">Most searched data by different categories</p>
			<div class="clearfix"></div>
			<div class="form-group filter-by-date">
				<select name="" id="filterDate" class="form-control">
						<option value="">Show All</option>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options']->value, 'option');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['option']->value->month;?>
-<?php echo $_smarty_tpl->tpl_vars['option']->value->year;?>
"><?php echo $_smarty_tpl->tpl_vars['option']->value->month_name;?>
 <?php echo $_smarty_tpl->tpl_vars['option']->value->year;?>
</option>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</select>
			</div>
			<div class="row st-cont">
				<div class="col-md-3 st-sidebar">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statistics_sections']->value, 'section', false, 'sc_key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc_key']->value => $_smarty_tpl->tpl_vars['section']->value) {
?>
					<p <?php if ($_smarty_tpl->tpl_vars['sc_key']->value == 0) {?>class="active"<?php }?>><a data-section-t="<?php echo $_smarty_tpl->tpl_vars['section']->value->section;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
</a></p>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

					
				</div>
				<div class="col-md-9 st-content" style="min-height: 480px; margin-bottom: 30px">
					<?php
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

							<?php if ($_smarty_tpl->tpl_vars['k']->value == 20) {?>
								<?php break 1;?>
							<?php }?>
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

				</div>
			</div>
			
		</div>
</div>


<?php echo '<script'; ?>
>
	var countries_arr =  [

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statistics_countries']->value, 'country_item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country_item']->value) {
?>
	{
		id: "<?php echo $_smarty_tpl->tpl_vars['country_item']->value->code;?>
",
		value: "<?php echo $_smarty_tpl->tpl_vars['country_item']->value->count_all;?>
"
	},
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


];


var date_f ='';
var country = '';
 function filterByCountry(id,name){
 	$('.st-title').text('Statistics for '+name);
 	country = id;
 	$.ajax({
 		url: '/statistics/filter',
 		data: {'country': country, 'date': date_f},
 		dataType: 'html'
 	})
 	.done(function(data) {
 		//$('#filterDate').val('').find('option:first-child').attr('selected',true);
 		$('.st-content').html(data);
 	}) 	
 }

 $('#filterDate').on('change',function(){
 	date_f = $(this).val();
 	$.ajax({
 		url: '/statistics/filter',
 		data: {'country': country,'date': date_f},
 		dataType: 'html'
 	})
 	.done(function(data) {
 		$('.st-content').html(data);
 	}) 
 })

 
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo base_url();?>
templates/default/assets/js/statistics-map.js?v=22"><?php echo '</script'; ?>
>
<?php if (isset($_smarty_tpl->tpl_vars['filter_country']->value) && $_smarty_tpl->tpl_vars['filter_country']->value != '') {
echo '<script'; ?>
>
	chart.events.on("ready", function(ev) {
	  chart.zoomToMapObject(polygonSeries.getPolygonById("<?php echo $_smarty_tpl->tpl_vars['filter_country']->value;?>
"));
	});
<?php echo '</script'; ?>
>
<?php }?>



<?php echo '<script'; ?>
>
	$(document).ready(function() {
		setTimeout(function(){
			var section_colors = [];
			$('.chartdiv-st').each(function(index, el) {
				var ch_class = $(this).data('section');
				section_colors[ch_class]=[];
				$(this).find('g').each(function(){
					
					if($(this).attr('fill') != undefined && $(this).attr('fill') !='#ffffff' && $(this).attr('fill') != '#000000' && $(this).attr('fill') != 'none'){
						section_colors[ch_class].push($(this).attr('fill'));
					}
				})
			});
			

			$('.st-param').each(function(){
				var sc = $(this).data('section');
				$(this).find('p').each(function(){
					var ind = $(this).index();
					$(this).find('.st-badge').css('background',section_colors[sc][ind]);
				})
			})
		},5000);

		$('.st-param').each(function(){
		if($(this).height() > 390){
			$(this).next().after('<a class="showmore">More</a>');
		}
		});
	});

	$(document).on('click', '.showmore', function(){
		$(this).prev().prev().addClass('showall');
	})

	$('.st-sidebar a').click(function(e){
		e.preventDefault();
		var targ = $(this).data('section-t');
		$(this).parent().siblings().removeClass('active');
		$(this).parent().addClass('active');
		 $([document.documentElement, document.body]).animate({
        scrollTop: $(".st-param[data-section='"+targ+"']").offset().top-90
	    }, 2000);
	})

/*	$(window).scroll(function(){
		var st = $(window).scrollTop();
		if(st>885){
			$('.st-sidebar').addClass('fixed');
			$('.st-content').addClass('fixed');
		}
		else{
			$('.st-sidebar').removeClass('fixed');
			$('.st-content').removeClass('fixed');
		}
	})
	*/
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'content'} */
}
