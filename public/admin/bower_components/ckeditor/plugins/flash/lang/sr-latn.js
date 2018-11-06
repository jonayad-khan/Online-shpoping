<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Logger;

/**
 * Sends notifications through Slack's Slackbot
 *
 * @author Haralan Dobrev <hkdobrev@gmail.com>
 * @see    https://slack.com/apps/A0F81R8ET-slackbot
 */
class SlackbotHandler extends AbstractProcessingHandler
{
    /**
     * The slug of the Slack team
     * @var string
     */
    private $slackTeam;

    /**
     * Slackbot token
     * @var string
     */
    private $token;

    /**
     * Slack channel name
     * @var string
     */
    private $channel;

    /**
     * @param  string $slackTeam Slack team slug
     * @param  string $token     Slackbot token
     * @param  string $channel   Slack channel (encoded ID or name)
     * @param  int    $level     The minimum logging level at 