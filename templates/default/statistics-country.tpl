{if isset($statistics_sections)}
{foreach $statistics_sections as $sc_key=>$section}
		<h2>{$section->name}</h2>

	<div class="col-md-6 st-param" data-section="{$section->section}">
		{foreach $section->statistics as $k => $st_val}
			{if $st_val->type!=''}
			<p {if strlen($st_val->type)>40}title="{$st_val->type}"{/if}>{if strlen($st_val->type)>40}{substr($st_val->type,0,40)}..{else}{$st_val->type}{/if} <span class="st-badge green">{$st_val->percent}%</span></p>
			{/if}
			{if $k == 20}
				{break}
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
{else}
	<div class="alert alert-warning">
		No results
	</div>
{/if}