{extends file=$layout}
{block name=content}

<div class="wrap margin-top-100 col-md-12">
	<div class="container">
		<div class="row">
			<div class="col-md-12" id="about" style="background: #fff; margin-bottom: 10px;margin-top: 10px;">
				<div class="alert alert-success">Your payment completed successfully. 
				{if ($response)}
				<br>
				You purchased <b>{$response.item_name}</b> pack. <b>{$response.item_amount}</b> capsules have been added to your balance
				{/if}
				</div>
			</div>
		</div>
	</div>
</div>

{/block}