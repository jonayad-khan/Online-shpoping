{
    "name": "laravel/framework",
    "description": "The Laravel Framework.",
    "keywords": ["framework", "laravel"],
    "license": "MIT",
    "homepage": "https://laravel.com",
    "support": {
        "issues": "https://github.com/laravel/framework/issues",
        "source": "https://github.com/laravel/framework"
    },
    "authors": [
        {
            "name": "Taylor Otwell",
            "email": "taylor@laravel.com"
        }
    ],
    "require": {
        "php": ">=7.0",
        "ext-mbstring": "*",
        "ext-openssl": "*",
        "doctrine/inflector": "~1.1",
        "erusev/parsedown": "~1.6",
        "league/flysystem": "~1.0",
        "monolog/monolog": "~1.12",
        "mtdowling/cron-expression": "~1.0",
        "nesbot/carbon": "~1.20",
        "psr/container": "~1.0",
        "psr/simple-cache": "^1.0",
        "ramsey/uuid": "~3.0",
        "swiftmailer/swiftmailer": "~6.0",
        "symfony/console": "~3.3",
        "symfony/debug": "~3.3",
        "symfony/finder": "~3.3",
        "symfony/http-foundation": "~3.3",
        "symfony/http-kernel": "~3.3",
        "symfony/process": "~3.3",
        "symfony/routing": "~3.3",
        "symfony/var-dumper": "~3.3",
        "tijsverkoyen/css-to-inline-styles": "~2.2",
        "vlucas/phpdotenv": "~2.2"
    },
    "replace": {
        "illuminate/auth": "self.version",
        "illuminate/broadcasting": "self.version",
        "illuminate/bus": "self.version",
        "illuminate/cache": "self.version",
        "illuminate/config": "self.version",
        "illuminate/console": "self.version",
        "illuminate/container": "self.version",
        "illuminate/contracts": "self.version",
        "illuminate/cookie": "self.version",
        "illuminate/database": "self.version",
        "illuminate/encryption": "self.version",
        "illuminate/events": "self.version",
        "illuminate/exception": "self.version",
        "illuminate/filesystem": "self.version",
        "illuminate/hashing": "self.version",
        "illuminate/http": "self.version",
        "illuminate/log": "self.version",
        "illuminate/mail": "self.version",
        "illuminate/notifications": "self.version",
        "illuminate/pagination": "self.version",
        "illuminate/pipeline": "self.version",
        "illuminate/queue": "self.version",
        "illuminate/redis": "self.version",
        "illuminate/routing": "self.version",
        "illuminate/session": "self.version",
        "illuminate/support": "self.version",
        "illuminate/translation": "self.version",
        "illuminate/validation": "self.version",
        "illuminate/view": "self.version",
        "tightenco/collect": "self.version"
    },
    "require-dev": {
        "aws/aws-sdk-php": "~3.0",
        "doctrine/dbal": "~2.5",
        "filp/whoops": "^2.1.4",
        "mockery/mockery": "~1.0",
        "orchestra/testbench-core": "3.5.*",
        "pda/pheanstalk": "~3.0",
        "phpunit/phpunit": "~6.0",
        "predis/predis": "^1.1.1",
        "symfony/css-selector": "~3.3",
        "symfony/dom-crawler": "~3.3"
    },
    "autoload": {
        "files": [
            "src/Illuminate/Foundation/helpers.php",
            "src/Illuminate/Support/helpers.php"
        ],
        "psr-4": {
            "Illuminate\\": "src/Illuminate/"
        }
    },
    "autoload-dev": {
        "files": [
            "tests/Database/stubs/MigrationCreatorFakeMigration.php"
        ],
        "psr-4": {
            "Illuminate\\Tests\\": "tests/"
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "5.5-dev"
        }
    },
    "suggest": {
        "aws/aws-sdk-php": "Required to use the SQS queue driver and SES mail driver (~3.0).",
        "doctrine/dbal": "Required to rename columns and drop SQLite columns (~2.5).",
        "fzaninotto/faker": "Required to use the eloquent factory builder (~1.4).",
        "guzzlehttp/guzzle": "Required to use the Mailgun and Mandrill mail drivers and the ping methods on schedules (~6.0).",
        "laravel/tinker": "Required to use the tinker console command (~1.0).",
        "league/flysystem-aws-s3-v3": "Required to use the Flysystem S3 driver (~1.0).",
        "league/flysystem-rackspace": "Required to use the Flysystem Rackspace driver (~1.0).",
        "nexmo/client": "Required to use the Nexmo transport (~1.0).",
        "pda/pheanstalk": "Required to use the beanstalk queue driver (~3.0).",
        "predis/predis": "Required to use the redis cache and queue drivers (~1.0).",
        "pusher/pusher-php-server": "Required to use the Pusher broadcast driver (~2.0).",
        "symfony/css-selector": "Required to use some of the crawler integration testing tools (~3.3).",
        "symfony/dom-crawler": "Required to use most of the crawler integration testing tools (~3.3).",
        "symfony/psr-http-message-bridge": "Required to psr7 bridging features (~1.0)."
    },
    "config": {
        "sort-packages": true
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          