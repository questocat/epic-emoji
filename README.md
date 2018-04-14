# epic-emoji

The emoji epic conversion library

[![StyleCI](https://styleci.io/repos/95678703/shield?branch=master)](https://styleci.io/repos/95678703)
[![Build Status](https://travis-ci.org/questocat/epic-emoji.svg?branch=master)](https://travis-ci.org/questocat/epic-emoji)
[![Code Coverage](https://scrutinizer-ci.com/g/questocat/epic-emoji/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/questocat/epic-emoji/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/questocat/epic-emoji/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/questocat/epic-emoji/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/questocat/epic-emoji/badges/build.png?b=master)](https://scrutinizer-ci.com/g/questocat/epic-emoji/build-status/master)
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://packagist.org/packages/questocat/epic-emoji)

## Installation

Using [Composer](https://getcomposer.org) to add the package to your project's dependencies:

```bash
$ composer require questocat/epic-emoji
```

## Usage

```php

$epicEmoji = new EpicEmoji();

// from Apple devices
$content = '呜呜，宝宝不开心😔';
$unified = $epicEmoji->unified($content);

$unified->emoji();        // output emoji
$unified->setText('哇哦👻')->emoji();   // output emoji
$unified->withText('哇哦👻')->emoji();  // output emoji
$unified->shorthand();    // output shorthand
$unified->codepoint();    // output codepoint
$unified->html();         // output html
$unified->htmlEntity();   // output htmlEntity

// convert to DoCoMo devices
$docomo = $unified->docomo();

// convert to Softbank & pre-iOS6 Apple devices
$softbank = $unified->softbank();

// convert to KDDI & Au devices
$kddi = $unified->kddi();

// convert to Google Android devices
$google = $unified->google();
$google->emoji();         // output emoji
$google->shorthand();     // output shorthand
$google->codepoint();     // output codepoint
$google->html();          // output html
$google->htmlEntity();    // output htmlEntity

```

## Inspiration

* [php-emoji](https://github.com/iamcal/php-emoji)

## Reference

* [Emoji introduction](http://www.ruanyifeng.com/blog/2017/04/emoji.html)
* [Emoji wiki](https://en.wikipedia.org/wiki/Emoji)
* [Unicode-org](http://www.unicode.org)
* [Full Emoji List, v5.0](http://www.unicode.org/emoji/charts/full-emoji-list.html)
* [Using Emoji in Web Apps](http://www.iamcal.com/emoji-in-web-apps/)

## License

Licensed under the [MIT license](https://github.com/questocat/epic-emoji/blob/master/LICENSE).
