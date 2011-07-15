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
 * Verifies that control statements conform to their coding standards.
 *
 * Based on Squiz_Sniffs_ControlStructures_ControlSignatureSniff.
 *
 * @package    local
 * @subpackage codechecker
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$requiredclass = 'PHP_CodeSniffer_Standards_AbstractPatternSniff';

if (class_exists($requiredclass, true) === false) {
    throw new PHP_CodeSniffer_Exception("Class $requiredclass not found");
}

/**
 * Verifies that control statements conform to their coding standards.
 *
 * @copyright 2011 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class moodle_Sniffs_ControlStructures_ControlSignatureSniff
        extends PHP_CodeSniffer_Standards_AbstractPatternSniff {


    /**
     * Constructs a moodle_sniffs_controlstructures_controlsignaturesniff.
     */
    public function __construct() {
        parent::__construct(true);
    }


    /**
     * Returns the patterns that this test wishes to verify.
     *
     * @return array(string)
     */
    protected function getpatterns() {
        return array(
            'try {EOL...} catch (...) {EOL'
            'do {EOL...} while (...);EOL',
            'while (...) {EOL',
            'for (...) {EOL',
            'if (...) {EOL',
            'foreach (...) {EOL',
            '} else if (...) {EOL',
            '} else {EOL',
        );
    }
}
