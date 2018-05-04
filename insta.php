<?php

/*
** Name:        : InstaGo
** Description  : PHP Instagram Downloader
** Version      : 2.0 BETA
** Developer    : Ayman Mohamed Abdullah
*/

session_start();

class InstaGo {

    static $Error = 'error';

    static function ValidateURL() {
        // checks if url is set
        $URL = isset($_POST['url']) ? $_POST['url'] : '';
        // regular expression validation to check if link is an Instagram post url match
        if (preg_match('@^https://www.instagram.com/p/(.*)/$@', $URL) && $URL !== ''):
            self::GetResponse($URL);
        else:
            self::SetSessionAndRedirect(self::$Error);
        endif;
    }

    static function GetResponse($URL) {
        // set error handler
        set_Error_handler(
            create_function(
                '$severity, $message, $file, $line',
                'throw new ErrorException($message, $severity, $severity, $file, $line);'
            )
        );

        // get link html content or catch exception
        try {
            $Response = file_get_contents($URL);
            self::ParseData($Response);
        } catch (Exception $e) {
            self::SetSessionAndRedirect(self::$Error);
        }

        // restore error handler
        restore_Error_handler();
    }

    static function ParseData($DataToParse) {
        // match link to get it out of $DataToParse content
        preg_match_all('/<meta property="og:image" content="(.*)"/', $DataToParse, $Output);
        // get link out of the array 
        $Image = $Output[1][0];
        // check if the length greater than 0 to make sure that the link is returned properly
        if (strlen($Image) > 0):
            self::SetSessionAndRedirect($Image);
        else:
            self::SetSessionAndRedirect(self::$Error);
        endif;
    }

    static function SetSessionAndRedirect($msg) {
        // sets response session to be used in index.php file to output result
        $_SESSION['response'] = $msg;
        // redirect to index.php
        header('Location:index.php');
    }

}

// fire validation method
InstaGo::ValidateURL();
