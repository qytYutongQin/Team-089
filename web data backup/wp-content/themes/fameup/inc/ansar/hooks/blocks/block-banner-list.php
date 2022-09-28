<?php
$fameup_slider_category = fameup_get_option('select_slider_news_category');
$fameup_number_of_slides = fameup_get_option('number_of_slides');
$fameup_all_posts_main = fameup_get_posts($fameup_number_of_slides, $fameup_slider_category);
$fameup_count = 1;

if ($fameup_all_posts_main->have_posts()) :
    while ($fameup_all_posts_main->have_posts()) : $fameup_all_posts_main->the_post();
        $fameup_slider_layout = get_theme_mod('fameup_slider_layout','slider-default');

        if($fameup_slider_layout == 'slider-default' ) {
         fameup_slider_default_section();
        }
        elseif($fameup_slider_layout == 'slider-three-col' )
        {
         fameup_slider_three_col();
        }

        elseif($fameup_slider_layout == 'slider-two-col' )
        {
         fameup_slider_two_col();
        }

        elseif($fameup_slider_layout == 'slider-full-col' )
        {
         fameup_slider_full_col();   
        }
    endwhile;
endif;
wp_reset_postdata();
?>