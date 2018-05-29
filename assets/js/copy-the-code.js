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
                $( el ).append( '<button class="copy-the-code-button" title="' + copyTheCode.string.title + '">' + copyTheCode.string.copy + '</button>' );
            });
        },

        copyCode: function( event )
        {
            var input   = $( this ).parents('pre'),
                btn     = $( this ),
                oldText = $( this ).text();

            // Copy the Code.
            var temp = jQuery("<textarea>");
            var brRegex = '/<br\s*[/\]?>/gi';
            jQuery("body").append(temp);
            temp.val( input.text().replace(brRegex, "\r\n" ) ).select();
            document.execCommand("copy");
            temp.remove();

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