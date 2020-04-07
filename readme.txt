=== Copy Anything to Clipboard ===
Contributors: Mahesh901122
Donate link: https://www.paypal.me/mwaghmare7/
Tags: Copy to Clipboard, Copy, Clipboard, Code, Copy Code, Copy Anything to Clipboard
Tested up to: 5.6
Stable tag: 1.6.1
Requires at least: 4.4

Copy Anything to Clipboard into 📋 (clipboard). Default support added for <code>&lt;pre&gt;</code> tag. Documentations and more visit <a href="https://github.com/maheshwaghmare/copy-the-code/"> on GitHub</a>.

== Description ==

Plugin add the `Copy` button within the `<pre>` tag and it copy the content of `<pre>` tag into the clipboard.

Few Tested Themes:

- Twenty Twelve – By WordPress.org
- Twenty Sixteen – By WordPress.org
- Twenty Seventeen – By WordPress.org
- Twenty Nineteen – By WordPress.org
- Velux – By GoDaddy
- Hello Elementor – By Elementor
- OceanWP – By oceanwp
- Astra – By Brainstorm Force
- Ascension – By GoDaddy
- Twenty Sixteen – By WordPress.org
- Twenty Fifteen – By WordPress.org
- Hestia – By Themeisle
- Neve – By Themeisle
- Escapade – By GoDaddy
- Shapely – By Silkalns
- Sydney – By athemes
- Storefront – By Automattic
- Twenty Fourteen – By WordPress.org
- Futurio – By FuturioWP
- Zakra – By ThemeGrill
- GeneratePress – By Tom
- Mesmerize – By Extend Themes
- Highlight – By Extend Themes
- Customify – By PressMaximum
- Ashe – By WP Royal

Extend the plugin on [Github](https://github.com/maheshwaghmare/copy-the-code/)

== Installation ==

1. Install the <code>Copy Anything to Clipboard</code> plugin either via the WordPress plugin directory, or by uploading the files to your server at <code>wp-content/plugins</code>.

== Frequently Asked Questions ==

= How it Works? =

After plugin install and activate, By default on front-end the `Copy` button is added for all the `<pre>` tags.

On click on it the content within the `pre` tags is copy in clipboard.

= What is selector? =

Selector is the target element in which we want to add the copy button. It should be any valid CSS selector.

= Some Examples of Selectors? =

Lets check below some selectors which are valid to use:

- `pre` - Copy button added all the `pre` tags.
- `.single pre` - Copy button added only if its parent have CSS class `.single`.
- `#my-account-section-1 pre` - Copy button added only if its parent have CSS class `#my-account-section-1`.

= Can I change the copied content? =

Yes, By default the content are copied as HTML. We can change it as Text so content copied without HTML tags.

= Can I default copy button string's? =

Yes, We can change the default strings of the button text, button copied text and the title of the button too.

= Can I change the copy button position?

Yes, By default the button is added within the selector. But, We can change it outside the selector.

= Can I change the selector with filter? =

Yes, We can use the `copy_the_code_localize_vars` selector to change the currently stored selector.

E.g.

<pre>
add_filter( 'copy_the_code_localize_vars', 'my_slug_copy_the_code_localize_vars' );
function my_slug_copy_the_code_localize_vars( $defaults )
{
	// `single class is added to the `<body>` tag for the single page, post etc.
	$defaults['selector'] = 'body.single pre';

	return $defaults;	
}
</pre>

= Is plugin compatible for all the themes? =

Yes, We have added `!important` for the Copy button to keep the button style same for each theme. We have tested below themes.

== Changelog ==

= 1.6.1 =

* Improvement: Added WordPress 5.4 compatibility.

= 1.6.0 =

* New: Added filter `copy_the_code_default_page_settings` to change the default page settings.
* New: Added filter `copy_the_code_page_settings` to change the page settings.

= 1.5.0 =

* New: Added option 'Button Text' to set the default button text. Default 'Copy'.
* New: Added option 'Button Copy Text' to set the button text after click on copy. Default 'Copied!'.
* New: Added option 'Button Title' to set the default button title which appear on hover on button. Default 'Copy to Clipboard'.
* New: Added option 'Button Position' to set the button position. Inside or outside the selector. Default 'inside'.
* Improvement: Added support for Internet Explorer devices. Reported by @rambo3000

= 1.4.1 =

* Fix: Added support for IOS devices. Reported by @radiocure1

= 1.4.0 =
* New: Added option 'Copy Content As' to copy the content as either HTML or Text. 

= 1.3.1 =
* Improvement: Updated the strings and compatibility for WordPress 5.0.

= 1.3.0 =
* New: Added support, contact links.

= 1.2.0 =
* New: Added settings page for customizing the plugin. Added option `selector` to set the JS selector. Default its `<pre>` html tag.

= 1.1.0 =
* Fix: Removed `Copy` button markup from the copied content from the clipboard.

= 1.0.0 =
* Initial release.