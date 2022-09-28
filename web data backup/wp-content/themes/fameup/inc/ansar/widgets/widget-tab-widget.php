<?php class fameup_popular_tab_Widget extends WP_Widget {
	/**
	 * Widget constructor.
	 */
	function __construct() {
		$widget_options = array(
			'classname'   => 'fameup_popular_tab_Widget',
		);
		parent::__construct( 'fameup_popular_tab_Widget', __( 'AR: Tabbed Posts', 'fameup' ), $widget_options );
	
	}

	// Creating widget front-end
  
	public function widget( $args, $instance ) {
		
		//echo "<pre>"; print_r($instance);
		$trending_title = $instance[ 'trending_title' ];
		$trending_cat = $instance[ 'trending_cat' ];

		$popular_title = $instance[ 'popular_title' ];
		$popular_cat = $instance['popular_cat'];

		$latest_title = $instance[ 'latest_title' ];
		$latest_cat = $instance['latest_cat'];

		
		// before and after widget arguments are defined by themes
		

		$trending_args = array(
						'cat' => $trending_cat,
						'order' => 'DESC',
						'orderby' => 'date',
						'posts_per_page' => 3
					);	
		$trending_post = new WP_Query( $trending_args );

		$popular_args = array(
						'cat' => $popular_cat,
						'order' => 'DESC',
						'orderby' => 'date',
						'posts_per_page' => 3
					);	
		$popular_post = new WP_Query( $popular_args );

		$latest_post_args = array(
						'cat' => $latest_cat,
						'order' => 'DESC',
						'orderby' => 'date',
						'posts_per_page' => 3
					);	
		$latest_post = new WP_Query( $latest_post_args );
		
		echo ($args['before_widget']);			
		?>
		
		


<!--  widget start-->

    <div class="tabarea-area">	
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-bolt"></i><?php echo esc_html($trending_title); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-fire"></i><?php echo esc_html($popular_title); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-fire"></i><?php echo esc_html($latest_title); ?></a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                	<?php if ( $trending_post->have_posts() ) : //loop for custom query ?>
                    		

                        
                        	<?php while ( $trending_post->have_posts() ) : $trending_post->the_post(); ?>
                        	<?php
                        		$postID = $trending_post->post->ID;
								$featured_img_url = get_the_post_thumbnail_url($postID, 'full');  
								$author_id = get_post_field ('post_author', $postID);
								$display_name = get_the_author_meta( 'display_name' , $author_id );
                        	?>


                            <div class="small-post">
                        <div class="img-small-post back-img hlgr" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');">
                          <a href="<?php echo esc_url(get_permalink($postID)); ?>" class="link-div"></a>
                        </div>
                        <!-- // img-small-post -->
                        <div class="small-post-content">
                          <?php fameup_post_categories(); ?>
                          <!-- small-post-content -->
                          <h5 class="title"><a href="<?php echo esc_url(get_permalink($postID)); ?>"><?php echo esc_html(get_the_title( $postID )); ?></a></h5>
                          <!-- // title_small_post -->
                          <?php fameup_post_meta(); ?>
                        </div>
                        <!-- // small-post-content -->
                      </div>
                            <?php endwhile; ?>
                        
                        <?php 
							else :

							    echo "No Post Found";

							endif; ?>
                    <!-- // small-list-post -->
                
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">  
            
                    <!-- small-list-post -->
                        <?php if ( $popular_post->have_posts() ) : //loop for custom query ?>
                        	<?php while ( $popular_post->have_posts() ) : $popular_post->the_post(); ?>
                        	<?php
                        		$postID = $popular_post->post->ID;
								$featured_img_url = get_the_post_thumbnail_url($postID, 'full');  
								$author_id = get_post_field ('post_author', $postID);
								$display_name = get_the_author_meta('display_name' , $author_id );
                        	?>
                            <div class="small-post">
                        <div class="img-small-post back-img hlgr" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');">
                          <a href="<?php echo esc_url(get_permalink($postID)); ?>" class="link-div"></a>
                        </div>
                        <!-- // img-small-post -->
                        <div class="small-post-content">
                          <?php fameup_post_categories(); ?>
                          <!-- small-post-content -->
                          <h5 class="title"><a href="<?php echo esc_url(get_permalink($postID)); ?>"><?php echo esc_html(get_the_title( $postID )); ?></a></h5>
                          <!-- // title_small_post -->
                          <?php fameup_post_meta(); ?>
                        </div>
                        <!-- // small-post-content -->
                      </div>
                            <?php endwhile; ?>
                        <?php 
							else :

							    echo "No Post Found";

							endif; ?>
                    <!-- // small-list-post -->
                
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            
                        <?php if ( $latest_post->have_posts() ) : //loop for custom query ?>
                        	<?php while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>
                        	<?php
                        		$postID = $latest_post->post->ID;
								$featured_img_url = get_the_post_thumbnail_url($postID, 'full');  
								$author_id = get_post_field ('post_author', $postID);
								$display_name = get_the_author_meta( 'display_name' , $author_id );
                        	?>
                            <div class="small-post">
                        <div class="img-small-post back-img hlgr" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');">
                          <a href="<?php echo esc_url(get_permalink($postID)); ?>" class="link-div"></a>
                        </div>
                        <!-- // img-small-post -->
                        <div class="small-post-content">
                          <?php fameup_post_categories(); ?>
                          <!-- small-post-content -->
                          <h5 class="title"><a href="<?php echo esc_url(get_permalink($postID)); ?>"><?php echo esc_html(get_the_title( $postID )); ?></a></h5>
                          <!-- // title_small_post -->
                          <?php fameup_post_meta(); ?>
                        </div>
                        <!-- // small-post-content -->
                      </div>
                            <?php endwhile; ?>
                        <?php 
							else :

							    echo "No Post Found";

							endif; ?>
                    <!-- // small-list-post -->
                
          </div>
        </div>
     </div>	
  <!-- /widget end-->

  
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$trending_title = ! empty( $instance['trending_title'] ) ? $instance['trending_title'] : esc_html__('Trending', 'fameup' );
		$trending_cat = ! empty( $instance['trending_cat'] ) ? $instance['trending_cat']: esc_html__('', 'fameup' );

		$popular_title = ! empty( $instance['popular_title'] ) ? $instance['popular_title'] : esc_html__('Popular', 'fameup' );
		$popular_cat = ! empty( $instance['popular_cat'] ) ? $instance['popular_cat']: esc_html__('', 'fameup' );

		$latest_title = ! empty( $instance['latest_title'] ) ? $instance['latest_title'] : esc_html__('Latest', 'fameup' );
		$latest_cat = ! empty( $instance['latest_cat'] ) ? $instance['latest_cat']: esc_html__('', 'fameup' );
		
		// Widget admin form
		?>
		<p>
			 <label for="<?php echo $this->get_field_id( 'trending_title' ); ?>">Trending Title:
			 <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'trending_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'trending_title' )); ?>" value="<?php echo esc_attr( $trending_title ); ?>" />
			 </label>
			
		</p>
		<p>
			<label>
				<?php esc_html_e('Category', 'fameup' ); ?>:
				<?php
					wp_dropdown_categories(
						array(
							'show_option_all' => __('All categories', 'fameup' ),
							'hide_empty'      => 0,
							'name'            => $this->get_field_name( 'trending_cat' ),
							'selected'        => $trending_cat,
						)
					);
				?>
			</label>
		</p>
		<p>
			 <label for="<?php echo $this->get_field_id( 'popular_title' ); ?>">Popular Title:
			 <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'popular_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'popular_title' )); ?>" value="<?php echo esc_attr( $popular_title ); ?>" />
			 </label>
		</p>
		<p>
			<label>
				<?php esc_html_e( 'Category', 'fameup' ); ?>:
				<?php
					wp_dropdown_categories(
						array(
							'show_option_all' => __('All categories', 'fameup' ),
							'hide_empty'      => 0,
							'name'            => $this->get_field_name( 'popular_cat' ),
							'selected'        => $popular_cat,
						)
					);
				?>
			</label>
		</p>
		<p>
			 <label for="<?php echo esc_attr($this->get_field_id( 'latest_title' )); ?>">Latest Title :
			 <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'latest_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'latest_title' )); ?>" value="<?php echo esc_attr( $latest_title ); ?>" /></label>
		</p>
		<p>
			<label>
				<?php esc_html_e( 'Category', 'fameup' ); ?>:
				<?php
					wp_dropdown_categories(
						array(
							'show_option_all' => __('All categories', 'fameup' ),
							'hide_empty'      => 0,
							'name'            => $this->get_field_name('latest_cat','fameup' ),
							'selected'        => $latest_cat,
						)
					);
				?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		 $instance = $old_instance;
		 $instance['trending_title'] = strip_tags($new_instance['trending_title']); 
		 $instance['trending_cat'] = strip_tags( $new_instance['trending_cat'] ); 
		 
		 $instance['popular_title'] = strip_tags($new_instance['popular_title']); 
		 $instance['popular_cat'] = strip_tags($new_instance['popular_cat']); 

		 $instance['latest_title'] = strip_tags($new_instance['latest_title']); 
		 $instance['latest_cat'] = strip_tags($new_instance['latest_cat']); 
		
		 return $instance;           

	}


}

function fameup_tab_register_widget() {

 	register_widget( 'fameup_popular_tab_Widget' );
  
}
add_action( 'widgets_init', 'fameup_tab_register_widget' );
?>