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
 * Default config
 * @package   block_birthday
 * @copyright 2021 Luiz Guilherme Dall' Acqua <luizguilherme@nte.ufsm.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    GLOBAL $DB;

    $fieldsDate = [];
    foreach($DB->get_records('user_info_field',['datatype'=>'datetime']) as $item){
        $fieldsDate[$item->id]=$item->name;
    };;

    $fieldsSubtitle = [0=>get_string('none', 'block_birthday')];
    foreach($DB->get_records('user_info_field',['datatype'=>'text']) as $item){
        $fieldsSubtitle[$item->shortname]=$item->name;
    };;
    //Enable
    $settings->add(new admin_setting_configselect('block_birthday_enable',
        get_string('configbirthday2', 'block_birthday'),
        get_string('configbirthday3', 'block_birthday'), '0', [
            '0' => get_string('configbirthday4', 'block_birthday'),
            '1' => get_string('configbirthday5', 'block_birthday')
        ]));

    //Field date
    $settings->add(new admin_setting_configselect('block_birthday_user_field',
        get_string('configbirthday10', 'block_birthday'),
        get_string('configbirthday11', 'block_birthday'), null, $fieldsDate));

    //Field subtitle
    $settings->add(new admin_setting_configselect('block_birthday_user_subtitle',
        get_string('configbirthday12', 'block_birthday'),
        get_string('configbirthday13', 'block_birthday'), null, $fieldsSubtitle));

    // Block Title
    $settings->add(new admin_setting_configtext('block_birthday_title',
        get_string('configbirthday6', 'block_birthday'),
        get_string('configbirthday7', 'block_birthday'), null));

    // Css
    $settings->add(new admin_setting_configtextarea('block_birthday_css',
        get_string('configbirthday8', 'block_birthday'),
        get_string('configbirthday9', 'block_birthday'), null));

    // Content
    $settings->add(new admin_setting_confightmleditor('block_birthday_content',
        get_string('configbirthday1', 'block_birthday'),
        get_string('configbirthday0', 'block_birthday'), null));


}
