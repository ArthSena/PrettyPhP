<?php namespace Illuminate\Translation;

class LanguageCacher {    

    /**
     * Sets the current language for the application.
     *
     * This function is used to store the selected language in the session.
     *
     * @param string $language The language code to be set.
     *
     * @return string The language code that was set.
     *
     * @throws \Exception If the session is not started.
     */
    public function setLanguage($language): string {
        if(!session_status() === PHP_SESSION_ACTIVE) {
            throw new \Exception('Session is not started');
        }

        $_SESSION['lang'] = $language;
        return $language;
    }

    /**
     * Retrieves the current language set in the application.
     *
     * This function retrieves the language code stored in the session.
     * If the 'lang' key is not set in the session, it will return an empty string.
     *
     * @return string The language code currently set in the session.
     * 
     * @throws \Exception If the session is not started.
     */
    public static function getLanguage(): string {
        if(!session_status() === PHP_SESSION_ACTIVE) {
            throw new \Exception('Session is not started');
        }

        return $_SESSION['lang'];
    }
}