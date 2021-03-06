<?php
/* Copyright (C) 2007      Patrick Raguin       <patrick.raguin@gmail.com>
 * Copyright (C) 2009      Regis Houssin        <regis.houssin@capnetworks.com>
 * Copyright (C) 2008-2013 Laurent Destailleur  <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\file       htdocs/core/menus/standard/auguria_menu.php
 *	\brief      Menu auguria manager
 */


/**
 *	Class to manage menu Auguria
 */
class MenuManager
{
	var $db;
	var $type_user;								// Put 0 for internal users, 1 for external users
	var $atarget="";                            // Valeur du target a utiliser dans les liens
	var $name="auguria";
	
	var $menu_array;
	var $menu_array_after;

	
    /**
     *  Constructor
     *
	 *  @param	DoliDB		$db     	Database handler
     *  @param	int			$type_user	Type of user
     */
    function __construct($db, $type_user)
    {
    	$this->type_user=$type_user;
    	$this->db=$db;
    }
	

    /**
     *  Show menu
     *
     *	@param	string	$mode		'top' or 'left'
     *  @return	int     			Number of menu entries shown
	 */
	function showmenu($mode)
	{
    	global $conf;
    	
        require_once DOL_DOCUMENT_ROOT.'/core/menus/standard/auguria.lib.php';

        if ($this->type_user == 1)
        {
        	$conf->global->MAIN_SEARCHFORM_SOCIETE=0;
	        $conf->global->MAIN_SEARCHFORM_CONTACT=0;
        }
            
        $res='ErrorBadParameterForMode';
        if ($mode == 'top')  $res=print_auguria_menu($this->db,$this->atarget,$this->type_user);
        if ($mode == 'left') $res=print_left_auguria_menu($this->db,$this->menu_array,$this->menu_array_after);

        return $res;
    }
}

?>
