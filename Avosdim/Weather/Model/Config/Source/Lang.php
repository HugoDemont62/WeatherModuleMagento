<?php

namespace Avosdim\Weather\Model\Config\Source;

class Lang
{
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            "en" => "English",
            "ru" => "Russian",
            "de" => "German",
            "fr" => "French",
            "it" => "Italian",
            "es" => "Spanish",
            "ua" => "Ukrainian",
            "pl" => "Polish",
            "ro" => "Romanian",
            "fi" => "Finnish",
            "nl" => "Dutch",
            "bg" => "Bulgarian",
            "zh" => "Chinese",
            "tr" => "Turkish",
            "sv" => "Swedish",
            "sr" => "Serbian",
            "sk" => "Slovak",
            "sl" => "Slovenian",
            "pt" => "Portuguese",
            "no" => "Norwegian",
            "ja" => "Japanese",
        ];
    }
}
