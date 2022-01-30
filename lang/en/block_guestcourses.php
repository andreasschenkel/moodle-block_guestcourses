<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     local_feedbackchoicegenerator
 * @category    string
 * @copyright   Andreas Schenkel
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Guestcourses';
$string['title'] = 'Courses with guestaccess';

$string['showguestcourselist'] = 'Show guestcourses';
$string['configshowguestcourselist'] = 'If activated then courses with enrolmentmethod guest are shown in the block.';

$string['showinvisible'] = 'Show invisible courses (should not be used in productiv moodle because name of course will be visible!)';
$string['configshowinvisible'] = '(should not be used in productiv moodle because name of course will be visible!) If activated then courses with that are unvisible are not integrated in the list of shown guestcourses. (capability is also needed)';

$string['showguestcourselistwithoutlogin'] = 'Show guestcourses without login';
$string['configshowguestcourselistwithoutlogin'] = 'If activated the list of guest courses is shown to user without login.';

$string['passwordindicatortitle'] = 'Guestaccesskey is needed';

// capabilitys
$string['guestcourses:myaddinstance'] = 'myaddinstance';
$string['guestcourses:addinstance'] = 'addinstance';
$string['guestcourses:viewcontent'] = 'viewcontent';
$string['guestcourses:viewinvisible'] = 'viewinvisible';