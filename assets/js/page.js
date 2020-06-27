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


(function($) {

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
            $( document ).on('input', '[name="button-text"], [name="button-copy-text"], [name="button-title"]', CopyTheCodePage._preview );
            $( document ).on('change', '[name="style"], [name="button-position"]', CopyTheCodePage._preview );
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
            var copy_as = 'text';
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

