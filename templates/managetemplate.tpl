{$form_start}
<fieldset>
	<legend>{$mod->Lang('manage_template')}</legend>
<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('title_template')}:</p>
		<p class="pageinput">{$input_template}</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('code')}:</p>
		<p class="pageinput">{$textarea_template}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">
		&nbsp;
	</p>
	<p class="pageinput">
		{$form_details_submit}
		{$form_details_apply}
		{$form_details_cancel}
		{$form_details_restore}
	</p>
</div>	
</fieldset>
{$form_end}