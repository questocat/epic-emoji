# epic-emoji

The emoji epic conversion library

## Usage

```php

$epicEmoji = new EpicEmoji();

// from apple devices
$content = '©呜呜，宝宝不开心😔';
$unified = $epicEmoji->unified($content);

echo $unified->emoji();                         // output emoji
echo $unified->withText('哇哦👻')->emoji();     // output emoji
echo $unified->shorthand();                     // output shorthand
echo $unified->codepoint();    // output codepoint
echo $unified->html();         // output html
echo $unified->htmlEntity();   // output htmlEntity

// convert to google devices
$google = $unified->google();
echo $google->emoji();         // output emoji
echo $google->shorthand();     // output emoji
echo $google->codepoint();     // output codepoint
echo $google->html();          // output html
echo $google->htmlEntity();    // output htmlEntity

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

Licensed under the [MIT license](https://github.com/emanci/epic-emoji/blob/master/LICENSE).
