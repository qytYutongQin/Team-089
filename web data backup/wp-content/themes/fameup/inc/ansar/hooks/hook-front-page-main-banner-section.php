<?php
if (!function_exists('fameup_front_page_banner_section')) :
    /**
     *
     * @since Fameup
     *
     */
    function fameup_front_page_banner_section()
    {
        if (is_front_page() || is_home()) {
        $fameup_enable_main_slider = fameup_get_option('show_main_news_section');
        $select_vertical_slider_news_category = fameup_get_option('select_vertical_slider_news_category');
        $vertical_slider_number_of_slides = fameup_get_option('vertical_slider_number_of_slides');
        $all_posts_vertical = fameup_get_posts($vertical_slider_number_of_slides, $select_vertical_slider_news_category);
        if ($fameup_enable_main_slider): ?>
         <div class="col-12">
             <div class="homemain bs swiper-container">
                <div class="swiper-wrapper">
                   <?php fameup_get_block('list', 'banner'); ?>         
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <!--==/ Home Slider ==-->
        <?php endif; ?>
        <!-- end slider-section -->
        <?php }
    }
endif;
add_action('fameup_action_front_page_main_section_1', 'fameup_front_page_banner_section', 40);