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
 * Quiz Password Change Admin Tool
 *
 * @package    tool_coursesummary
 * @copyright  2017 Colin Bernard {@link http://bclearningnetwork.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_coursesummary\output;                                                                                                         
 
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       
 
class success_html implements renderable, templatable {                                                                               

    var $success_string = null;
    var $password = null;
    var $course = null;
    var $to = null;                                                                                                   
 
    public function __construct($success_string, $password, $course, $to) {                                                                                        
        $this->success_string = $success_string;
        $this->password = $password;
        $this->course = $course;          
        $this->to = $to;                                                                                     
    }
 
    /**                                                                                                                             
     * Export this data so it can be used as the context for a mustache template.                                                   
     *                                                                                                                              
     * @return stdClass                                                                                                             
     */                                                                                                                             
    public function export_for_template(renderer_base $output) {                                                                    
        $data = new stdClass();                                                                                                     
        $data->success_string = $this->success_string;
        $data->password = $this->password;
        $data->course = $this->course;         
        $data->to = $this->to;                                                                                
        return $data;                                                                                                               
    }
}