<?php namespace Illuminate\Translation;

class MessageHandler {

    /**
     * Translates a given message path to its corresponding translation in the specified locale.
     * If the translation is not found in the specified locale, it will attempt to fall back to the fallback locale.
     *
     * @param string $path The message path in the format 'file.key@domain'.
     * @param string $locale The locale to translate the message to.
     * @return string The translated message.
     * 
     * @throws \Exception If the translation is not found in the specified locale and the fallback locale.
     */
    public static function translate($path, $locale): string {
        $parts = explode('@', $path);

        $file = str_replace('.', '/', $parts[0]);
        $msgPath = $parts[1];

        $fileDomain = '/' . APP['translations_dir'] . '/' . $locale. '/' . $file .'.php';

        $translations = include __HOME_DIR__ . $fileDomain;

        if (isset($translations[$msgPath])) {
            return $translations[$msgPath];
        }

        if($locale !== APP['fallback_locale']) {
            return self::translate($path, APP['fallback_locale']);
        }  else {
            throw new \Exception('Unable to find translation for: ' . $path . ' on file '. $fileDomain);
        }
    }

}