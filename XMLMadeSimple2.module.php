<?php
#-------------------------------------------------------------------------
# A fork of Module: XMLMadeSimple - This module allow you to grab an XML or RSS feed and to integrate it in your website very easily.
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

class XMLMadeSimple2 extends CMSModule {
    function GetName() {
        return 'XMLMadeSimple2';
    }

    function GetFriendlyName() {
        return $this->Lang('friendlyname');
    }

    function GetVersion() {
        return '1.0';
    }

    function GetHelp() {
        return $this->Lang('help');
    }

    function GetAuthor() {
        return 'Jean-Christophe Cuvelier';
    }

    function GetAuthorEmail() {
        return 'jcc@morris-chapman.com';
    }

    function GetChangeLog() {
        return $this->Lang('changelog');
    }

    function IsPluginModule() {
        return true;
    }

    function HasAdmin() {
        return true;
    }

    function GetAdminSection() {
        return 'content';
    }

    function GetAdminDescription() {
        return $this->Lang('admindescription');
    }

    function VisibleToAdminUser() {
        return $this->CheckAccess();
    }

    function CheckAccess($perm = 'Manage XML Made Simple') {
        return $this->CheckPermission($perm);
    }

    function DisplayErrorPage($id, &$params, $return_id, $message = '') {
        $smarty->assign('title_error', $this->Lang('error'));
        $smarty->assign_by_ref('message', $message);
        // Display the populated template
        echo $this->ProcessTemplate('error.tpl');
    }

    function GetDependencies() {
        return array();
    }

    function MinimumCMSVersion() {
        return "2.0";
    }

    function InstallPostMessage() {
        return $this->Lang('postinstall');
    }

    function UninstallPostMessage() {
        return $this->Lang('postuninstall');
    }

    function UninstallPreMessage() {
        return $this->Lang('really_uninstall');
    }

    function InitializeFrontend() {
        $this->RegisterModulePlugin();
        $this->RestrictUnknownParams();

        $this->SetParameterType('action', CLEAN_STRING);
        $this->SetParameterType('feed_id', CLEAN_INT);
        $this->SetParameterType('feeds_id', CLEAN_STRING);
        $this->SetParameterType('feed', CLEAN_STRING);
        $this->SetParameterType('xpath', CLEAN_STRING);
        $this->SetParameterType('values', CLEAN_STRING);
        $this->SetParameterType('max_items', CLEAN_STRING);
        $this->SetParameterType('sort_by_date', CLEAN_STRING);
        $this->SetParameterType('template', CLEAN_STRING);
        $this->SetParameterType('detailpage', CLEAN_STRING);
    }

    function InitializeAdmin() {
        $this->CreateParameter('action', 'default', $this->Lang('help_param_action'));
        $this->CreateParameter('feed_id', '', $this->Lang('help_param_feed_id'), $optional = false);
        $this->CreateParameter('feeds_id', '', $this->Lang('help_param_feeds_id'));
        $this->CreateParameter('feed', '', $this->Lang('help_param_feed'));
        $this->CreateParameter('xpath', '', $this->Lang('help_param_xpath'));
        $this->CreateParameter('values', '', $this->Lang('help_param_values'));
        $this->CreateParameter('max_items', '', $this->Lang('help_param_max_items'));
        $this->CreateParameter('sort_by_date', '', $this->Lang('help_param_sort_by_date'));
        $this->CreateParameter('template', 'default', $this->Lang('help_param_template'));
        $this->CreateParameter('detailpage', '', $this->Lang('help_param_detailpage'));
    }

    function LazyLoadFrontend() {
        return false; // set to true after only 1.11+ is supported
    }

    function LazyLoadAdmin() {
        return true;
    }

    public function DoAction($name,$id,$params,$returnid='') {
        $smarty =& cmsms()->GetSmarty();

        $smarty->assign_by_ref('mod', $this);
        $smarty->assign_by_ref('actionid', $id);
        $smarty->assign_by_ref('returnid', $returnid);

        parent::DoAction($name,$id,$params,$returnid);
    }

    function checkWebsite($url) {
        $auth_sites = unserialize($this->getPreference('auth_sites'));
        foreach ($auth_sites as $site) {
            if (strpos($url, $site) === 0) {
                return true;
            }
        }
        return false;
    }

}
?>