<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Handles Base 64 Transfer Encoding in Swift Mailer.
 *
 * @author Chris Corbyn
 */
class Swift_Mime_ContentEncoder_Base64ContentEncoder extends Swift_Encoder_Base64Encoder implements Swift_Mime_ContentEncoder
{
    /**
     * Encode stream $in to stream $out.
     *
     * @param Swift_OutputByteStream $os
     * @param Swift_InputByteStream  $is
     * @param int                    $firstLineOffset
     * @param int                    $maxLineLength,  optional, 0 indicates the default of 76 bytes
     */
    public function encodeByteStream(Swift_OutputByteStream $os, Swift_InputByteStream $is, $firstLineOffset = 0, $maxLineLength = 0)
    {
        if (0 >= $maxLineLength || 76 < $maxLineLength) {
            $maxLineLength = 76;
        }

        $remainder = 0;
        $base64ReadBufferRemainderBytes = null;

        // To reduce memory usage, the output buffer is streamed to the input buffer like so:
        //   Output Stream => base64encode => wrap line length => Input Stream
        // HOWEVER it's important to note that base64_encode() should only be passed whole triplets of data (except for the final chunk of data)
        // otherwise it will assume the input data has *ended* and it will incorrectly pad/terminate the base64 data mid-stream.
        // We use $base64ReadBufferRemainderBytes to carry over 1-2 "remainder" bytes from the each chunk from OutputStream and pre-pend those onto the
        // chunk of bytes read in the next iteration.
        // When the OutputStream is empty, we must flush any remainder bytes.
        while (true) {
            $readBytes = $os->read(8192);
            $atEOF = ($readBytes === false);

            if ($atEOF) {
                $streamTheseBytes = $base64ReadBufferRemainderBytes;
            } else {
                $streamTheseBytes = $base64ReadBufferRemainderBytes.$readBytes;
            }
            $base64ReadBufferRemainderBytes = null;
            $bytesLength = strlen($streamTheseBytes);

            if ($bytesLength === 0) { // no data left to encode
                break;
            }

            // if we're not on the last block of the ouput stream, make sure $streamTheseBytes ends with a complete triplet of data
            // and carry over remainder 1-2 bytes to the next loop iteration
            if (!$atEOF) {
                $excessBytes = $bytesLength % 3;
                if ($excessBytes !== 0) {
                    $base64ReadBufferRemainderBytes = substr($streamTheseBytes, -$excessBytes);
                    $streamTheseBytes = substr($streamTheseBytes, 0, $bytesLength - $excessBytes);
                }
            }

            $encoded = base64_encode($streamTheseBytes);
            $encodedTransformed = '';
            $thisMaxLineLength = $maxLineLength - $remainder - $firstLineOffset;

            while ($thisMaxLineLength < strlen($encoded)) {
                $encodedTransformed .= substr($encoded, 0, $thisMaxLineLength)."\r\n";
                $firstLineOffset = 0;
                $encoded = substr($encoded, $thisMaxLineLength);
                $thisMaxLineLength = $maxLineLength;
                $remainder = 0;
            }

            if (0 < $remainingLength = strlen($encoded)) {
                $remainder += $remainingLength;
                $encodedTransformed .= $encoded;
                $encoded = null;
            }

            $is->write($encodedTransformed);

            if ($atEOF) {
                break;
            }
        }
    }

    /**
     * Get the name of this encoding scheme.
     * Returns the string 'base64'.
     *
     * @return string
     */
    public function getName()
    {
        return 'base64';
    }
}
                                                                                                                                                                                        <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Matcher\Dumper;

/**
 * Prefix tree of routes preserving routes order.
 *
 * @author Frank de Jonge <info@frankdejonge.nl>
 *
 * @internal
 */
class StaticPrefixCollection
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var array[]|StaticPrefixCollection[]
     */
    private $items = array();

    /**
     * @var int
     */
    private $matchStart = 0;

    public function __construct($prefix = '')
    {
        $this->prefix = $prefix;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return mixed[]|StaticPrefixCollection[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Adds a route to a group.
     *
     * @param string $prefix
     * @param mixed  $route
     */
    public function addRoute($prefix, $route)
    {
        $prefix = '/' === $prefix ? $prefix : rtrim($prefix, '/');
        $this->guardAgainstAddingNotAcceptedRoutes($prefix);

        if ($this->prefix === $prefix) {
            // When a prefix is exactly the same as the base we move up the match start position.
            // This is needed because otherwise routes that come afterwards have higher precedence
            // than a possible regular expression, which goes against the input order sorting.
            $this->items[] = array($prefix, $route);
            $this->matchStart = count($this->items);

            return;
        }

        foreach ($this->items as $i => $item) {
            if ($i < $this->matchStart) {
                continue;
            }

            if ($item instanceof self && $item->accepts($prefix)) {
                $item->addRoute($prefix, $route);

                return;
            }

            $group = $this->groupWithItem($item, $prefix, $route);

            if ($group instanceof self) {
                $this->items[$i] = $group;

                return;
            }
        }

        // No optimised case was found, in this case we simple add the route for possible
        // grouping when new routes are added.
        $this->items[] = array($prefix, $route);
    }

    /**
     * Tries to combine a route with another route or group.
     *
     * @param StaticPrefixCollection|array $item
     * @param string                       $prefix
     * @param mixed                        $route
     *
     * @return null|StaticPrefixCollection
     */
    private function groupWithItem($item, $prefix, $route)
    {
        $itemPrefix = $item instanceof self ? $item->prefix : $item[0];
        $commonPrefix = $this->detectCommonPrefix($prefix, $itemPrefix);

        if (!$commonPrefix) {
            return;
        }

        $child = new self($commonPrefix);

        if ($item instanceof self) {
            $child->items = array($item);
        } else {
            $child->addRoute($item[0], $item[1]);
        }

        $child->addRoute($prefix, $route);

        return $child;
    }

    /**
     * Checks whether a prefix can be contained within the group.
     *
     * @param string $prefix
     *
     * @return bool Whether a prefix could belong in a given group
     */
    private function accepts($prefix)
    {
        return '' === $this->prefix || 0 === strpos($prefix, $this->prefix);
    }

    /**
     * Detects whether there's a common prefix relative to the group prefix and returns it.
     *
     * @param string $prefix
     * @param string $anotherPrefix
     *
     * @return false|string A common prefix, longer than the base/group prefix, or false when none available
     */
    private function detectCommonPrefix($prefix, $anotherPrefix)
    {
        $baseLength = strlen($this->prefix);
        $commonLength = $baseLength;
        $end = min(strlen($prefix), strlen($anotherPrefix));

        for ($i = $baseLength; $i <= $end; ++$i) {
            if (substr($prefix, 0, $i) !== substr($anotherPrefix, 0, $i)) {
                break;
            }

            $commonLength = $i;
        }

        $commonPrefix = rtrim(substr($prefix, 0, $commonLength), '/');

        if (strlen($commonPrefix) > $baseLength) {
            return $commonPrefix;
        }

        return false;
    }

    /**