Message Headers
===============

Sometimes you'll want to add your own headers to a message or modify/remove
headers that are already present. You work with the message's HeaderSet to do
this.

Header Basics
-------------

All MIME entities in Swift Mailer -- including the message itself -- store
their headers in a single object called a HeaderSet. This HeaderSet is
retrieved with the ``getHeaders()`` method.

As mentioned in the previous chapter, everything that forms a part of a message
in Swift Mailer is a MIME entity that is represented by an instance of
``Swift_Mime_SimpleMimeEntity``. This includes -- most notably -- the message
object itself, attachments, MIME parts and embedded images. Each of these MIME
entities consists of a body and a set of headers that describe the body.

For all of the "standard" headers in these MIME entities, such as the
``Content-Type``, there are named methods for working with them, such as
``setContentType()`` and ``getContentType()``. This is because headers are a
moderately complex area of the library. Each header has a slightly different
required structure that it must meet in order to comply with the standards that
govern email (and that are checked by spam blockers etc).

You fetch the HeaderSet from a MIME entity like so::

    $message = new Swift_Message();

    // Fetch the HeaderSet from a Message object
    $headers = $message->getHeaders();

    $attachment = Swift_Attachment::fromPath('document.pdf');

    // Fetch the HeaderSet from an attachment object
    $headers = $attachment->getHeaders();

The job of the HeaderSet is to contain and manage instances of Header objects.
Depending upon the MIME entity the HeaderSet came from, the contents of the
HeaderSet will be different, since an attachment for example has a different
set of headers to those in a message.

You can find out what the HeaderSet contains with a quick loop, dumping out the
names of the headers::

    foreach ($headers->getAll() as $header) {
      printf("%s<br />\n", $header->getFieldName());
    }

    /*
    Content-Transfer-Encoding
    Content-Type
    MIME-Version
    Date
    Message-ID
    From
    Subject
    To
    */

You can also dump out the rendered HeaderSet by calling its ``toString()``
method::

    echo $headers->toString();

    /*
    Message-ID: <1234869991.499a9ee7f1d5e@swift.generated>
    Date: Tue, 17 Feb 2009 22:26:31 +1100
    Subject: Awesome subject!
    From: sender@example.org
    To: recipient@example.org
    MIME-Version: 1.0
    Content-Type: text/plain; charset=utf-8
    Content-Transfer-Encoding: quoted-printable
    */

Where the complexity comes in is when you want to modify an existing header.
This complexity comes from the fact that each header can be of a slightly
different type (such as a Date header, or a header th