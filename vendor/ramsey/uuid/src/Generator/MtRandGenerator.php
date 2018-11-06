{
    "name": "illuminate/cache",
    "description": "The Illuminate Cache package.",
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
        "illuminate/contracts": "5.5.*",
        "illuminate/support": "5.5.*"
    },
    "autoload": {
        "psr-4": {
            "Illuminate\\Cache\\": ""
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "5.5-dev"
        }
    },
    "suggest": {
        "illuminate/database": "Required to use the database cache driver (5.5.*).",
        "illuminate/filesystem": "Required to use the file cache driver (5.5.*).",
        "illuminate/redis": "Required to use the redis cache driver (5.5.*)."
    },
    "config": {
        "sort-packages": true
    },
    "minimum-stability": "dev"
}
                                                                                   