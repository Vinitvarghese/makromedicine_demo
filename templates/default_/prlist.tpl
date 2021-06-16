{extends file=$layout}
{block name=content}

 <div class="wrap margin-top-100 col-md-12">
      <div class="container">
        <div class="row">
          <div class="clearfix"></div>
			 <div class="col-md-12" id="about" style="background: #fff; margin-bottom: 10px;margin-top: 10px;">
			<table class="table table-hover">
				<tbody>
				{foreach $companies as $company}
				<tr>
					<td><a href="{base_url('company/')}{$company->slug}">{$company->company_name}</a></td>
				</tr>
				{/foreach}
				</tbody>
			</table>
			{$pagination}
			</div>
		</div>
	</div>
</div>

{/block}