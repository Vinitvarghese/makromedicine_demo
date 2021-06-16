{extends file=$layout}
{block name=content}
<style>
{literal}
	.planContainer{display:flex;flex-wrap:wrap;margin:1em;display:flex;flex-direction:row;align-items:flex-start;justify-content:center;}
	.plan{background:#edf2ff;width:20em;box-sizing:border-box;text-align:center;margin:1em;margin-bottom:1em;}
	.plan .titleContainer{background-color:#485e92;padding:1em;}
	.plan .titleContainer .title{font-size:1.45em;text-transform:uppercase;color:#ffffff;font-weight:700;}
	.plan .infoContainer{padding:1em;color:#2d3b48;box-sizing:border-box;border-bottom:5px solid #485e92}
	.plan .infoContainer .price{font-size:1.75em;padding:1em 0;font-weight:500;margin-top:0;display:inline-block;width:80%;}
	.plan .infoContainer .price b{font-weight:800;font-family:'GothamBold';}
	.plan .infoContainer .price p{font-size:1.35em;display:inline-block;margin:0;}
	.plan .infoContainer .price img{width:25px;margin-right:10px;}
	.plan .infoContainer .price span{font-size:1.0125em;display:inline-block;}
	.plan .infoContainer .desc{padding-bottom:1em;border-bottom:2px solid #f3f3f3;margin:0 auto;width:90%;min-height:120px;display:flex;align-items:center;}
	.plan .infoContainer .desc em{font-size:1.1em;font-weight:500;line-height:1.8;}
	.plan .infoContainer .features{font-size:1em;list-style:none;padding-left:0;}
	.plan .infoContainer .features li{padding:0.5em;}
	.plan .infoContainer .selectPlan{border:2px solid #485e92;color:#fff;background:#485e92;padding:0.35em 0.5em;border-radius:2.5em;cursor:pointer;transition:all 0.25s;margin:1em auto;box-sizing:border-box;max-width:55%;display:block;font-weight:700;font-size:1.5em;font-family:'Segoe UI';text-decoration:none!important;}
	.plan .infoContainer .selectPlan:hover{background:transparent;color:#485e92;}
	@media screen and (max-width:25em){
		.planContainer{margin:0;}
		.planContainer .plan{width:100%;margin:1em 0;}
	}
	#about{min-height:600px}
{/literal}
</style>
<div class="wrap margin-top-100 col-md-12">
	<div class="container">
		<div class="row">
			<div class="col-md-12" id="about" style="background: #fff; margin-bottom: 10px;margin-top: 10px;">
				
				<div class="planContainer">

					{if $plans}
						{foreach $plans as $plan}
						<div class="plan">
							<div class="titleContainer">
								<div class="title">{$plan->title}</div>
							</div>
							<div class="infoContainer">
								<div class="price">
									<img src="{base_url()}templates/default/assets/img/meds.svg" alt=""><b>{$plan->amount}</b> <span>capsule</span>
								</div>
								<div class="p desc"><em>{$plan->description}</em></div>
								{if isset($user.loggedin)}
								<form class="paypal" action="{site_url_multi('buy-capsule')}" method="post" id="paypal_form">
							        <input type="hidden" name="cmd" value="_xclick" />
							        <input type="hidden" name="no_note" value="1" />
							        <input type="hidden" name="lc" value="UK" />
							        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
							        <input type="hidden" name="first_name" value="{$user.fullname}" />
							        <input type="hidden" name="last_name" value="" />
							        <input type="hidden" name="payer_email" value="{$user.email}" />
							        <input type="hidden" name="item_number" value="{$plan->id}" / >
							        <button style="width: 130px" class="selectPlan" type="submit" name="submit">${$plan->price}</button>
							    </form>
							    {else}
							        <button style="width: 130px" class="selectPlan triggerSignup" type="button" >${$plan->price}</button>
							        {/if}
							</div>
						</div>
						{/foreach}
					{/if}
				
							</div>
						</div>
					</div>
				</div>
			</div>
			{/block}