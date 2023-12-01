<?php

namespace Tests\Unit;

use App\Services\FormatterServes;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testFormatted1(): void  // Так можно делать свои автотесты
    {
        $val = "1000000,679";
        $needly = "1 000 000,68";
        $formatter_serves = new FormatterServes($val);
        $formatted = $formatter_serves->formatted();
        $this->assertEquals($needly, $formatted);
    }

    public function testFormatted2(): void  // Так можно делать свои автотесты
    {
        $val = "1 000 000.679";
        $needly = "1 000 000,68";
        $formatter_serves = new FormatterServes($val);
        $formatted = $formatter_serves->formatted();
        $this->assertEquals($needly, $formatted);
    }

    public function testFormatted3(): void  // Так можно делать свои автотесты
    {
        $val = 1000000;
        $needly = "1 000 000,00";
        $formatter_serves = new FormatterServes($val);
        $formatted = $formatter_serves->formatted();
        $this->assertEquals($needly, $formatted);
    }
}
