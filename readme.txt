===  CodeBard's Patron Button and Widgets for Patreon ===
Author URI: http://codebard.com
Plugin URI: https://wordpress.org/plugins/patron-button-and-widgets-by-codebard/
Contributors: CodeBard
Donate link: http://codebard.com/donate
Tags: patreon, widgets, crowdfunding, donations, social
License: GPL
Requires at least: 4.0
Tested up to: 6.8.2
Stable Tag: 2.2.4

Add Patreon buttons to your content and sidebars. Upgrade to Patron Plugin Pro for patron-only posts and powerful features.

== Description ==

This free plugin allows you to add a Patreon Button under the content to have your users to become your patrons on Patreon easily. It also provides two customizable Widgets that you can use in your sidebar.

The buttons and widgets blend in with your theme seamlessly. You can use the new or old Patreon button or you can use your own button image.

You can customize the call to action text over the buttons or turn them on/off, as well as use your own call to action text. You can disable the Buttons under content if you wish to use only the Widgets as well.

You can enter the default account to be used in buttons in plugin options page.

In addition, all authors will be able to add their own Patreon username in their profile to be used for the Buttons, so the Buttons showing under their posts as well as the Author Widget in sidebar will go to their Patreon profile. This feature can be disabled if you wish, from plugin settings, with “Force Site Button instead of Author” option.

More features are planned as they become available in Patreon API.

You can upgrade to Patron Plugin Pro, add the Patron Content Manager addon and enable powerful content-locking options to serve Patron only content from your own website! Patron Plugin Pro will also allow you to put your patrons directly to patron pipeline instead of your profile. Check it out below:

https://codebard.com/patron-plugin-pro

---------------------------

After install, activate the plugin, and that’s it.

You should fill in the Site Patreon Account in plugin settings page. This is the Patreon account which will be used for buttons for any user who did not put their Patreon account in their profile on your site.

You will find the two widgets you can use in your Appearance -> Widgets section. Widgets are customizable

== Installation ==

1. Activate the plugin
2. A "CB Patreon" menu item will be added to your WordPress Admin Menu
3. At least visit this menu and fill in the "Site/Admin Patreon Account" field with the username/slug you entered to "Personal Patreon url" field in your Patreon Profile. This will be the default Patreon user for all buttons.
4. Done.
5. You can find two widgets in Appearance -> Widgets. 
6. All authors will receive a profile field for Patreon. If they fill in this field in the same manner for themselves like in step #3, then their own personal Patreon account will be used in their buttons instead of Site's.

== Frequently Asked Questions ==

= How can I report security bugs? =

You can report security bugs through the Patchstack Vulnerability Disclosure Program. The Patchstack team help validate, triage and handle any security vulnerabilities. [Report a security vulnerability.](https://patchstack.com/database/vdp/patron-button-and-widgets-by-codebard)

== Screenshots ==

1. Patron Button for Posts
2. Patron Button Widget for Site
3. Patron Button Widget for Author
4. Quick Start easy settings page


== Upgrade Notice ==

= 2.2.4 =

* Removed unused updater code

= 2.2.3 =

* Fixed a PHP deprecation warning

= 2.2.2 =

* Fixed a PHP warning

= 2.2.1 =

* Sanitized various inputs against xss attacks

= 2.2.0 =

* Settings tab resetting & going to dashboard when saving a setting was fixed
* An issue with settings tabs not working correctly was fixed
* An issue with cross site scripting vulnerability was fixed
* Various forms and actions had security nonces added

= 2.1.9 =

* Added extra sanitization for security

= 2.1.8 =

* Fixed a bug that could prevent WP cli used in managed hosting services from failing in certain tasks
* Addressed a PHP warning
* Sanitized setup modal's site_account input

= 2.1.7 =

* Added alt tags and aria labels for screen readers to call to action button under posts and sitebar widgets and forms for accessibility.
* Fixed a PHP warning

= 2.1.6 =

* Fixed a PHP warning

= 2.1.5 =

* Added conditional that hides PCM notice if PP is installed

= 2.1.4 =

* Changed plugin name to "CodeBard's Patron Button and Widgets for Patreon" per WP org rules

= 2.1.3 =

* Changed plugin name per WP org repo rules

= 2.1.2 =

* Added checks to prevent the same notice being shown twice at the same page load

= 2.1.1 =

* Added a notice system. Adjusted notices to show 30 days after last notice is shown. Made notices appear in sequential order. Separated system notices and non system notices. Notices are permanently dismissable.
* Made plugin save time of activation when activated
* Added notice for new Patreon plugin

= 2.1.0 =

* Updated update_usermeta to update_user_meta to address warnings

= 2.0.9 =

* Fixed widget and post button urls giving 404 if a non vanity Patreon url when user id was used.
* Better decision logic in constructing urls

= 2.0.8 =

* Added Goals widget. Shows financial goals from Patreon.
* Added one click auto installer for the needed Patreon WordPress free plugin to use goals widget
* Added admin pointers
* Added admin pointer for goal widget

= 2.0.7 =

* Changed post button appearing logic to show for all content except pages. It should show for all posts and custom posts as long as they are singular.

= 2.0.6 =

* Removed PHP 7 compatible widget notice
* Updated tested up to

= 2.0.5 =

* Minor fix for unused plugins_api injectinfo function - removed

= 2.0.4 =

* Widget language loading causing some WP-CLI command line functions to fail fixed
* Important issue that prevented languages from being saved and custom languages from being used fixed

= 2.0.3 =

* Widgets now PHP 7.x+ compatible with proper constructors
* Notice to update the widgets added

= 2.0.2 =

* Major bugfix non-English (en-US) language sites and Out of Memory errors
* New Modal based wizards

= 2.0.1 =

* Major bugfix with the patron urls containing utm_source not working - a must

= 2.0.0 =

* Totally new plugin engine 

= 1.0.6 =

* New Patreon Button 
* Option for using new or old Patreon button
* Custom button uploader
* Custom button width option
* Minor Css fixes
* Admin side jquery and media uploader queueing

= 1.0.5 =

* Unnecessary info update code removed to prevent foreach errors

= 1.0.4 =

* Fix to prevent output buffering from capturing whitespace

= 1.0.3 =

* Option to hide Site Widget in Single Posts
* Reinforced checking for singular post type for appending the button
* Changes to settings page tab code to prevent PHP Warnings regarding strings

= 1.0.2 =

* Installation Wizard to help users fill in their Patreon URLS during first install or if they didnt save it before
* Patreon URL verifications in Install Wizard
* Allow both URL and account name (Personal Url slug to be used from the database for constructing button urls
* Routine to check versions and update variables in db if necessary during updates
* Option to open Patreon Profiles in new window when users click on buttons
* Minor fixes to settings tabs

= 1.0.1 =

* Unnecessary update and api codes removed

= 1.0.0 =

* Initial release!

== Changelog ==

= 2.2.4 =

* Removed unused updater code

= 2.2.3 =

* Fixed a PHP deprecation warning

= 2.2.2 =

* Fixed a PHP warning

= 2.2.1 =

* Sanitized various inputs against xss attacks

= 2.2.0 =

* Settings tab resetting & going to dashboard when saving a setting was fixed
* An issue with settings tabs not working correctly was fixed
* An issue with cross site scripting vulnerability was fixed
* Various forms and actions had security nonces added

= 2.1.9 =

* Added extra sanitization for security

= 2.1.8 =

* Fixed a bug that could prevent WP cli used in managed hosting services from failing in certain tasks
* Addressed a PHP warning
* Sanitized setup modal's site_account input

= 2.1.7 =

* Added alt tags and aria labels for screen readers to call to action button under posts and sitebar widgets and forms for accessibility
* Fixed a PHP warning

= 2.1.6 =

* Fixed a PHP warning

= 2.1.5 =

* Added conditional that hides PCM notice if PP is installed

= 2.1.4 =

* Changed plugin name to "CodeBard's Patron Button and Widgets for Patreon" per WP org rules

= 2.1.3 =

* Changed plugin name per WP org repo rules

= 2.1.2 =

* Added checks to prevent the same notice being shown twice at the same page load

= 2.1.1 =

* Added a notice system. Adjusted notices to show 30 days after last notice is shown. Made notices appear in sequential order. Separated system notices and non system notices. Notices are permanently dismissable.
* Made plugin save time of activation when activated
* Added notice for new Patreon plugin

= 2.1.0 =

* Updated update_usermeta to update_user_meta to address warnings

= 2.0.9 =

* Fixed widget and post button urls giving 404 if a non vanity Patreon url when user id was used.
* Better decision logic in constructing urls

= 2.0.8 =

* Added Goals widget. Shows financial goals from Patreon.
* Added one click auto installer for the needed Patreon WordPress free plugin to use goals widget
* Added admin pointers
* Added admin pointer for goal widget

= 2.0.7 =

* Changed post button appearing logic to show for all content except pages. It should show for all posts and custom posts as long as they are singular.

= 2.0.6 =

* Removed PHP 7 compatible widget notice
* Updated tested up to

= 2.0.5 =

* Minor fix for unused plugins_api injectinfo function - removed

= 2.0.4 =

* Widget language loading causing some WP-CLI command line functions to fail fixed
* Important issue that prevented languages from being saved and custom languages from being used fixed

= 2.0.3 =

* Widgets now PHP 7.x+ compatible with proper constructors
* Notice to update the widgets added

= 2.0.2 =

* Major bugfix non-English (en-US) language sites and Out of Memory errors
* New Modal based wizards

= 2.0.1 =

* Major bugfix with the patron urls containing utm_source not working - a must

= 2.0.0 =

* Totally new plugin engine 

= 1.0.6 =

* New Patreon Button 
* Option for using new or old Patreon button
* Custom button uploader
* Custom button width option
* Minor Css fixes
* Admin side jquery and media uploader queueing

= 1.0.5 =

* Unnecessary info update code removed to prevent foreach errors

= 1.0.4 =

* Fix to prevent output buffering from capturing whitespace

= 1.0.3 =

* Option to hide Site Widget in Single Posts
* Reinforced checking for singular post type for appending the button
* Changes to settings page tab code to prevent PHP Warnings regarding strings

= 1.0.2 =

* Installation Wizard to help users fill in their Patreon URLS during first install or if they didnt save it before
* Patreon URL verifications in Install Wizard
* Allow both URL and account name (Personal Url slug to be used from the database for constructing button urls
* Routine to check versions and update variables in db if necessary during updates
* Option to open Patreon Profiles in new window when users click on buttons
* Minor fixes to settings tabs

= 1.0.1 =

* Unnecessary update and api codes removed

= 1.0.0 =

* Initial release!