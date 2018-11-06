<?php

use Egulias\EmailValidator\EmailValidator;

class Swift_Signers_DKIMSignerTest extends \SwiftMailerTestCase
{
    public function testBasicSigningHeaderManipulation()
    {
        $headers = $this->createHeaders();
        $messageContent = 'Hello World';
        $signer = new Swift_Signers_DKIMSigner(file_get_contents(dirname(dirname(dirname(__DIR__))).'/_samples/dkim/dkim.test.priv'), 'dummy.nxdomain.be', 'dummySelector');
        /* @var $signer Swift_Signers_HeaderSigner */
        $altered = $signer->getAlteredHeaders();
        $signer->reset();
        // Headers
        $signer->setHeaders($headers);
        // Body
        $signer->startBody();
        $signer->write($messageContent);
        $signer->endBody();
        // Signing
        $signer->addSignature($headers);
    }

    // SHA1 Signing
    public function testSigningSHA1()
    {
        $headerSet = $this->createHeaderSet();
        $messageContent = 'Hello World';
        $signer = new Swift_Signers_DKIMSigner(file_get_contents(dirname(dirname(dirname(__DIR__))).'/_samples/dkim/dkim.test.priv'), 'dummy.nxdomain.be', 'dummySelector');
        $signer->setHashAlgorithm('rsa-sha1');
        $signer->setSignatureTimestamp('1299879181');
        $altered = $signer->getAlteredHeaders();
        $this->assertEquals(['DKIM-Signature'], $altered);
        $signer->reset();
        $signer->setHeaders($headerSet);
        $this->assertFalse($headerSet->has('DKIM-Signature'));
        $signer->startBody();
        $signer->write($messageContent);
        $signer->endBody();
        $signer->addSignature($headerSet);
        $this->assertTrue($headerSet->has('DKIM-Signature'));
        $dkim = $headerSet->getAll('DKIM-Signature');
        $sig = reset($dkim);
        $this->assertEquals($sig->getValue(), 'v=1; a=rsa-sha1; bh=wlbYcY9O9OPInGJ4D0E/rGsvMLE=; d=dummy.nxdomain.be; h=; i=@dummy.nxdomain.be; s=dummySelector; t=1299879181; b=RMSNelzM2O5MAAnMjT3G3/VF36S3DGJXoPCXR001F1WDReu0prGphWjuzK/m6V1pwqQL8cCNg Hi74mTx2bvyAvmkjvQtJf1VMUOCc9WHGcm1Yec66I3ZWoNMGSWZ1EKAm2CtTzyG0IFw4ml9DI wSkyAFxlgicckDD6FibhqwX4w=');
    }

    // SHA256 Signing
    public function testSigning256()
    {
        $headerSet = $this->createHeaderSet();
        $messageContent = 'Hello World';
        $signer = new Swift_Signers_DKIMSigner(file_get_contents(dirname(dirname(dirname(__DIR__))).'/_samples/dkim/dkim.test.priv'), 'dummy.nxdomain.be', 'dummySelector');
        $signer->setHashAlgorithm('rsa-sha256');
        $signer->setSignatureTimestamp('1299879181');
        $altered = $signer->getAlteredHeaders();
        $this->assertEquals(['DKIM-Signature'], $altered);
        $signer->reset();
        $signer->setHeaders($headerSet);
        $this->assertFalse($headerSet->has('DKIM-Signature'));
        $signer->startBody();
        $signer->write($messageContent);
        $signer->endBody();
        $signer->addSignature($headerSet);
        $this->assertTrue($headerSet->has('DKIM-Signature'));
        $dkim = $headerSet->getAll('DKIM-Signature');
        $sig = reset($dkim);
        $this->assertEquals($sig->getValue(), 'v=1; a=rsa-sha256; bh=f+W+hu8dIhf2VAni89o8lF6WKTXi7nViA4RrMdpD5/U=; d=dummy.nxdomain.be; h=; i=@dummy.nxdomain.be; s=dummySelector; t=1299879181; b=jqPmieHzF5vR9F4mXCAkowuphpO4iJ8IAVuioh1BFZ3VITXZj5jlOFxULJMBiiApm2keJirnh u4mzogj444QkpT3lJg8/TBGAYQPdcvkG3KC0jdyN6QpSgpITBJG2BwWa+keXsv2bkQgLRAzNx qRhP45vpHCKun0Tg9LrwW/KCg=');
    }

    // Relaxed/Relaxed Hash Signing
    public function testSigningRelaxedRelaxed256()
    {
        $headerSet = $this->createHeaderSet();
        $messageContent = 'Hello World';
        $signer = new Swift_Signers_DKIMSigner(file_get_contents(dirname(dirname(dirname(__DIR__))).'/_samples/dkim/dkim.test.priv'), 'dummy.nxdomain.be', 'dummySelector');
        $signer->setHashAlgorithm('rsa-sha256');
        $signer->setSignatureTimestamp('1299879181');
        $signer->setBodyCanon('relaxed');
        $signer->setHeaderCanon('relaxed');
        $altered = $signer->getAlteredHeaders();
        $this->assertEquals(['DKIM-Signature'], $altered);
        $signer->reset();
        $signer->setHeaders($headerSet);
        $this->assertFalse($headerSet->has('DKIM-Signature'));
        $signer->startBody();
        $signer->write($messageContent);
        $signer->endBody();
        $signer->addSignature($headerSet);
        $this->assertTrue($headerSet->has('DKIM-Signature'));
        $dkim = $headerSet->getAll('DKIM-Signature');
        $sig = reset($dkim);
        $this->assertEquals($sig->getValue(), 'v=1; a=rsa-sha256; bh=f+W+hu8dIhf2VAni89o8lF6WKTXi7nViA4RrMdpD5/U=; d=dummy.nxdomain.be; h=; i=@dummy.nxdomain.be; s=dummySelector; c=relaxed/relaxed; t=1299879181; b=gzOI+PX6HpZKQFzwwmxzcVJsyirdLXOS+4pgfCpVHQIdqYusKLrhlLeFBTNoz75HrhNvGH6T0 Rt3w5aTqkrWfUuAEYt0Ns14GowLM7JojaFN+pZ4eYnRB3CBBgW6fee4NEMD5WPca3uS09tr1E 10RYh9ILlRtl+84sovhx5id3Y=');
    }

    // Relaxed/Simple Hash Signing
    public function testSigningRelaxedSimple256()
    {
        $headerSet = $this->createHeaderSet();
        $messageContent = 'Hello World';
        $signer = new Swift_Signers_DKIMSigner(file_get_contents(dirname(dirname(dirname(__DIR__))).'/_samples/dkim/dkim.test.priv'), 'dummy.nxdomain.be', 'dummySelector');
        $signer->setHashAlgorithm('rsa-sha256');
        $signer->setSignatureTimestamp('1299879181');
        $signer->setHeaderCanon('relaxed');
        $altered = $signer->getAlteredHeaders();
        $this->assertEquals(['DKIM-Signature'], $altered);
        $signer->reset();
        $signer->setHeaders($headerSet);
        $this->assertFalse($headerSet->has('DKIM-Signature'));