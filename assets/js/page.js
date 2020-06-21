window.CopyTheCodeToClipboard = (function(window, document, navigator) {
    var textArea,
        copy;

    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }

    function createTextArea(text) {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.appendChild(textArea);
    }

    function selectText() {
        var range,
            selection;

        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }

    function copyToClipboard() {        
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }

    copy = function(text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };

    return {
        copy: copy
    };
})(window, document, navigator);


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

        // $( '.preview pre' ).CopyTheCode({
        //     markup: '&lt;pre&gt;Mahesh&lt;/pre&gt;',
        //     style: 'normal-button',
        //     button_text: 'Copy',
        //     button_copy_text: 'Copied!',
        //     // position: position,
        // });

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
            this._preview();
            $('.copy-the-code .nav-tab-wrapper > .nav-tab:first-child').addClass('nav-tab-active');
        },

        _bind: function()
        {
            // $( document ).on('click', '.nav-tab', CopyTheCodePage._switch_tab );
            $( document ).on('input', '[name="button-text"], [name="button-copy-text"], [name="button-title"]', CopyTheCodePage._preview );
            $( document ).on('change', /*select[name="copy-as"],*/ ' [name="style"], [name="button-position"]', CopyTheCodePage._preview );
            $( document ).on('click', '.copy-the-code-button', CopyTheCodePage.copyCode );
        },

        /**
         * Copy to Clipboard
         */
        copyCode: function( event )
        {
            var btn     = $( this ),
                preview = $('#preview').find('pre'),
                source   = btn.parents('.copy-the-code-wrap').find( preview ),
                oldText = btn.text();

            var buttonMarkup = $('.copy-the-code-wrap').html() || '';
            var copy_as = 'text'; // $( 'select[name="copy-as"]' ).children("option:selected").val() || '';
            var button_text = $( '[name="button-text"]' ).val() || '';
            var button_copy_text = $( '[name="button-copy-text"]' ).val() || '';
            var style = $( '[name="style"]' ).val() || 'button';

            if( 'text' === copy_as ) {
                var html = source.text();

                // Remove the 'copy' text.
                var tempHTML = html.replace(button_text, '');
    
            } else {
                var html = source.html();

                // Remove the <copy> button.
                var tempHTML = html.replace(buttonMarkup, '');
            }


            // Copy the Code.
            var tempPre = $("<textarea id='temp-pre'>"),
                temp    = $("<textarea>"),
                brRegex = '/<br\s*[/\]?>/gi';

            // Append temporary elements to DOM.
            $("body").append(temp);
            $("body").append(tempPre);

            // Set temporary HTML markup.
            tempPre.html( tempHTML );

            // Format the HTML markup.
            temp.val( tempPre.text().replace(brRegex, "\r\n" ) ).select();

            // Support for IOS devices too.
            CopyTheCodeToClipboard.copy( tempPre.text().replace(brRegex, "\r\n" ) );

            // Remove temporary elements.
            temp.remove();
            tempPre.remove();

            // Copied!
            btn.text( button_copy_text );
            setTimeout(function() {
                if( 'svg-icon' === style ) {
                    btn.html( copyTheCode.buttonSvg );
                } else {
                    btn.text( oldText );
                }
            }, 1000);
        },

        _preview: function() {
            var button_position = $( '[name="button-position"]' ).val() || '';
            // var value = $( 'select[name="copy-as"]' ).children("option:selected").val() || '';
            var style = $( '[name="style"]' ).val() || 'button';
            var button_text = $( '[name="button-text"]' ).val() || '';
            var button_copy_text = $( '[name="button-copy-text"]' ).val() || '';
            var button_title = $( '[name="button-title"]' ).val() || '';
            var buttonMarkup = copyTheCode.buttonMarkup || '';

            console.log( buttonMarkup );

            var markup = '<div class="outer">';
            markup += '<div class="inner copy-as-text">';
            markup += '<p>Sample Preview 1</p>';
            markup += '<pre id="pre-html"></pre>';
            // markup += '<p class="description">Here, We don\'t see the HTML markup of above content. On click on copy the with its actual HTML markup.</p>';
            markup += '</div>';

            markup += '<div class="inner copy-as-html">';
            markup += '<p>Sample Preview 2</p>';
            markup += '<pre id="pre-text"></pre>';
            markup += '</div>';

            markup += '</div>';

            $('#preview').html( markup );
            $('#preview #pre-html').html( copyTheCode.previewMarkup );
            $('#preview #pre-text').text( copyTheCode.previewMarkup );
 
           if( 'cover' !== style && 'outside' === button_position ) {
                $('#preview pre').wrap( '<span class="copy-the-code-wrap copy-the-code-outside-wrap"></span>' );
                $('#preview pre').parent().prepend('<div class="copy-the-code-outside">' + buttonMarkup + '</div>');
            } else {
                $('#preview pre').wrap( '<span class="copy-the-code-wrap copy-the-code-inside-wrap"></span>' );
                $('#preview pre').append( buttonMarkup );
            }

            $('#preview').find( '.copy-the-code-button').attr('title', button_title);
            $('#preview').find( '.copy-the-code-button').attr( 'style', style);

            if( 'svg-icon' === style ) {
                $( '[name="button-text"]' ).parents('tr').hide();
                $( '[name="button-position"]' ).parents('tr').hide();
            } else {
                $( '[name="button-text"]' ).parents('tr').show();
                $( '[name="button-position"]' ).parents('tr').show();
            }
            if( 'cover' === style ) {
                $( '[name="button-position"]' ).parents('tr').hide();
            } else {
                $( '[name="button-position"]' ).parents('tr').show();
            }

            switch( style ) {
                case 'svg-icon':
                        $('#preview').find( '.copy-the-code-button').html( copyTheCode.buttonSvg );
                    break;
                case 'cover':
                case 'button':
                default:
                    $('#preview').find( '.copy-the-code-button').html( button_text );
                    break;
            }
            
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

