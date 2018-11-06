Sending Messages
================

Quick Reference for Sending a Message
-------------------------------------

Sending a message is very straightforward. You create a Transport, use it to
create the Mailer, then you use the Mailer to send the message.

When using ``send()`` the message will be sent just like it would be sent if
you used your mail client. An integer is returned which includes the number of
successful recipients. If none of the recipients could be sent to then zero
will be returned, which equates to a boolean ``false``. If you set two ``To:``
recipients and three ``Bcc:`` recipients in the message and all of the
recipients are delivered to successfully then the value 5 will be returned::

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
      ->setUsername('your username')
      ->setPassword('your password')
      ;

    /*
    You could alternatively use a different transport such as Sendmail:

    // Sendmail
    $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
    */
