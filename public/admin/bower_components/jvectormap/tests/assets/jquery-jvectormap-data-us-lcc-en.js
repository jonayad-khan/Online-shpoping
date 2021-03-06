 new Swift_ByteStream_ArrayByteStream();

        $message->toByteStream($streamA);
        $message->toByteStream($streamB);

        $this->assertPatternInStream($pattern, $streamA);
        $this->assertPatternInStream($pattern, $streamB);
    }

    public function testWritingMessageToByteStreamTwiceUsingAFileAttachment()
    {
        $message = new Swift_Message();
        $message->setSubject('test subject');
        $message->setTo('user@domain.tld');
        $message->setCc('other@domain.tld');
        $message->setFrom('user@domain.tld');

        $attachment = Swift_Attachment::fromPath($this->attFile);

        $message->attach($attachment);

        $message->setBody('HTML part', 'text/html');

        $id = $message->getId();
        $date = preg_quote($message->getDate()->format('r'), '~');
        $boundary = $message->getBoundary();

        $streamA = new Swift_ByteStream_ArrayByteStream();
        $streamB = new Swift_ByteStream_ArrayByteStream();

        $pattern = '~^'.
            'Message-ID: <'.$id.'>'."\r\n".
            'Date: '.$date."\r\n".
            'Subject: test subject'."\r\n".
            'From: user@domain.tld'."\r\n".
            'To: user@domain.tld'."\r\n".
            'Cc: other@domain.tld'."\r\n".
            'MIME-Version: 1.0'."\r\n".
            'Content-Type: multipart/mixed;'."\r\n".
            ' boundary="'.$boundary.'"'."\r\n".
            "\r\n\r\n".
            '--'.$boundary."\r\n".
            'Content-Type: text/html; charset=utf-8'."\r\n".
            'Content-Transfer-Encoding: quoted-printable'."\r\n".
            "\r\n".
            'HTML part'.
            "\r\n\r\n".
            '--'.$boundary."\r\n".
            'Content-Type: '.$this->attFileType.'; name='.$this->attFileName."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-Disposition: attachment; filename='.$this->attFileName."\r\n".
            "\r\n".
            preg_quote(base64_encode(file_get_contents($this->attFile)), '~').
            "\r\n\r\n".
            '--'.$boundary.'--'."\r\n".
            '$~D'
            ;

        $message->toByteStream($streamA);
        $message->toByteStream($streamB);

        $this->assertPatternInStream($pattern, $streamA);
        $this->assertPatternInStream($pattern, $streamB);
    }

    public function assertPatternInStream($pattern, $stream, $message = '%s')
    {
        $string = '';
        while (false !== $bytes = $stream->read(8192)) {
            $string .= $bytes;
        }
        $this->assertRegExp($pattern, $string, $message);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   //
// Jumbotron
// --------------------------------------------------


.jumbotron {
  padding-top:    @jumbotron-padding;
  padding-bottom: @jumbotron-padding;
  margin-bottom: @jumbotron-padding;
  color: @jumbotron-color;
  background-color: @jumbotron-bg;

  h1,
  .h1 {
    color: @jumbotron-heading-color;
  }

  p {
    margin-bottom: (@jumbotron-padding / 2);
    font-size: @jumbotron-font-size;
    font-weight: 200;
  }

  > hr {
    border-top-color: darken(@jumbotron-bg, 10%);
  }

  .container &,
  .container-fluid & {
    border-radius: @border-radius-large; // Only round corners at higher resolutions if contained in a container
    padding-left:  (@grid-gutter-width / 2);
    padding-right: (@grid-gutter-width / 2);
  }

  .container {
    max-width: 100%;
  }

  @media screen and (min-width: @screen-sm-min) {
    padding-top:    (@jumbotron-padding * 1.6);
    padding-bottom: (@jumbotron-padding * 1.6);

    .container &,
    .container-fluid & {
      padding-left:  (@jumbotron-padding * 2);
      padding-right: (@jumbotron-padding * 2);
    }

    h1,
    .h1 {
      font-size: @jumbotron-heading-font-size;
    }
  }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.plugins.setLang("specialchar","nl",{euro:"Euro-teken",lsquo:"Linker enkel aanhalingsteken",rsquo:"Rechter enkel aanhalingsteken",ldquo:"Linker dubbel aanhalingsteken",rdquo:"Rechter dubbel aanhalingsteken",ndash:"En dash",mdash:"Em dash",iexcl:"Omgekeerd uitroepteken",cent:"Cent-teken",pound:"Pond-teken",curren:"Valuta-teken",yen:"Yen-teken",brvbar:"Gebroken streep",sect:"Paragraaf-teken",uml:"Trema",copy:"Copyright-teken",ordf:"Vrouwelijk ordinaal",laquo:"Linker guillemet",not:"Ongelijk-teken",
reg:"Geregistreerd handelsmerk-teken",macr:"Macron",deg:"Graden-teken",sup2:"Superscript twee",sup3:"Superscript drie",acute:"Accent aigu",micro:"Micro-teken",para:"Alinea-teken",middot:"Halfhoge punt",cedil:"Cedille",sup1:"Superscript een",ordm:"Mannelijk ordinaal",raquo:"Rechter guillemet",frac14:"Breuk kwart",frac12:"Breuk half",frac34:"Breuk driekwart",iquest:"Omgekeerd vraagteken",Agrave:"Latijnse hoofdletter A met een accent grave",Aacute:"Latijnse hoofdletter A met een accent aigu",Acirc:"Latijnse hoofdletter A met een circonflexe",
Atilde:"Latijnse hoofdletter A met een tilde",Auml:"Latijnse hoofdletter A met een trema",Aring:"Latijnse hoofdletter A met een corona",AElig:"Latijnse hoofdletter Æ",Ccedil:"Latijnse hoofdletter C met een cedille",Egrave:"Latijnse hoofdletter E met een accent grave",Eacute:"Latijnse hoofdletter E met een accent aigu",Ecirc:"Latijnse hoofdletter E met een circonflexe",Euml:"Latijnse hoofdletter E met een trema",Igrave:"Latijnse hoofdletter I met een accent grave",Iacute:"Latijnse hoofdletter I met een accent aigu",
Icirc:"Latijnse hoofdletter I met een circonflexe",Iuml:"Latijnse hoofdletter I met een trema",ETH:"Latijnse hoofdletter Eth",Ntilde:"Latijnse hoofdletter N met een tilde",Ograve:"Latijnse hoofdletter O met een accent grave",Oacute:"Latijnse hoofdletter O met een accent aigu",Ocirc:"Latijnse hoofdletter O met een circonflexe",Otilde:"Latijnse hoofdletter O met een tilde",Ouml:"Latijnse hoofdletter O met een trema",times:"Maal-teken",Oslash:"Latijnse hoofdletter O met een schuine streep",Ugrave:"Latijnse hoofdletter U met een accent grave",
Uacute:"Latijnse hoofdletter U met een accent aigu",Ucirc:"Latijnse hoofdletter U met een circonflexe",Uuml:"Latijnse hoofdletter U met een trema",Yacute:"Latijnse hoofdletter Y met een accent aigu",THORN:"Latijnse hoofdletter Thorn",szlig:"Latijnse kleine ringel-s",agrave:"Latijnse kleine letter a met een accent grave",aacute:"Latijnse kleine letter a met een accent aigu",acirc:"Latijnse kleine letter a met een circonflexe",atilde:"Latijnse kleine letter a met een tilde",auml:"Latijnse kleine letter a met een trema",
aring:"Latijnse kleine letter a met een corona",aelig:"Latijnse kleine letter æ",ccedil:"Latijnse kleine letter c met een cedille",egrave:"Latijnse kleine letter e met een accent grave",eacute:"Latijnse kleine letter e met een accent aigu",ecirc:"Latijnse kleine letter e met een circonflexe",euml:"Latijnse kleine letter e met een trema",igrave:"Latijnse kleine letter i met een accent grave",iacute:"Latijnse kleine letter i met een accent aigu",icirc:"Latijnse kleine letter i met een circonflexe",
iuml:"Latijnse kleine letter i met een trema",eth:"Latijnse kleine letter eth",ntilde:"Latijnse kleine letter n met een tilde",ograve:"Latijnse kleine letter o met een accent grave",oacute:"Latijnse kleine letter o met een accent aigu",ocirc:"Latijnse kleine letter o met een circonflexe",otilde:"Latijnse kleine letter o met een tilde",ouml:"Latijnse kleine letter o met een trema",divide:"Deel-teken",oslash:"Latijnse kleine letter o met een schuine streep",ugrave:"Latijnse kleine letter u met een accent grave",
uacute:"Latijnse kleine letter u met een accent aigu",ucirc:"Latijnse kleine letter u met een circonflexe",uuml:"Latijnse kleine letter u met een trema",yacute:"Latijnse kleine letter y met een accent aigu",thorn:"Latijnse kleine letter thorn",yuml:"Latijnse kleine letter y met een trema",OElig:"Latijnse hoofdletter Œ",oelig:"Latijnse kleine letter œ",372:"Latijnse hoofdletter W met een circonflexe",374:"Latijnse hoofdletter Y met een circonflexe",373:"Latijnse kleine letter w met een circonflexe",
375:"Latijnse kleine letter y met een circonflexe",sbquo:"Lage enkele aanhalingsteken",8219:"Hoge omgekeerde enkele aanhalingsteken",bdquo:"Lage dubbele aanhalingsteken",hellip:"Beletselteken",trade:"Trademark-teken",9658:"Zwarte driehoek naar rechts",bull:"Bullet",rarr:"Pijl naar rechts",rArr:"Dubbele pijl naar rechts",hArr:"Dubbele pijl naar links",diams:"Zwart ruitje",asymp:"Benaderingsteken"});                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 16.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path d="M438.4,192.4c12.2-14.2,19.6-32.3,19.6-52.2c0.1-43.8-35.5-79.6-80.4-82.1c-1.6-0.1-3.1-0.1-4.8-0.1
			c-20.4-0.1-39.1,6.8-53.8,18.1l53.8,52.4l-10.5,10.4c-25.7-19.4-57-32-91-34.9v-0.1c0-8.5-7-15.5-15.5-15.5
			c-8.5,0-15.5,7-15.5,15.5v0.1c-33.9,2.9-65.1,15.5-90.7,34.9l-10.4-10.4l53.8-52.4c-14.7-11.4-33.4-18.2-53.7-18.1
			c-1.6,0-3.2,0.1-4.8,0.1c-45,2.5-80.6,38.3-80.4,82.1c0,19.8,7.4,38,19.6,52.2l54-52.6l9.5,9.5c-35.1,31.9-57.1,78-57.1,129.2
			c0,43.9,16.2,84,43,114.7l-36.4,44.6L99,448l35.2-42.9c31.6,30.2,74.4,48.9,121.6,48.9h0.1c0,0,0.2,0,0.3,0
			c47.2,0,90.2-18.7,121.8-48.9l35.2,43l12.3-10.1L389,393.3c26.8-30.8,43-70.9,43-114.7c0-51.1-22-97.3-57.2-129.3l9.5-9.5
			L438.4,192.4z M76.2,167.8c-4.2-8.6-6.4-18.4-6.5-28c-0.1-35.1,28.4-64.6,65.5-66.8c12.7-0.7,23.1,1.4,32.1,6.1L76.2,167.8z
			 M415.9,276.5c0,87.7-72,157.1-160.1,157.1C167.8,433.6,96,364.2,96,276.5c0-87.7,71.8-158.7,159.9-158.7
			C344,117.8,415.9,188.7,415.9,276.5z M344.7,79.2c8.8-4.8,19.3-6.8,32.1-6.1c37.2,2,65.6,31.5,65.5,66.8c0,9.6-2.3,19.4-6.5,28.1
			L344.7,79.2z"/>
	</g>
	<polygon points="256,160 256,288 160,288 160,304 272,304 272,160 	"/>
</g>
</svg>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           //! moment.js locale configuration
//! locale : Czech [cs]
//! author : petrbela : https://github.com/petrbela

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../moment')) :
   typeof define === 'function' && define.amd ? define(['../moment'], factory) :
   factory(global.moment)
}(this, (function (moment) { 'use strict';


var months = 'leden_únor_březen_duben_květen_červen_červenec_srpen_září_říjen_listopad_prosinec'.split('_');
var monthsShort = 'led_úno_bře_dub_kvě_čvn_čvc_srp_zář_říj_lis_pro'.split('_');
function plural(n) {
    return (n > 1) && (n < 5) && (~~(n / 10) !== 1);
}
function translate(number, withoutSuffix, key, isFuture) {
    var result = number + ' ';
    switch (key) {
        case 's':  // a few seconds / in a few seconds / a few seconds ago
            return (withoutSuffix || isFuture) ? 'pár sekund' : 'pár sekundami';
        case 'm':  // a minute / in a minute / a minute ago
            return withoutSuffix ? 'minuta' : (isFuture ? 'minutu' : 'minutou');
        case 'mm': // 9 minutes / in 9 minutes / 9 minutes ago
            if (withoutSuffix || isFuture) {
                return result + (plural(number) ? 'minuty' : 'minut');
            } else {
                return result + 'minutami';
            }
            break;
        case 'h':  // an hour / in an hour / an hour ago
            return withoutSuffix ? 'hodina' : (isFuture ? 'hodinu' : 'hodinou');
        case 'hh': // 9 hours / in 9 hours / 9 hours ago
            if (withoutSuffix || isFuture) {
                return result + (plural(number) ? 'hodiny' : 'hodin');
            } else {
                return result + 'hodinami';
            }
            break;
        case 'd':  // a day / in a day / a day ago
            return (withoutSuffix || isFuture) ? 'den' : 'dnem';
        case 'dd': // 9 days / in 9 days / 9 days ago
            if (withoutSuffix || isFuture) {
                return result + (plural(number) ? 'dny' : 'dní');
            } else {
                return result + 'dny';
            }
            break;
        case 'M':  // a month / in a month / a month ago
            return (withoutSuffix || isFuture) ? 'měsíc' : 'měsícem';
        case 'MM': // 9 months / in 9 months / 9 months ago
            if (withoutSuffix || isFuture) {
                return result + (plural(number) ? 'měsíce' : 'měsíců');
            } else {
                return result + 'měsíci';
            }
            break;
        case 'y':  // a year / in a year / a year ago
            return (withoutSuffix || isFuture) ? 'rok' : 'rokem';
        case 'yy': // 9 years / in 9 years / 9 years ago
            if (withoutSuffix || isFuture) {
                return result + (plural(number) ? 'roky' : 'let');
            } else {
                return result + 'lety';
            }
            break;
    }
}

var cs = moment.defineLocale('cs', {
    months : months,
    monthsShort : monthsShort,
    monthsParse : (function (months, monthsShort) {
        var i, _monthsParse = [];
        for (i = 0; i < 12; i++) {
            // use custom parser to solve problem with July (červenec)
            _monthsParse[i] = new RegExp('^' + months[i] + '$|^' + monthsShort[i] + '$', 'i');
        }
        return _monthsParse;
    }(months, monthsShort)),
    shortMonthsParse : (function (monthsShort) {
        var i, _shortMonthsParse = [];
        for (i = 0; i < 12; i++) {
            _shortMonthsParse[i] = new RegExp('^' + monthsShort[i] + '$', 'i');
        }
        return _shortMonthsParse;
    }(monthsShort)),
    longMonthsParse : (function (months) {
        var i, _longMonthsParse = [];
        for (i = 0; i < 12; i++) {
            _longMonthsParse[i] = new RegExp('^' + months[i] + '$', 'i');
        }
        return _longMonthsParse;
    }(months)),
    weekdays : 'neděle_pondělí_úterý_středa_čtvrtek_pátek_sobota'.split('_'),
    weekdaysShort : 'ne_po_út_st_čt_pá_so'.split('_'),
    weekdaysMin : 'ne_po_út_st_čt_pá_so'.split('_'),
    longDateFormat : {
        LT: 'H:mm',
        LTS : 'H:mm:ss',
        L : 'DD.MM.YYYY',
        LL : 'D. MMMM YYYY',
        LLL : 'D. MMMM YYYY H:mm',
        LLLL : 'dddd D. MMMM YYYY H:mm',
        l : 'D. M. YYYY'
    },
    calendar : {
        sameDay: '[dnes v] LT',
        nextDay: '[zítra v] LT',
        nextWeek: function () {
            switch (this.day()) {
                case 0:
                    return '[v neděli v] LT';
                case 1:
                case 2:
                    return '[v] dddd [v] LT';
                case 3:
                    return '[ve středu v] LT';
                case 4:
                    return '[ve čtvrtek v] LT';
                case 5:
                    return '[v pátek v] LT';
                case 6:
                    return '[v sobotu v] LT';
            }
        },
        lastDay: '[včera v] LT',
        lastWeek: function () {
            switch (this.day()) {
                case 0:
                    return '[minulou neděli v] LT';
                case 1:
                case 2:
                    return '[minulé] dddd [v] LT';
                case 3:
                    return '[minulou středu v] LT';
                case 4:
                case 5:
                    return '[minulý] dddd [v] LT';
                case 6:
                    return '[minulou sobotu v] LT';
            }
        },
        sameElse: 'L'
    },
    relativeTime : {
        future : 'za %s',
        past : 'před %s',
        s : translate,
        m : translate,
        mm : translate,
        h : translate,
        hh : translate,
        d : translate,
        dd : translate,
        M : translate,
        MM : translate,
        y : translate,
        yy : translate
    },
    dayOfMonthOrdinalParse : /\d{1,2}\./,
    ordinal : '%d.',
    week : {
        dow : 1, // Monday is the first day of the week.
        doy : 4  // The week that contains Jan 4th is the first week of the year.
    }
});

return cs;

})));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Egulias\EmailValidator;

use Egulias\EmailValidator\Exception\ExpectingATEXT;
use Egulias\EmailValidator\Exception\NoLocalPart;
use Egulias\EmailValidator\Parser\DomainPart;
use Egulias\EmailValidator\Parser\LocalPart;
use Egulias\EmailValidator\Warning\EmailTooLong;

/**
 * EmailParser
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 */
class EmailParser
{
    const EMAIL_MAX_LENGTH = 254;

    protected $warnings;
    protected $domainPart = '';
    protected $localPart = '';
    protected $lexer;
    protected $localPartParser;
    protected $domainPartParser;

    public function __construct(EmailLexer $lexer)
    {
        $this->lexer = $lexer;
        $this->localPartParser = new LocalPart($this->lexer);
        $this->domainPartParser = new DomainPart($this->lexer);
        $this->warnings = new \SplObjectStorage();
    }

    /**
     * @param $str
     * @return array
     */
    public function parse($str)
    {
        $this->lexer->setInput($str);

        if (!$this->hasAtToken()) {
            throw new NoLocalPart();
        }


        $this->localPartParser->parse($str);
        $this->domainPartParser->parse($str);

        $this->setParts($str);

        if ($this->lexer->hasInvalidTokens()) {
            throw new ExpectingATEXT();
        }

        return array('local' => $this->localPart, 'domain' => $this->domainPart);
    }

    public function getWarnings()
    {
        $localPartWarnings = $this->localPartParser->getWarnings();
        $domainPartWarnings = $this->domainPartParser->getWarnings();
        $this->warnings = array_merge($localPartWarnings, $domainPartWarnings);

        $this->addLongEmailWarning($this->localPart, $this->domainPart);

        return $this->warnings;
    }

    public function getParsedDomainPart()
    {
        return $this->domainPart;
    }

    protected function setParts($email)
    {
        $parts = explode('@', $email);
        $this->domainPart = $this->domainPartParser->getDomainPart();
        $this->localPart = $parts[0];
    }

    protected function hasAtToken()
    {
        $this->lexer->moveNext();
        $this->lexer->moveNext();
        if ($this->lexer->token['type'] === EmailLexer::S_AT) {
            return false;
        }

        return true;
    }

    /**
     * @param string $localPart
     * @param string $parsedDomainPart
     */
    protected function addLongEmailWarning($localPart, $parsedDomainPart)
    {
        if (strlen($localPart . '@' . $parsedDomainPart) > self::EMAIL_MAX_LENGTH) {
            $this->warnings[EmailTooLong::CODE] = new EmailTooLong();
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

namespace Illuminate\Routing;

use ReflectionMethod;
use ReflectionParameter;
use Illuminate\Support\Arr;
use ReflectionFunctionAbstract;

trait RouteDependencyResolverTrait
{
    /**
     * Resolve the object method's type-hinted dependencies.
     *
     * @param  array  $parameters
     * @param  object  $instance
     * @param  string  $method
     * @return array
     */
    protected function resolveClassMethodDependencies(array $parameters, $instance, $method)
    {
        if (! method_exists($instance, $method)) {
            return $parameters;
        }

        return $this->resolveMethodDependencies(
            $parameters, new ReflectionMethod($instance, $method)
        );
    }

    /**
     * Resolve the given method's type-hinted dependencies.
     *
     * @param  array  $parameters
     * @param  \ReflectionFunctionAbstract  $reflector
     * @return array
     */
    public function resolveMethodDependencies(array $parameters, ReflectionFunctionAbstract $reflector)
    {
        $instanceCount = 0;

        $values = array_values($parameters);

        foreach ($reflector->getParameters() as $key => $parameter) {
            $instance = $this->transformDependency(
                $parameter, $parameters
            );

            if (! is_null($instance)) {
                $instanceCount++;

                $this->spliceIntoParameters($parameters, $key, $instance);
            } elseif (! isset($values[$key - $instanceCount]) &&
                      $parameter->isDefaultValueAvailable()) {
                $this->spliceIntoParameters($parameters, $key, $parameter->getDefaultValue());
            }
        }

        return $parameters;
    }

    /**
     * Attempt to transform the given parameter into a class instance.
     *
     * @param  \ReflectionParameter  $parameter
     * @param  array  $parameters
     * @return mixed
     */
    protected function transformDependency(ReflectionParameter $parameter, $parameters)
    {
        $class = $parameter->getClass();

        // If the parameter has a type-hinted class, we will check to see if it is already in
        // the list of parameters. If it is we will just skip it as it is probably a model
        // binding and we do not want to mess with those; otherwise, we resolve it here.
        if ($class && ! $this->alreadyInParameters($class->name, $parameters)) {
            return $parameter->isDefaultValueAvailable()
                ? $parameter->getDefaultValue()
                : $this->container->make($class->name);
        }
    }

    /**
     * Determine if an object of the given class is in a list of parameters.
     *
     * @param  string  $class
     * @param  array  $parameters
     * @return bool
     */
    protected function alreadyInParameters($class, array $parameters)
    {
        return ! is_null(Arr::first($parameters, function ($value) use ($class) {
            return $value instanceof $class;
        }));
    }

    /**
     * Splice the given value into the parameter list.
     *
     * @param  array  $parameters
     * @param  string  $offset
     * @param  mixed  $value
     * @return void
     */
    protected function spliceIntoParameters(array &$parameters, $offset, $value)
    {
        array_splice(
            $parameters, $offset, 0, [$value]
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Abstract class
-----
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
-----
array(
    0: Stmt_Class(
        flags: MODIFIER_ABSTRACT (16)
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_PUBLIC (1)
                byRef: false
                name: a
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
            1: Stmt_ClassMethod(
                flags: MODIFIER_PUBLIC | MODIFIER_ABSTRACT (17)
                byRef: false
                name: b
                params: array(
                )
                returnType: null
                stmts: null
            )
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       --TEST--
#2137: Error message for invalid dataprovider
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = 'Issue2137Test';
$_SERVER['argv'][3] = __DIR__ . '/2137/Issue2137Test.php';
$_SERVER['argv'][4] = '--filter';
$_SERVER['argv'][5] = 'BrandService';

require __DIR__ . '/../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

W                                                                   1 / 1 (100%)

Time: %s, Memory: %s

There was 1 warning:

1) Warning
The data provider specified for Issue2137Test::testBrandService is invalid.
Data set #0 is invalid.

WARNINGS!
Tests: 1, Assertions: 0, Warnings: 1.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Matcher;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ExceptionInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * TraceableUrlMatcher helps debug path info matching by tracing the match.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableUrlMatcher extends UrlMatcher
{
    const ROUTE_DOES_NOT_MATCH = 0;
    const ROUTE_ALMOST_MATCHES = 1;
    const ROUTE_MATCHES = 2;

    protected $traces;

    public function getTraces($pathinfo)
    {
        $this->traces = array();

        try {
            $this->match($pathinfo);
        } catch (ExceptionInterface $e) {
        }

        return $this->traces;
    }

    public function getTracesForRequest(Request $request)
    {
        $this->request = $request;
        $traces = $this->getTraces($request->getPathInfo());
        $this->request = null;

        return $traces;
    }

    protected function matchCollection($pathinfo, RouteCollection $routes)
    {
        foreach ($routes as $name => $route) {
            $compiledRoute = $route->compile();

            if (!preg_match($compiledRoute->getRegex(), $pathinfo, $matches)) {
                // does it match without any requirements?
                $r = new Route($route->getPath(), $route->getDefaults(), array(), $route->getOptions());
                $cr = $r->compile();
                if (!preg_match($cr->getRegex(), $pathinfo)) {
                    $this->addTrace(sprintf('Path "%s" does not match', $route->getPath()), self::ROUTE_DOES_NOT_MATCH, $name, $route);

                    continue;
                }

                foreach ($route->getRequirements() as $n => $regex) {
                    $r = new Route($route->getPath(), $route->getDefaults(), array($n => $regex), $route->getOptions());
                    $cr = $r->compile();

                    if (in_array($n, $cr->getVariables()) && !preg_match($cr->getRegex(), $pathinfo)) {
                        $this->addTrace(sprintf('Requirement for "%s" does not match (%s)', $n, $regex), self::ROUTE_ALMOST_MATCHES, $name, $route);

                        continue 2;
                    }
                }

                continue;
            }

            // check host requirement
            $hostMatches = array();
            if ($compiledRoute->getHostRegex() && !preg_match($compiledRoute->getHostRegex(), $this->context->getHost(), $hostMatches)) {
                $this->addTrace(sprintf('Host "%s" does not match the requirement ("%s")', $this->context->getHost(), $route->getHost()), self::ROUTE_ALMOST_MATCHES, $name, $route);

                continue;
            }

            // check HTTP method requirement
            if ($requiredMethods = $route->getMethods()) {
                // HEAD and GET are equivalent as per RFC
                if ('HEAD' === $method = $this->context->getMethod()) {
                    $method = 'GET';
                }

                if (!in_array($method, $requiredMethods)) {
                    $this->allow = array_merge($this->allow, $requiredMethods);

                    $this->addTrace(sprintf('Method "%s" does not match any of the required methods (%s)', $this->context->getMethod(), implode(', ', $requiredMethods)), self::ROUTE_ALMOST_MATCHES, $name, $route);

                    continue;
                }
            }

            // check condition
            if ($condition = $route->getCondition()) {
                if (!$this->getExpressionLanguage()->evaluate($condition, array('context' => $this->context, 'request' => $this->request ?: $this->createRequest($pathinfo)))) {
                    $this->addTrace(sprintf('Condition "%s" does not evaluate to "true"', $condition), self::ROUTE_ALMOST_MATCHES, $name, $route);

                    continue;
                }
            }

            // check HTTP scheme requirement
            if ($requiredSchemes = $route->getSchemes()) {
                $scheme = $this->context->getScheme();

                if (!$route->hasScheme($scheme)) {
                    $this->addTrace(sprintf('Scheme "%s" does not match any of the required schemes (%s); the user will be redirected to first required scheme', $scheme, implode(', ', $requiredSchemes)), self::ROUTE_ALMOST_MATCHES, $name, $route);

                    return true;
                }
            }

            $this->addTrace('Route matches!', self::ROUTE_MATCHES, $name, $route);

            return true;
        }
    }

    private function addTrace($log, $level = self::ROUTE_DOES_NOT_MATCH, $name = null, $route = null)
    {
        $this->traces[] = array(
            'log' => $log,
            'name' => $name,
            'level' => $level,
            'path' => null !== $route ? $route->getPath() : null,
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Processor;

/**
 * Injects url/method and remote IP of the current web request in all records
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class WebProcessor
{
    /**
     * @var array|\ArrayAccess
     */
    protected $serverData;

    /**
     * Default fields
     *
     * Array is structured as [key in record.extra => key in $serverData]
     *
     * @var array
     */
    protected $extraFields = array(
        'url'         => 'REQUEST_URI',
        'ip'          => 'REMOTE_ADDR',
        'http_method' => 'REQUEST_METHOD',
        'server'      => 'SERVER_NAME',
        'referrer'    => 'HTTP_REFERER',
    );

    /**
     * @param array|\ArrayAccess $serverData  Array or object w/ ArrayAccess that provides access to the $_SERVER data
     * @param array|null         $extraFields Field names and the related key inside $serverData to be added. If not provided it defaults to: url, ip, http_method, server, referrer
     */
    public function __construct($serverData = null, array $extraFields = null)
    {
        if (null === $serverData) {
            $this->serverData = &$_SERVER;
        } elseif (is_array($serverData) || $serverData instanceof \ArrayAccess) {
            $this->serverData = $serverData;
        } else {
            throw new \UnexpectedValueException('$serverData must be an array or object implementing ArrayAccess.');
        }

        if (null !== $extraFields) {
            if (isset($extraFields[0])) {
                foreach (array_keys($this->extraFields) as $fieldName) {
                    if (!in_array($fieldName, $extraFields)) {
                        unset($this->extraFields[$fieldName]);
                    }
                }
            } else {
                $this->extraFields = $extraFields;
            }
        }
    }

    /**
     * @param  array $record
     * @return array
     */
    public function __invoke(array $record)
    {
        // skip processing if for some reason request data
        // is not present (CLI or wonky SAPIs)
        if (!isset($this->serverData['REQUEST_URI'])) {
            return $record;
        }

        $record['extra'] = $this->appendExtraFields($record['extra']);

        return $record;
    }

    /**
     * @param  string $extraName
     * @param  string $serverName
     * @return $this
     */
    public function addExtraField($extraName, $serverName)
    {
        $this->extraFields[$extraName] = $serverName;

        return $this;
    }

    /**
     * @param  array $extra
     * @return array
     */
    private function appendExtraFields(array $extra)
    {
        foreach ($this->extraFields as $extraName => $serverName) {
            $extra[$extraName] = isset($this->serverData[$serverName]) ? $this->serverData[$serverName] : null;
        }

        if (isset($this->serverData['UNIQUE_ID'])) {
            $extra['unique_id'] = $this->serverData['UNIQUE_ID'];
        }

        return $extra;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Illuminate\Mail\Transport;

use Swift_Mime_SimpleMessage;
use GuzzleHttp\ClientInterface;

class MandrillTransport extends Transport
{
    /**
     * Guzzle client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * The Mandrill API key.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new Mandrill transport instance.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     * @param  string  $key
     * @return void
     */
    public function __construct(ClientInterface $client, $key)
    {
        $this->key = $key;
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $this->client->post('https://mandrillapp.com/api/1.0/messages/send-raw.json', [
            'form_params' => [
                'key' => $this->key,
                'to' => $this->getTo($message),
                'raw_message' => $message->toString(),
                'async' => true,
            ],
        ]);

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }

    /**
     * Get all the addresses this message should be sent to.
     *
     * Note that Mandrill still respects CC, BCC headers in raw message itself.
     *
     * @param  \Swift_Mime_SimpleMessage $message
     * @return array
     */
    protected function getTo(Swift_Mime_SimpleMessage $message)
    {
        $to = [];

        if ($message->getTo()) {
            $to = array_merge($to, array_keys($message->getTo()));
        }

        if ($message->getCc()) {
            $to = array_merge($to, array_keys($message->getCc()));
        }

        if ($message->getBcc()) {
            $to = array_merge($to, array_keys($message->getBcc()));
        }

        return $to;
    }

    /**
     * Get the API key being used by the transport.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the API key being used by the transport.
     *
     * @param  string  $key
     * @return string
     */
    public function setKey($key)
    {
        return $this->key = $key;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace Mockery\Generator;

class MockConfigurationBuilder
{
    protected $name;
    protected $blackListedMethods = array(
        '__call',
        '__callStatic',
        '__clone',
        '__wakeup',
        '__set',
        '__get',
        '__toString',
        '__isset',
        '__destruct',
        '__debugInfo', ## mocking this makes it difficult to debug with xdebug

        // below are reserved words in PHP
        "__halt_compiler", "abstract", "and", "array", "as",
        "break", "callable", "case", "catch", "class",
        "clone", "const", "continue", "declare", "default",
        "die", "do", "echo", "else", "elseif",
        "empty", "enddeclare", "endfor", "endforeach", "endif",
        "endswitch", "endwhile", "eval", "exit", "extends",
        "final", "for", "foreach", "function", "global",
        "goto", "if", "implements", "include", "include_once",
        "instanceof", "insteadof", "interface", "isset", "list",
        "namespace", "new", "or", "print", "private",
        "protected", "public", "require", "require_once", "return",
        "static", "switch", "throw", "trait", "try",
        "unset", "use", "var", "while", "xor"
    );

    protected $php7SemiReservedKeywords = [
        "callable", "class", "trait", "extends", "implements", "static", "abstract", "final",
        "public", "protected", "private", "const", "enddeclare", "endfor", "endforeach", "endif",
        "endwhile", "and", "global", "goto", "instanceof", "insteadof", "interface", "namespace", "new",
        "or", "xor", "try", "use", "var", "exit", "list", "clone", "include", "include_once", "throw",
        "array", "print", "echo", "require", "require_once", "return", "else", "elseif", "default",
        "break", "continue", "switch", "yield", "function", "if", "endswitch", "finally", "for", "foreach",
        "declare", "case", "do", "while", "as", "catch", "die", "self", "parent",
    ];

    protected $whiteListedMethods = array();
    protected $instanceMock = false;
    protected $parameterOverrides = array();

    protected $mockOriginalDestructor = false;
    protected $targets = array();


    public function __construct()
    {
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            $this->blackListedMethods = array_diff($this->blackListedMethods, $this->php7SemiReservedKeywords);
        }
    }

    public function addTarget($target)
    {
        $this->targets[] = $target;

        return $this;
    }

    public function addTargets($targets)
    {
        foreach ($targets as $target) {
            $this->addTarget($target);
        }

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function addBlackListedMethod($blackListedMethod)
    {
        $this->blackListedMethods[] = $blackListedMethod;
        return $this;
    }

    public function addBlackListedMethods(array $blackListedMethods)
    {
        foreach ($blackListedMethods as $method) {
            $this->addBlackListedMethod($method);
        }
        return $this;
    }

    public function setBlackListedMethods(array $blackListedMethods)
    {
        $this->blackListedMethods = $blackListedMethods;
        return $this;
    }

    public function addWhiteListedMethod($whiteListedMethod)
    {
        $this->whiteListedMethods[] = $whiteListedMethod;
        return $this;
    }

    public function addWhiteListedMethods(array $whiteListedMethods)
    {
        foreach ($whiteListedMethods as $method) {
            $this->addWhiteListedMethod($method);
        }
        return $this;
    }

    public function setWhiteListedMethods(array $whiteListedMethods)
    {
        $this->whiteListedMethods = $whiteListedMethods;
        return $this;
    }

    public function setInstanceMock($instanceMock)
    {
        $this->instanceMock = (bool) $instanceMock;
    }

    public function setParameterOverrides(array $overrides)
    {
        $this->parameterOverrides = $overrides;
    }

    public function setMockOriginalDestructor($mockDestructor)
    {
        $this->mockOriginalDestructor = $mockDestructor;
        return $this;
    }

    public function getMockConfiguration()
    {
        return new MockConfiguration(
            $this->targets,
            $this->blackListedMethods,
            $this->whiteListedMethods,
            $this->name,
            $this->instanceMock,
            $this->parameterOverrides,
            $this->mockOriginalDestructor
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

> **Note:** This repository contains the core code of the Laravel framework. If you want to build an application using Laravel 5, visit the main [Laravel repository](https://github.com/laravel/laravel).

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials covering a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](CODE_OF_CONDUCT.md).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'year' => '1 ano|:count anos',
    'y' => '1 ano|:count anos',
    'month' => '1 mês|:count meses',
    'm' => '1 mês|:count meses',
    'week' => '1 semana|:count semanas',
    'w' => '1 semana|:count semanas',
    'day' => '1 dia|:count dias',
    'd' => '1 dia|:count dias',
    'hour' => '1 hora|:count horas',
    'h' => '1 hora|:count horas',
    'minute' => '1 minuto|:count minutos',
    'min' => '1 minuto|:count minutos',
    'second' => '1 segundo|:count segundos',
    's' => '1 segundo|:count segundos',
    'ago' => ':time atrás',
    'from_now' => 'em :time',
    'after' => ':time depois',
    'before' => ':time antes',
);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
/**
 * Random_* Compatibility Library
 * for using the new PHP 7 random_* API in PHP 5 projects
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 - 2017 Paragon Initiative Enterprises
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

if (!is_callable('RandomCompat_intval')) {
    
    /**
     * Cast to an integer if we can, safely.
     * 
     * If you pass it a float in the range (~PHP_INT_MAX, PHP_INT_MAX)
     * (non-inclusive), it will sanely cast it to an int. If you it's equal to
     * ~PHP_INT_MAX or PHP_INT_MAX, we let it fail as not an integer. Floats 
     * lose precision, so the <= and => operators might accidentally let a float
     * through.
     * 
     * @param int|float $number    The number we want to convert to an int
     * @param bool      $fail_open Set to true to not throw an exception
     * 
     * @return float|int
     * @psalm-suppress InvalidReturnType
     *
     * @throws TypeError
     */
    function RandomCompat_intval($number, $fail_open = false)
    {
        if (is_int($number) || is_float($number)) {
            $number += 0;
        } elseif (is_numeric($number)) {
            $number += 0;
        }

        if (
            is_float($number)
            &&
            $number > ~PHP_INT_MAX
            &&
            $number < PHP_INT_MAX
        ) {
            $number = (int) $number;
        }

        if (is_int($number)) {
            return (int) $number;
        } elseif (!$fail_open) {
            throw new TypeError(
                'Expected an integer.'
            );
        }
        return $number;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Exception;

/**
 * A "type error" Exception for Psy.
 */
class TypeErrorException extends \Exception implements Exception
{
    private $rawMessage;

    /**
     * Constructor!
     *
     * @param string $message (default: "")
     * @param int    $code    (default: 0)
     */
    public function __construct($message = '', $code = 0)
    {
        $this->rawMessage = $message;
        $message = preg_replace('/, called in .*?: eval\\(\\)\'d code/', '', $message);
        parent::__construct(sprintf('TypeError: %s', $message), $code);
    }

    /**
     * Get the raw (unformatted) message for this error.
     *
     * @return string
     */
    public function getRawMessage()
    {
        return $this->rawMessage;
    }

    /**
     * Create a TypeErrorException from a TypeError.
     *
     * @param \TypeError $e
     *
     * @return TypeErrorException
     */
    public static function fromTypeError(\TypeError $e)
    {
        return new self($e->getMessage(), $e->getLine());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Iterator;

/**
 * CustomFilterIterator filters files by applying anonymous functions.
 *
 * The anonymous function receives a \SplFileInfo and must return false
 * to remove files.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class CustomFilterIterator extends FilterIterator
{
    private $filters = array();

    /**
     * Constructor.
     *
     * @param \Iterator  $iterator The Iterator to filter
     * @param callable[] $filters  An array of PHP callbacks
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(\Iterator $iterator, array $filters)
    {
        foreach ($filters as $filter) {
            if (!is_callable($filter)) {
                throw new \InvalidArgumentException('Invalid PHP callback.');
            }
        }
        $this->filters = $filters;

        parent::__construct($iterator);
    }

    /**
     * Filters the iterator values.
     *
     * @return bool true if the value should be kept, false otherwise
     */
    public function accept()
    {
        $fileinfo = $this->current();

        foreach ($this->filters as $filter) {
            if (false === call_user_func($filter, $fileinfo)) {
                return false;
            }
        }

        return true;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php
    
     require_once './Product.php';
     $product = new Product();
     $queryResult = $product->getAllProductInfo();
     
     if(isset($_GET['status'])){
         $id = $_GET['id'];
         $product->deleteProductInfo($id);
     }
     

?> 




<hr>
        <a href="add-product.php">Add Product</a>
        <a href="view-product.php">View Products</a>
<hr>

<table border="2" style="text-align: center">
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product Quantity</th>
        <th>Product Description</th>
        <th>Publication Status</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($queryResult)){ ?>   
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['product_name'];?></td>
        <td><?php echo $row['product_price'];?></td>
        <td><?php echo $row['product_quantity'];?></td>
        <td><?php echo $row['product_description'];?></td>
        <td><?php if($row['publication_status'] == '1') echo 'Published'; else echo 'Unpublished';?></td>
        <td>
            <a href="edit-product.php?id=<?php echo $row['id'];?>">Edit Product</a>||
            <a href="?status=delete&id=<?php echo $row['id'];?>" onclick="return confirm('Are You Sure To Delete This??');">Delete Product</a>
        </td>
    </tr>
    <?php }?>
</table>


<hr>
<div style="text-align: center; background-color: gray; color:DarkRed; padding: 15px;">&copy;All Right Reserved By Mostak Ahmad Emo. SEID: 171477</div>
<hr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Exception;

/**
 * @author Ben Ramsey <ben@benramsey.com>
 */
class UnsupportedMediaTypeHttpException extends HttpException
{
    /**
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param int        $code     The internal exception code
     * @param array      $headers
     */
    public function __construct(string $message = null, \Exception $previous = null, int $code = 0, array $headers = array())
    {
        parent::__construct(415, $message, $previous, $headers, $code);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\Command;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Store\FlockStore;
use Symfony\Component\Lock\Store\SemaphoreStore;

class LockableTraitTest extends TestCase
{
    protected static $fixturesPath;

    public static function setUpBeforeClass()
    {
        self::$fixturesPath = __DIR__.'/../Fixtures/';
        require_once self::$fixturesPath.'/FooLockCommand.php';
        require_once self::$fixturesPath.'/FooLock2Command.php';
    }

    public function testLockIsReleased()
    {
        $command = new \FooLockCommand();

        $tester = new CommandTester($command);
        $this->assertSame(2, $tester->execute(array()));
        $this->assertSame(2, $tester->execute(array()));
    }

    public function testLockReturnsFalseIfAlreadyLockedByAnotherCommand()
    {
        $command = new \FooLockCommand();

        if (SemaphoreStore::isSupported()) {
            $store = new SemaphoreStore();
        } else {
            $store = new FlockStore();
        }

        $lock = (new Factory($store))->createLock($command->getName());
        $lock->acquire();

        $tester = new CommandTester($command);
        $this->assertSame(1, $tester->execute(array()));

        $lock->release();
        $this->assertSame(2, $tester->execute(array()));
    }

    public function testMultipleLockCallsThrowLogicException()
    {
        $command = new \FooLock2Command();

        $tester = new CommandTester($command);
        $this->assertSame(1, $tester->execute(array()));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                 