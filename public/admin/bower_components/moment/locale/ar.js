-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEA0oBIX7V+n9cFfrqlpeCfs8Ap/Hx2i2U+hmdBrPU4ROHvuJpC
xta70hCCaJ/FNInPGaYdVBmtRq73oeW4G5XR5RcWErAgsgxoIsUb0VjYSCrjvksW
iGQoaqisFZ92jUOAWTkqPzIyf40Mq/QTIDJncZR0d3tcJJHgJFv/7DrH7sUBhdYf
cnkL7rvxmxuiu7x0hjhneTtxu237X0O5e/EzKnie41d9gHSXrjuTA+HUZ1uAkC02
nq4myzdDCp9+VHUohaGcSh6qlnILZecXCVjzpqugrACdhKPdJFvwRzqy79dIejmp
/UdT3V0r0gr1Z12Nys99M6H8N9OaAPyiZP4VcwIDAQABAoIBAQDLJiKyu2XIvKsA
8wCKZY262+mpUjTVso/1BhHL6Zy0XZgMgFORsgrxYB16+zZGzfiguD/1uhIP9Svn
gtt7Q8udW/phbrkfG/okFDYUg7m3bCz+qVjFqGOZC8+Hzq2LB2oGsbSj6L3zexyP
lq4elIZghvUfml4CrQW0EVWbld79/kF7XHABcIOk2+3f63XAQWkjdFNxj5+z6TR0
52Rv7SmRioAsukW9wr77G3Luv/0cEzDFXgGW5s0wO+rJg28smlsIaj+Y0KsptTig
reQvReAT/S5ZxEp4H6WtXQ1WmaliMB0Gcu4TKB0yE8DoTeCePuslo9DqGokXYT66
oqtcVMqBAoGBAPoOL9byNNU/bBNDWSCiq8PqhSjl0M4vYBGqtgMXM4GFOJU+W2nX
YRJbbxoSd/DKjnxEsR6V0vDTDHj4ZSkgmpEmVhEdAiwUwaZ0T8YUaCPhdiAENo5+
zRBWVJcvAC2XKTK1hy5D7Z5vlC32HHygYqitU+JsK4ylvhrdeOcGx5cfAoGBANeB
X0JbeuqBEwwEHZqYSpzmtB+IEiuYc9ARTttHEvIWgCThK4ldAzbXhDUIQy3Hm0sL
PzDA33furNl2WwB+vmOuioYMNjArKrfg689Aim1byg4AHM5XVQcqoDSOABtI55iP
E0hYDe/d4ema2gk1uR/mT4pnLnk2VzRKsHUbP9stAoGBAKjyIuJwPMADnMqbC0Hg
hnrVHejW9TAJlDf7hgQqjdMppmQ3gF3PdjeH7VXJOp5GzOQrKRxIEABEJ74n3Xlf
HO+K3kWrusb7syb6mNd0/DOZ5kyVbCL0iypJmdeXmuAyrFQlj9LzdD1Cl/RBv1d4
qY/bo7xsZzQc24edMU2uJ/XzAoGBAMHChA95iK5HlwR6vtM8kfk4REMFaLDhxV8R
8MCeyp33NQfzm91JT5aDd07nOt9yVGHInuwKveFrKuXq0C9FxZCCYfHcEOyGI0Zo
aBxTfyKMIMMtvriXNM/Yt2oJMndVuUUlfsTQxtcfu/r5S4h0URopTOK3msVI4mcV
sEnaUjORAoGAGDnslKYtROQMXTe4sh6CoJ32J8UZVV9M+8NLus9rO0v/eZ/pIFxo
MXGrrrl51ScqahCQ+DXHzpLvInsdlAJvDP3ymhb7H2xGsyvb3x2YgsLmr1YVOnli
ISbCssno3vZyFU1TDjeEIKqZHc92byHNMjMuhmlaA25g8kb0cCO76EA=
-----END RSA PRIVATE KEY-----
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use PhpConsole\Connector;
use PhpConsole\Handler;
use PhpConsole\Helper;

/**
 * Monolog handler for Google Chrome extension "PHP Console"
 *
 * Display PHP error/debug log messages in Google Chrome console and notification popups, executes PHP code remote