=== Copy Anything to Clipboard ===
Contributors: Mahesh901122
Donate link: https://www.paypal.me/mwaghmare7/
Tags: Copy to Clipboard, Clipboard, Copy Anything to Clipboard
Tested up to: 5.4
Stable tag: 1.8.0
Requires PHP: 5.6
Requires at least: 4.4

== Description ==

=== Copy Anything to Clipboard: the #1 WordPress Copy to Clipboard plugin

Add a copy button anywhere and simply copy it into the clipboard (📋).

You can copy to clipboard: code snippets, special symbols, discount codes, or anything which you want.

By default, the copy button is added to the `<pre>` tag. You can easily change the `pre` tag selector with any other selector. You can read more [about selector](https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#what-is-the-selector).

**FREE And Popular Copy to Clipboard Plugin**

Over 1k+ users are empowering their websites with "Copy Anything to Clipboard" – 100% compatible for all themes and plugins.

Reasons why people love the Copy Anything to Clipboard

- Zero configuration
- Easy to use
- Customization options
- Quick support

**Welcome for featured requests**

If you have any suggestion or any featured request then don't hesitate to [contact](https://maheshwaghmare.com/say-hello/).

=== Bug reports

Bug reports for "Copy Anything to Clipboard" are welcomed in our [repository on GitHub](https://github.com/maheshwaghmare/copy-the-code/). Please note that GitHub is not a support forum, and that issues that are not properly qualified as bugs will be closed.

=== Further reading

For more info check out the following:

* The [maheshwaghmare.com](https://maheshwaghmare.com/) official website.
* The [Contact Me](https://maheshwaghmare.com/say-hello/).
* The [Getting started guide](https://maheshwaghmare.com/doc/copy-anything-to-clipboard/).
* Other my [WordPress Plugins](https://wordpress.org/plugins/search/mahesh901122/).
* Contribute with [development](https://github.com/maheshwaghmare/copy-the-code/).
* Make a [small donation](https://www.paypal.me/mwaghmare7/).

== Image Copyrights

Icons made by <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>

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

= 1.8.0 =

* New: Set the `Copy Content As` default option with `text`.
* Improvements: Converted the `<br>` tags into the new line if the option "Copy Content As" selected as `Text`.
* Improvements: Converted the `<div>` tags into the new line if the option "Copy Content As" selected as `Text`.
* Improvements: Converted the `<p>` tags into the new line if the option "Copy Content As" selected as `Text`.
* Improvements: Converted the `<li>` tags into the new line if the option "Copy Content As" selected as `Text`.
* Improvements: Remove the white spaces and trim the content if the option "Copy Content As" selected as `Text`.
* Fix: Copy the content as text works different on Chrome, Firefox and Internet Explorer browsers.

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