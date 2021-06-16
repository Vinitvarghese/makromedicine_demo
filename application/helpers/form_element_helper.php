<?php

if(!function_exists('form_status'))
{
	function form_status($name)
	{
		$options[0] = translate('deactive');
		$options[1] = translate('deactive');
		return form_dropdown($name, $options, 'default');
		
	}
}