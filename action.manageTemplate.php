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

// if cancel is triggered
if (isset($params['cancelbutton'])) {
    $params = array('active_tab' => 'templates');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$title   = (isset($params['template']) ? $params['template'] : '');
$content = (isset($params['templatedetails']) ? $params['templatedetails'] : '');

if (isset($params['submitbutton']) || isset($params['applybutton'])) {
    $errors = array();
    // check for errors
    if (empty($title)) {
        $errors[] = $this->Lang('template_title_empty');
    }
    if (empty($content)) {
        $errors[] = $this->Lang('template_content_empty');
    }
    // no errors continue
    if (empty($errors)) {
        
        // check if template name exists
        $params['orig_template'] = $title;       
        if (isset($params['orig_template'])) {
            $this->DeleteTemplate($params['orig_template']);
        }

        $this->SetTemplate($title, $content);

        if (isset($params['submitbutton'])) {
            $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templates', 'message' => 'changessaved'));
        } else {
            echo $this->ShowMessage($this->Lang('changessaved'));
        }
        
    } else if (!empty($errors)) {
        // show errors if any
        echo $this->ShowErrors($errors);
    }
}

// load template if exists, else handle default
if (isset($params['template']) && $params['template'] != '' && (!isset($params['restore']))) {
    $templatecode = $this->GetTemplate($params['template']);
} elseif (isset($params['restore'])) {
    $templatecode = $this->GetTemplateFromFile('feed');
} else {
    $templatecode = $this->GetTemplateFromFile('feed');
}

// pass to smarty
$smarty->assign('form_start', $this->CreateFormStart($id, 'manageTemplate', $returnid));
$smarty->assign('input_template', $this->CreateInputText($id, 'template', $title, 50));
$smarty->assign('textarea_template', $this->CreateSyntaxArea($id, $templatecode, 'templatedetails', 'pagebigtextarea', 'html', '', '', 90, 15, 'EditArea'));
$smarty->assign('form_details_submit', $this->CreateInputSubmit($id, 'submitbutton', $this->Lang('submit')));
$smarty->assign('form_details_apply', $this->CreateInputSubmit($id, 'applybutton', $this->Lang('apply')));
$smarty->assign('form_details_cancel', $this->CreateInputSubmit($id, 'cancelbutton', $this->Lang('cancel')));
$smarty->assign('form_details_restore', $this->CreateInputSubmit($id, 'restore', $this->Lang('restore')));

$smarty->assign('form_end', $this->CreateFormEnd());

echo $this->ProcessTemplate('managetemplate.tpl');
?>