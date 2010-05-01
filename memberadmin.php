<?php
/*
Plugin Name: MemberAdmin
Plugin URI: http://code.google.com/p/memberadmin/
Description: A member database administration plugin.
Version: 0.2.0
* File-Version: 0.0.1.0002
Author: Daniel Perez, Svenn-Arne Dragly and Thor Erik Lie
Author URI: http://code.google.com/p/memberadmin/

Copyright 2010 Daniel Perez, Svenn-Arne Dragly and Thor Erik Lie (email : hnnashikama@gmail.com, s@dragly.com, thorerik.lie@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3 or later, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class MemberAdmin {

    function __construct() {
        // Public variables
        global $wpdb;
        $this->prefix = $wpdb->prefix . "mbdb_";
    }
    function print_list_headers() {
        print "<th>" . __("First Name") . 
            "</th><th>" . __("Last Name") . 
            "</th><th>" . __("E-mail") . "</th>";
    }
    function print_list_headers_edit() {
        print "<th>" . __("First Name") . 
            "</th><th>" . __("Last Name") . 
            "</th><th>" . __("E-mail") . 
			"</th><th>" . __("Location") .
			"</th><th>" . __("Birthdate") .
			"</th><th>" . __("Gender") . 
			"</th><th>" . __("") . "</th>";
    }
    function memberadmin_menu() {
	    add_options_page('MemberAdmin Options', 'MemberAdmin', 'administrator', 'memberadmin-menu', array($this, 'memberadmin_options'));
    }
    
    function search_members() {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM " . $this->prefix . "members");
    }
	function select_member($id) {
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM " . $this->prefix . "members WHERE id = " . $id);
	}
    function memberadmin_options() {
	
		global $wpdb;
		switch($_GET['mode'])
		{
        case "default":
		default:
            include 'member-show.php';
        break;
		case 'edit':
			include 'member-edit.php';
		break;
		case 'save':
		break;
        }
    }
};

$mbadmin = new MemberAdmin();

add_action('admin_menu', array($mbadmin, 'memberadmin_menu'));

/*
CREATE TABLE `wp_mbdb_members` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`first_name` VARCHAR( 255 ) NOT NULL ,
`last_name` VARCHAR( 255 ) NOT NULL ,
`location` VARCHAR( 255 ) NOT NULL ,
`birthdate` DATE NOT NULL ,
`gender` VARCHAR( 10 ) NOT NULL ,
`email` VARCHAR( 255 ) NOT NULL
) ENGINE = MYISAM ;


*/
?>
