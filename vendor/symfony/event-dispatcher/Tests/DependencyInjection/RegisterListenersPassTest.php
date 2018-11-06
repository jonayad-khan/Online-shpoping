Mailer about which recipients were
rejected, but in reality the majority of locally installed ``sendmail``
instances are not configured well enough to provide any useful feedback. As
such Swift Mailer may report successful deliveries where they did in fact fail
before they even left your server.

You can run the Sendmail Transport in two different modes specified by command
line flags:

* "``-bs``" runs in SMTP mode so theoretically it will act like the SMTP
  Transport

* "``-t``" runs in piped mode with no feedback, but theoretically faster,
  though not advised

You can think of the Sendmail Transport as a sort of asynchronous SMTP
Transport -- though if you have problems with delivery failures you should try
using the SMTP Transport instead. Swift Mailer isn't doing the work here, it's
simply passing the work to somebody else (i.e. ``sendmail``).

Using the Sendmail Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To use the Sendmail Transport you simply need to call ``new
Swift_SendmailTransport()`` with the command as a parameter.

To use the Sendmail Transport you need to know where ``sendmail`` or another
MTA exists on the server. Swift Mailer uses a default value of
``/usr/sbin/sendmail``, which should work on most systems.

You specify the entire command as a parameter (i.e. including the command line
flags). Swift Mailer supports operational modes of "``-bs``" (default) and
"``-t``".

.. note::

    If you run sendmail in "``-t``" mode you will get no feedback as to whether
    or not sending has succeeded. Use "``-bs``" unless you have a reason not to.

A sendmail process will be started upon the first call to ``send()``. If the
process cannot be started successfully an Exception of type
``Swift_TransportException`` will be thrown::

    // Create the Transport
    $transport = new Swift_SendmailTransport('/usr/sbin/exim -bs');

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

Available Methods for Sending Messages
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The Mailer class offers one method for sending Messages -- ``send()``.

When a message is sent in Swift Mailer, the Mailer class communicates with
whichever Transport class you have chosen to use.

Each recipient in the message should either be accepted or rejected by the
Transport. For example, if the domain name on the email address is not
reachable the SMTP Transport may reject the address because it cannot process
it. ``send()`` will return an integer indicating the number of accepted
recipients.

.. note::

    It's possible to find out which recipients were rejected -- we'll cover that
    later in this chapter.

Using the ``send()`` Method
...........................

The ``send()`` method of the ``Swift_Mailer`` class sends a message using
exactly the same logic as your Desktop mail client would use. Just pass it a
Message and get a result.

The message will be sent just like it would be sent if you used your mail
client. An integer is returned which includes the number of successful
recipients. If none of the recipients could be sent to then zero will be
returned, which equates to a boolean ``false``. If you set two
``To:`` recipients and three ``Bcc:`` recipients in the message and all of the
recipients are delivered to successfully then the value 5 will be returned::

    // Create the Transport
    $transport = new Swift_SmtpTransport('localhost', 25);

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Wonderful Subject'))
      ->setFrom(['john@doe.com' => 'John Doe'])
      ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
      ->setBody('Here is the message itself')
      ;

    // Send the message
    $numSent = $mailer->send($message);

    printf("Sent %d messages\n", $numSent);

    /* Note that often that only the boolean equivalent of the
       return value is of concern (zero indicates FALSE)

    if ($mailer->send($message))
    {
      echo "Sent\n";
    }
    else
    {
      echo "Failed\n";
    }

    */

Sending Emails in Batch
.......................

If you want to send a separate message to each recipient so that only their own
address shows up in the ``To:`` field, follow the following recipe:

* Create a Transport from one of the provided Transports --
  ``Swift_SmtpTransport``, ``Swift_SendmailTransport``,
  or one of the aggregate Transports.

* Create an instance of the ``Swift_Mailer`` class, using the Transport as
  it's constructor parameter.

* Create a Message.

* Iterate over the recipients and send message via the ``send()`` method on
  the Mailer object.

Each recipient of the messages receives a different copy with only their own
email address on the ``To:`` field.

Make sure to add only valid email addresses as recipients. If you try to add an
invalid email address with ``setTo()``, ``setCc()`` or ``setBcc()``, Swift
Mailer will throw a ``Swift_RfcComplianceException``.

If you add recipients automatically based on a data source that may contain
invalid email addresses, you can prevent possible exceptions by validating the
addresses using ``Swift_Validate::email($email)`` and only adding addresses
that validate. Another way would be to wrap your ``setTo()``, ``setCc()`` and
``setBcc()`` calls in a try-catch block and handle the
``Swift_RfcComplianceException`` in the catch block.

Handling invalid addresses properly is especially important when sending emails
in large batches since a single invalid address might cause an unhandled
exception and stop the execution or your script early.

.. note::

    In the following example, two emails are sent. One to each of
    ``receiver@domain.org`` and ``other@domain.org``. These recipients will
    not be aware of each other::

        // Create the Transport
        $transport = new Swift_SmtpTransport('localhost', 25);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Wonderful Subject'))
          ->setFrom(['john@doe.com' => 'John Doe'])
          ->setBody('Here is the message itself')
          ;

        // Send the message
        $failedRecipients = [];
        $numSent = 0;
        $to = ['receiver@domain.org', 'other@domain.org' => 'A name']