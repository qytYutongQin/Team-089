<?php
if (!class_exists('Fameup_Latest_Post')) :
    /**
     * Adds Fameup_Latest_Post widget.
     */
    class Fameup_Latest_Post extends Fameup_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('fameup-categorised-posts-title', 'fameup-posts-number', 'fameup-excerpt-length');
            $this->select_fields = array('fameup-select-category', 'fameup-show-excerpt');

            $widget_ops = array(
                'classname' => 'bs-posts-sec bs-posts-modul-6',
                'description' => __('Displays posts from selected category in single column.', 'fameup'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('fameup_latest_post', __('AR: Latest News Post', 'fameup'), $widget_ops);
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

            $title = apply_filters('widget_title', $instance['fameup-categorised-posts-title'], $instance, $this->id_base);
            $category = isset($instance['fameup-select-category']) ? $instance['fameup-select-category'] : '0';
            $show_excerpt = isset($instance['fameup-show-excerpt']) ? $instance['fameup-show-excerpt'] : 'true';
            $excerpt_length = 25;
            $number_of_posts = 5;

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title) || !empty($subtitle)): ?>
             <!-- bs-posts-sec bs-posts-modul-6 -->
            <div class="bs-posts-sec bs-posts-modul-6">
                <!-- bs-sec-title -->
                <div class="bs-widget-title">
                <?php if (!empty($title)): ?>
                    <h4 class="title"><?php echo esc_html($title); ?></h4>
                <?php endif; ?>
                </div>
                <!-- // bs-sec-title -->
                <?php endif; ?>
                <?php
                $all_posts = fameup_get_posts($number_of_posts, $category);
                ?>
                <!-- bs-posts-sec-inner -->
                <div class="bs-posts-sec-inner">
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post; ?>
                        <div class="col-md-12 fadeInDown wow" data-wow-delay="0.1s">
                             <div class="bs-blog-post list-blog">
                            <?php fameup_post_image_display_type($post); ?>
                            <article class="small col">
                              <?php 
                                $fameup_global_category_enable = get_theme_mod('fameup_global_category_enable','true');
                                if($fameup_global_category_enable == 'true') {
                                fameup_post_categories(); } ?>
                                <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                <?php fameup_post_meta(); ?>
                                      <?php fameup_posted_content(); wp_link_pages( ); 
                                      $fameup_readmore_excerpt=get_theme_mod('fameup_blog_content','excerpt');
                                      if($fameup_readmore_excerpt=="excerpt"){?>
                                      <p><a href="<?php the_permalink();?>" class="more-link"><?php _e('Read More','fameup'); ?></a></p>
                                      <?php } ?>
                                <?php  fameup_post_social_share_post($post); ?>
                            </article>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif;
                wp_reset_postdata(); ?>
                </div> <!-- // bs-posts-sec-inner -->
            </div> <!-- // bs-posts-sec block_6 -->
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
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::fameup_generate_text_input('fameup-categorised-posts-title', 'Title', 'Latest News');
                echo parent::fameup_generate_select_options('fameup-select-category', __('Select category', 'fameup'), $categories);

                echo parent::fameup_generate_select_options('fameup-show-excerpt', __('Show excerpt', 'fameup'), $options);



            }

            //print_pre($terms);


        }

    }
endif;