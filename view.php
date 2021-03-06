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
 * MOODLE VERSION INFORMATION
 *
 * This file defines the current version of the core Moodle code being used.
 * This is compared against the values stored in the database to determine
 * whether upgrades should be performed (see lib/db/*.php)
 *
 * @package    local_guestinfo
 * @outhor     Kumkumia Habiba
 * @license
 */
global $temp;

require_once(__DIR__.'/../../config.php');
global $DB;
$PAGE->set_url(new moodle_url('/local/guestinfo/view.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('guest table');

$sql = "SELECT {customcert_guestinfo}.id,{course}.fullname, {customcert_guestinfo}.guestname,{customcert_guestinfo}.guestage,{customcert_guestinfo}.guestschool,{customcert_guestinfo}.guestemail FROM {course}  JOIN {customcert_guestinfo} ON {course}.id = {customcert_guestinfo}.course";
$guest_data=$DB->get_records_sql($sql);

$temp=(object)[
     'guest_data'=>array_values($guest_data),
 ];


 $linkname = get_string('getguestinfo', 'local_guestinfo');
 $link = new moodle_url('/local/guestinfo/view.php', array( 'downloadown' => true));
 

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname','local_guestinfo'));

echo $OUTPUT->render_from_template('local_guestinfo/table', $temp);
echo "<button type='submit' class='btn btn-primary' style='margin-left: 10px ; margin-top: 10px'><a class='m-b-1' target='_blank'  href= $link style='color:white'>$linkname</a></button>";


echo $OUTPUT->footer();