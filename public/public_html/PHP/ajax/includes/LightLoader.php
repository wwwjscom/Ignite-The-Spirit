<?php
/******************************************************************************
 Lightloader
 Copyright (C) 2007  Jeremy Nicoll

 This library is free software; you can redistribute it and/or
 modify it under the terms of the GNU Lesser General Public
 License as published by the Free Software Foundation; either
 version 2.1 of the License, or (at your option) any later version.

 This library is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public
 License along with this library; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

 Please see lgpl.txt for a copy of the license - this notice and the file
 lgpl.txt must accompany this code.

 Please go to forums.SeeMySites.net for questions and support of this library.
 Go to www.ScriptSing.com for code updates.
*******************************************************************************/

  function unset_request_var($var) {
    unset($_REQUEST[$var], $_POST[$var], $_GET[$var]);
  }

  function setup_ll_files() {
    if (isset($_REQUEST['ll_ids'])) {
      foreach ($_REQUEST['ll_ids'] as $val) {
        unset_request_var('upload_form_' . $val . '_upload');
      }

      $vars = array('tmp_name', 'name', 'size', 'type', 'index');
      $n = isset($_REQUEST['ll_field_name']) ? sizeof($_REQUEST['ll_field_name']) : 0;
      $t = array();

      for ($i=0; $i <  $n; $i++) {
        $fld_name = preg_replace('#[^a-zA-Z0-9_]+#', '', $_REQUEST['ll_field_name'][$i]);
        if (!$fld_name) continue;
        if (!isset($t[$fld_name]) || !is_array($t[$fld_name])) $t[$fld_name] = array();
        $a = array();
        foreach ($vars as $val) $a[$val] = $_REQUEST['ll_' . $val][$i];
        $a['db_id'] = $_REQUEST['ll_db_ids'][$i];
        $t[$fld_name][] = $a;
      }

      foreach ($vars as $val) unset_request_var('ll_'.$val);
      unset_request_var('ll_ids');
      unset_request_var('ll_db_ids');
      unset_request_var('ll_field_name');
      unset_request_var('ll_index');

      $GLOBALS['_LL_FILES'] = $t;
    }
  }
  setup_ll_files();
?>