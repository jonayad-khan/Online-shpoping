<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Polyfill\Ctype as p;

if (!function_exists('ctype_alnum')) {
    function ctype_alnum($text) { return p\Ctype::ctype_alnum($text); }
    function ctype_alpha($text) { return p\Ctype::ctype_alpha($text); }
    function ctype_cntrl($text) { return p\Ctype::ctype_cntrl($text); }
    function ctype_digit($text) { return p\Ctype::ctype_digit($text); }
    function ctype_graph($text) { return p\Ctype::ctype_graph($text); }
    function ctype_lower($text) { return p\Ctype::ctype_lower($text); }
    function ctype_print($text) { return p\Ctype::ctype_print($text); }
    function ctype_punct($text) { return p\Ctype::ctype_punct($text); }
    function ctype_space($text) { return p\Ctype::ctype_space($text); }
    function ctype_upper($text) { return p\Ctype::ctype_upper($text); }
    function ctype_xdigit($text) { return p\Ctype::ctype_xdigit($text); }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StreamableInputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;

/**
 * The QuestionHelper class provides helpers to interact with the user.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class QuestionHelper extends Helper
{
    private $inputStream;
    private static $shell;
    private static $stty;

    /**
     * Asks a question to the user.
     *
     * @return mixed The user answer
     *
     * @throws RuntimeException If there is no data to read in the input stream
     */
    public function ask(InputInterface $input, OutputInterface $output, Question $question)
    {
        if ($output instanceof ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }

        if (!$input->isInteractive()) {
            if ($question instanceof ChoiceQuestion) {
        