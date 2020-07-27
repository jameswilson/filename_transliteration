# Filename Transliteration

A Drupal 8 helper module to enable basic transliteration for all uploaded
File Entities.

Transliterations include:

* Special characters are converted from UTF8 to ASCII using Drupal core's
  [PhpTransliteration::transliterate][1] functionality.
* Capital leters are lowercased.
* Anything that is not a valid filename character (including the space
  character) is repleaced with an underscore.
* Sequences of underscores, dashes, and periods are simplified.

## Why does this module exist?

While the transliteration functionality was ported into Drupal 8 core,
there is no support for filename transliteration yet.

## Configuration

The module currently has no configuration UI. Pull Requests welcome.

## Credits

This module is based on the [blog post][2] by Alexander Belov, but
simplified for a less specific use case.

[1]: https://api.drupal.org/api/function/PhpTransliteration::transliterate
[2]: https://www.buzzwoo.de/blog/better-filename-transliteration-drupal-8-transliteration-using-non-default-language
