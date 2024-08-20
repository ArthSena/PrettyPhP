<?php namespace Illuminate\Translation;

class Lang {

    protected static LanguageCacher $cache;

    /**
     * Constructs a new Lang instance.
     *
     * Initializes the LanguageCacher instance to be used for caching language settings.
     */
    public function __construct() {
        self::$cache = new LanguageCacher();
    }

    /**
     * Sets the current language for the application.
     *
     * @param string $language The language code to set.
     * @return string The set language code.
     * @throws \Exception If the provided language is not supported.
     *
     * The function validates the provided language against the supported languages and sets it as the current language.
     * If the provided language is not supported, it throws an exception with a list of supported languages.
     * If the provided language is the same as the fallback locale, it is still considered valid.
     * The function then calls the setLanguage method of the LanguageCacher class to store the language in the cache.
     */
    public static function setLanguage($language): string {
        if(!self::validateLanguage($language) && $language !== APP['fallback_locale'] ) {
            throw new \Exception('Invalid language: ' . $language . '. Supported languages are: ' . implode(',', APP['supported_languages']));
        }
        
        return self::$cache->setLanguage($language);
    }

    /**
     * Retrieves the current language set for the application.
     *
     * If the language is not set in the cache, it will default to the fallback locale.
     *
     * @return string The current language code.
     *
     * @throws \Exception If the fallback locale is not supported.
     *
     * The function first attempts to retrieve the current language from the cache using the getLanguage method of the LanguageCacher class.
     * If the language is not set in the cache, it calls the setLanguage method with the fallback locale as the parameter.
     * If the fallback locale is not supported, it throws an exception with a list of supported languages.
     */
    public static function getLanguage(): string {
        return self::$cache->getLanguage() ?? self::setLanguage(APP['fallback_locale']);
    }

    /**
     * Validates if a given language is supported by the application.
     *
     * @param string $language The language code to validate.
     * @return bool True if the language is supported, false otherwise.
     *
     * This function checks if the provided language is included in the list of supported languages.
     * The supported languages are defined in the 'supported_languages' configuration variable (APP['supported_languages']).
     * The function uses the explode function to split the supported languages string into an array and then checks if the provided language is in the array.
     */
    public static function validateLanguage($language): bool {
        return in_array($language, APP['supported_languages']);
    }
}