{extends file=$layout}
{block name=content}

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
<script src="{base_url()}templates/default/assets/plugin/amcharts4/core.js"></script>
<script src="{base_url()}templates/default/assets/plugin/amcharts4/maps.js"></script>
<script src="{base_url()}templates/default/assets/plugin/amcharts4/charts.js"></script>
<script src="{base_url()}templates/default/assets/plugin/amcharts4/geodata/worldHigh.js"></script>
<script src="{base_url()}templates/default/assets/plugin/amcharts4/themes/animated.js"></script>




		<div class="container" style="position: relative;">
			<h1 class="st-title">Statistics</h1>
			<p class="sr-subtitle">Most searched data by different categories</p>
			<div class="clearfix"></div>
			<div class="form-group filter-by-date">
				<select name="" id="filterDate" class="form-control">
						<option value="">Show All</option>
					{foreach $options as $option}
						<option value="{$option->month}-{$option->year}">{$option->month_name} {$option->year}</option>
					{/foreach}
				</select>
			</div>
			<div class="row st-cont">
				<div class="col-md-3 st-sidebar">
					{foreach $statistics_sections as $sc_key=>$section}
					<p {if $sc_key eq 0 }class="active"{/if}><a data-section-t="{$section->section}" href="#">{$section->name}</a></p>
					{/foreach}
					
				</div>
				<div class="col-md-9 st-content" style="min-height: 480px; margin-bottom: 30px">
					{foreach $statistics_sections as $sc_key=>$section}
						<h2>{$section->name}</h2>

					<div class="col-md-6 st-param" data-section="{$section->section}">
						{foreach $section->statistics as $k => $st_val}
						{if $st_val->type!=''}
							
							<p {if strlen($st_val->type)>40}title="{$st_val->type}"{/if}>{if strlen($st_val->type)>40}{substr($st_val->type,0,40)}..{else}{$st_val->type}{/if} <span class="st-badge green">{$st_val->percent}%</span></p>

							{if $k == 20}
								{break}
							{/if}
							{/if}
						{/foreach}
					</div>
					<div class="col-md-6">
						<div class="chartdiv-st chartdiv{$sc_key}" data-section="{$section->section}"></div>
					</div>
					<div class="clearfix"></div>



							<script>
	
							// Themes begin
							am4core.useTheme(am4themes_animated);
							// Themes end

							

							// Create chart instance
							var chart = am4core.create("chartdiv{$sc_key}", am4charts.PieChart);

							// Add data
							chart.data = [ 
							{foreach $section->statistics as $k => $st_val}
							{
							  "country": "{$st_val->type}",
							  "litres": {$st_val->percent}
							},

							{if $k == 20}
								{break}
							{/if}

							{/foreach}
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

						</script>

			
						
					{/foreach}
				</div>
			</div>
			
		</div>
</div>


<script>
	var countries_arr =  [

	{foreach $statistics_countries as $country_item}
	{
		id: "{$country_item->code}",
		value: "{$country_item->count_all}"
	},
	{/foreach}

];

{literal}
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

 {/literal}
</script>

<script src="{base_url()}templates/default/assets/js/statistics-map.js?v=22"></script>
{if isset ($filter_country) && $filter_country!=''}
<script>
	chart.events.on("ready", function(ev) {
	  chart.zoomToMapObject(polygonSeries.getPolygonById("{$filter_country}"));
	});
</script>
{/if}


{literal}
<script>
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
</script>
{/literal}
{/block}