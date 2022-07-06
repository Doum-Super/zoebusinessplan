<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{

    public function getFunctions()
    {
        return array(
            new TwigFunction('current_year', array(Runtime::class, 'getCurrentYear')),
            new TwigFunction('decode', array(Runtime::class, 'decode')),
        );
    }
}
