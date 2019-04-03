Clara Language
===============

Add a lang repository to Clara.

## Installation

```php
composer require ceddyg/clara-language
```

Add to your providers in 'config/app.php'
```php
CeddyG\ClaraLanguage\ClaraLanguageServiceProvider::class,
```

Then to publish the files.
```php
php artisan vendor:publish --provider="CeddyG\ClaraLanguage\ClaraLanguageServiceProvider"