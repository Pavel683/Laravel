<?php

namespace App\Services;

class FormatterServes
{

    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function formatted()
    {
        $val = $this->value;
        $val = str_replace([' ', '/', '_'], "", $val);
        if (strpos($val, ',') !== false){
            $val = str_replace(",", ".", $val);
        }

        $number = number_format(round($val, 2), 2, ',', ' ');
        return $number;
    }


}
