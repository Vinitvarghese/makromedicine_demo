{extends file=$layout}
{block name=content}
	<div class="wrap margin-top-100 col-md-12">
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="margin-top:25px;margin-bottom:25px;padding-top:150px;">
					<div class="col-md-offset-4 col-md-4"> 
						<form class="" action="" method="post">
							<div class="form-group">
								<label for="new_password">Email</label>
								<input id="new_password" type="text" name="email" value="{$thisUser->email}" class="form-control" disabled readonly/>
							</div>
							<div class="form-group">
								<label for="new_password">New password</label>
								<input id="new_password" type="password" name="new_password" class="form-control">
							</div>
							<div class="form-group">
								<label for="re_password">Re password</label>
								<input id="re_password" type="password" name="re_password" class="form-control">
							</div>
							<div class="form-group">
								<label></label>
								<button type="submit" class="btn btn-info pull-right">Change</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
{/block}
