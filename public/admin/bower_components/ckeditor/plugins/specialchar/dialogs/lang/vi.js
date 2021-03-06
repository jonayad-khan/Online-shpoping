    $read = fread($fp, $remaining);
                if (!is_string($read)) {
                    if ($read === false) {
                        /**
                         * We cannot safely read from the file. Exit the
                         * do-while loop and trigger the exception condition
                         *
                         * @var string|bool
                         */
                        $buf = false;
                        break;
                    }
                }
                /**
                 * Decrease the number of bytes returned from remaining
                 */
                $remaining -= RandomCompat_strlen($read);
                /**
                 * @var string|bool
                 */
                $buf = $buf . $read;
            } while ($remaining > 0);

            /**
             * Is our result valid?
             */
            if (is_string($buf)) {
                if (RandomCompat_strlen($buf) === $bytes) {
                    /**
                     * Return our random entropy buffer here:
                     */
                    return $buf;
                }
            }
        }

        /**
         * If we reach here, PHP has failed us.
         */
        throw new Exception(
            'Error reading from source device'
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Descriptor\DescriptorInterface;
use Symfony\Component\Console\Descriptor\JsonDescriptor;
use Symfony\Component\Console\Descriptor\MarkdownDescriptor;
use Symfony\Component\Console\Descriptor\TextDescriptor;
use Symfony\Component\Console\Descriptor\XmlDescriptor;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * This class adds helper method to describe objects in various formats.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class DescriptorHelper extends Helper
{
    /**
     * @var DescriptorInterface[]
     */
    private $descriptors = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this
            ->register('txt', new TextDescriptor())
            ->register('xml', new XmlDescriptor())
            ->register('json', new JsonDescriptor())
            ->register('md', new MarkdownDescriptor())
        ;
    }

    /**
     * Describes an object if supported.
     *
     * Available options are:
     * * format: string, the output format name
     * * raw_text: boolean, sets output type as raw
     *
     * @param OutputInterface $output
     * @param object          $object
     * @param array           $options
     *
     * @throws InvalidArgumentException when the given format is not supported
     */
    public function describe(OutputInterface $output, $object, array $options = array())
    {
        $options = array_merge(array(
            'raw_text' => false,
            'format' => 'txt',
        ), $options);

        if (!isset($this->descriptors[$options['format']])) {
            throw new 