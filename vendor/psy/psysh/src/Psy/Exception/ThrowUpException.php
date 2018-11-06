     $this->assertEquals($message->getTo(), ['lars-to@internal.com' => 'Lars (To)', 'god@example.com' => null]);
        $this->assertEquals($message->getCc(), ['lars-cc@internal.org' => 'Lars (Cc)']);
        $this->assertEquals($message->getBcc(), ['john-bcc@example.org' => 'John (Bcc)']);

        $plugin->sendPerformed($evt);

        $this->assertEquals($message->getTo(), $to);
        $this->assertEquals($message->getCc(), $cc);
        $this->assertEquals($message->getBcc(), $bcc);
    }

    public function testArrayOfRecipientsCanBeExplicitlyDefined()
    {
        $message = (new Swift_Message())
            ->setSubject('...')
            ->setFrom(['john@example.com' => 'John Doe'])
            ->setTo([
            'fabien@example.com' => 'Fabien',
            'chris@example.com' => 'Chris (To)',
            'lars-to@internal.com' => 'Lars (To)',
        ])
        