# DWS WordPress Utility Plugin

**Contributors:** Antonius Hegyes, Deep Web Solutions GmbH  
**Requires at least:** 5.5  
**Tested up to:** 5.7  
**Requires PHP:** 7.4  
**Stable tag:** 1.0.0  
**License:** GPLv3 or later  
**License URI:** http://www.gnu.org/licenses/gpl-3.0.html  


## Description 

[![Build Status](https://travis-ci.com/deep-web-solutions/wordpress-plugins-utility.svg?branch=master)](https://travis-ci.com/deep-web-solutions/wordpress-plugins-utility)

A skeleton plugin using the DWS framework that can be used to add site-specific code. If installing on a new site, run this 
command on the live site:

`composer install --no-dev --ignore-platform-reqs`

Do NOT push any changes to the `vendor` folder to the server afterwards (unless you know what you're doing).


## Contributing 

Contributions both in the form of bug-reports and pull requests are more than welcome!


## Frequently Asked Questions 

- Will you support earlier versions of WordPress and PHP?

The bootstrapper module itself will run on any PHP version back to 5.3 -- however, it will do so only to let the user know
that they should update to at least PHP 7.4. As of this writing (March 2021), PHP 7.3 is close to EOL, and we consider 7.4
to provide a few features that are absolutely amazing. Moreover, WP 5.5 introduced a few new features that we really want
to use as well, and we consider it to be one of the first versions of WordPress to have packed a more-or-less mature version of Gutenberg.

If you're using older versions of either one, you should really consider upgrading at least for security reasons.

- Is this bug-free?

Hopefully yes, probably not. If you found any problems, please raise an issue on Github!


## Changelog 

### 1.0.0 (TBD) 
* First official release.
