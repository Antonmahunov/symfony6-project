<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension implements GlobalsInterface
{

    private string $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('price', [$this, 'priceFilter']),
        ];
    }

    public function getGlobals(): array
    {
        return [
            'locale' => $this->locale,
        ];
    }

    public function priceFilter($number): string
    {
        return '$'.number_format($number, 0, '', ' ');
    }
}