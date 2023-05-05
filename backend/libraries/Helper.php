<?php
// namespace App\Libraries;

class Helper {
    public static function dump($data) {
        echo "<pre>";
        echo "::: START DUMP :::\n\n";
        var_dump($data);
        die("::: END DUMP :::");
    }
}