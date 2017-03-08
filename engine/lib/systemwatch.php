<?php
/**
 * Apace
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	  Apace
 * @author	  Apace Dev Team | apacedev@gmail.com
 * @copyright Copyright (c) 2014 - 2017, Apace
 * @license	  http://opensource.org/licenses/MIT	MIT License
 * @link	  https://github.com/apacedev/apace
 * @since	  Version 1.0.0
 * @filesource
 */

require_once('developmentenvironment.php');
$DE = new DevelopmentEnvironment();

/**
 * Compile and minify js
 *
 * @param	string	$argv[1]	type of file
 * @param	string	$argv[2]	filename itself without an extension
 * @param	string	$argv[3]	datafolder to write the file to when finished compiling
 */
if ($argv[1] == 'minifyjs') {
	$DE->compressJavascript($argv[2], $argv[3]);
}

/**
 * Compile and minify less to css
 *
 * @param	string	$argv[1]	type of file
 * @param	string	$argv[2]	filename itself without an extension
 * @param	string	$argv[3]	datafolder to write the file to when finished compiling
 */

/**
 * Compile and minify less to css
 * @param	string	$argv[1]	type of file
 * @param	string	$argv[2]	full filepath to the file
 * @param	string	$argv[3]	filename itself without an extension
 * @param	string	$argv[4]	datafolder to write the file to when finished compiling
 */
if ($argv[1] == 'less') {
	$DE->compileLess($argv[2], $argv[3], $argv[4]);
}