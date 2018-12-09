# Copy Anything to Clipboard

Copy Anything to Clipboard into 📋 (clipboard). Default support added for <code>&lt;pre&gt;</code> tag.

### Installation

1. Install the <code>Copy Anything to Clipboard</code> plugin either via the WordPress plugin directory, or by uploading the files to your server at <code>wp-content/plugins</code>.

### Documentation

**1. How it Works?**

Simply, It search the `<pre>` tag within the page and add the `Copy` button within it.

**2. It add `Copy` button for each `<pre>` tag?**

Yes, Once you activate the plugin it add search the `<pre>` tag and add the `Copy` button in it.

**3. Can I use another selector instead of `<pre>` tag?**

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

**4. Plugin compatible for all themes?**

Yes, We have added `!important` for the Copy button to keep the button style same for each theme. We have tested below themes.

> **Theme: Bhari**

![Theme Bhari](https://i.imgur.com/1besqBgl.jpg)

---

> **Theme: Astra**

![Theme Astra](https://i.imgur.com/EvlMrMHl.jpg)

---

> **Theme: AwesomePress**

![Theme AwesomePress](https://i.imgur.com/ZODBLeO.png)

---

> **Theme: Storefront**

![Theme Storefront](https://i.imgur.com/tTCQKW4l.jpg)

---

> **Theme: OceanWP**

![Theme OceanWP](https://i.imgur.com/jmFoqFxl.jpg)

---

> **Theme: Twenty Twelve**

![Theme Twenty Twelve](https://i.imgur.com/CkeCs3Yl.jpg)

---

> **Theme: Twenty Sixteen**

![Theme Twenty Sixteen](https://i.imgur.com/yyXlL9Vl.jpg)

---

> **Theme: Twenty Seventeen**

![Theme Twenty Seventeen](https://i.imgur.com/JpxA9ALl.jpg)

Extend the plugin on [Github](https://github.com/maheshwaghmare/copy-the-code/)

### Changelog

** 1.3.1 **

* Improvement: Updated the strings and compatibility for WordPress 5.0.

** 1.3.0 **

* New: Added support, contact links.

** 1.2.0 **

* New: Added settings page for customizing the plugin. Added option `selector` to set the JS selector. Default its `<pre>` html tag.

** 1.1.0 **

- Fix: Removed `Copy` button markup from the copied content from the clipboard.

**1.0.0**

- Initial release.
