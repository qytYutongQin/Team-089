<?php

class featured_post_Widget extends WP_Widget {
	/**
	 * Widget constructor.
	 */
	function __construct() {
		$widget_options = array(
			'classname'   => 'featured_post_Widget',
			'description' => __( 'Featured Posts List', 'fameup' ),
		);
		parent::__construct( 'featured_post_Widget', __( 'Featured Posts List', 'fameup' ), $widget_options );
	
	}

	// Creating widget front-end
  
	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$cat = $instance['cat'];
		$args = array(
			'cat' => $instance['cat'] // Insert category ID here
		);	
		$query = new WP_Query( $args );
		
		// before and after widget arguments are defined by themes
		echo isset($args['before_widget']) ? $args['before_widget'] :'';	
		

		?>
		
		<div class="featured-post-widget">
			<div class="bs-widget-title">
                    <h4 class="title"><?php if ( ! empty( $title ) )
			echo $title; ?></h4></div>
			<div class="row">
			<?php if ( $query->have_posts() ) : //loop for custom query ?>
				<?php $i=1; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php 
					$postID = $query->post->ID;
					$featured_img_url = get_the_post_thumbnail_url($postID, 'full');  
					$author_id = get_post_field ('post_author', $postID);
					$display_name = get_the_author_meta( 'display_name' , $author_id );
					?>
					 <?php if($i == 1){  ?>
					 	
					 	<div class="col-md-6">	
			            	<div class="bs-blog-post bshre">
				              <div class="bs-blog-thumb md back-img" style="background-image: url('<?php echo $featured_img_url; ?>');">
				                <a href="<?php echo get_permalink($postID); ?>" class="link-div"></a>
				              </div>
				              <article class="small">
				                <div class="bs-blog-category"> 
				                	<?php 
								    $cats = get_the_category($postID);
								    echo ( count($cats) == 1  ? 'Category: ' : 'Categories: ');
								    $c = 0; $n = 0;
								    $c = count($cats);
								    foreach ( $cats as $cat ):
								        $n++; ?>
								        <a href="<?php echo get_category_link($cat->cat_ID); ?>">
								            <?php echo $cat->name; echo ( $n > 0 && $n < $c ? ', ' : ''); ?>
								        </a>
								    <?php endforeach; ?>
								</div>
				                <h4 class="title"><a title="<?php echo get_the_title( $postID ); ?>" href="<?php echo get_permalink($postID); ?>"><?php echo get_the_title( $postID ); ?></a></h4>
				                <div class="bs-blog-meta">
				                  <span class="bs-author"><img src="http://0.gravatar.com/avatar/3979576bcdcbd166d005a5b225e1bc52?s=150&d=mm&r=g" alt="Admin"> <?php echo $display_name; ?></span>
				                  <span class="bs-blog-date"><?php echo get_the_date( 'M j , Y' , $postID); ?></span>
				                  <span class="comments-link"> <a href="#"><?php echo get_comments_number($postID); ?> Comments</a> </span>
				                </div>
				                <p><?php echo get_the_excerpt($postID); ?></p>
				              </article>
				           	</div>
			         	</div>
			         	<div class="col-md-6">
					 <?php } else { ?>
					 		<div class="small-post">
				                <div class="img-small-post back-img hlgr" style="background-image: url('<?php echo $featured_img_url; ?>');">
				                  <a href="<?php echo get_permalink($postID); ?>" class="link-div"></a>
				                </div>
				                <!-- // img-small-post -->
				                <div class="small-post-content">
				                  <div class="mg-blog-category"> 
				                  	<?php 
								    $cats = get_the_category($postID);
								    echo ( count($cats) == 1  ? 'Category: ' : 'Categories: ');
								    $c = 0; $n = 0;
								    $c = count($cats);
								    foreach ( $cats as $cat ):
								        $n++; ?>
								        <a href="<?php echo get_category_link($cat->cat_ID); ?>">
								            <?php echo $cat->name; echo ( $n > 0 && $n < $c ? ', ' : ''); ?>
								        </a>
								    <?php endforeach; ?> </div>
				                  <!-- small-post-content -->
				                  <h5 class="title"><a title="<?php echo get_the_title( $postID ); ?>" href="<?php echo get_permalink($postID); ?>"><?php echo get_the_title( $postID ); ?></a></h5>
				                  <!-- // title_small_post -->
				                  <div class="bs-blog-meta">
				                    <span class="bs-blog-date"><?php echo get_the_date( 'M j , Y' , $postID ); ?></span>
				                  </div>
				                </div>
				                <!-- // small-post-content -->
				            </div>
					 <?php } ?>	
				<?php $i++; endwhile; ?>
			<?php 
				else :

				    echo "No Post Found";

				endif; ?>
			 </div></div>
        </div>
		<?php
		echo isset($args['after_widget']) ? $args['after_widget'] :'';
	}

	public function form( $instance ) {
		
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'fameup' );
		$cat = ! empty( $instance['cat'] ) ? $instance['cat'] : esc_html__( '', 'fameup' );
		
		// Widget admin form
		?>
		<p>
			 <label for="<?php echo $this->get_field_id( 'title'); ?>">Title One:</label>
			 <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label>
				<?php esc_html_e( 'Select Category', 'fameup' ); ?>:
				<?php
					wp_dropdown_categories(
						array(
							'show_option_all' => __( 'All categories', 'fameup' ),
							'hide_empty'      => 0,
							'name'            => $this->get_field_name( 'cat' ),
							'selected'        => $cat,
						)
					);
				?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		 $instance = $old_instance;
		 $instance['title'] = strip_tags( $new_instance['title'] );
		 $instance['cat'] = strip_tags( $new_instance['cat'] );
		
		 return $instance;           

	}


}

function featured_post_register_widget() {

 	register_widget( 'featured_post_Widget' );
  
}
add_action( 'widgets_init', 'featured_post_register_widget' );
?>
