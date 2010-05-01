<?php
/* 
Plugin Name: MemberAdmin
Plugin URI: http://code.google.com/p/memberadmin/
Description: A member database administration plugin.
Version: 0.2.0
* File-Version: 0.0.1.0001
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
?>

<div class="wrap">
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
					<form action="<?php print $_SERVER['REQUEST_URI'];?>" method="GET">
						<td class="username column-username"><?php print get_avatar( $member->email, 32 ); ?><input type="text" name="first_name" value="<?php print $member->first_name ?>" /></td>
						<td><input type="text" name="last_name" value="<?php print $member->last_name ?>" /></td>
						<td><input type="text" name="email" value="<?php print $member->email ?>" /></td>
						<td><input type="text" name="location" value="<?php print $member->location ?>" /></td>
						<td><input type="text" name="birthdate" value="<?php print $member->birthdate ?>" /></td>
						<td><input type="text" name="gender" value="<?php print $member->gender ?>" /><input type="text" name="mode" value="save" readonly="readonly" style="visibility:hidden;" /></td>
						<td><button type="submit" value="Save" /></td>
					</form>
					</tr> 
				</tbody>
            </table>	
		</div>
