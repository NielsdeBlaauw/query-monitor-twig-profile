<?php

namespace Twig\Profiler\Dumper;

use Twig\Profiler\Profile;

final class Dumper extends BaseDumper
{
    private static $colors = [
        'auto' => '#fdf',
        'block' => '#dfd',
        'macro' => '#ddf',
        'template' => '#ffd',
        'big' => '#d44',
        'text-light' => '#fff',
        'text-dark' => '#000',
    ];

    public function dump(Profile $profile)
    {
        return '<pre>'.parent::dump($profile).'</pre>';
    }

    protected function formatTemplate(Profile $profile, $prefix)
    {
        return sprintf('%s└ <span style="background-color: %s; color: %s">%s</span>', $prefix, self::$colors['template'], self::$colors['text-dark'], $profile->getTemplate());
    }

    protected function formatNonTemplate(Profile $profile, $prefix)
    {
        return sprintf('%s└ %s::%s(<span style="background-color: %s; color: %s">%s</span>)', $prefix, $profile->getTemplate(), $profile->getType(), isset(self::$colors[$profile->getType()]) ? self::$colors[$profile->getType()] : self::$colors['auto'], self::$colors['text-dark'], $profile->getName());
    }

    protected function formatTime(Profile $profile, $percent)
    {
        return sprintf('<span style="color: %s">%.2fms/%.0f%%</span>', $percent > 20 ? self::$colors['big'] : 'auto', $profile->getDuration() * 1000, $percent);
    }
}
