<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

/**
 * Helps outputting debug information when running an external program from a command.
 *
 * An external program can be a Process, an HTTP request, or anything else.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class DebugFormatterHelper extends Helper
{
    private $colors = array('black', 'red', 'green', 'yellow', 'blue', 'magenta', 'cyan', 'white', 'default');
    private $started = array();
    private $count = -1;

    /**
     * Starts a debug formatting session.
     *
     * @param string $id      The id of the formatting session
     * @param string $message The message to display
     * @param string $prefix  The prefix to use
     *
     * @return string
     */
    public function start($id, $message, $prefix = 'RUN')
    {
        $this->started[$id] = array('border' => ++$this->count % count($this->colors));

        return sprintf("%s<bg=blue;fg=white> %s </> <fg=blue>%s</>\n", $this->getBorder($id), $prefix, $message);
    }

    /**
     * Adds progress to a formatting session.
     *
     * @para