<?php

namespace App\Twig;

use Symfony\Component\Filesystem\Filesystem;
use Twig\Extension\RuntimeExtensionInterface;

class Runtime implements RuntimeExtensionInterface
{

    public function getCurrentYear() {
        return (new \DateTime())->format('Y');
    }

    public function decode(String $text)
    {   
        return html_entity_decode($text);
    }
}
