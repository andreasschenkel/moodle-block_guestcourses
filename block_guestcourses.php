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
 * block_guestcourses
 *
 * @package    block_guestcourses
 * @copyright  Andreas Schenkel
 * @author     Andreas Schenkel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_guestcourses extends block_base {
    public function init() {
        $this->title = get_string('title', 'block_guestcourses');
    }

    public function get_content() {
        global $USER;
        $id = $USER->id;
        if ($this->content !== null) {
            return $this->content;
        }

        // Check setting.
        $showguestcourselist = get_config('showguestcourselist', 'block_guestcourses');

        if (!$showguestcourselist) {
            return "showguestcourselist = $showguestcourselist";
        }

        $showinvisible = false;
        $showinvisible = get_config('showinvisible', 'block_guestcourses');

        // Has user capapility to view the list of all courses with enrolmentmethod guest?
        $capabilityviewcontent = '';
        $capabilityviewcontent = has_capability('block/guestcourses:viewcontent', $this->context);

        $showguestcourselistwithoutlogin = false;
        $showguestcourselistwithoutlogin = get_config('showguestcourselistwithoutlogin', 'block_guestcourses');

        if (!$capabilityviewcontent && !$showguestcourselistwithoutlogin) {
            $this->content = null;
            return $this->content;
        }

        $capabilityviewinvisible = has_capability('block/guestcourses:viewinvisible', $this->context);

        $guestcourses = $this->all_courseids_with_guestenrolment();
        $links = '';
        foreach ($guestcourses as $guestcourse) {
            $id = $guestcourse[0]->id;
            $fullname = $guestcourse[0]->fullname;
            $isvisible = $guestcourse[0]->visible;
            $password = '';
            $password = $guestcourse[1];

            $passwordindicator = '';

            if ($password != '') {
                $passwordindicator = '<i class="icon fa fa-key fa-fw " title="'
                .  get_string('passwordindicatortitle', 'block_guestcourses')
                . '" aria-label="'
                . get_string('passwordindicatortitle', 'block_guestcourses')
                . '"></i>';
            }

            $icon = '<i class="icon fa fa-graduation-cap fa-fw " title="' .
                get_string('course') .
                '"aria-label="' .
                get_string('course') .
                '"></i>';

            $class = '';
            if (!$isvisible) {
                $class = 'dimmed';
            }

            $linktext = "$icon $fullname id=$id $passwordindicator";
            if ($isvisible || ($showinvisible && $capabilityviewinvisible)) {
                $links .= html_writer::link(
                    new moodle_url('/course/view.php', array('id' => $id, 'notifyeditingon' => 1)),
                    $linktext,
                    array('class' => "$class")
                );
                $links .= "<br>";
            }
        }

        $footer = '';
        $this->content = new stdClass;
        $this->content->text  = $links;
        $this->content->footer = $footer;
        return $this->content;
    }

    public function has_config() {
        return true;
    }

    /**
     * @return array returns all courses where the guestrole is activated and the guestaccesskey
     */
    public function all_courseids_with_guestenrolment(): array {
        $courses = $this->getallcoursesbyselect();
        $guestcourses = [];
        if ($courses) {
            foreach ($courses as $course) {
                $enrolmethods = enrol_get_instances($course->id, true);
                foreach ($enrolmethods as $enrolmethod) {
                    if ($enrolmethod->enrol == "guest") {
                        $guestcourses[] = array($course, $enrolmethod->password);
                    }
                }
            }
            return $guestcourses;
        }
        return $guestcourses;
    }

    /**
     * @return array returns all courses in this moodle
     */
    public function getallcoursesbyselect(): array {
        $courselist = [];
        $courselist = core_course_category::get(0)->get_courses(array('recursive' => true, 'sort' => array('id' => 1)));
        return $courselist;
    }

}
