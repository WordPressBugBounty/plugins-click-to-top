/**
 * Click to Top - Admin Settings Scripts
 * 
 * @since 1.3.6
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Toggle Button Type options (Icon vs Text)
        function toggleBtnType() {
            var btnType = $('input[name="click_top_style[btn_type]"]:checked').val();
            var $iconRow = $('select[name="click_top_style[select_icon]"]').closest('tr');
            var $textRow = $('input[name="click_top_style[btn_text]"]').closest('tr');

            if (btnType === 'text') {
                $iconRow.hide();
                $textRow.show();
            } else {
                $iconRow.show();
                $textRow.hide();
            }
        }

        // Toggle Progress Indicator dependent options
        function toggleProgress() {
            var progress = $('input[name="click_top_basic[progress_indicator]"]:checked').val();
            var $colorRow = $('input[name="click_top_basic[progress_color]"]').closest('tr');
            var $widthRow = $('input[name="click_top_basic[progress_width]"]').closest('tr');

            if (progress === 'disable') {
                $colorRow.hide();
                $widthRow.hide();
            } else {
                $colorRow.show();
                $widthRow.show();
            }
        }

        // Toggle Touch Tap Area dependent options
        function toggleTapArea() {
            var tapArea = $('input[name="click_top_basic[touch_tap_area]"]:checked').val();
            var $sizeRow = $('input[name="click_top_basic[tap_area_size]"]').closest('tr');

            if (tapArea === 'disable') {
                $sizeRow.hide();
            } else {
                $sizeRow.show();
            }
        }

        // Bind change events
        $(document).on('change', 'input[name="click_top_style[btn_type]"]', toggleBtnType);
        $(document).on('change', 'input[name="click_top_basic[progress_indicator]"]', toggleProgress);
        $(document).on('change', 'input[name="click_top_basic[touch_tap_area]"]', toggleTapArea);

        // Run on page load
        toggleBtnType();
        toggleProgress();
        toggleTapArea();
    });
})(jQuery);