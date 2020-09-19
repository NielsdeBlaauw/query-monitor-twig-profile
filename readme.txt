=== Query monitor Twig profile ===
Contributors: nielsdeblaauw
Tags: timber, twig, query monitor, performance, profile, speed, template, theme
Requires at least: 4.9.0
Tested up to: 5.5.1
Requires PHP: 7.0
Stable tag: 1.0.3
License: MIT
License URI: https://raw.githubusercontent.com/NielsdeBlaauw/query-monitor-twig-profile/master/LICENSE

Displays Twig profiler output in Query Monitor.

== Description ==
Find out which pages are slow, and why! Immediately see profiling information from twig in your Query Monitor toolbar. 

Automatically integrates with Timber.

== Installation ==
1. Install the plugin.
2. Activate it.
3. Check the \'Twig profile\' tab in Query Monitor.
4. Optimize your site.

== Frequently Asked Questions ==
# Can I use it with other frameworks that use twig?
Definitely. Just add a twig profiler extension to your twig instance and submit it to the collector.

```
$profile = new \Twig\Profiler\Profile();
$twig->addExtension( new \Twig\Extension\ProfilerExtension( $profile ) );
$collector = \QM_Collectors::get( 'twig_profile' );
if ( $collector instanceof \NdB\QM_Twig_Profile\Collector ) {
	$collector->add( $profile );
}
```

= Privacy Statement =
Query Monitor Twig Profile is private by default and always will be. It does not persistently store any of the data that it collects. It does not send data to any third party, nor does it include any third party resources.

== Screenshots ==
1. The Twig profile tab in Query Monitor (light mode)
2. The Twig profile tab in Query Monitor (dark mode)

== Changelog ==
next
* Support for dark mode.

1.0.3
* Removes assets release library.
* Uses readme.txt file.

1.0.2
* Fixes readme.

1.0.1
* Adds automated releases from GitHub.
* Improves readme.
* Fixes several type hints.
* Adds CI checks (phpstan, phpcs, phpcompat, composer validate).
* Defines required PHP version as >7.0.

1.0.0:
* Initial release.
