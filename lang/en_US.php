<?php
$lang['friendlyname'] = 'XML Made Simple';
$lang['postinstall'] = 'Module installed.';
$lang['postuninstall'] = 'Module uninstalled.';
$lang['really_uninstall'] = 'Really? Are you sure you want to unsinstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['moddescription'] = 'This module allows you to grab an XML or RSS feed and to integrate it in your website very easily. ';

$lang['error'] = 'Error!';
$lang['template_title_empty'] = 'Template Title is empty!';
$lang['template_content_empty'] = 'Template content is empty!';
$lang['feed_title_empty'] = 'Please insert a title for this Feed';
$lang['feed_url_empty'] = 'Please add a URL for this Feed';
$lang['changessaved'] = 'Changes were successfully saved.';
$lang['itemdeleted'] = 'Item was deleted';
$lang['cache_cleared'] = 'Cache cleared';
$lang['admin_title'] = 'XML Made Simple Admin Panel';
$lang['admindescription'] = 'This module allows you to grab an XML or RSS feed and to integrate it in your website very easily. ';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['postinstall'] = 'Be sure to set "Manage XML Made Simple" permissions to use this module!';
$lang['Feeds'] = 'Feeds';
$lang['Templates'] = 'Templates';
$lang['Options'] = 'Options';
$lang['tag'] = 'Module Tag';
$lang['title_feeds'] = 'Feeds';
$lang['title_templates'] = 'Templates';
$lang['title_options'] = 'Options';

$lang['manage_template'] = 'Manage Template';
$lang['title_add_template'] = 'Add template';
$lang['title_template'] = 'Template title';
$lang['code'] = 'Code';
$lang['areyousure'] = 'Are you sure ?';

$lang['auth_options_title'] = 'Authorized URL Options';
$lang['cache_options_title'] = 'Cache Options';
$lang['clear_cache'] = 'Clear Cache';
$lang['clearcache_input'] = 'Clear';
$lang['cache'] = 'Feed cache timeout';
$lang['auth_url'] = 'Authorized url';

$lang['manage_feed'] = 'Manage Feed';
$lang['feed_title'] = 'Title';
$lang['feed_url'] = 'Url';
$lang['title_feed_description'] = 'Feed Description';
$lang['title_add_feed'] = 'Add feed';

$lang['title_feed_title'] = 'Title';
$lang['title_feed_url'] = 'Url';

$lang['authorized_sites'] = 'Authorized Sites';
$lang['proxy_url'] = 'Proxy url';
$lang['proxy_login'] = 'Proxy login';
$lang['proxy_password'] = 'Proxy password';

$lang['submit'] = 'Submit';
$lang['apply'] = 'Apply';
$lang['restore'] = 'Restore';
$lang['cancel'] = 'Cancel';

$lang['template_help'] = 'You can use the {$xml} parameter for your template (see help for more information).';

$lang['help_param_action'] = 'Specifies a module action that should be performed. Possible values are:
<ul>
    <li>default</li>
    <li>detail</li>
    <li>mixfeeds</li>
    <li>search</li>
</ul>';
$lang['help_param_feed_id'] = 'ID of the feed to be used.';
$lang['help_param_feeds_id'] = 'With this parameter multiple feeds can be used. Enter comma separated Feed ID\'s like feeds_id=\'1,2,3\'';
$lang['help_param_feed'] = '';
$lang['help_param_xpath'] = 'Perform XPath search on your XML. (See http://www.php.net/manual/en/simplexmlelement.xpath.php)';
$lang['help_param_values'] = 'You can also specify values with the param "values". <br />
<strong>Example:</strong><br />
<code>{XMLMadeSimple2 action="search" xpath="/root/leaf/leaf"}</code> or <code>{XMLMadeSimple2 action="search" xpath="/root/leaf/%s/%s" values="value1,value2"}</code> or <code>{XMLMadeSimple2 action="search" xpath="/root/leaf[tag=\'%s\']" values="value1"}</code>';
$lang['help_param_max_items'] = 'Limit the number of items to be displayed';
$lang['help_param_sort_by_date'] = 'With this parameter Feeds can be sorted by date when using "mixfeeds" action';
$lang['help_param_template'] = 'Name of template to be used.';
$lang['help_param_detailpage'] = 'Detail page alias for "detail" action.';

$lang['changelog'] = '
<h3>Version 0.1.2</h3>
    <ul>
        <li>1.10.x Compatibility</li>
        <li>Clear cache</li>
        <li>#6356 Bugfix</li>
        <li>Fix when using RSS Feed, max_items didn\'t work</li>
        <li>Some code rework and usabillity changes</li>
    </ul>
<h3>Version 0.0.2</h3>
    <ul>
        <li>Feed Mixer.</li>
    </ul>
<h3>Version 0.0.1 - 21 October 2009.</h3>
    <ul>
        <li>Initial Release.</li>
    </ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module allow you to grab an XML or RSS feed and to integrate it in your website very easily. </p>
<h3>How Do I Use It</h3>
<p>Create your feed and template (default template is "default" one.) and then use {XMLMadeSimple2 id="The_id_of_your_feed"}</p>
<h3>Template vars</h3>
<p>You can use {$xml} to navigate trough your xml. ({$xml|var_dump} can help a little bit). If you define a max items number you can use the {$feeds} variable.</p>
<h3>Feed Mixer</h3>
<p>If your xml sources are rss feeds, you can mix them together using the action mixfeed. It will mix the feeds together. {XMLMadeSimple2 action="mixfeed"}. It will give you a {$feeds} containing all the feeds entries.</p>
<h3>Feed search</h3>
<p>You can now perform XPath search on your XML. For this you can use the param "xpath". You can also specify values with the param "values". Example: {XMLMadeSimple2 action="search" xpath="/root/leaf/leaf"} or {XMLMadeSimple2 action="search" xpath="/root/leaf/%s/%s" values="value1,value2"} or {XMLMadeSimple2 action="search" xpath="/root/leaf[tag=\'%s\']" values="value1"}. (See http://www.php.net/manual/en/simplexmlelement.xpath.php)</p>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2009, Jean-Christophe Cuvelier <a href="mailto:jcc@morris-chapman.com">&lt;jcc@morris-chapman.com&gt;</a>. <a href="http://www.morris-chapman.com" target="_new" alt="Morris & Chapman Belgium">Morris & Chapman Belgium</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
?>
