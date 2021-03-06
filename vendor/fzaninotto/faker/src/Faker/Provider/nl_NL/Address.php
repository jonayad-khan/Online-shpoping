<?xml version="1.0" encoding="UTF-8"?>

<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="http://schema.phpunit.de/4.1/phpunit.xsd"
         backupGlobals="false"
         colors="true"
         bootstrap="vendor/autoload.php"
         failOnRisky="true"
         failOnWarning="true"
>
    <php>
        <ini name="error_reporting" value="-1" />
        <env name="DUMP_LIGHT_ARRAY" value="" />
        <env name="DUMP_STRING_LENGTH" value="" />
    </php>

    <testsuites>
        <testsuite name="Symfony VarDumper Component Test Suite">
            <directory>./Tests/</directory>
        </testsuite>
    </testsuites>

    <filter>
        <whitelist>
            <directory>./</directory>
            <exclude>
                <directory>./Resources</directory>
                <directory>./Tests</directory>
                <directory>./vendor</directory>
            </exclude>
        </whitelist>
    </filter>
</phpunit>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     INDX( 	                 (   P  �                             7    ` L      7    `1��b�
�/�5����b�^1��b�                        . i d e a     
7    ` L      7     ��b�$z��5�����b� ��b�                        a d m i n     7    X H      7    6���b�xF;�5�!ԡ�b�0���b�                        a p p 7    ` N      7    ⡢b�ҙ�5����b�⡢b�                        a s s e t s   7    h R      7    �ם�b�����5�D흢b��ם�b�       �              b l o g . s q l       7    p \      7    ����b�����5��
��b�����b��       �                c o m p o s e r . j s o n     7    h T      7    ���b�D���5��%��b����b�       �              	 i n d e x . p h p     :7    ` N      7    ��b�\^��5�Zg��b� ��b�                        v e n d o r                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   �   $       4                                  �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Log;

use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Minimalist PSR-3 logger designed to write in stderr or any other stream.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Logger extends AbstractLogger
{
    private static $levels = array(
        LogLevel::DEBUG => 0,
        LogLevel::INFO => 1,
        LogLevel::NOTICE => 2,
        LogLevel::WARNING => 3,
        LogLevel::ERROR => 4,
        LogLevel::CRITICAL => 5,
        LogLevel::ALERT => 6,
        LogLevel::EMERGENCY => 7,
    );

    private $minLevelIndex;
    private $formatter;
    private $handle;

    public function __construct(string $minLevel = null, $output = 'php://stderr', callable $formatter = null)
    {
        if (null === $minLevel) {
            $minLevel = LogLevel::WARNING;

            if (isset($_ENV['SHELL_VERBOSITY']) || isset($_SERVER['SHELL_VERBOSITY'])) {
                switch ((int) (isset($_ENV['SHELL_VERBOSITY']) ? $_ENV['SHELL_VERBOSITY'] : $_SERVER['SHELL_VERBOSITY'])) {
                    case -1: $minLevel = LogLevel::ERROR; break;
                    case 1: $minLevel = LogLevel::NOTICE; break;
                    case 2: $minLevel = LogLevel::INFO; break;
                    case 3: $minLevel = LogLevel::DEBUG; break;
                }
            }
        }

        if (!isset(self::$levels[$minLevel])) {
            throw new InvalidArgumentException(sprintf('The log level "%s" does not exist.', $minLevel));
        }

        $this->minLevelIndex = self::$levels[$minLevel];
        $this->formatter = $formatter ?: array($this, 'format');
        if (false === $this->handle = is_resource($output) ? $output : @fopen($output, 'a')) {
            throw new InvalidArgumentException(sprintf('Unable to open "%s".', $output));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset(self::$levels[$level])) {
            throw new InvalidArgumentException(sprintf('The log level "%s" does not exist.', $level));
        }

        if (self::$levels[$level] < $this->minLevelIndex) {
            return;
        }

        $formatter = $this->formatter;
        fwrite($this->handle, $formatter($level, $message, $context));
    }

    private function format(string $level, string $message, array $context): string
    {
        if (false !== strpos($message, '{')) {
            $replacements = array();
            foreach ($context as $key => $val) {
                if (null === $val || is_scalar($val) || (\is_object($val) && method_exists($val, '__toString'))) {
                    $replacements["{{$key}}"] = $val;
                } elseif ($val instanceof \DateTimeInterface) {
                    $replacements["{{$key}}"] = $val->format(\DateTime::RFC3339);
                } elseif (\is_object($val)) {
                    $replacements["{{$key}}"] = '[object '.\get_class($val).']';
                } else {
                    $replacements["{{$key}}"] = '['.\gettype($val).']';
                }
            }

            $message = strtr($message, $replacements);
        }

        return sprintf('%s [%s] %s', date(\DateTime::RFC3339), $level, $message).\PHP_EOL;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

//Ensure that all lines are aligned to the begin of the first line in a very long line block
return function (InputInterface $input, OutputInterface $output) {
    $output = new SymfonyStyle($input, $output);
    $output->block(
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
        'CUSTOM',
        'fg=white;bg=green',
        'X ',
        true
    );
};
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          Creating Messages
=================

Creating messages in Swift Mailer is done by making use of the various MIME
entities provided with the library. Complex messages can be quickly created
with very little effort.

Quick Reference
---------------

You can think of creating a Message as being similar to the steps you perform
when you click the Compose button in your mail client. You give it a subject,
specify some recipients, add any attachments and write your message::

    // Create the message
    $message = (new Swift_Message())

      // Give the message a subject
      ->setSubject('Your subject')

      // Set the From address with an associative array
      ->setFrom(['john@doe.com' => 'John Doe'])

      // Set the To addresses with an associative array (setTo/setCc/setBcc)
      ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])

      // Give it a body
      ->setBody('Here is the message itself')

      // And optionally an alternative body
      ->addPart('<q>Here is the message itself</q>', 'text/html')

      // Optionally add any attachments
      ->attach(Swift_Attachment::fromPath('my-document.pdf'))
      ;

Message Basics
--------------

A message is a container for anything you want to send to somebody else. There
are several basic aspects of a message that you should know.

An e-mail message is made up of several relatively simple entities that are
combined in different ways to achieve different results. All of these entities
have the same fundamental outline but serve a different purpose. The Message
itself can be defined as a MIME entity, an Attachment is a MIME entity, all
MIME parts are MIME entities -- and so on!

The basic units of each MIME entity -- be it the Message itself, or an
Attachment -- are its Headers and its body:

.. code-block:: text

    Header-Name: A header value
    Other-Header: Another value

    The body content itself

The Headers of a MIME entity, and its body must conform to some strict
standards defined by various RFC documents. Swift Mailer ensures that these
specifications are followed by using various types of object, including
Encoders and different Header types to generate the entity.

The Structure of a Message
~~~~~~~~~~~~~~~~~~~~~~~~~~

Of all of the MIME entities, a message -- ``Swift_Message`` is the largest and
most complex. It has many properties that can be updated and it can contain
other MIME entities -- attachments for example -- nested inside it.

A Message has a lot of different Headers which are there to present information
about the message to the recipients' mail client. Most of these headers will be
familiar to the majority of users, but we'll list the basic ones. Although it's
possible to work directly with the Headers of a Message (or other MIME entity),
the standard Headers have accessor methods provided to abstract away the
complex details for you. For example, although the Date on a message is written
with a strict format, you only need to pass a DateTimeInterface instance to
``setDate()``.

+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| Header                        | Description                                                                                                                        | Accessors                                   |
+===============================+====================================================================================================================================+=============================================+
| ``Message-ID``                | Identifies this message with a unique ID, usually containing the domain name and time generated                                    | ``getId()`` / ``setId()``                   |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Return-Path``               | Specifies where bounces should go (Swift Mailer reads this for other uses)                                                         | ``getReturnPath()`` / ``setReturnPath()``   |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``From``                      | Specifies the address of the person who the message is from. This can be multiple addresses if multiple people wrote the message.  | ``getFrom()`` / ``setFrom()``               |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Sender``                    | Specifies the address of the person who physically sent the message (higher precedence than ``From:``)                             | ``getSender()`` / ``setSender()``           |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``To``                        | Specifies the addresses of the intended recipients                                                                                 | ``getTo()`` / ``setTo()``                   |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Cc``                        | Specifies the addresses of recipients who will be copied in on the message                                                         | ``getCc()`` / ``setCc()``                   |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Bcc``                       | Specifies the addresses of recipients who the message will be blind-copied to. Other recipients will not be aware of these copies. | ``getBcc()`` / ``setBcc()``                 |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Reply-To``                  | Specifies the address where replies are sent to                                                                                    | ``getReplyTo()`` / ``setReplyTo()``         |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Subject``                   | Specifies the subject line that is displayed in the recipients' mail client                                                        | ``getSubject()`` / ``setSubject()``         |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Date``                      | Specifies the date at which the message was sent                                                                                   | ``getDate()`` / ``setDate()``               |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Content-Type``              | Specifies the format of the message (usually text/plain or text/html)                                                              | ``getContentType()`` / ``setContentType()`` |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+
| ``Content-Transfer-Encoding`` | Specifies the encoding scheme in the message                                                                                       | ``getEncoder()`` / ``setEncoder()``         |
+-------------------------------+------------------------------------------------------------------------------------------------------------------------------------+---------------------------------------------+

Working with a Message Object
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Although there are a lot of available methods on a message object, you only
need to make use of a small subset of them. Usually you'll use
``setSubject()``, ``setTo()`` and ``setFrom()`` before setting the body of your
message with ``setBody()``::

    $message = new Swift_Message();
    $message->setSubject('My subject');

All MIME entities (including a message) have a ``toString()`` method that you
can call if you want to take a look at what is going to be sent. For example,
if you ``echo $message->toString();`` you would see something like this:

.. code-block:: text

    Message-ID: <1230173678.4952f5eeb1432@swift.generated>
    Date: Thu, 25 Dec 2008 13:54:38 +1100
    Subject: Example subject
    From: Chris Corbyn <chris@w3style.co.uk>
    To: Receiver Name <recipient@example.org>
    MIME-Version: 1.0
    Content-Type: text/plain; charset=utf-8
    Content-Transfer-Encoding: quoted-printable

    Here is the message

We'll take a closer look at the methods you use to create your message in the
following sections.

Adding Content to Your Message
------------------------------

Rich content can be added to messages in Swift Mailer with relative ease by
calling methods such as ``setSubject()``, ``setBody()``, ``addPart()`` and
``attach()``.

Setting the Subject Line
~~~~~~~~~~~~~~~~~~~~~~~~

The subject line, displayed in the recipients' mail client can be set with the
``setSubject()`` method, or as a parameter to ``new Swift_Message()``::

    // Pass it as a parameter when you create the message
    $message = new Swift_Message('My amazing subject');

    // Or set it after like this
    $message->setSubject('My amazing subject');

Setting the Body Content
~~~~~~~~~~~~~~~~~~~~~~~~

The body of the message -- seen when the user opens the message -- is specified
by calling the ``setBody()`` method. If an alternative body is to be included,
``addPart()`` can be used.

The body of a message is the main part that is read by the user. Often people
want to send a message in HTML format (``text/html``), other times people want
to send in plain text (``text/plain``), or sometimes people want to send both
versions and allow the recipient to choose how they view the message.

As a rule of thumb, if you're going to send a HTML email, always include a
plain-text equivalent of the same content so that users who prefer to read
plain text can do so.

If the recipient's mail client offers preferences for displaying text vs. HTML
then the mail client will present that part to the user where available. In
other cases the mail client will display the "best" part it can - usually HTML
if you've included HTML::

    // Pass it as a parameter when you create the message
    $message = new Swift_Message('Subject here', 'My amazing body');

    // Or set it after like this
    $message->setBody('My <em>amazing</em> body', 'text/html');

    // Add alternative parts with addPart()
    $message->addPart('My amazing body in plain text', 'text/plain');

Attaching Files
---------------

Attachments are downloadable parts of a message and can be added by calling the
``attach()`` method on the message. You can add attachments that exist on disk,
or you can create attachments on-the-fly.

Although we refer to files sent over e-mails as "attachments" -- because
they're attached to the message -- lots of other parts of the message are
actually "attached" even if we don't refer to these parts as attachments.

File attachments are created by the ``Swift_Attachment`` class and then
attached to the message via the ``attach()`` method on it. For all of the
"every day" MIME types such as all image formats, word documents, PDFs and
spreadsheets you don't need to explicitly set the content-type of the
attachment, though it would do no harm to do so. For less common formats you
should set the content-type -- which we'll cover in a moment.

Attaching Existing Files
~~~~~~~~~~~~~~~~~~~~~~~~

Files that already exist, either on disk or at a URL can be attached to a
message with just one line of code, using ``Swift_Attachment::fromPath()``.

You can attach files that exist locally, or if your PHP installation has
``allow_url_fopen`` turned on you can attach files from other
websites.

The attachment will be presented to the recipient as a downloadable file with
the same filename as the one you attached::

    // Create the attachment
    // * Note that you can technically leave the content-type parameter out
    $attachment = Swift_Attachment::fromPath('/path/to/image.jpg', 'image/jpeg');

    // Attach it to the message
    $message->attach($attachment);

    // The two statements above could be written in one line instead
    $message->attach(Swift_Attachment::fromPath('/path/to/image.jpg'));

    // You can attach files from a URL if allow_url_fopen is on in php.ini
    $message->attach(Swift_Attachment::fromPath('http://site.tld/logo.png'));

Setting the Filename
~~~~~~~~~~~~~~~~~~~~

Usually you don't need to explicitly set the filename of an attachment because
the name of the attached file will be used by default, but if you want to set
the filename you use the ``setFilename()`` method of the Attachment.

The attachment will be attached in the normal way, but meta-data sent inside
the email will rename the file to something else::

    // Create the attachment and call its setFilename() method
    $attachment = Swift_Attachment::fromPath('/path/to/image.jpg')
      ->setFilename('cool.jpg');

    // Because there's a fluid interface, you can do this in one statement
    $message->attach(
      Swift_Attachment::fromPath('/path/to/image.jpg')->setFilename('cool.jpg')
    );

Attaching Dynamic Content
~~~~~~~~~~~~~~~~~~~~~~~~~

Files that are generated at runtime, such as PDF documents or images created
via GD can be attached directly to a message without writing them out to disk.
Use ``Swift_Attachment`` directly.

The attachment will be presented to the recipient as a downloadable file
with the filename and content-type you specify::

    // Create your file contents in the normal way, but don't write them to disk
    $data = create_my_pdf_data();

    // Create the attachment with your data
    $attachment = new Swift_Attachment($data, 'my-file.pdf', 'application/pdf');

    // Attach it to the message
    $message->attach($attachment);


    // You can alternatively use method chaining to build the attachment
    $attachment = (new Swift_Attachment())
      ->setFilename('my-file.pdf')
      ->setContentType('application/pdf')
      ->setBody($data)
      ;

.. note::

    If you would usually write the file to disk anyway you should just attach
    it with ``Swift_Attachment::fromPath()`` since this will use less memory.

Changing the Disposition
~~~~~~~~~~~~~~~~~~~~~~~~

Attachments just appear as files that can be saved to the Desktop if desired.
You can make attachment appear inline where possible by using the
``setDisposition()`` method of an attachment.

The attachment will be displayed within the email viewing window if the mail
client knows how to display it::

    // Create the attachment and call its setDisposition() method
    $attachment = Swift_Attachment::fromPath('/path/to/image.jpg')
      ->setDisposition('inline');


    // Because there's a fluid interface, you can do this in one statement
    $message->attach(
      Swift_Attachment::fromPath('/path/to/image.jpg')->setDisposition('inline')
    );

.. note::

    If you try to create an inline attachment for a non-displayable file type
    such as a ZIP file, the mail client should just present the attachment as
    normal.

Embedding Inline Media Files
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Often, people want to include an image or other content inline with a HTML
message. It's easy to do this with HTML linking to remote resources, but this
approach is usually blocked by mail clients. Swift Mailer allows you to embed
your media directly into the message.

Mail clients usually block downloads from remote resources because this
technique was often abused as a mean of tracking who opened an email. If
you're sending a HTML email and you want to include an image in the message
another approach you can take is to embed the image directly.

Swift Mailer makes embedding files into messages extremely streamlined. You
embed a file by calling the ``embed()`` method of the message,
which returns a value you can use in a ``src`` or
``href`` attribute in your HTML.

Just like with attachments, it's possible to embed dynamically generated
c