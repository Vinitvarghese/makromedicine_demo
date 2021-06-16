{extends file=$layout}
{block name=content}
	<div class="wrap margin-top-100 col-md-12">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12" style="margin-top:25px;margin-bottom:25px;">
					<div class="col-md-12">
						<h1 class="faq-title">{translate('title')}</h1>
						<p class="faq-subtitle"> {translate('description')}</p>
					</div>
					<div class="clearfix"></div>
					{if $faqs}
					<div class="panel-group" id="accordion">
						{foreach $faqs as $key=>$faq}
						<div class="panel panel-default">
							<div class="panel-heading shape" data-toggle="collapse" data-parent="#accordion" href="#collapse_{$faq->id}">
								<h4 class="panel-title">{$faq->question}</h4>
							</div>
							<div id="collapse_{$faq->id}" class="panel-collapse collapse {if $key eq 0}}in{/if}">
								<div class="panel-body">{$faq->answer}</div>
							</div>
						</div>
						{/foreach}
					</div>
					{/if}
				</div>
			</div>
		</div>
	</div>
{/block}
