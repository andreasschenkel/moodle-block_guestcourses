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

class block_guestcourses extends block_base
{
    public function init() {
        $this->title = get_string('title', 'block_guestcourses');
    }

    public function get_content() {
        global $CFG, $USER;
        $id = $USER->id;
        if ($this->content !== null) {
          return $this->content;
        }

        // Check setting.
        $showguestcourselist = $CFG->block_guestcourses_showguestcourselist;
        if (!$showguestcourselist) {
            return "showguestcourselist = $showguestcourselist";
        }

        $showinvisible = false;
        $showinvisible = $CFG->block_guestcourses_showinvisible;

        // Has user capapility to view the list of all courses with enrolmentmethod guest?
        $capabilityviewContent = has_capability('block/guestcourses:viewcontent', $this->context);

        $showguestcourselistwithoutlogin = false;
        $showguestcourselistwithoutlogin  = $CFG->block_guestcourses_showguestcourselistwithoutlogin;
        if (!$capabilityviewContent && !$showguestcourselistwithoutlogin) {
            $this->content->text = "capabilityviewContent=$capabilityviewContent . Inhalt nicht freigegeben.";
            return $this->content;
        }

        $capabilityviewinvisible = has_capability('block/guestcourses:viewinvisible', $this->context);

        $guestcourses = $this->all_courseids_with_guestenrolment();
        $links = '';
        foreach ($guestcourses as $guestcourse){

            $id = $guestcourse[0]->id;
            $fullname = $guestcourse[0]->fullname;
            $isvisible = $guestcourse[0]->visible;
            $password = '';
            $password = $guestcourse[1];

            $passwordindicator = '';

            if ($password != '') {
                $passwordindicator = '<i class="icon fa fa-key fa-fw " title="Der Gastzugang benötigt einen Gastschlüssel." aria-label="Der Gastzugang benötigt einen Gastschlüssel."></i>';
            }

            $icon = '<i class="icon fa fa-graduation-cap fa-fw " title="Kurs" aria-label="Kurs"></i>';

            $class = '';
            if (!$isvisible) {
                $class = 'dimmed';
            }

            // $linktext = "$icon $fullname id=$id $passwordindicator visible=$isvisible";
            $linktext = "$icon $fullname id=$id $passwordindicator";
            if ($isvisible || ($showinvisible && $capabilityviewinvisible))  {
                $links .= html_writer::link(new moodle_url('/course/view.php', array('id' => $id, 'notifyeditingon' => 1)), $linktext, array('class' => "$class") );
                $links .= "<br>";
            }
        }

        $this->content = new stdClass;
        $this->content->text  = $links;

        $footer = '';
        
        $footerdebug = 
        '$showguestcourselist=' . $showguestcourselist . '<br>' .
        '$showinvisible=' . $showinvisible . '<br>' .
        '$capabilityviewContent=' . $capabilityviewContent . '<br>' .
        '$capabilityviewinvisible=' . $capabilityviewinvisible . '<br>'  .
        '$isvisible=' . $isvisible .  '<br>' ;
        // $footer = "$footerdebug";

        $this->content->footer = "$footer";

        return $this->content;
    }

    public function has_config() {
        return true;
    }

    /**
     * @var  $USER  
     * @var  int $roleid
     * @var  $context  
     * @return bool true, if $user has the role with $roleid in $context
     */
    public function has_user_role_with_roleid_in_context($USER, int $roleid, $context): bool {
        $roles = get_user_roles($context, $USER->id, true);
        foreach ($roles as $role) {
            if ($role->roleid === $roleid ) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array returns all courses where the guestrole is activated and the guestaccesskey
     */ 
    public function all_courseids_with_guestenrolment(): array {
        $courses = $this->getallcoursesbyselect();
        $guestcourses = [];
        if ($courses) {
            foreach ($courses as $course) {
                $enrolmethods = enrol_get_instances($course->id, true) ;
                foreach ($enrolmethods as $enrolmethod) {
                    if ($enrolmethod->enrol == "guest") {
                        $guestcourses[] = array($course, $enrolmethod->password);
                    }
                } 
            } 
        return $guestcourses;
        } 
    }

    /**
     * @return array returns all courses in this moodle
     */
    public function getallcoursesbyselect(): array {
        global $DB;
        $query = "SELECT id, fullname, shortname, startdate, enddate, visible from {course}";
        $courselist = $DB->get_records_sql($query);
        return $courselist;
    }

}
