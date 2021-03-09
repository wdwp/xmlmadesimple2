{$form_start}
<fieldset>
	<legend>{$mod->Lang('manage_feed')}</legend>
{if isset($feed_id)}
{$feed_id}
{/if}

<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('title_feed_title')}:</p>
    <p class="pageinput">{$input_feed_title}</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('title_feed_url')}:</p>
    <p class="pageinput">{$input_feed_url}</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('title_feed_description')}:</p>
    <p class="pageinput">{$input_feed_description}</p>
</div>
{if isset($input_submitted)}
	{$input_submitted}
{/if}

<div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">{$submit_button}{$apply_button}{$cancel}</p>
</div>
</fieldset>
{$form_end}