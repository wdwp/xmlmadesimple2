<?php
#-------------------------------------------------------------------------
# Module: XMLMadeSimple - This module allow you to grab an XML or RSS feed and to integrate it in your website very easily.
# Version: 0.1.2, Jean-Christophe Cuvelier
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2009 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
# This file originally created by ModuleMaker module, version 0.3.1
# Copyright (c) 2009 by Samuel Goldstein (sjg@cmsmadesimple.org)
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
if (!is_object(cmsms()))
    exit ;

if (!$this->CheckAccess()) {
    return $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
}

if (isset($params['errors']) && count($params['errors'])) {
    echo $this->ShowErrors($params['errors']);
}

if (isset($params['message'])) {
    echo $this->ShowMessage($this->Lang($params['message']));
}

if (!empty($params['active_tab'])) {
    $tab = $params['active_tab'];
} else {
    $tab = 'feeds';
}

$admintheme = cms_utils::get_theme_object('admintheme');
$config = cms_utils::get_config();

// tabs
$smarty->assign('tab_headers',
    $this->StartTabHeaders() .
    $this->SetTabHeader('feeds', $this->Lang('title_feeds'), ($tab == 'feeds')) .
    $this->SetTabHeader('templates', $this->Lang('title_templates'), ($tab == 'templates')) .
    $this->SetTabHeader('options', $this->Lang('title_options'), ($tab == 'options')) .
    $this->EndTabHeaders() .
    $this->StartTabContent());

$smarty->assign('end_tab', $this->EndTab());
$smarty->assign('tab_footers', $this->EndTabContent());
$smarty->assign('start_feeds_tab', $this->StartTab('feeds'));
$smarty->assign('start_templates_tab', $this->StartTab('templates'));
$smarty->assign('start_options_tab', $this->StartTab('options'));
$smarty->assign('title_section', 'defaultadmin');

#--------------
# Feeds Tab
#--------------

$feeds = MCFeed::doSelect();
$rowclass = 'row1';

foreach ($feeds as $feed) {

    $feed->rowclass = $rowclass;
    $feed->name     = $this->CreateLink($id, 'manageFeed', $returnid, $feed->getTitle(), array('feed_id' => $feed->getId()), '');
    $feed->edit     = $this->CreateLink($id, 'manageFeed', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $feed->getTitle(), '', '', 'systemicon'), array('feed_id' => $feed->getId()), '');
    $feed->delete   = $this->CreateLink($id, 'deleteFeed', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $feed->getTitle(), '', '', 'systemicon'), array('feed_id' => $feed->getId()), '');

    ($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
}

$smarty->assign('feeds', $feeds);

$smarty->assign('addfeedlink', $this->CreateLink($id, 'manageFeed', '', $this->Lang('title_add_feed'), array()));
$smarty->assign('addfeedicon', $this->CreateLink($id, 'manageFeed', '', $admintheme->DisplayImage('icons/system/newobject.gif', $this->Lang('title_add_feed'), '', '', 'systemicon'), array()));

# ---------------
# Templates Tabs
# ---------------

$template_list = $this->ListTemplates();
$rowclass = 'row1';
$templates = array();

foreach ($template_list as $template) {

    $onerow = new stdClass();

    $onerow->deletelink = $this->CreateLink($id, 'deleteTemplate', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $this->Lang('deleteTemplate'), '', '', 'systemicon'), array('template' => $template), $this->Lang('areyousure'));
    $onerow->editlink   = $this->CreateLink($id, 'manageTemplate', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $this->Lang('editTemplate'), '', '', 'systemicon'), array('template' => $template));
    $onerow->name       = $this->CreateLink($id, 'manageTemplate', $returnid, $template, array('template' => $template));
    $onerow->rowclass   = $rowclass;

    $templates[] = $onerow;

    ($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
}

$smarty->assign('templates', $templates);
$smarty->assign('addtemplatelink', $this->CreateLink($id, 'manageTemplate', '', $this->Lang('title_add_template'), array()));
$smarty->assign('addtemplateicon', $this->CreateLink($id, 'manageTemplate', '', $admintheme->DisplayImage('icons/system/newobject.gif', $this->Lang('title_add_template'), '', '', 'systemicon'), array()));

#--------------
# Options Tab
#--------------

$smarty->assign('form_start', $this->CreateFormStart($id, 'defaultadmin', $returnid));
$smarty->assign('form_end', $this->CreateFormEnd());

// Caching options

if (isset($params['submit_options']) && isset($params['cache']) && is_numeric($params['cache']) && $params['cache'] > 0) {
    $this->SetPreference('cache', $params['cache']);
}

// clear cached files
if (isset($params['clearcache'])) {
    $directory = $config['previews_path'];
    if (!$dirhandle = opendir($directory))
        return;

    while (false !== ($filename = readdir($dirhandle))) {
        if ($filename != "." && $filename != "..") {
            $filename = $directory . "/" . strstr($filename, 'xmlmadesimple_');
            unlink($filename);
        }
    }
}


// Authorized sites
$auth_sites = unserialize($this->getPreference('auth_sites'));

if (!is_array($auth_sites)) {
    $auth_sites = array();
}

if (isset($params['auth_url']) && $params['auth_url'] != '') {
    if (array_search($params['auth_url'], $auth_sites) === false) {
        $auth_sites[] = $params['auth_url'];
        $this->setPreference('auth_sites', serialize($auth_sites));
    }
}

$sites = array();

foreach ($auth_sites as $site) {
    $sites[] = array('url' => $site, 'delete' => $this->CreateLink($id, 'deleteAuthUrl', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $site, '', '', 'systemicon'), array('url' => $site), ''));
}

$smarty->assign('auth_sites', $sites);

if (isset($params['proxy_url']))
    $this->SetPreference('proxy_url', $params['proxy_url']);
if (isset($params['proxy_login']))
    $this->SetPreference('proxy_login', $params['proxy_login']);
if (isset($params['proxy_password']))
    $this->SetPreference('proxy_password', $params['proxy_password']);

if (isset($params['clearcache']) || isset($params['submit_options'])) {
    $params = array('active_tab' => 'options', 'message' => 'cache_cleared');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

// pass inputs to smarty
$smarty->assign('cache', $this->CreateInputText($id, 'cache', $this->GetPreference('cache')));
$smarty->assign('clearcache', $this->CreateInputSubmit($id, 'clearcache', $this->Lang('clearcache_input')));
$smarty->assign('auth_url', $this->CreateInputText($id, 'auth_url', null, 80));
$smarty->assign('proxy_url', $this->CreateInputText($id, 'proxy_url', $this->getPreference('proxy_url'), 80));
$smarty->assign('proxy_login', $this->CreateInputText($id, 'proxy_login', $this->getPreference('proxy_login'), 80));
$smarty->assign('proxy_password', $this->CreateInputText($id, 'proxy_password', $this->getPreference('proxy_password'), 80));
$smarty->assign('submit_options', $this->CreateInputSubmit($id, 'submit_options', $this->Lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));

$smarty->assign('options_tab', $this->ProcessTemplate('admin.options.tab.tpl'));

echo $this->ProcessTemplate('adminpanel.tpl');
?>