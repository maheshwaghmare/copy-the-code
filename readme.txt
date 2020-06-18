=== Copy Anything to Clipboard ===
Contributors: Mahesh901122
Donate link: https://www.paypal.me/mwaghmare7/
Tags: Copy to Clipboard, Clipboard, Copy Anything to Clipboard
Tested up to: 5.4
Stable tag: 1.7.5
Requires at least: 4.4

Copy the Text or HTML into the clipboard 📋 (clipboard). You can use it for code snippets, special symbols, discount codes, or anything which you want. By default it add the copy to clipboard button to the <code>&lt;pre&gt;</code> tag.

Documentations and more visit <a href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/"> on Quick Guide</a>.

== Description ==

Simply copy the content into the clipboard.

Copy the Text or HTML into the clipboard 📋 (clipboard). You can use it for code snippets, special symbols, discount codes, or anything which you want. By default it add the copy to clipboard button to the `<pre>` tag.

Documentations and more visit <a href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/"> on Quick Guide</a>.

By default, the Copy to Clipboard button is added to the `<pre>` tag. So, After plugin installs and activates the plugin add the Copy to Clipboard button to all pre tags.

In plugin we have a setting page in which we can change the `<pre>` selector.

Below is the list of manually testing themes:

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

= How does it Works? =

After plugin install and activate, By default on front-end the `Copy` button is added for all the `<pre>` tags.

On click on it the content within the `pre` tags is copy in clipboard.

= What is the selector? =

Selector is the target element in which we want to add the copy button. It should be any valid CSS selector.

<a href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#what-is-the-selector/">Read more about selectors »</a>

= Some Examples of Selectors? =

Lets check below some selectors which are valid to use:

- `pre` - Copy button added all the `pre` tags.
- `.single pre` - Copy button added only if its parent have CSS class `.single`.
- `#my-account-section-1 pre` - Copy button added only if its parent have CSS class `#my-account-section-1`.

<a href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#what-is-the-selector/">Read more about selectors »</a>

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

= 1.7.5 =

* Fix: The `<br>` tag converted into the next line. Select the `Text` from option `Copy Content As`. Reported by Konrad.
* Fix: Single level selector copies the selector in the clipboard. Reported by Seb.

= 1.7.4 =

* Fix: Nested selectors was not working due to mismatch the copy button position.

= 1.7.3 =

* Fix: The `<br>` tags was not copied as new line.  Reported by @psanger.

= 1.7.2 =

* Improvement: Removed unwanted code.

= 1.7.1 =

* Improvement: Updated Freemius SDK library with version 2.3.2.
* Improvement: Added the latest new section.
* Fix: The submit button is not visible form the settings page. Reported by Nicolas Tizio

= 1.7.0 =

* New: Added General & Style tabs.

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