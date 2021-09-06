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
 *  Block birthday
 * @package   block_birthday
 * @copyright 2021 Luiz Guilherme Dall' Acqua <luizguilherme@nte.ufsm.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


class block_birthday extends block_base
{

    /**
     * @throws coding_exception
     */
    function init()
    {
        $this->title = get_string('pluginname', 'block_birthday');
    }

    /**
     * @return array
     */
    function applicable_formats()
    {
        return ['all' => true];
    }

    /**
     * @return bool
     */
    function has_config()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function instance_allow_config()
    {
        return false;
    }

    /**
     * @throws coding_exception
     */
    function specialization()
    {
        global $CFG;
        if (!empty($CFG->block_birthday_title)) {
            $this->title = $CFG->block_birthday_title;
        } else {
            $this->title = get_string('pluginname', 'block_birthday');
        }
    }

    /**
     * @return array|stdClass
     * @throws coding_exception
     */
    function get_content()
    {
        if (isguestuser() or !isloggedin()) {
            return (array());
        }
        global $DB, $COURSE, $CFG, $OUTPUT;
        $this->content = new stdClass();
        if ($CFG->block_birthday_enable == "1" and $CFG->block_birthday_user_field != '0') {
            $dt0 = new DateTime();

            $param = [$CFG->block_birthday_user_field, $dt0->format('md')];
            $sql = "SELECT u.id, u.firstname, u.lastname, u.username, u.email, uid.data, uif.shortname FROM {user} AS u";
            $sql .= " INNER JOIN {user_info_data} AS uid ON u.id = uid.userid ";
            $sql .= " INNER JOIN {user_info_field} AS uif ON uid.fieldid = uif.id ";

            if ($COURSE->id > 1) {
                $sql .= " INNER JOIN {user_enrolments} as ue on u.id = ue.userid ";
                $sql .= " INNER JOIN {enrol} as e on ue.enrolid = e.id and e.courseid ";
            }

            $sql .= " WHERE uid.fieldid = ? AND DATE_FORMAT(from_unixtime(uid.data),'%m%d') = ?";
            if ($COURSE->id > 1) {
                $param[] = $COURSE->id;
                $sql .= " AND e.courseid= ?";
            }
            $users = $DB->get_records_sql($sql, $param);
            if (count(($users)) == 0) {
                $this->content->text = null;
                return $this->content;
            }
            if (isset($CFG->block_birthday_content) && !is_null($CFG->block_birthday_content) and $CFG->block_birthday_content != "") {
                foreach ($users as $user) {
                    $content = $CFG->block_birthday_content;
                    $profile = profile_user_record($user->id);
                    $url = new moodle_url('/user/profile.php', ['id' => $user->id]);
                    if (strpos($content, '*-picture-size-')) {
                        preg_match('/\*-picture-size-(?P<size>\d+)-\*/', $content, $size);
                        $content = str_replace($size[0], "", $content);
                        $size = (int)!count($size) ? 50 : $size[1];
                        $picture = $OUTPUT->user_picture($user, ['size' => $size]);
                    } else {
                        $picture = $OUTPUT->user_picture($user, ['size' => 50]);
                    }
                    $yearsold = (new DateTime())->setTimestamp($profile->{$user->shortname})->diff(new DateTime())->y;
                    $content = str_replace("*-firstname-*", $user->firstname, $content);
                    $content = str_replace("*-lastname-*", $user->lastname, $content);
                    $content = str_replace("*-username-*", $user->username, $content);
                    $content = str_replace("*-email-*", $user->email, $content);
                    $content = str_replace("*-profile-url-*", $url, $content);
                    $content = str_replace("*-picture-*", $picture, $content);
                    $content = str_replace("*-years-old-*", $yearsold, $content);
                    if (isset($CFG->block_birthday_user_subtitle) and $CFG->block_birthday_user_subtitle != '0') {
                        $subtitle = $profile->{$CFG->block_birthday_user_subtitle};
                        $content = str_replace("*-subtitle-*", $subtitle, $content);
                    }
                    $this->content->text .= $content;
                }
            } else {
                $this->content->text .= "<table>";
                foreach ($users as $user) {
                    $url = new moodle_url('/user/profile.php', ['id' => $user->id]);
                    $name = $user->firstname . " " . $user->lastname;
                    $this->content->text .= "<tr>";
                    $this->content->text .= "<tr>";
                    $this->content->text .= "<td>";
                    $this->content->text .= $OUTPUT->user_picture($user, array('size' => 50));;
                    $this->content->text .= "</td>";
                    $this->content->text .= "<td><a href='$url' title='$name'>";
                    $this->content->text .= "<b> $name</b>";
                    if (isset($CFG->block_birthday_user_subtitle) and $CFG->block_birthday_user_subtitle != '0') {
                        $subtitle = profile_user_record($user->id)->{$CFG->block_birthday_user_subtitle};
                        $this->content->text .= "<br><small> $subtitle</small>";
                    }
                    $this->content->text .= "</a></td>";
                    $this->content->text .= "</tr>";
                }
                $this->content->text .= "</table>";
            }
            if (isset($CFG->block_birthday_css)) {
                $this->content->text .= "<style>" . $CFG->block_birthday_css . "</style>";
            }
        }
        return $this->content;
    }
}