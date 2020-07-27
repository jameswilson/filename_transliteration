<?php

namespace Drupal\filename_transliteration;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Component\Transliteration\TransliterationInterface;

/**
 * Class FilenamePostprocessor.
 *
 * @package Drupal\filename_transliteration
 */
class FilenamePostprocessor {

  /**
   * The configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * The transliteration service.
   *
   * @var \Drupal\Component\Transliteration\PhpTransliteration
   */
  protected $transliteration;

  /**
   * Constructs the Filename Postprocessor service.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   * @param \Drupal\Component\Transliteration\TransliterationInterface $transliteration
   *   The transliteration service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, TransliterationInterface $transliteration) {
    $this->configFactory = $config_factory;
    $this->transliteration = $transliteration;
  }

  /**
   * Custom method for transliterating filenames.
   *
   * Convert spaces to underscores and pass the filename string through
   * Drupal's core transliteration mechanism.
   *
   * @param string $filename
   *   The filename containing characters.
   *
   * @return string
   *   A transliterated filename with lowercase US ASCII characters only.
   */
  public function process($filename) {

    // Transliterate and downcase.
    $filename = $this->transliteration->transliterate($filename, 'en', '_');
    $filename = mb_strtolower($filename);

    // Repace anything that is not a valid filename character, including a
    // space, with an underscore.
    $filename = preg_replace('/[^a-z0-9_.-]+/', '_', $filename);

    // Replace sequential separator characters with a single instance.
    $filename = preg_replace('/\_+/', '_', $filename);
    $filename = preg_replace('/\-+/', '-', $filename);
    $filename = preg_replace('/\.+/', '.', $filename);
    $filename = str_replace('_-_', '_', $filename);
    $filename = str_replace('_-', '_', $filename);
    $filename = str_replace('-_', '_', $filename);
    $filename = str_replace('_.', '.', $filename);
    $filename = str_replace('-.', '.', $filename);

    return $filename;
  }

}
