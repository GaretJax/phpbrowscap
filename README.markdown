Browser Capabilities PHP Project
================================

_Hacking around with PHP to have a better solution than `get_browser()`_

[![Build Status](https://secure.travis-ci.org/GaretJax/phpbrowscap.png?branch=master)](http://travis-ci.org/GaretJax/phpbrowscap)

Introduction
------------

The [browscap.ini](http://tempdownloads.browserscap.com/) file is a
database was maintained by [Gary Keith](https://github.com/GaretJax/) and is 
now maintained by [RAD Moose](https://plus.google.com/u/0/114247395634091389252/).
More information about the transfer of owners can be found here: https://groups.google.com/forum/#!topic/browscap/pk_dkkqdXzg
The [browscap.ini](http://tempdownloads.browserscap.com/), which,
provides a lot of details about browsers and their capabilities, such as name,
versions, Javascript support and so on.

PHP's native [get_browser()](http://php.net/get_browser) function parses this
file and provides you with a complete set of information about every browser's
details, But it requires the path to the browscap.ini file to be specified in
the php.ini [browscap](http://ch2.php.net/manual/en/ref.misc.php#ini.browscap)
directive which is flagged as `PHP_INI_SYSTEM`.

Since in most shared hosting environments you have not access to the php.ini
file, the browscap directive cannot be modified and you are stuck with either
and outdated database or without browscap support at all.

Browscap is a standalone class for PHP >=5.3 that gets around the limitations of
`get_browser()` and manages the whole thing.
It offers methods to update, cache, adapt and get details about every supplied
user agent on a standalone basis.

Browscap is a [Composer](http://packagist.org/about-composer) package.


Browscap is currently running on a temporary site (http://tempdownloads.browserscap.com/)
while some things are sorted out and redone after a change of owners. For more
information, look here: https://groups.google.com/d/msg/browscap/pk_dkkqdXzg/5ij0kxjCfocJ

Quick start
-----------

A quick start guide is available on the GitHub wiki, at the following address:
https://github.com/GaretJax/phpbrowscap/wiki/QuickStart


Features
--------

Here is a non-exaustive feature list of the Browscap class:

 * Fast
 * Standalone
 * Even faster parsing many user agents
 * Fully get_browser() compatible
 * Often faster and more accurate than get_browser()
 * Fully PHP configuration independent
 * User agent auto-detection
 * Returns object or array
 * Parsed .ini file cached directly into PHP arrays
 * Accepts any .ini file (even ASP and lite versions)
 * Auto updated browscap.ini file and cache from remote server with version checking
 * Configurable remote update server
 * Fully configurable (since 0.2)
 * <del>PHP4 and</del> PHP >=5.3 compatible (PHP <5.3 version deprecated)
 * Released under the MIT License


Issues and feature requests
---------------------------

Please report your issues and ask for new features on the GitHub Issue Tracker
at https://github.com/GaretJax/phpbrowscap/issues

Please note that the browscap class only parses and queries the browscap.ini
database provided by Gary Keith. If a browser is wrongly identified or a results
presents erroneous properties, please refer directly to the temporary browscap project
homepage at: http://tempdownloads.browserscap.com/
