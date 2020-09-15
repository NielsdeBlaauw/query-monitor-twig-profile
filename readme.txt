=== Query monitor Twig profile ===
Contributors: nielsdeblaauw
Tags: timber, twig, query monitor, performance, profile, speed, template, theme
Requires at least: 4.9.0
Tested up to: 5.5.1
Requires PHP: 7.2
Stable tag: 1.0.0
License: MIT
License URI: https://raw.githubusercontent.com/NielsdeBlaauw/query-monitor-twig-profile/master/LICENSE

Displays Twig profiler output in Query Monitor. Automatically works with Timber.

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
$profile = new Profile();
$twig->addExtension( new ProfilerExtension( $profile ) );
$collector = QM_Collectors::get( \'twig_profile\' );
if ( $collector instanceof Collector ) {
	$collector->add( $profile );
}
```

== Changelog ==
1.0.0:
* Initial release
