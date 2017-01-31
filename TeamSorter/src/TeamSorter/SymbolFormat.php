<?php

namespace TeamSorter;

use pocketmine\utils\TextFormat as TF;

class SymbolFormat{

    public function FormatText($text){
        $symbol = "&";
        $othersymbol = "§";
        $text = str_replace($symbol . "0", TF::BLACK, $text);
        $text = str_replace($symbol . "1", TF::DARK_BLUE, $text);
        $text = str_replace($symbol . "2", TF::DARK_GREEN, $text);
        $text = str_replace($symbol . "3", TF::DARK_AQUA, $text);
        $text = str_replace($symbol . "4", TF::DARK_RED, $text);
        $text = str_replace($symbol . "5", TF::DARK_PURPLE, $text);
        $text = str_replace($symbol . "6", TF::GOLD, $text);
        $text = str_replace($symbol . "7", TF::GRAY, $text);
        $text = str_replace($symbol . "8", TF::DARK_GRAY, $text);
        $text = str_replace($symbol . "9", TF::BLUE, $text);
        $text = str_replace($symbol . "a", TF::GREEN, $text);
        $text = str_replace($symbol . "b", TF::AQUA, $text);
        $text = str_replace($symbol . "c", TF::RED, $text);
        $text = str_replace($symbol . "d", TF::LIGHT_PURPLE, $text);
        $text = str_replace($symbol . "e", TF::YELLOW, $text);
        $text = str_replace($symbol . "f", TF::WHITE, $text);
        $text = str_replace($symbol . "k", TF::OBFUSCATED, $text);
        $text = str_replace($symbol . "l", TF::BOLD, $text);
        $text = str_replace($symbol . "m", TF::STRIKETHROUGH, $text);
        $text = str_replace($symbol . "n", TF::UNDERLINE, $text);
        $text = str_replace($symbol . "o", TF::ITALIC, $text);
        $text = str_replace($symbol . "r", TF::RESET, $text);
        $text = str_replace($othersymbol . "0", TF::BLACK, $text);
        $text = str_replace($othersymbol . "2", TF::DARK_GREEN, $text);
        $text = str_replace($othersymbol . "3", TF::DARK_AQUA, $text);
        $text = str_replace($othersymbol . "4", TF::DARK_RED, $text);
        $text = str_replace($othersymbol . "5", TF::DARK_PURPLE, $text);
        $text = str_replace($othersymbol . "6", TF::GOLD, $text);
        $text = str_replace($othersymbol . "7", TF::GRAY, $text);
        $text = str_replace($othersymbol . "8", TF::DARK_GRAY, $text);
        $text = str_replace($othersymbol . "9", TF::BLUE, $text);
        $text = str_replace($othersymbol . "a", TF::GREEN, $text);
        $text = str_replace($othersymbol . "b", TF::AQUA, $text);
        $text = str_replace($othersymbol . "c", TF::RED, $text);
        $text = str_replace($othersymbol . "d", TF::LIGHT_PURPLE, $text);
        $text = str_replace($othersymbol . "e", TF::YELLOW, $text);
        $text = str_replace($othersymbol . "f", TF::WHITE, $text);
        $text = str_replace($othersymbol . "k", TF::OBFUSCATED, $text);
        $text = str_replace($othersymbol . "l", TF::BOLD, $text);
        $text = str_replace($othersymbol . "m", TF::STRIKETHROUGH, $text);
        $text = str_replace($othersymbol . "n", TF::UNDERLINE, $text);
        $text = str_replace($othersymbol . "o", TF::ITALIC, $text);
        $text = str_replace($othersymbol . "r", TF::RESET, $text);
        return $text;
    }
    
}

?>