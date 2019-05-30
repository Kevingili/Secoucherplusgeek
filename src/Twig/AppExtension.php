<?php
// src/Twig/AppExtension.php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('twig_get_env', 'getenv'),
        ];
    }
}