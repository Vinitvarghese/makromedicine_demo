{extends file=$layout}
{block name=content}
<div class="wrap col-md-12">
	<div class="container-fuild">
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12" id="add-product">
				<div class="col-md-12 no-padding add-product" id="collapseExample">
					<div class="col-md-12 no-padding panel-add">
						<form class="" role="form" method="POST" action="{site_url_multi('product/add')}">
							<div class="no-padding search-tool" style="display:none;">
								<div class="col-md-12 malecule">
									<div class="search-module">
										<input type="text" class="module-search" placeholder="Search">
										<div class="search-inner"></div>
									</div>
									<div class="col-md-12 no-padding discom">
										<ul class="list-chemical periodic collapse" id="chemical">
											{if $chemichal}
                                                {foreach from=$chemichal item=chemical} 
                                                    <li data-txt="{$chemical->meaning}" data-target="chemical" data-id="{$chemical->id}"> <a href="#">{$chemical->atc_code} | {$chemical->meaning}</a> </li> 
                                                {/foreach}
                                            {/if} 
										</ul>
										<ul class="list-herbal periodic collapse" id="herbal"> 
											{if $herbals} {foreach from=$herbals item=herbal} 
											<li data-txt="{$herbal->name}" data-target="herbal" data-id="{$herbal->id}"> <a href="#">{$herbal->name}</a> </li> 
											{/foreach}{/if} 
										</ul>
										<ul class="list-animal periodic collapse" id="animal"> 
											{if $animals} {foreach from=$animals item=animal} 
											<li data-txt="{$animal->name}" data-target="animal" data-id="{$animal->id}"> <a href="#">{$animal->name}</a> </li> 
											{/foreach}{/if} 
										</ul>
										<ul class="list-casNumber periodic collapse" id="casNumber">
											{if $cas_numbers} {foreach from=$cas_numbers item=cas_number} 
											<li data-txt="{$cas_number->cas_no}" data-target="casNumber" data-id="{$cas_number->id}"> <a href="#">{$cas_number->cas_no}</a> </li> 
											{/foreach}{/if} 
										</ul>
										<ul class="list-dossageForm periodic collapse" id="dossageForm"> 
											{if $dossageforms} {foreach from=$dossageforms item=dossageform} 
											<li data-txt="{$dossageform->name}" data-target="dossageForm" data-id="{$dossageform->id}"> <a href="#">{$dossageform->name}</a> </li> 
											{/foreach}{/if} 
										</ul>
										<ul class="list-dossageForm periodic collapse" id="medicalClassification"> 
											{if $medicals} {foreach from=$medicals item=medical} 
											<li data-txt="{$medical->name}" data-target="medicalClassification" data-id="{$medical->id}"> <a href="#">{$medical->name}</a> </li> 
											{/foreach}{/if} 
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-12 no-padding specilation">
								<div class="col-md-12 add-frist">
									{if isset($message)}
									<div class="alert alert-{$message.type}">
										{$message.message}
									</div>
									{literal}
									<script>
										$(document).ready(function() {
											$('.add-product-btn').trigger('click');
										});
									</script>
									{/literal}
									{/if}
									<div class="form-group">
										<div class="col-md-4 no-padding">
											<select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
												<option value="0">Product type</option>
												{if $product_type}
													{foreach from=$product_type key=key item=type}
														<option value="{$type->id}" {if $product->pr_type eq $type->id}selected="selected"{/if}>{$type->name}</option> 
													{/foreach}
												{/if}
												
											</select>
										</div>
										<div class="col-md-4 no-padding brandName">
											<input type="text" name="title" class="form-control mylos" placeholder="Brand name" value="{$product->title}">
										</div>
										<div class="col-md-4 no-padding country">
											<select name="country" class="form-control mylos selectpicker show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
												<option value="0">Country</option>
												{if $countrys}
													{foreach from=$countrys key=key item=country}
														<option value="{$country->id}" {if $product->country eq $country->id}selected="selected"{/if}>{$country->name}</option> 
													{/foreach}
												{/if}
											</select>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									<div class="form-group">
										<button type="button" class="target chemical" data-widget="" data-target="#chemical" >Chemical +</button>
										<button type="button" class="target herbal" data-widget="" data-target="#herbal" >Herbal +</button>
										<button type="button" class="target animal" data-widget="" data-target="#animal">Animal + </button>
										<button type="button" class="target casNumber" data-widget="" data-target="#casNumber">CAS Number +</button>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-12 frist-inner">
									{assign var=atc_codes value=json_decode($product->atc_code)}
									{if !empty($atc_codes)}
										{foreach from=$atc_codes item=atc_code}
											<div class="form-group vared label_">
												<label class="col-sm-4 no-padding control-label">{get_atc_code_name($atc_code->id)}</label>
												<div class="col-sm-1 no-padding">
													<input type="hidden" name="atc_codes[`+count+`][id]" value="{$atc_code->id}">
													<input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[`+count+`][mdoza]" value="{$atc_code->mdoza}">
												</div>
												<div class="col-sm-1 no-padding">
													<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[`+count+`][vdoza]">
														<option value="">Dose unit</option>
														{if $unit}
															{foreach from=$unit key=$ey item=value} 
																<option value="{$value->id}" {if $atc_code->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
															{/foreach}
														{/if} 
													</select>
												</div>
												<div class="col-sm-1">
													{if $atc_code->mdoza2}
														<button type="button" class="minus_item" style="display:block !important">-</button>
													{else}
														<button type="button" class="plus_item" data-id="`+count+`" data-type="chemicals">+</button>
													{/if}
												</div>
												<div class="col-md-2 no-padding extra-mg">
													{if $atc_code->mdoza2}
														<div class="col-sm-6 no-padding">
															<input type="number" class="form-control mylos" placeholder="Quantity" name="chemical[`+data_id+`][mdoza2]" value="{$atc_code->mdoza2}">
														</div>
														<div class="col-sm-6 no-padding">
															<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="chemical[`+data_id+`][vdoza2]">
																<option value="">Volume unit</option>
																{if $unit}
																	{foreach from=$unit key=key item=value} 
																		<option value="{$value->id}" {if $atc_code->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
																	{/foreach}
																{/if} 
															</select>
														</div>
													{/if}
												</div>
												<div class="col-sm-1">
													<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[`+count+`][purity_unit]">
														{if $puritys}
															{foreach from=$puritys  key=key item=purity} 
																<option value="{$purity->id}" {if $atc_code->purity_unit eq $purity->id}selected="selected"{/if} data-code="{$purity->code}">{$purity->code}</option>
															{/foreach}
														{/if} 
													</select>
												</div>
												<div class="col-sm-1">
													<input type="text" class="form-control mylos" placeholder="purity (%)" name="atc_codes[`+count+`][purity]" value="{$atc_code->purity}">
												</div>
												<div class="col-md-1">
													<button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
												</div>
												<div class="clearfix"></div>
											</div>
										{/foreach}
									{/if}

									{assign var=herbals value=json_decode($product->herbal)}
									{if !empty($herbals)}
										{foreach from=$herbals item=$herbal}
											<div class="form-group vared label_">
												<label class="col-sm-5 no-padding control-label">{get_herbal_name($herbal->id)}</label>
												<div class="col-sm-1 no-padding">
													<input type="hidden" name="herbals[`+count+`][id]" value="{$herbal->id}">
													<input type="text" class="form-control mylos" placeholder="Quantity" name="herbals[`+count+`][mdoza]" value="{$herbal->mdoza}">
												</div>
												<div class="col-sm-2">
													<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[`+count+`][vdoza]">
														<option value="">Dose unit</option>
														{if $unit}
															{foreach from=$unit  key=key item=value} 
																<option value="{$value->id}" {if $herbal->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
															{/foreach}
														{/if} 
													</select>
												</div>
												<div class="col-sm-1 no-padding">
													<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[`+count+`][part]">
														<option class="bs-title-option" value="">Herb part</option>
														{if $herb_parts}
															{foreach from=$herb_parts key=key item=herb_part} 
																<option value="{$herb_part->id}"  {if $herbal->herb_part eq $herb_part->id}selected="selected"{/if} data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option> 
															{/foreach}
														{/if} 
													</select>
												</div>
												<div class="col-sm-2">
												<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[`+count+`][form]">
													<option class="bs-title-option" value="">Herb form</option>
													{if $herb_forms}
														{foreach from=$herb_forms key=key item=herb_form} 
															<option value="{$herb_form->id}" {if $herbal->herb_form eq $herb_form->id}selected="selected"{/if} data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option> 
														{/foreach}
													{/if}  
												</select>
												</div>
												<div class="col-sm-1">
													<button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
												</div>
												<div class="clearfix"></div>
											</div>
										{/foreach}
									{/if}

									{assign var=animals value=json_decode($product->animal)}
									{if !empty($animals)}
									{foreach from=$animals item=animal}
										<div class="form-group vared label_">
											<label class="col-sm-6 no-padding control-label">{get_animal_name($animal->id)}</label>
											<div class="col-sm-1 no-padding">
											<input type="hidden" name="animals[`+count+`][id]" value="{$animal->id}">
											<input type="text" class="form-control mylos" placeholder="Quantity" name="animals[`+count+`][mdoza]" value="{$animal->mdoza}">
											</div>
											<div class="col-sm-2">
												<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[`+count+`][vdoza]">
													<option value="">Dose unit</option>
													{if $unit}
														{foreach $unit as $key=>$value} 
															<option value="{$value->id}" {if $animal->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
														{/foreach}
													{/if} 
												</select>
											</div>
											<div class="col-sm-1 no-padding">
												<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[`+count+`][part]">
													<option class="bs-title-option" value="">Animal part</option>
													{if $animal_parts}
														{foreach from=$animal_parts key=key item=animal_part} 
															<option value="{$animal_part->id}" {if $animal->part eq $animal_part->id}selected="selected"{/if}  data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option> 
														{/foreach}
													{/if} 
												</select>
											</div>
											<div class="col-sm-1">
											<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[`+count+`][form]">
												<option class="bs-title-option" value="">Animal form</option>
												{if $animal_forms}
													{foreach from=$animal_forms key=key item=animal_form} 
														<option value="{$animal_form->id}" {if $animal->form eq $animal_form->id}selected="selected"{/if} data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option> 
													{/foreach}
												{/if}  
											</select>
											</div>
											<div class="col-sm-1">
												<button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
											</div>
											<div class="clearfix"></div>
										</div>
									{/foreach}
									{/if}

									{assign var=cass value=json_decode($product->cas)}
									{if !empty($cass)}
										{foreach from=$cass item=cas}
											<div class="form-group">
												<label class="col-sm-2 no-padding control-label">{get_cas_name($cas->id)}</label>
												<div class="col-sm-1 no-padding">													
												<input type="hidden" name="cass[`+count+`][id]" value="{$cas->id}">
												<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[`+count+`][purity_unit]">
													{if $puritys}
														{foreach from=$puritys key=key item=purity} 
															<option value="{$purity->id}" {if $cas->purity_unit eq $purity->id}selected="selected"{/if} data-code="{$purity->code}"> {$purity->code} </option>
														{/foreach}
													{/if} 
												</select>
												</div>
												<div class="col-sm-1 no-padding">
													<input type="text" class="form-control mylos" placeholder="purity (%)" name="cass[`+count+`][purity]" value="{$cas->purity}">
												</div>
												<div class="col-sm-1 no-padding">
													<input type="text" class="form-control mylos" placeholder="Quantity" name="cass[`+count+`][mdoza]" value="{$cas->mdoza}">
												</div>
												<div class="col-sm-1 no-padding">
													<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name=cass[`+count+`][vdoza]"">
														<option value="">Dose unit</option>
														{if $unit}
															{foreach from=$unit key=key item=value} 
																<option value="{$value->id}" {if $cas->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
															{/foreach}
														{/if} 
													</select>
												</div>
												<div class="col-sm-1">
													{if $cas->mdoza2}
														<button type="button" class="minus_item" style="display:block !important">-</button>
													{else}
														<button type="button" class="plus_item" data-id="`+count+`" data-type="cass">+</button>
													{/if}
												</div>
												<div class="col-sm-2 no-padding extra-mg">
													{if $cas->mdoza2}
														<div class="col-sm-6 no-padding">
															<input type="number" class="form-control mylos" placeholder="Quantity" name="cass[`+data_id+`][mdoza2]" value="{$cas->mdoza2}">
														</div>
														<div class="col-sm-6 no-padding">
															<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="chemical[`+data_id+`][vdoza2]">
																<option value="">Volume unit</option>
																{if $unit}
																	{foreach from=$unit key=key item=value} 
																		<option value="{$value->id}" {if $cas->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
																	{/foreach}
																{/if} 
															</select>
														</div>
													{/if}
												</div>
												<div class="col-sm-2">
													<input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="cass[`+count+`][atc_code]" data-role="tagsinput" multiple>
												</div>
												<div class="col-sm-1">
													<button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
												</div>
												<div class="clearfix"></div>
											</div>
										{/foreach}
									{/if}

								</div>
								<!-- Dossage Form -->
								<div class="col-md-12 term-inner">
									<div class="form-group">
										<button type="button" class="dossage dossageForm btn-dossage" data-widget=""  data-target="#dossageForm">Dosage Form +</button>
									</div>
								</div>
								<div class="col-md-12 dossageForm-inner term-inner back">
									{assign var=packing_types value=json_decode($product->packing_type)}
									{if !empty($packing_types)}
										{foreach from=$packing_types item=packing_type}
											<div class="form-group vared label_">
												<label class="col-sm-4 no-padding control-label">{get_packing_type_name($packing_type->id)}</label>
												<div class="col-sm-1 no-padding">
													<input type="hidden" name="packing_types[`+count+`][id]" value="{$packing_type->id}">
													<input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[`+count+`][mdoza]" value="{$packing_type->mdoza}">
												</div>
												<div class="col-sm-2 no-padding">
													<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[`+count+`][vdoza]">
														<option value="">Dose unit</option>
														{if $unit}
															{foreach from=$unit key=key item=value} 
																<option value="{$value->id}" {if $packing_type->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
															{/foreach}
														{/if} 
													</select>
												</div>
												<div class="col-sm-1">
													{if $packing_type->mdoza2}
														<button type="button" class="minus_item" style="display:block !important">-</button>
													{else}
														<button type="button" class="plus_item" data-id="`+count+`" data-type="packing_types">+</button>
													{/if}
												</div>
												<div class="col-md-3 extra-mg">
													{if $packing_type->mdoza2}
														<div class="col-sm-6 no-padding">
															<input type="number" class="form-control mylos" placeholder="Quantity" name="packing_types[`+data_id+`][mdoza2]" value="{$packing_type->mdoza2}">
														</div>
														<div class="col-sm-6 no-padding">
															<select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[`+data_id+`][vdoza2]">
																<option value="">Volume unit</option>
																{if $unit}
																	{foreach from=$unit key=key item=value} 
																		<option value="{$value->id}" {if $packing_type->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
																	{/foreach}
																{/if} 
															</select>
														</div>
													{/if}
												</div>
												<div class="col-md-1">
													<button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
												</div>
												<div class="clearfix"></div>
											</div>
										{/foreach}
									{/if}
								</div>
								<!-- Dossage Form -->
								<div id="div_timer"></div>
								<!-- Medical Classifiction -->
								<div class="col-md-12 term-inner">
									<div class="form-group">
										<button type="button" class="dossage medicalClassifiction btn-dossage" data-widget="" data-target="#medicalClassification">Medical Classification +</button>
									</div>
								</div>
								<div class="col-md-12 term-inner medicalClassifiction medicalClassification-inner back">
									{assign var=medical_cls value=explode(',', $product->medical_cl)}
									{assign var=medical_cl_count value=0}
									{foreach from=$medical_cls item=medical_cl}
									<div class="form-group col-md-3 no-padding vared label_{$medical_cl_count}">
										<div class="input-group">
										<input type="text" class="form-control mylos" value="{get_medical_classification_name($medical_cl)}" readonly>
										<input type="hidden" value="{$medical_cl}" name="classifiction[{$medical_cl_count}]">
										<span class="input-group-btn">
											<button type="button" class="btn btn-danger btn-bix pull-right remove-item-classifiction" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-times"></i> </button>
										</span>
										</div>
									</div>
									{assign var=medical_cl_count value=$medical_cl_count+1}
									{/foreach}
								</div>
								<!-- Medical Classifiction -->
								<div class="col-md-12 second-inner">
									<div class="modal fade bs-example-modal-lg addPhoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal"><span class="md-close"></span></button>
													<h4 class="modal-title" id="myModalLabel">Add picture</h4>
												</div>
												<div class="modal-body for-upload-md"> 
													<div class="img-upload-full-block">
														<div class="img-full-left-block">
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="big-upload upload-big-button"></button>
																	</label>
																</div>
															</div>
														</div>
														<div class="img-full-right-block ">
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="mini-upload upload-button"></button>
																	</label>
																</div>
															</div>
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="mini-upload upload-button"></button>
																	</label>
																</div>
															</div>
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="mini-upload upload-button"></button>
																	</label>
																</div>
															</div>
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="mini-upload upload-button"></button>
																	</label>
																</div>
															</div>
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="mini-upload upload-button"></button>
																	</label>
																</div>
															</div>
															<div class="img-upload-group">
																<div class="reload-form-upload">
																	<label>
																		<input type="file"  />
																		<button type="button" class="mini-upload upload-button"></button>
																	</label>
																</div>
															</div>
														</div>
													</div> 
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<button type="button" class="btn-moders moreInfo" data-toggle="collapse" data-target="#more-information" aria-expanded="false" aria-controls="more-information">More information</button>
										<button type="button" class="btn-moders addPhoto" data-toggle="modal" data-target=".bs-example-modal-lg">Add Photo</button>
									</div>
									<div class="more-information moreInfo" id="more-information">
										<div class="form-group">
											<div class="col-md-3 no-padding" style="padding-top: 10px;padding-left:20px;">
											<label>Dossage format</label>
											<div class="form-group">
												<input type="checkbox" id="CTD" name="ctd" value="1" {if $product->ctd eq 1}checked="checked"{/if} >
												<label for="CTD" class="pull-right">CTD</label>
												<input type="checkbox" id="BE" name="be" value="1" {if $product->be eq 1}checked="checked"{/if} >
												<label for="BE" class="pull-right">BE</label>
											</div>
											</div>
											<div class="col-md-3 no-padding">
												<input type="number" class="form-control mylos" placeholder="Moq" name="moq" value="{$product->moq}">
											</div>
											<div class="col-md-3 no-padding">
												<input type="number" class="form-control mylos" placeholder="Shelf life" name="shelf_life" value="{$product->shelf_life}">
											</div>
											<div class="col-md-3 no-padding">
												<input type="text" class="form-control mylos" placeholder="Storage" name="storage" value="{$product->storage}">
											</div>
											<div class="clearfix"></div>
										</div>										
										<div class="clearfix"></div>
										<div class="form-group">
											<textarea name="description" placeholder="demo" data-validation-error-msg=" " data-validation="alphanumeric " class="ckeditor" id="CKeditor" style="visibility: hidden; display: none;">{$product->description}</textarea>
										</div>
										
									</div>
									<div class="form-group">
											<button type="submit" class="close-product-btn">Submit</button>
										</div>
								</div>
								<div class="clearfix"></div>
								
							</div>
							<div class="clearfix"></div>
						</form> 
					</div>
				</div>				
			</div>
		</div>
	</div>
</div> 
<script>
	// success
	function addHerbal(count, data_txt, data_target, data_id) {
		var component =
		`<div class="form-group vared label_`+count+`">
			<label class="col-sm-5 no-padding control-label">`+data_txt+`</label>
			<div class="col-sm-1 no-padding">
			   <input type="hidden" name="herbals[`+count+`][id]" value="`+data_id+`">
			   <input type="text" class="form-control mylos" placeholder="Quantity" name="herbals[`+count+`][mdoza]">
			</div>
			<div class="col-sm-2">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[`+count+`][vdoza]">
				  <option value="">Dose unit</option>
				  {if $unit}{foreach $unit as $key=>$value} 
				  <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1 no-padding">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[`+count+`][part]">
				  <option class="bs-title-option" value="">Herb part</option>
				  {if $herb_parts}{foreach $herb_parts as $key=>$herb_part} 
				  <option value="{$herb_part->id}" data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option> 
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-2">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[`+count+`][form]">
				  <option class="bs-title-option" value="">Herb form</option>
				  {if $herb_forms}{foreach $herb_forms as $key=>$herb_form} 
				  <option value="{$herb_form->id}" data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option> 
				  {/foreach}{/if}  
			   </select>
			</div>
			<div class="col-sm-1">
			   <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
			</div>
			<div class="clearfix"></div>
		 </div>`;
		return component;
	}
	
	// succsess
	function addAnimal(count, data_txt, data_target, data_id) {
		var component =
		`<div class="form-group vared label_`+count+`">
			<label class="col-sm-6 no-padding control-label">`+data_txt+`</label>
			<div class="col-sm-1 no-padding">
			   <input type="hidden" name="animals[`+count+`][id]" value="`+data_id+`">
			   <input type="text" class="form-control mylos" placeholder="Quantity" name="animals[`+count+`][mdoza]">
			</div>
			<div class="col-sm-2">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[`+count+`][vdoza]">
				  <option value="">Dose unit</option>
				  {if $unit}{foreach $unit as $key=>$value} 
				  <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1 no-padding">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[`+count+`][part]">
				  <option class="bs-title-option" value="">Animal part</option>
				  {if $animal_parts}{foreach $animal_parts as $key=>$animal_part} 
				  <option value="{$animal_part->id}" data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option> 
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[`+count+`][form]">
				  <option class="bs-title-option" value="">Animal form</option>
				  {if $animal_forms}{foreach $animal_forms as $key=>$animal_form} 
				  <option value="{$animal_form->id}" data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option> 
				  {/foreach}{/if}  
			   </select>
			</div>
			<div class="col-sm-1">
			   <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
			</div>
			<div class="clearfix"></div>
		 </div>`;
		return component;
	}

	function addChermical(count, data_txt, data_target, data_id) {
		var component =
		`<div class="form-group vared label_`+count+`">
			<label class="col-sm-4 no-padding control-label">`+ data_txt +`</label>
			<div class="col-sm-1 no-padding">
			   <input type="hidden" name="atc_codes[`+count+`][id]" value="`+data_id+`">
			   <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[`+count+`][mdoza]">
			</div>
			<div class="col-sm-1 no-padding">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[`+count+`][vdoza]">
				  <option value="">Dose unit</option>
				  {if $unit}{foreach $unit as $key=>$value} 
				  <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1">
			   <button type="button" class="plus_item" data-id="`+count+`" data-type="atc_codes">+</button>
			   <button type="button" class="minus_item">-</button>
			</div>
			<div class="col-md-2 no-padding extra-mg"></div>
			<div class="col-sm-1">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[`+count+`][purity_unit]">
					{if $puritys}{foreach $puritys as $key=>$purity} 
					<option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
					{/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1">
			   <input type="text" class="form-control mylos" placeholder="purity (%)" name="atc_codes[`+count+`][purity]">
			</div>
			<div class="col-md-1">
			   <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
			</div>
			<div class="clearfix"></div>
		</div>`;
		return component;
	}

	function addDossageForm(count, data_txt, data_target, data_id) {
		var component = 
		`<div class="form-group vared label_`+count+`">
			<label class="col-sm-4 no-padding control-label">`+data_txt+`</label>
			<div class="col-sm-1 no-padding">            
			   <input type="hidden" name="packing_types[`+count+`][id]" value="`+data_id+`">
			   <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[`+count+`][mdoza]">
			</div>
			<div class="col-sm-2 no-padding">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[`+count+`][vdoza]">
				  <option value="">Dose unit</option>
				  {if $unit}{foreach $unit as $key=>$value} 
				  <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1">
			   <button type="button" class="plus_item" data-id="`+count+`" data-type="packing_types">+</button>
			   <button type="button" class="minus_item">-</button>
			</div>
			<div class="col-md-3 extra-mg"></div>
			<div class="col-md-1">
			   <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
			</div>
			<div class="clearfix"></div>
		 </div>`;

		return component;
	}

	function addmedicalClassification(count, data_txt, data_target, data_id) {
		var component =  
		`<div class="form-group col-md-3 no-padding vared label_`+count+`">
			<div class="input-group">
			  <input type="text" class="form-control mylos" value="`+data_txt+`" readonly>
			  <input type="hidden" value="`+data_id+`" name="classifiction[`+count+`]" readonly>
			  <span class="input-group-btn">
				<button type="button" class="btn btn-danger btn-bix pull-right remove-item-classifiction" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-times"></i> </button>
			  </span>
			</div>
		</div>`;
		return component;
	}

	function addCasNumber(count, data_txt, data_target, data_id) {
		var component =
		`<div class="form-group">
			<label class="col-sm-2 no-padding control-label">`+data_txt+`</label>
			<div class="col-sm-1 no-padding">
				
			   <input type="hidden" name="cass[`+count+`][id]" value="`+data_id+`">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[`+count+`][purity_unit]">
					{if $puritys}{foreach $puritys as $key=>$purity} 
					<option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
					{/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1 no-padding">
			   <input type="text" class="form-control mylos" placeholder="purity (%)" name="cass[`+count+`][purity]">
			</div>
			<div class="col-sm-1 no-padding">
			   <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[`+count+`][mdoza]">
			</div>
			<div class="col-sm-1 no-padding">
			   <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name=cass[`+count+`][vdoza]"">
				  <option value="">Dose unit</option>
				  {if $unit}{foreach $unit as $key=>$value} 
				  <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
				  {/foreach}{/if} 
			   </select>
			</div>
			<div class="col-sm-1">
			   <button type="button" class="plus_item" data-id="`+count+`" data-type="cass">+</button>
			   <button type="button" class="minus_item">-</button>
			</div>
			<div class="col-sm-2 no-padding extra-mg">
			</div>
			<div class="col-sm-2">
			   <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="cass[`+count+`][atc_code]" data-role="tagsinput" multiple>
			</div>
			<div class="col-sm-1">
			   <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
			</div>
			<div class="clearfix"></div>
		 </div>`;
		return component;
	} 
	
	$(document).on('click','.plus_item',function(){
		var data_id = $(this).data('id');
		var data_type = $(this).data('type');
		var component = `
		<div class="col-sm-6 no-padding">
		  <input type="number" class="form-control mylos" placeholder="Quantity" name="`+data_type+`[`+data_id+`][mdoza2]" value="1">
		</div>
		<div class="col-sm-6 no-padding">
		  <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="`+data_type+`[`+data_id+`][vdoza2]">
			<option value="">Volume unit</option>
			{if $unit}{foreach $unit as $key=>$value} 
			<option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
			{/foreach}{/if} 
		  </select>
		</div>`;
		$(this).parent().parent().find('div.extra-mg').append(component);
		$('.selectpicker').selectpicker();
		
		
		$(this).hide();
		$(this).parent().find('.minus_item').show();
	});

	$(document).on('click','.minus_item',function(){
		$(this).parent().parent().find('div.extra-mg').empty();
		$(this).hide();
		$(this).parent().find('.plus_item').show();
	});
		 
	   
</script>
 
{literal}
<script type="text/javascript">
	
	
	
	$(document).ready(function(){
		$('select.product_type_select').on('change', function(e){
			var selected = $(this).find('option:selected').val();
			$.isLoading({text:""});
			e.preventDefault(); 
			$.ajax({
				type:'POST',
				url: site_url+'product/type/',
				data: {'value':selected},
				cache:false,
				success:function(data){ 
					var obj = jQuery.parseJSON(data);
					console.log(obj);  
					json = {
						id : obj[0].id,
						name : obj[0].name,
						settings : [{
							visible : [{
							  chemical : obj[0].chemical_visible,
							  herbal : obj[0].herbal_visible,
							  animal : obj[0].animal_visible,
							  casNumber : obj[0].casNumber_visible,
							  dossageForm : obj[0].dossageForm_visible,
							  medicalClassifiction : obj[0].medicalClassifiction_visible,
							  moreInfo : obj[0].moreInfo_visible,
							  brandName : obj[0].brandName_visible,
							  country : obj[0].country_visible,
							}],
							multiple : [{
							  chemical : obj[0].chemical_multiple,
							  herbal : obj[0].herbal_multiple, 
							  casNumber : obj[0].casNumber_multiple,
							  dossageForm : obj[0].dossageForm_multiple,
							  medicalClassifiction : obj[0].medicalClassifiction_multiple
							}]
						  }]
					};
					
					$.each( json.settings[0].visible[0], function( key, value ) {
						if(value == '1'){$('.'+key).show();}else{$('.'+key).hide();}});
						$.each( json.settings[0].multiple[0], function( key, value ) {
							if(value == '1')
							{
								
							}
							else
							{

							}
						});
					 
					
					setTimeout(function(){$.isLoading("hide");},1000);
					console.log(json);
				},
				error: function(){
					setTimeout(function(){$.isLoading("hide");},1000);
				}
			});
			e.preventDefault();
			return false; 
		});
	});
</script>
{/literal}
<script type="text/javascript">  
	var general = {$parent_cal};   

	{literal}
	var count = 0;
	$(document).on('click keydown', '.discom ul.in li', function (e) {
		e.preventDefault();
		$('.discom ul.in li').removeClass('selected');
		$(this).addClass('selected');

		var data_txt = $(this).attr('data-txt'); 
		var data_target = $(this).attr('data-target');
		var data_id = $(this).attr('data-id');

		if (data_target == 'chemical') { // ad chemical
			var component = addChermical(count, data_txt, data_target, data_id);
			$('.frist-inner').append(component);

			$('.selectpicker').selectpicker();
			count += 1;
		} else if (data_target == 'herbal') { // add herbal
			var component = addHerbal(count, data_txt, data_target, data_id);
			$('.frist-inner').append(component);

			$('.selectpicker').selectpicker();
			count += 1;
		} else if (data_target == 'animal') { // add animal
			var component = addAnimal(count, data_txt, data_target, data_id);

			$('.frist-inner').append(component);

			$('.selectpicker').selectpicker();
			count += 1;
		} else if (data_target == 'casNumber') { // add cas number
			var component = addCasNumber(count, data_txt, data_target, data_id);
			$('.frist-inner').append(component);

			$('.selectpicker').selectpicker();
			
			var citynames = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				local: $.map(general, function (city) {
					return {
						value: city.value,
						name: city.name
					};
				})
			}); 
			$('input.atc_code_input').tagsinput({
				typeaheadjs: {
					name: 'citynames',
					displayKey: 'name',
					valueKey: 'name',
					source: citynames.ttAdapter()
				}
			});
			count += 1;
		} else if (data_target == 'dossageForm') { // add dossage form
			var component = addDossageForm(count, data_txt, data_target, data_id);
			$('.dossageForm-inner').show();
			//
			$('.dossageForm-inner').append(component);
			$('.selectpicker').selectpicker();
			count += 1;
		} else if (data_target == 'medicalClassification') { // add medical classifiction
			var component = addmedicalClassification(count, data_txt, data_target, data_id);
			$('.medicalClassification-inner').show();
			//
			$('.medicalClassification-inner').append(component);
			$('.selectpicker').selectpicker();
			
			count += 1;
		} else {

		}
		$('.search-tool').removeClass('col-md-3');
		$('.search-tool').hide();
		$('.specilation').addClass('col-md-12');
		$('.specilation').removeClass('col-md-9');
		$('.blackstack').remove(); 
		$('html, body').stop().animate({scrollTop: 180 }, 500, function() {});
		e.preventDefault();
		return false;
	});
	{/literal}   
</script> 

{/block}