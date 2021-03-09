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

if (!$this->CheckAccess("Manage XML Made Simple")) {
    return $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
}

if (isset($params['cancel'])) {
    $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'feeds'));
}

if (!isset($params['feed_id']) || !($feed = MCFeed::retrieveByPk($params['feed_id']))) {
    $feed = new MCFeed();
}

$title = (isset($params['feed_title']) ? $params['feed_title'] : '');
$url   = (isset($params['feed_url']) ? $params['feed_url'] : '');

if (isset($params['submit']) || isset($params['apply'])) {

    $errors = array();
    // check for errors
    if (empty($title)) {
        $errors[] = $this->Lang('feed_title_empty');
    }
    if (empty($url)) {
        $errors[] = $this->Lang('feed_url_empty');
    }

    if (empty($errors)) {
        $feed->setTitle($params['feed_title']);
        $feed->setFeedUrl($params['feed_url']);
        $feed->setFeedDescription($params['feed_description']);
        $feed->save();

        if (isset($params['submit'])) {
            $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'feeds', 'message' => 'changessaved'));
        } else {
            echo $this->ShowMessage($this->Lang('changessaved'));
        }
    } else if (!empty($errors)) {
        // show errors if any
        echo $this->ShowErrors($errors);
    }
}

// pass to smarty
if ($feed->getId()) {
    $smarty->assign('feed_id', $this->CreateInputHidden($id, 'feed_id', $feed->getId()));
}

$smarty->assign('form_start', $this->CreateFormStart($id, 'manageFeed', $returnid));
$smarty->assign('input_feed_title', $this->CreateInputText($id, 'feed_title', $feed->getTitle(), 50));
$smarty->assign('input_feed_url', $this->CreateInputText($id, 'feed_url', $feed->getFeedUrl(), 50));
$smarty->assign('input_feed_description', $this->CreateTextArea(false, $id, $feed->getFeedDescription(), 'feed_description', 'pagesmalltextarea', '', '', '', '40', '10'));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));
$smarty->assign('submit_button', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('apply_button', $this->CreateInputSubmit($id, 'apply', $this->Lang('apply')));
$smarty->assign('form_end', $this->CreateFormEnd());

echo $this->ProcessTemplate('admin.manageFeed.tpl');
?>