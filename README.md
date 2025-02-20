Copy and add following code into composer.json after "autoload"

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/kanhaiyanigam05/media.git",
            "name": "kanhaiyanigam05/media"
        }
    ],

after pasting it, run following command in composer

composer require kanhaiyanigam05/media:"dev-main"

after successfully installing package, add following code in bootstrap/providers.php file


return [
    Media\MediaServiceProvider::class
];
if any provider already exists there, then add following line insite array

Media\MediaServiceProvider::class

now run following command to publish assets and load migration to project

php artisan vendor:publish --provider="Media\MediaServiceProvider"

after publishing assets open your layout file and  add following line

@stack('css') just above ending of head tag
@stack('models') just above script tags
@stack('js') just before closing body tag

now migrate loaded migration and run commad

php artisan migrate
