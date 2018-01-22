Yii2 DevKit
===========
[![Build Status](https://travis-ci.org/yiithings/yii2-devkit.svg)](https://travis-ci.org/yiithings/yii2-devkit)
[![Latest Stable Version](https://poser.pugx.org/yiithings/yii2-devkit/v/stable.svg)](https://packagist.org/packages/yiithings/yii2-devkit) 
[![Total Downloads](https://poser.pugx.org/yiithings/yii2-devkit/downloads.svg)](https://packagist.org/packages/yiithings/yii2-devkit) 
[![Latest Unstable Version](https://poser.pugx.org/yiithings/yii2-devkit/v/unstable.svg)](https://packagist.org/packages/yiithings/yii2-devkit)
[![License](https://poser.pugx.org/yiithings/yii2-devkit/license.svg)](https://packagist.org/packages/yiithings/yii2-devkit)

Developer helper kit for Yii2 framework.

Features
---------
+ Integrated IDE auto complete generator [![](https://img.shields.io/badge/Powered_by-yii2_autocomplete_helper-green.svg?style=flat)](https://github.com/iiifx-production/yii2-autocomplete-helper)
+ Integrated Migration code generator [![](https://img.shields.io/badge/Powered_by-yii2_schemadump-green.svg?style=flat)](https://github.com/jamband/yii2-schemadump)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiithings/yii2-devkit "*"
```

or add

```
"yiithings/yii2-devkit": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :
```php
[
    'bootstrap' => ['devkit'],
    'modules' => [
        'devkit' => [
            'class' => 'yiithings\devkit\Module',
        ],
    ],
]
```

Use console:
```bash
$ ./yii devkit/ide-helper
$ ./yii devkit/schema-create
$ ./yii devkit/schema-drop
```
