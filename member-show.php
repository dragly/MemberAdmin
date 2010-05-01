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
        </div>
