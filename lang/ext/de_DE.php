<?php
$lang['friendlyname'] = 'XML Made Simple';
$lang['postinstall'] = 'Legen Sie die &quot;Manage XML Made Simple&quot; Berechtigungen fest, um dieses Modul nutzen zu k&ouml;nnen!';
$lang['postuninstall'] = 'Modul installiert.';
$lang['really_uninstall'] = 'Wirklich? Sind Sie sicher, Sie wollen dieses feine Modul deinstallieren?';
$lang['uninstalled'] = 'Modul deinstalliert.';
$lang['installed'] = 'Modul Version %s installiert.';
$lang['upgraded'] = 'Modul auf Version %s aktualisiert.';
$lang['moddescription'] = 'Dieses Modul erm&ouml;glicht es Ihnen, ein XML- oder RSS-Feed zu lesen und es in Ihre Webseite sehr einfach zu integrieren. ';
$lang['error'] = 'Fehler!';
$lang['template_title_empty'] = 'Template-Titel ist leer!';
$lang['template_content_empty'] = 'Template-Inhalt ist leer!';
$lang['feed_title_empty'] = 'Bitte geben Sie einen Titel f&uuml;r diesen Feed';
$lang['feed_url_empty'] = 'Bitte f&uuml;gen Sie eine URL f&uuml;r diesen Feed';
$lang['changessaved'] = '&Auml;nderungen erfolgreich gespeichert.';
$lang['itemdeleted'] = 'Artikel wurde gel&ouml;scht';
$lang['cache_cleared'] = 'Zwischenspeicher geleert';
$lang['admin_title'] = 'XML Made Simple Administrationsbereich';
$lang['admindescription'] = 'Dieses Modul erm&ouml;glicht es Ihnen, ein XML- oder RSS-Feed zu lesen und es in Ihre Webseite sehr einfach zu integrieren.';
$lang['accessdenied'] = 'Zugriff verweigert. Bitte &uuml;berpr&uuml;fen Sie Ihre Berechtigungen.';
$lang['Feeds'] = 'Feeds';
$lang['Templates'] = 'Templates';
$lang['Options'] = 'Optionen';
$lang['tag'] = 'Modul Tag';
$lang['title_feeds'] = 'Feeds';
$lang['title_templates'] = 'Templates';
$lang['title_options'] = 'Optionen';
$lang['manage_template'] = 'Template verwalten';
$lang['title_add_template'] = 'Template hinzuf&uuml;gen';
$lang['title_template'] = 'Template Titel';
$lang['code'] = 'Code';
$lang['areyousure'] = 'Sind Sie sicher?';
$lang['auth_options_title'] = 'Optionen f&uuml;r Autorisierte-URL';
$lang['cache_options_title'] = 'Zwischenspeicher Optionen';
$lang['clear_cache'] = 'Zwischenspeicher leeren';
$lang['clearcache_input'] = 'Leeren';
$lang['cache'] = 'Zeitlimit f&uuml;r Feed Zwischenspeicher';
$lang['auth_url'] = 'Autorisierte URL';
$lang['manage_feed'] = 'Feed Verwalten';
$lang['feed_title'] = 'Titel';
$lang['feed_url'] = 'Url';
$lang['title_feed_description'] = 'Feed Beschreibung';
$lang['title_add_feed'] = 'Feed hinzuf&uuml;gen';
$lang['title_feed_title'] = 'Titel';
$lang['title_feed_url'] = 'Url';
$lang['authorized_sites'] = 'Autorisierte Seiten';
$lang['proxy_url'] = 'Proxy URL';
$lang['proxy_login'] = 'Proxy Login';
$lang['proxy_password'] = 'Proxy Kennwort';
$lang['submit'] = 'Absenden';
$lang['apply'] = '&Uuml;bernehmen';
$lang['restore'] = 'Zur&uuml;cksetzen';
$lang['cancel'] = 'Abbrechen';
$lang['template_help'] = 'You can use the {$xml} parameter for your template (see help for more information).';
$lang['help_param_action'] = 'Specifies a module action that should be performed. Possible values are:
<ul>
    <li>default</li>
    <li>detail</li>
    <li>mixfeeds</li>
    <li>search</li>
</ul>';
$lang['help_param_feed_id'] = 'ID des Feeds das verwendet wird.';
$lang['help_param_feeds_id'] = 'With this parameter multiple feeds can be used. Enter comma separated Feed ID&#039;s like feeds_id=&#039;1,2,3&#039;';
$lang['help_param_feed'] = '';
$lang['help_param_xpath'] = 'F&uuml;hren Sie XPath Suche f&uuml;r Ihr XML. (Sehen Sie http://www.php.net/manual/en/simplexmlelement.xpath.php)';
$lang['help_param_values'] = 'You can also specify values with the param &quot;values&quot;. <br />
<strong>Example:</strong><br />
<code>{XMLMadeSimple2 action=&quot;search&quot; xpath=&quot;/root/leaf/leaf&quot;}</code> or <code>{XMLMadeSimple2 action=&quot;search&quot; xpath=&quot;/root/leaf/%s/%s&quot; values=&quot;value1,value2&quot;}</code> or <code>{XMLMadeSimple2 action=&quot;search&quot; xpath=&quot;/root/leaf[tag=&#039;%s&#039;]&quot; values=&quot;value1&quot;}</code>';
$lang['help_param_max_items'] = 'Beschr&auml;nken Sie die Anzahl der anzuzeigenden Elemente';
$lang['help_param_sort_by_date'] = 'With this parameter Feeds can be sorted by date when using &quot;mixfeeds&quot; action';
$lang['help_param_template'] = 'Name des zu verwendenden Template.';
$lang['help_param_detailpage'] = 'Detail page alias for &quot;detail&quot; action.';
$lang['changelog'] = '<h3>Version 0.1.2</h3>
    <ul>
        <li>1.10.x Compatibility</li>
        <li>Clear cache</li>
        <li>#6356 Bugfix</li>
        <li>Fix when using RSS Feed, max_items didn&#039;t work</li>
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
<p>Create your feed and template (default template is &quot;default&quot; one.) and then use {XMLMadeSimple2 id=&quot;The_id_of_your_feed&quot;}</p>
<h3>Template vars</h3>
<p>You can use {$xml} to navigate trough your xml. ({$xml|var_dump} can help a little bit). If you define a max items number you can use the {$feeds} variable.</p>
<h3>Feed Mixer</h3>
<p>If your xml sources are rss feeds, you can mix them together using the action mixfeed. It will mix the feeds together. {XMLMadeSimple2 action=&quot;mixfeed&quot;}. It will give you a {$feeds} containing all the feeds entries.</p>
<h3>Feed search</h3>
<p>You can now perform XPath search on your XML. For this you can use the param &quot;xpath&quot;. You can also specify values with the param &quot;values&quot;. Example: {XMLMadeSimple2 action=&quot;search&quot; xpath=&quot;/root/leaf/leaf&quot;} or {XMLMadeSimple2 action=&quot;search&quot; xpath=&quot;/root/leaf/%s/%s&quot; values=&quot;value1,value2&quot;} or {XMLMadeSimple2 action=&quot;search&quot; xpath=&quot;/root/leaf[tag=&#039;%s&#039;]&quot; values=&quot;value1&quot;}. (See http://www.php.net/manual/en/simplexmlelement.xpath.php)</p>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &amp;copy; 2009, Jean-Christophe Cuvelier <a href="mailto:jcc@morris-chapman.com">&amp;lt;jcc@morris-chapman.com&amp;gt;</a>. <a href="http://www.morris-chapman.com" target="_new" alt="Morris &amp; Chapman Belgium">Morris &amp; Chapman Belgium</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['qca'] = 'P0-1458450664-1284573084918';
$lang['utma'] = '156861353.276278907.1342793520.1342793520.1342793520.1';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1342793520.1.1.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/search.php';
$lang['utmb'] = '156861353.1.10.1342793520';
?>