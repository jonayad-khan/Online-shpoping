<?php

require_once 'swift_required.php';

//This is more of a "cross your fingers and hope it works" test!

class Swift_DependencyContainerAcceptanceTest extends PHPUnit\Framework\TestCase
{
    public function testNoLookupsFail()
    {
        $di = Swift_DependencyContainer::getInstance();
        foreach ($di->listItems() as $itemName) {
            try {
                $di->lookup($itemName);
            } catch (Swift_DependencyException $e) {
                $this->fail($e->getMessage());
            }
        }
        // previous loop would fail if there is an issue
        $this->addToAssertionCount(1);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Formatter\FormatterInterface;
use Monolog\Logger;
use Monolog\Handler\Slack\SlackRecord;

/**
 * Sends notifications through Slack Webhooks
 *
 * @author Haralan Dobrev <hkdobrev@gmail.com>
 * @see    https://api.slack.com/incoming-webhooks
 */
class SlackWebhookHandler extends AbstractProcessingHandler
{
    /**
     * Slack Webhook token
     * @var string
     */
    private $webhookUrl;

    /**
     * Instance of the SlackRecord util class preparing data for Slack API.
     * @var SlackRecord
     */
    private $slackRecord;

    /**
     * @param  string      $webhookUrl             Slack Webhook URL
     * @param  string|null $channel                Slack channel (encoded ID or name)
     * @param  string|null $username               Name of a bot
     * @param  bool        $useAttachment          Whether the message should be added to Slack as attachment (plain text otherwise)
     * @param  string|null $iconEmoji              The emoji name to use (or null)
     * @param  bool        $useShortAttachment     Whether the the context/extra messages added to Slack as attachments are in a short style
     * @param  bool        $includeContextAndExtra Whether the attachment should include context and extra data
     * @param  int         $level                  The minimum logging level at which this handler will be triggered
     * @param  bool        $bubble                 Whether the messages that are handled can bubble up the stack or not
     * @param  array       $excludeFields          Dot separated list of fields to exclude from slack message. E.g. ['context.field1', 'extra.field2']
     */