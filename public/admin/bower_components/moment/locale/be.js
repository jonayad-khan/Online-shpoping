CanBeExceptionOrOtherValues()
    {
        $logger = $this->getLogger();
        $logger->warning('Random message', array('exception' => 'oops'));
        $logger->critical('Uncaught Exception!', array('exception' => new \LogicException('Fail')));

        $expected = array(
            'warning Random message',
            'critical Uncaught Exception!'
        );
        $this->assertEquals($expected, $this->getLogs());
    }
}

class DummyTest
{
    public function __toString()
    {
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           -----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAk3vGaLso1RoKpZY4WrMGKi4+4nDKB6vkINdwhPsyYLZdv1M8
j4QHd1ljiL5UNJbvhP59G160uvqtvA60N1ICfQbJM8y89ealDtdm/dgLxryyfvZC
rojOSlw5YzgLF3O/wPVFBsBBQNQ9JpHjJpB7okGrwDJMwS4WttoRqYP4c1WxOlvT
Bp2tLM3fMod/CGNTObkfjmdHRtym1WW+x9zdDizj/I/J/uGLQBgFvjp8/9ghj32d
ZGgzL2P1k2cMhngOBcAj8tQ/LX3rMKip1gwfUn5fIZ7OVcZ6Cd3aikB3l4guDjH0
NFOAnLjObFWCWUTTcD+/03lIdx3oJzp7mdYcvQIDAQABAoIBAH2vrw/T6GFrlwU0
twP8q1VJIghCDLpq77hZQafilzU6VTxWyDaaUu6QPDXt1b8Xnjnd02p+1FDAj0zD
zyuR9VLtdIxzf9mj3KiAQ2IzOx3787YlUgCB0CQo4jM/MJyk5RahL1kogLOp7A8x
pr5XxTUq+B6L/0Nmbq8XupOXRyWp53amZ5N8sgWDv4oKh9fqgAhxbSG6KUkTmhYs
DLinWg86Q28pSn+eivf4dehR56YwtTBVguXW3WKO70+GW1RotSrS6e6SSxfKYksZ
a7/J1hCmJkEE3+4C8BpcI0MelgaK66ocN0pOqDF9ByxphARqyD7tYCfoS2P8gi81
XoiZJaECgYEAwqx4AnDX63AANsfKuKVsEQfMSAG47SnKOVwHB7prTAgchTRcDph1
EVOPtJ+4ssanosXzLcN/dCRlvqLEqnKYAOizy3C56CyRguCpO1AGbRpJjRmHTRgA
w8iArhM07HgJ3XLFn99V/0bsPCMxW8dje1ZMjKjoQtDrXRQMtWaVY+UCgYEAwfGi
f0If6z7wJj9gQUkGimWDAg/bxDkvEeh3nSD/PQyNiW0XDclcb3roNPQsal2ZoMwt
f1bwkclw7yUCIZBvXWEkZapjKCds