=== YouTube Playlist Player ===
Contributors: butterflymedia
Tags: youtube, player, playlist, video, carousel, thumbnail, javascript
Requires at least: 4.5
Tested up to: 4.9.1
Requires PHP: 5.5
Stable tag: 4.3.3
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Display a YouTube player (with an optional playlist) on any post or page using a simple shortcode.

== Description ==

Display a YouTube player (with an optional playlist) on any post or page using a simple shortcode. The plugin supports a static YouTube player (no video title) and a dynamic one (video title) using the YouTube Data API v3.

Check out the YouTube Playlist Player demo here:
[https://getbutterfly.com/demos/youtube-playlist-player/](https://getbutterfly.com/demos/youtube-playlist-player/ "YouTube Playlist Player demo")

Check out more WordPress plugins here:
[https://getbutterfly.com/wordpress-plugins/](https://getbutterfly.com/wordpress-plugins/ "More WordPress plugins")

== Installation ==

1. Upload to your plugins folder, usually `wp-content/plugins/`
2. Activate the plugin on the plugins screen.
3. Configure the plugin from Settings -> YouTube Playlist Player.

== Screenshots ==

1. Front-end player
2. Dashboard
3. General Settings
4. YouTube API
5. Help/Usage

== Changelog ==

= 4.3.3 =
* FIX: Fixed localized issue not saving options

= 4.3.2 =
* UPDATE: Updated WordPress compatibility
* UPDATE: Added new screenshots
* UPDATE: UI tweaks

= 4.3.1 =
* FIX: Removed old code
* UPDATE: Refactored and moved player functions
* UPDATE: Added YouTube related options
* UPDATE: Removed unused option
* UPDATE: Added more documentation (+ YouTube API how-to)
* UPDATE: Added more/better YouTube branding

= 4.3 =
* FIX: Loaded JS/CSS assets only when shortcode is present
* FEATURE: Added YouTube API V3
* FEATURE: Added new settings screen
* FEATURE: Added new shortcode
* UPDATE: Added a bit of documentation
* UPDATE: Added more/better YouTube branding

= 4.2.4 =
* FIX: YouTube Branding fixes
* FIX: Author box layout fixes

= 4.2.3 =
* FIX: Regression fix for previous version (added interval checking)

= 4.2.2 =
* FIX: Fixed player detection before being loaded

= 4.2.1 =
* FIX: Fixed JS code being executed on all pages
* UPDATE: Updated readme.txt

= 4.2 =
* FIX: Added PHP compatibility
* FIX: Fixed/updated old screenshots
* FIX: Removed jQuery dependency
* FIX: Fixed JS codeflow
* UPDATE: Updated WordPress compatibility
* UPDATE: Updated readme.txt and general information

= 4.1.6 =
* FIX: Fixed script being included before jQuery
* FIX: Fixed duplicated variable assignment
* FIX: Fixed strict variable assignment
* FIX: Removed unused colour picker script
* UPDATE: Updated plugin usage details
* UPDATE: Small admin UI tweaks
* UPDATE: Removed `novd` argument and switched to internal count

= 4.1.5 =
* PERFORMANCE: Stopped options from autoloading
* UPDATE: Updated WordPress compatibility
* UPDATE: Better i18n options
* UPDATE: Removed unused colour option

= 4.1.4 =
* FIX: Removed version constant
* FIX: Better security tweaks
* UPDATE: Updated admin menu name to reflect the plugin

= 4.1.3 =
* FIX: License update
* FIX: Official link update

= 4.1.2 =
* FIX: Fixed color picker enqueue dependency
* UPDATE: Moved all JS code to a separate file
* UPDATE: Changed the main video playlist function (JS) to accept parameters

= 4.1.1 =
* FIX: Removed hardcoded background colour
* FIX: Removed hardcoded padding and increased margin
* FIX: Correctly enqueued style.css
* UPDATE: Updated default height and added option autoloading
* UPDATE: Completely refactored YouTube Javascript
* UPDATE: Removed all Flash (SWFObject) dependencies

= 4.1.0 =
* FIX: Added index.php file to plugin root
* UPDATE: Updated plugin URLs
* UPDATE: Updated CSS styles for better compatibility

= 4.0.1 =
* UPDATE: Added getButterfly ad box

= 4.0.0 =
* FIX: Changed all HTTP links to HTTPS
* FIX: Updated YouTube API and removed all deprecated functions and parameters
* FIX: Removed parameters with same values as the default ones
* FIX: Cleaned up the code (slight performance increase)
* FIX: Fixed rare cases of line ending issues
* UI: Removed background color for better theme integration

= 3.2.0 =
* FIX: Fixed IFRAME name target
* FEATURE: Added responsiveness

= 3.1.0 =
* FIX: Fixed a PHP warning
* FIX: Removed deprecated options nonce
* FEATURE: Added usage details on the plugin page
* PROMOTION: Added link to premium version on CodeCanyon

= 3.0.2 =
* Added license link
* Added donate link
* Added default options
* Fixed wrong internal version

= 3.0.1 =
* Added CSS vendor prefixes

= 3.0.0 =
* Initial release
