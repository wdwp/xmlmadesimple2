{if $auth_sites|@count > 0}
<fieldset>
	<legend>{$mod->Lang('authorized_sites')}</legend>
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th>Url</th>
      <th class="pageicon" width="10">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
{foreach from=$auth_sites item=entry}
    <tr class='{cycle values='row1,row2'}'>
      <td>{$entry.url}</td>
	  <td>{$entry.delete}</td>
    </tr>
{/foreach}
  </tbody>
</table>
</fieldset>
{/if}

<fieldset>
	<legend>{$mod->Lang('auth_options_title')}</legend>
<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('auth_url')}:</p>
    <p class="pageinput">{$auth_url}</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('proxy_url')}:</p>
    <p class="pageinput">{$proxy_url}</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('proxy_login')}:</p>
    <p class="pageinput">{$proxy_login}</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('proxy_password')}:</p>
    <p class="pageinput">{$proxy_password}</p>
</div>
</fieldset>

<fieldset>
	<legend>{$mod->Lang('cache_options_title')}</legend>
<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('cache')}:</p>
    <p class="pageinput">{$cache}</p>
</div>
<div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('clear_cache')}:</p>
    <p class="pageinput">{$clearcache}</p>
</div>
</fieldset>
<div class="pageoverflow">
    <p class="pagetext">
    	&nbsp;
    </p>
	<p class="pageinput">
		{$submit_options}{$cancel}
	</p>
