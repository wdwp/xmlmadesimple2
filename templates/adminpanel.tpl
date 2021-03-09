{$tab_headers}
{$form_start}
{$start_feeds_tab}
{if $feeds|count > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$mod->Lang('feed_title')}</th>
			<th>{$mod->Lang('feed_url')}</th>
			<th>{$mod->lang('title_feed_description')}</th>
			<th>{$mod->Lang('tag')}</th>
			<th class="pageicon"></th>
			<th class="pageicon"></th>
		</tr>
	</thead>
	<tbody>
{foreach from=$feeds item='entry'}
    <tr class="{$entry->rowclass}">
      <td>{$entry->name}</td>
      <td>{$entry->getFeedUrl()}</td>
      <td>{$entry->getFeedDescription()|truncate:'100'}</td>
      <td>{literal}{XMLMadeSimple2 feed_id="{/literal}{$entry->getId()}{literal}"}{/literal}</td>
      <td>{$entry->edit}</td>
      <td>{$entry->delete}</td>
    </tr>
{/foreach}
	</tbody>
</table>
{/if}

<div class="pageoptions">
	<p class="pageoptions">{$addfeedicon} {$addfeedlink}</p>
</div>

{$end_tab}

{$start_templates_tab}
<div class="pageoptions">
  <p class="pageoptions">{$addtemplateicon} {$addtemplatelink}</p>
</div>
{if $templates|count > 0}
<table cellspacing="0" class="pagetable"><thead><tr><th>{$mod->Lang('title_template')}</th><th class="pageicon"> </th><th class="pageicon"> </th></tr></thead><tbody>
{foreach from=$templates item=entry}
    <tr class="{$entry->rowclass}">
    <td>{$entry->name}</td><td>{$entry->editlink}</td><td>{$entry->deletelink}</td></tr>
{/foreach}
  </tbody></table>

<div class="pageoptions">
  <p class="pageoptions">{$addtemplateicon} {$addtemplatelink}</p>
</div>
{/if}
{$end_tab}

{$start_options_tab}
{$options_tab}
{$end_tab}
{$form_end}
{$tab_footers}
