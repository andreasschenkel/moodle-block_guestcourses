<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_feedbackchoicegenerator
 * @copyright   Andreas Schenkel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$settings = new admin_settingpage( 'block_guestcourses', 'Guest course list' );

// Create 
// $ADMIN->add( 'blocksettings', $settings );


if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configcheckbox(
        'block_guestcourses_showguestcourselist',
        get_string('showguestcourselist', 'block_guestcourses'),
        get_string('configshowguestcourselist', 'block_guestcourses'),
        1
    ));

    $settings->add(new admin_setting_configcheckbox(
        'block_guestcourses_showinvisible',
        get_string('showinvisible', 'block_guestcourses'),
        get_string('configshowinvisible', 'block_guestcourses'),
        0
    ));

    $settings->add(new admin_setting_configcheckbox(
        'block_guestcourses_showguestcourselistwithoutlogin',
        get_string('showguestcourselistwithoutlogin', 'block_guestcourses'),
        get_string('configshowguestcourselistwithoutlogin', 'block_guestcourses'),
        0
    ));

}
