<?php
/*
Plugin Name: MemberAdmin
Plugin URI: http://code.google.com/p/memberadmin/
Description: A member database administration plugin.
Version: 0.2.0.5
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
			"</th><th>" . __("Gender") . "</th>";
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
	
		switch($_GET['mode'])
		{
        case "default":
		default:
            global $wpdb;
            echo '<div class="wrap">';
            ?>
            <h2><?php _e("Members") ?></h2><a href="user-new.php" class="button add-new-h2">Add New</a>
            <table class="widefat fixed" cellspacing="0">
            <thead>
            <tr class="thead">
            <?php
            $this->print_list_headers();
            ?>
            </tr>
            </thead>
            <tfoot>
            <tr class="thead">
            <?php
            $this->print_list_headers();
            ?>
            </tr>
            </tfoot>
            <tbody>
            <?php
            $style = '';
            foreach ($this->search_members() as $member) {
                $style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
                ?>
                <tr <?php print $style; ?>>
                <td class="username column-username"><?php print get_avatar( $member->email, 32 ); ?><?php print $member->first_name ?><div class="row-actions">
                    <span class='button edit'><a href="<?php print $_SERVER['REQUEST_URI'] ?>&amp;mode=edit&amp;id=<?php print $member->id ?>">Edit</a></span>
                </div></td>
                <td><?php print $member->last_name ?></td>
                <td><?php print $member->email ?></td>
                </tr>
                <?php
            }
            ?> 
            </tbody>
            </table>
            <?php
            echo '</div>';
        break;
		case "edit":
            echo '<div class="wrap">';
			?>
			<table class="widefat fixed" cellspacing="0">
				<thead>
					<tr class="thead">
					<?php
						$this->print_list_headers_edit();
					?>
					</tr>
				</thead>
				<tbody>
				<?php
					$member = $this->select_member($id);
				?>
					<tr class="alternate">
						<td class="username column-username"><?php print get_avatar( $member->email, 32 ); ?><?php print $member->first_name ?></td>
						<td><?php print $member->last_name ?></td>
						<td><?php print $member->email ?></td>
						<td><?php print $member->location ?></td>
						<td><?php print $member->birthdate ?></td>
						<td><?php print $member->gender ?></td>
					</tr> 
				</tbody>
            </table>
			<?php
			echo '</div>';
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
