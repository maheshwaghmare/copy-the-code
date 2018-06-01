(function($) {

    CopyTheCode = {

        /**
         * Init
         */
        init: function()
        {
            this._bind();
            this._initialize();
        },

        /**
         * Binds events
         */
        _bind: function()
        {
            $( document ).on('click', '.copy-the-code-button', CopyTheCode.copyCode );
        },

        /**
         * Initialize the Button
         */
        _initialize: function()
        {
            if( ! $( copyTheCode.selector ).length )
            {
                return;
            }

            $( copyTheCode.selector ).each(function(index, el) {
                $( el ).append( CopyTheCode._getButtonMarkup() );
            });
        },

        /**
         * Get Copy Button Markup
         */
        _getButtonMarkup()
        {
            return '<button class="copy-the-code-button" title="' + copyTheCode.string.title + '">' + copyTheCode.string.copy + '</button>';
        },

        /**
         * Copy to Clipboard
         */
        copyCode: function( event )
        {
            var btn     = $( this ),
                input   = btn.parents('pre'),
                html    = input.html(),
                oldText = btn.text();

            // Remove the <copy> button.
            var tempHTML = html.replace(CopyTheCode._getButtonMarkup(), '');

            // Copy the Code.
            var tempPre = $("<pre id='temp-pre'>"),
                temp    = $("<textarea>"),
                brRegex = '/<br\s*[/\]?>/gi';

            // Append temporary elements to DOM.
            $("body").append(temp);
            $("body").append(tempPre);

            // Set temporary HTML markup.
            tempPre.html( tempHTML );

            // Format the HTML markup.
            temp.val( tempPre.text().replace(brRegex, "\r\n" ) ).select();
            document.execCommand("copy");

            // Remove temporary elements.
            temp.remove();
            tempPre.remove();

            // Copied!
            btn.text( copyTheCode.string.copied );
            setTimeout(function() {
                btn.text( oldText );
            }, 1000);
        }
    };

    /**
     * Initialization
     */
    $(function() {
        CopyTheCode.init();
    });

})(jQuery);