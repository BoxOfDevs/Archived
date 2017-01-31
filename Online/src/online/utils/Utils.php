<?php
namespace online\utils;
class Utils {
    static function popup() {
        exec('mshta.exe %~dp0\popup.hta');
    }
    static function alert($message) {
        exec('mshta javascript:alert("'. $message . '");close();');
    }
    static function confirm($message) {
        exec('mshta '. implode("", ['javascript:if(confirm("'. $message . '");){var%20hiddenElement%20=%20document.createElement("a");',
            "}%20else%20{",
            "};close();"]));
        if(file_get_contents("currentConfirm")) {
            return true;
        } else {
            return false;
        }
    }
    static function prompt($message) {
        exec('mshta javascript:var hiddenElement = document.createElement("a");
            hiddenElement.href = "data:attachment/text," + encodeURI(prompt("'. $message . '"));
            hiddenElement.target = "_blank";
            hiddenElement.download = "currentConfirm";
            hiddenElement.click();close();');
    }
}