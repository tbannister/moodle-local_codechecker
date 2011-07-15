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
 * Verifies that class members have scope modifiers. Created by sam marshall,
 * based on a sniff by Greg Sherwood and Marc McIntyre.
 *
 * @package    local
 * @subpackage codechecker
 * @copyright  2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license    http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 */

$requiredclass = 'PHP_CodeSniffer_Standards_AbstractVariableSniff';

if (class_exists($requiredclass, true) === false) {
    throw new PHP_CodeSniffer_Exception("Class $requiredclass not found");
}

/**
 * Verifies that class members have scope modifiers.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @author    sam marshall <s.marshall@open.ac.uk>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @copyright 2011 The Open University
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: 1.3.0
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class moodle_Sniffs_PHP_MemberVarScopeSniff
        extends PHP_CodeSniffer_Standards_AbstractVariableSniff {

    /**
     * Processes the function tokens within the class.
     *
     * @param PHP_CodeSniffer_File $file     The file where this token was found.
     * @param int                  $stackptr The position where the token was found.
     *
     * @return void
     */
    protected function processMemberVar(PHP_CodeSniffer_File $file, $stackptr) {
        $tokens = $file->getTokens();

        $modifier = $file->findPrevious(PHP_CodeSniffer_Tokens::$scopeModifiers, $stackptr);
        $semicolon = $file->findPrevious(T_SEMICOLON, $stackptr);

        if ($modifier === false || $modifier < $semicolon) {
            $error = 'Scope modifier not specified for member variable "%s"';
            $data  = array($tokens[$stackptr]['content']);
            $file->addError($error, $stackptr, 'Missing', $data);
        }
    }

    /**
     * Processes normal variables.
     *
     * @param PHP_CodeSniffer_File $file     The file where this token was found.
     * @param int                  $stackptr The position where the token was found.
     *
     * @return void
     */
    protected function processVariable(PHP_CodeSniffer_File $file, $stackptr) {
        return;
    }

    /**
     * Processes variables in double quoted strings.
     *
     * @param PHP_CodeSniffer_File $file     The file where this token was found.
     * @param int                  $stackptr The position where the token was found.
     *
     * @return void
     */
    protected function processVariableInString(PHP_CodeSniffer_File $file, $stackptr) {
        return;
    }
}
