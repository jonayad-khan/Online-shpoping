<?php


class Swift_Mime_AttachmentTest extends Swift_Mime_AbstractMimeEntityTest
{
    public function testNestingLevelIsAttachment()
    {
        $attachment = $this->createAttachment($this->createHeaderSet(),
            $this->createEncoder(), $this->createCache()
            );
        $this->assertEquals(
            Swift_Mime_SimpleMimeEntity::LEVEL_MIXED, $attachment->getNestingLevel()
            );
    }

    public function testDispositionIsReturnedFromHeader()
    {
        /* -- RFC 2183, 2.1, 2.2.
     */

        $disposition = $this->createHeader('Content-Disposition', 'attachment');
        $attachment = $this->createAttachment($this->createHeaderS