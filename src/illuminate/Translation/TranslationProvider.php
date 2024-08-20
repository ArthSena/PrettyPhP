<?php

use Illuminate\Translation\Lang;
use Illuminate\Translation\MessageHandler;

/**
 * Translates a given path to a localized string using the specified locale.
 * If no locale is provided, the current application locale is used.
 *
 * @param string $path The path to be translated.
 * @param string|null $locale The locale to use for translation. If null, the current application locale is used.
 * @return string The translated string.
 * 
 * @throws \Exception If the provided locale is invalid.
 */
function __($path, $locale = null): string {
    if(is_null($locale))
        $locale = Lang::getLanguage();

    if(!Lang::validateLanguage($locale))
        throw new \Exception('Invalid language: ' . $locale);
    
    return MessageHandler::translate($path, $locale);
}