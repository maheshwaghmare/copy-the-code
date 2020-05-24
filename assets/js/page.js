/*
 *  Project: Example Plugin
 *  Description: Example Plugin Description
 *  Author: Author Name
 *  License: Plugin License
 */

// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function ($, window, document, undefined) {

    // undefined is used here as the undefined global variable in ECMAScript 3 is
    // mutable (ie. it can be changed by someone else). undefined isn't really being
    // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
    // can no longer be modified.

    // window is passed through as local variable rather than global
    // as this (slightly) quickens the resolution process and can be more efficiently
    // minified (especially when both are regularly referenced in your plugin).

    var // plugin name
        pluginName = "CopyTheCode",
        // key using in $.data()
        dataKey = "plugin_" + pluginName;

    var privateMethod = function () {
        // ...
    };

    var Plugin = function (element, options) {
        this.element = element;
        
        this.options = {
            text: 'default',
            // default options
        };
        
        /*
         * Initialization
         */
        
        this.init(options);
    };

    Plugin.prototype = {
        // initialize options
        init: function (options) {
            $.extend(this.options, options);

            console.log( options );

            // alert( this.element )
            // this.element.html( options.markup );

            /*
             * Update plugin for options
             */
            /**
             * Button Style: Button
             * @type {String}
             */
            switch( options.style ) {
                case 'normal-button':
                        this.element.find( options.selector ).html( '<span class="copy-the-code-wrap copy-the-code-inside-wrap">'+options.markup+'</span>' + this._getButtonMarkup() );
                        // this.element.find( selector ).append(  );
                    break;
                case 'svg-button':
                        // this.element.wrap( '<span class="copy-the-code-wrap copy-the-code-inside-wrap"></span>' );
                        // this.element.append( this._getSVGMarkup() );
                    break;
                case 'cover':
                    break;
            }

            // console.log( text );
            console.log( options );

            // Click handaler.
            this.element.on('click', '.copy-the-code-button', function(event) {
                event.preventDefault();
                console.log( 'clicked' );
            })
        },

        _getButtonMarkup: function()
        {
            return '<button class="copy-the-code-button" title="Copy to Clipobard">Copy</button>';
        },

        _getSVGMarkup: function() {
            return '<span class="copy-the-code-button" title="Copy to Clipobard"><img style="width:20px;" src="'+copyTheCode['image-url']+'" /></span>';
        },
        
        publicMethod: function () {
            // ...
        }
    };

    /*
     * Plugin wrapper, preventing against multiple instantiations and
     * return plugin instance.
     */
    $.fn[pluginName] = function (options) {

        var plugin = this.data(dataKey);

        // has plugin instantiated ?
        if (plugin instanceof Plugin) {
            // if have options arguments, call plugin.init() again
            if (typeof options !== 'undefined') {
                plugin.init(options);
            }
        } else {
            plugin = new Plugin(this, options);
            this.data(dataKey, plugin);
        }
        
        return plugin;
    };

}(jQuery, window, document));


(function($) {

    $(function() {

        $( '.preview pre' ).CopyTheCode({
            markup: '&lt;pre&gt;Mahesh&lt;/pre&gt;',
            style: 'normal-button',
            button_text: 'Copy',
            button_copy_text: 'Copied!',
            // position: position,
        });

        // updatePreview();

        // $( document ).on('change', '.button-position, .style', updatePreview );

        // function updatePreview() {
        //     var style = $( '.style' ).val() || '';
        //     var position = $( '.button-position' ).val() || '';

        //     console.log( style );
        //     console.log( position );

        //     $( 'body' ).CopyTheCode({
        //         selector: '.preview pre',
        //         markup: '<pre>Heallo World</pre>',
        //         style: style,
        //         button_text: 'Copy',
        //         button_copy_text: 'Copied!',
        //         position: position,
        //     });
        // }
    });

    CopyTheCodePage = {
    	 /**
         * Init
         */
        init: function()
        {
            this._bind();
            $('.copy-the-code .nav-tab-wrapper > .nav-tab:first-child').addClass('nav-tab-active');
        },

        _bind: function()
        {
            $( document ).on('click', '.nav-tab', CopyTheCodePage._switch_tab );
        },

        _switch_tab: function( event ) {
        	$(this).siblings().removeClass('nav-tab-active');
        	$(this).addClass('nav-tab-active');
        	$( '#' + $(this).attr( 'data-id' ) ).siblings().hide();
        	$( '#' + $(this).attr( 'data-id' ) ).show();
        }

    };

    /**
     * Initialization
     */
    $(function() {
        CopyTheCodePage.init();
    });

})(jQuery);

		