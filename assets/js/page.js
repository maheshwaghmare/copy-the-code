(function($) {

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

		