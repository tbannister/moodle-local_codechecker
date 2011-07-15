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
 * moodle_Sniffs_ControlStructures_MultiLineConditionSniff.
 *
 * @package    local
 * @subpackage codechecker
 * @copyright  2011 Remote Learner  http://www.remote-learner.net/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * moodle_Sniffs_ControlStructures_MultiLineConditionSniff.
 *
 * Verifies that multi-line IF conditions are not present.
 *
 * @copyright 2011 Remote Learner  http://www.remote-learner.net/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class moodle_Sniffs_ControlStructures_MultiLineConditionSniff
         implements PHP_CodeSniffer_Sniff {


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register() {
        return array(T_IF);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $file     The file being scanned.
     * @param int                  $stackptr The position of the current token
     *                                       in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $file, $stackptr) {
        $tokens = $file->getTokens();

        // There shouldn't be any new lines in the parenthesis
        $openbracket  = $tokens[$stackptr]['parenthesis_opener'];
        $closebracket = $tokens[$stackptr]['parenthesis_closer'];
        $lastline     = $tokens[$openbracket]['line'];

        for ($i = ($openbracket + 1); $i < $closebracket; $i++) {

            if ($tokens[$i]['line'] !== $lastline) {
                // We changed lines.
                $error = 'Multi-line control structures are not allowed.';
                $file->addError($error, $i, 'Multiline');
                $lastline = $tokens[$i]['line'];
                break;
            }//end if
        }//end for
    }//end process()


}//end class
