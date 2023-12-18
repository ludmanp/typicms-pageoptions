# PageOptions for TypiCMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ludmanp/typicms-pageoptions.svg?style=flat-square)](https://packagist.org/packages/ludmanp/typicms-pageoptions)
[![Total Downloads](https://img.shields.io/packagist/dt/ludmanp/typicms-pageoptions.svg?style=flat-square)](https://packagist.org/packages/ludmanp/typicms-pageoptions)
[![MIT Licence](https://img.shields.io/packagist/l/ludmanp/typicms-pageoptions.svg?style=flat-square)](https://packagist.org/packages/ludmanp/typicms-pageoptions)

Allow to extend TypiCMS Page properties according to page templates.

## Installation

You can install the package via composer:

```bash
composer require ludmanp/typicms-pageoptions
```

To prepare for usage you can run

```bash
php artisan page-options:install
```
The command will publish and run the migrations.  

You can alternatively run separate commands to do these operations:

```bash
php artisan vendor:publish --tag="page-options-migrations"
php artisan migrate
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="typicms-pageoptions-views"
```

## Usage

### Admin

Include 
```php
<x-pageoptions-admin-form :model="$model" />
```
into `resources/viwes/vendor/pages/admin/_from.blade.php`. 

`$model` is the current Page model

Create blade file in `resources/viwes/vendor/page-options/admin` directory with page tempalate name. 
For example `default.blade.php`

To add options you can use, for example,

```php
{!! BootForm::text(__('Description'), 'options[description]') !!}
{!! TranslatableBootForm::text(__('Phone number'), 'options[phone][number]') !!}
```

To include specific images, use

```php
<x-pageoptions-image :model="$model" name="preview_image_id" label="Preview image"/>
<x-pageoptions-image :model="$model" name="phone.icon_id" label="Phone icon"/>
```

`name` is option's name, use dots to make multilevel array.
`label` is optional, but recommended to distinguish from other image fields 

The same way you can add file fields

```php
<x-pageoptions-file :model="$model" name="specification" label="Specification"/>
```

### Public

To output PageOptions use in page template (`pages/public/*.blade/php`)

To output simple option use

```php
{{ $pageOptions->present()->option('phone') }}
```

To output translatable option use

```php
{{ $pageOptions->present()->optionTranslated('company.name') }}
```

There is available optional locale parameter

```php
{{ $pageOptions->present()->optionTranslated('company.name', 'en') }}
```

To output image use

```php

<img src="{{ $pageOptions->present()->optionsImage('contact.image') }}"
    alt="{{ optional($pageOptions->present()->optionsFile('contact.image'))->alt_attribute ?? 'Contacts' }}"/>
```

Additional parameters `width`, `height` and `options` are available, like in presenter's `image` method.

To get file model use. 

```php

$pageOptions->present()->optionsFile('contact.file')
```

As you can see above it is available also for images to get `alt_attribute` for example. 

To make link to file you can write like following

```php
<a href="{{ optional($pageOptions->present()->optionsFile('contact.file'))->url }}">File</a>
```

## Credits

- [Mark Leidman](https://github.com/ludmanp)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
