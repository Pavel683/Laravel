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
        return $this->value;
    }


}
