<?php
if (!class_exists('Fameup_Design_Slider')) :
    /**
     * Adds fameup_Design_Slider widget.
     */
    class Fameup_Design_Slider extends Fameup_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('fameup-posts-design-slider-title', 'fameup-excerpt-length', 'fameup-posts-slider-number');
            $this->select_fields = array('fameup-select-category', 'fameup-show-excerpt');

            $widget_ops = array(
                'classname' => 'fameup_posts_design_slider_widget',
                'description' => __('Displays posts slider from selected category.', 'fameup'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('fameup_design_slider', __('AR: 3 Column Posts Slider', 'fameup'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::fameup_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters('widget_title', $instance['fameup-posts-design-slider-title'], $instance, $this->id_base);
            $category = isset($instance['fameup-select-category']) ? $instance['fameup-select-category'] : 0;
            $number_of_posts = 5;

            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="bs-posts-sec">
            <?php if (!empty($title)): ?>
             <div class="bs-widget-title">
            <!-- bs-sec-title -->
                <h4 class="title"><?php echo esc_html($title); ?></h4>
            </div>
            <!-- // bs-sec-title -->
            <?php endif; ?>
            <?php

            $all_posts = fameup_get_posts($number_of_posts, $category);
            ?>

            <div class="colmnthree bs swiper-container">
              <div class="swiper-wrapper">
                                            <!-- item -->
                <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post;
                            $url = fameup_get_freatured_image_url($post->ID, 'fameup-slider-full');
                            ?>
                        <div class="swiper-slide">
                            <div class="bs-blog-post three lg back-img bshre" style="background-image: url('<?php echo esc_url($url); ?>');">
                                <a class="link-div" href="<?php the_permalink(); ?>"></a>
                                <div class="inner">
                                  <?php fameup_post_categories(); ?>
                                  <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                  <?php fameup_post_meta(); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                     </div>
            </div></div>
            <div class="clearfix mr-bot30"></div>

            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            $options = array(
                'true' => __('Yes', 'fameup'),
                'false' => __('No', 'fameup')

            );
            $categories = fameup_get_terms();
            if (isset($categories) && !empty($categories)) {
                echo parent::fameup_generate_text_input('fameup-posts-design-slider-title', __('Title', 'fameup'), 'Posts 3 Column Slider');

                echo parent::fameup_generate_select_options('fameup-select-category', __('Select category', 'fameup'), $categories);


            }
        }
    }
endif;