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
 * Verify there is a single space after a comma.
 *
 * @package    local
 * @subpackage codechecker
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Verify there is a single space after a comma.
 *
 * @copyright 2011 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class moodle_Sniffs_WhiteSpace_SpaceAfterCommaSniff implements PHP_CodeSniffer_Sniff {

    /**
     * Create the list of tokens for which this sniff should be registered
     *
     * @return array The list of tokens to register the sniff for
     */
    public function register() {
        return array(T_COMMA);
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $file     The file being scanned.
     * @param int                  $stackptr The position of the current token in
     *                                       the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $file, $stackptr) {
        $tokens = $file->getTokens();

        if ($tokens[$stackptr + 1]['code'] !== T_WHITESPACE) {
            $error = 'Commas (,) must be followed by white space.';
            $file->addError($error, $stackptr, 'NoSpace');
        }
    }
}
