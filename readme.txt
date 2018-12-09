=== Copy Anything to Clipboard ===
Contributors: Mahesh901122
Donate link: https://www.paypal.me/mwaghmare7/
Tags: Copy to Clipboard, Copy the Code, Copy, Clipboard, Code, Copy Code, Copy Anything to Clipboard
Tested up to: 5.0.0
Stable tag: 1.3.0
Requires at least: 4.4

Copy the code into 📋 (clipboard). Default support added for <code>&lt;pre&gt;</code> tag. Documentations and more visit <a href="https://github.com/maheshwaghmare/copy-the-code/"> on GitHub</a>.

== Description ==

Plugin add the `Copy` button within the `<pre>` tag and it copy the content of `<pre>` tag into the clipboard.

= 1. How it Works? =

Simply, It search the `<pre>` tag within the page and add the `Copy` button within it.

= 2. It add `Copy` button for each `&lt;pre&gt;` tag? =

Yes, Once you activate the plugin it add search the `<pre>` tag and add the `Copy` button in it.

= 3. Can I use another selector instead of `&lt;pre&gt;` tag? =

Yes, You can change the selector though filter `copy_the_code_localize_vars`.

Eg. If you want to enable the `Copy` button for only single page, post etc. Then You can change the selector `body.single pre` though filter.

<pre>
add_filter( 'copy_the_code_localize_vars', 'my_slug_copy_the_code_localize_vars' );
function my_slug_copy_the_code_localize_vars( $defaults )
{
	// `single class is added to the `<body>` tag for the single page, post etc.
	$defaults['selector'] = 'body.single pre';

	return $defaults;	
}
</pre>

= 4. Plugin compatible for all themes? =

Yes, We have added `!important` for the Copy button to keep the button style same for each theme. We have tested below themes.

== Supported Themes

- Bhari
- Astra
- AwesomePress
- Storefront
- OceanWP
- Twenty Twelve
- Twenty Sixteen
- Twenty Seventeen
- Twenty Nineteen

Extend the plugin on [Github](https://github.com/maheshwaghmare/copy-the-code/)

== Installation ==

1. Install the <code>Copy the Code</code> plugin either via the WordPress plugin directory, or by uploading the files to your server at <code>wp-content/plugins</code>.

== Changelog ==

= 1.3.0 =
* New: Added support, contact links.

= 1.2.0 =
* New: Added settings page for customizing the plugin. Added option `selector` to set the JS selector. Default its `<pre>` html tag.

= 1.1.0 =
* Fix: Removed `Copy` button markup from the copied content from the clipboard.

= 1.0.0 =
* Initial release.