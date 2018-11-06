<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\Descriptor;

use Symfony\Component\Console\Descriptor\JsonDescriptor;
use Symfony\Component\Console\Output\BufferedOutput;

class JsonDescriptorTest extends AbstractDescriptorTest
{
    protected function getDescriptor()
    {
        return new JsonDescriptor();
    }

    protected function getFormat()
    {
        return 'json';
    }

    protected function assertDescription($expectedDescription, $describedObject, array $options = array())
    {
        $output = new BufferedOutput(BufferedOutput::VERBOSITY_NORMAL, true);
        $this->getDescriptor()->describe($output, $describedObject, $options + array('raw_output' => true)