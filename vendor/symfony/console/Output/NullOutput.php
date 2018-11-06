e SMTP servers -- Google for example -- use encryption for security reasons.
Swift Mailer supports using both SSL and TLS encryption settings.

Using the SMTP Transport
^^^^^^^^^^^^^^^^^^^^^^^^

The SMTP Transport is easy to use. Most configuration options can be set with
the constructor.

To use the SMTP Transport you need to know which SMTP server your code needs to
connect to. Ask your web host if you're not sure. Lots of people ask me who to
connect to -- I really can't answer that since it's a setting that's extremely
specific to your hosting environment.

A connection to the SMTP server will be established upon the first call to
``send()``::

    // Create the Transport
    $transport = new Swift_SmtpTransport('smtp.example.org', 25);

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    /*
    It's also possible to use multiple method calls

    $transport = (new Swift_SmtpTransport())
      ->setHost('smtp.example.org')
      ->setPort(25)
      ;
    */

Encrypted SMTP
^^^^^^^^^^^^^^

You can use SSL or TLS encryption with the SMTP Transport by specifying it as a
parameter or with a method call::

    // Create the Transport
    $transport = new Swift_SmtpTransport('smtp.example.org', 587, 'ssl');

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

A connection to the SMTP server will be established upon the first call to
``send()``. The connection will be initiated with the correct encryption
settings.

.. note::

    For SSL or TLS encryption to work your PHP installation must have
    appropriate OpenSSL transports wrappers. You can check if "tls" and/or
    "ssl" are present in your PHP installation by using the PHP function
    ``stream_get_transports()``.

SMTP with a Username and Password
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Some servers require authentication. You can provide a username and password
with ``setUsername()`` and ``setPassword()`` methods::

    // Create the Transport the call setUsername() and setPassword()
    $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
      ->setUsername('u