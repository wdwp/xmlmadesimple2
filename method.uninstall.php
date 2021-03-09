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
if (!is_object(cmsms())) exit;


 // Typical Database Removal
 $db = cms_utils::get_db();

 $dict = NewDataDictionary($db);
 // remove the database table
 $sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_xmlmadesimple_feed " );
 $dict->ExecuteSQLArray($sqlarray);

 // remove the sequence
 $sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_xmlmadesimple_feed_seq" );
 $dict->ExecuteSQLArray($sqlarray);

// remove the permissions
$this->RemovePermission('Manage XML Made Simple');

// put mention into the admin log
$this->Audit(0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));
?>