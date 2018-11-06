{
    "name": "filp/whoops",
    "license": "MIT",
    "description": "php error handling for cool kids",
    "keywords": ["library", "error", "handling", "exception", "whoops", "throwable"],
    "homepage": "https://filp.github.io/whoops/",
    "authors": [
        {
            "name": "Filipe Dobreira",
            "homepage": "https://github.com/filp",
            "role": "Developer"
        }
    ],
    "require": {
        "php": "^5.5.9 || ^7.0",
        "psr/log": "^1.0.1"        
    },
    "require-dev": {
        "phpunit/phpunit": "^4.8.35 || ^5.7",
        "mockery/mockery": "0.9.*",
        "symfony/var-dumper": "^2.6 || ^3.0"
    },
    "suggest": {
        "symfony/var-dumper": "Pretty print complex values better with var-dumper available",
        "whoops/soap": "Formats errors as SOAP responses"
    },
    "autoload": {
        "psr-4": {
            "Whoops\\": "src/Whoops/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Whoops\\": "tests/Whoops/"
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "2.0-dev"
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

/**
 * Used for testing purposes.
 *
 * It records all records and gives you access to them for verification.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 *
 * @method bool hasEmergency($record)
 * @method bool hasAlert($record)
 * @method bool hasCritical($record)
 * @method bool hasError($record)
 * @method bool hasWarning($record)
 * @method bool hasNotice($record)
 * @method bool hasInfo($record)
 * @method bool hasDebug($record)
 *
 * @method bool hasEmergencyRecords()
 * @method bool hasAlertRecords()
 * @method bool hasCriticalRecords()
 * @method bool hasErrorRecords()
 * @method bool hasWarningRecords()
 * @method bo