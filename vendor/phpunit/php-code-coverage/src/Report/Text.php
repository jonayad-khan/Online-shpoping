IP file, the mail client should just present the attachment as
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
content without having an existing file available.

The embedded files are sent in the email as a special type of attachment that
has a unique ID used to reference them within your HTML attributes. On mail
clients that do not support embedded files they may appear as attachments.

Although this is commonly done for images, in theory it will work for any
displayable (or playable) media type. Support for other media types (such as
video) is dependent on the mail client however.

Embedding Existing Files
........................

Files that already exist, either on disk or at a URL can be embedded in a
message with just one line of code, using ``Swift_EmbeddedFile::fromPath()``.

You can embed files that exist locally, or if your PHP installation has
``allow_url_fopen`` turned on you can embed files from other websites.

The file will be displayed with the message inline with the HTML wherever its ID
is used as a ``src`` attribute::

    // Create the message
    $message = new Swift_Message('My subject');

    // Set the body
    $message->setBody(
    '<html>' .
    ' <body>' .
    '  Here is an image <img src="' . // Embed the file
         $message->embed(Swift_Image::fromPath('image.png')) .
       '" alt="Image" />' .
    '  Rest of message' .
    ' </body>' .
    '</html>',
      'text/html' // Mark the content-type as HTML
    );

    // You can embed files from a URL if allow_url_fopen is on in php.ini
    $message->setBody(
    '<html>' .
    ' <body>' .
    '  Here is an image <img src="' .
         $message->embed(Swift_Image::fromPath('http://site.tld/logo.png')) .
       '" alt="Image" />' .
    '  Rest of message' .
    ' </body>' .
    '</html>',
      'text/html'
    );

.. note::

    ``Swift_Image`` and ``Swift_EmbeddedFile`` are just aliases of one another.
    ``Swift_Image`` exists for semantic purposes.

.. note::

    You can embed files in two stages if you prefer. Just capture the return
    value of ``embed()`` in a variable and use that as the ``src`` attribute::

        // If placing the embed() code inline becomes cumbersome
        // it's easy to do this in two steps
        $cid = $message->embed(Swift_Image::fromPath('image.png'));

        $message->setBody(
        '<html>' .
        ' <body>' .
        '  Here is an image <img src="' . $cid . '" alt="Image" />' .
        '  Rest of message' .
        ' </body>' .
        '</html>',
          'text/html' // Mark the content-type as HTML
        );

Embedding Dynamic Content
.........................

Images that are generated at runtime, such as images created via GD can be
embedded directly to a message without writing them out to disk. Use the
standard ``new Swift_Image()`` method.

The file will be displayed with the message inline with the HTML wherever its ID
is used as a ``src`` attribute::

    // Create your file contents in the normal way, but don't write them to disk
    $img_data = create_my_image_data();

    // Create the message
    $message = new Swift_Message('My subject');

    // Set the body
    $message->setBody(
    '<html>' .
    ' <body>' .
    '  Here is an image <img src="' . // Embed the file
         $message->embed(new Swift_Image($img_data, 'image.jpg', 'image/jpeg')) .
       '" alt="Image" />' .
    '  Rest of message' .
    ' </body>' .
    '</html>',
      'text/html' // Mark the content-type as HTML
    );

.. note::

    ``Swift_Image`` and ``Swift_EmbeddedFile`` are just aliases of one another.
    ``Swift_Image`` exists for semantic purposes.

.. note::

    You can embed files in two stages if you prefer. Just capture the return
    value of ``embed()`` in a variable and use that as the ``src`` attribute::

        // If placing the embed() code inline becomes cumbersome
        // it's easy to do this in two steps
        $cid = $message->embed(new Swift_Image($img_data, 'image.jpg', 'image/jpeg'));

        $message->setBody(
        '<html>' .
        ' <body>' .
        '  Here is an image <img src="' . $cid . '" alt="Image" />' .
        '  Rest of message' .
        ' </body>' .
        '</html>',
          'text/html' // Mark the content-type as HTML
        );

Adding Recipients to Your Message
---------------------------------

Recipients are specified within the message itself via ``setTo()``, ``setCc()``
and ``setBcc()``. Swift Mailer reads these recipients from the message when it
gets sent so that it knows where to send the message to.

Message recipients are one of three types:

* ``To:`` recipients -- the primary recipients (required)

* ``Cc:`` recipients -- receive a copy of the message (optional)

* ``Bcc:`` recipients -- hidden from other recipients (optional)

Each type can contain one, or several addresses. It's possible to list only the
addresses of the recipients, or you can personalize the address by providing
the real name of the recipient.

Make sure to add only valid email addresses as recipients. If you try to add an
invalid email address with ``setTo()``, ``setCc()`` or ``setBcc()``, Swift
Mailer will throw a ``Swift_RfcComplianceException``.

If you add recipients automatically based on a data source that may contain
invalid email addresses, you can prevent possible exceptions by validating the
addresses using::
        use Egulias\EmailValidator\EmailValidator;
        use Egulias\EmailValidator\Validation\RFCValidation;

        $validator = new EmailValidator();
        $validator->isValid("example@example.com", new RFCValidation()); //true
and only adding addresses that validate. Another way would be to wrap your ``setTo()``, ``setCc()`` and
``setBcc()`` calls in a try-catch block and handle the
``Swift_RfcComplianceException`` in the catch block.

.. sidebar:: Syntax for Addresses

    If you only wish to refer to a single email address (for example your
    ``From:`` address) then you can just use a string::

          $message->setFrom('some@address.tld');

    If you want to include a name then you must use an associative array::

         $message->setFrom(['some@address.tld' => 'The Name']);

    If you want to include multiple addresses then you must use an array::

         $message->setTo(['some@address.tld', 'other@address.tld']);

    You can mix personalized (addresses with a name) and non-personalized
    addresses in the same list by mixing the use of associative and
    non-associative array syntax::

         $message->setTo([
           'recipient-with-name@example.org' => 'Recipient Name One',
           'no-name@example.org', // Note that this is not a key-value pair
           'named-recipient@example.org' => 'Recipient Name Two'
         ]);

Setting ``To:`` Recipients
~~~~~~~~~~~~~~~~~~~~~~~~~~

``To:`` recipients are required in a message and are set with the ``setTo()``
or ``addTo()`` methods of the message.

To set ``To:`` recipients, create the message object using either ``new
Swift_Message( ... )`` or ``new Swift_Message( ... )``, then call the
``setTo()`` method with a complete array of addresses, or use the ``addTo()``
method to iteratively add recipients.

The ``setTo()`` method accepts input in various formats as described earlier in
this chapter. The ``addTo()`` method takes either one or two parameters. The
first being the email address and the second optional parameter being the name
of the recipient.

``To:`` recipients are visible in the message headers and will be seen by the
other recipients::

    // Using setTo() to set all recipients in one go
    $message->setTo([
      'person1@example.org',
      'person2@otherdomain.org' => 'Person 2 Name',
      'person3@example.org',
      'person4@example.org',
      'person5@example.org' => 'Person 5 Name'
    ]);

.. note::

    Multiple 