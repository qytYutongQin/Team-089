<script type="text/javascript">
	var fb = '<?php echo esc_html__( "Facebook", "dalmatian-blog" ); ?>';
	var twitter = '<?php echo esc_html__( "Twitter", "dalmatian-blog" ); ?>';
	var pinterest = '<?php echo esc_html__( "Pinterest", "dalmatian-blog" ); ?>';
	var linkedin = '<?php echo esc_html__( "Linkedin", "dalmatian-blog" ); ?>';
</script>



<?php
	$url = urlencode(get_the_permalink());
    $title = html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8');
    $media = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));
    $twitter_id = get_theme_mod('twitter_id');

    $social_share = $args;
?>

<ul class="list-inline">

	<li><?php esc_html_e( "Share", 'dalmatian-blog' ); ?>:</li>

	<?php if( in_array( 'facebook', $social_share ) ) { ?>
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" onclick="return ! window.open( this.href, fb, 'width=500, height=500' )">
		<svg version="1.1" viewBox="0 0 56.693 56.693" width="56.693px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M40.43,21.739h-7.645v-5.014c0-1.883,1.248-2.322,2.127-2.322c0.877,0,5.395,0,5.395,0V6.125l-7.43-0.029  c-8.248,0-10.125,6.174-10.125,10.125v5.518h-4.77v8.53h4.77c0,10.947,0,24.137,0,24.137h10.033c0,0,0-13.32,0-24.137h6.77  L40.43,21.739z"/></svg></a></li>
	<?php } ?>

	<?php if( in_array( 'twitter', $social_share ) ) { ?>
		<li><a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>&amp;via=<?php echo esc_html( $twitter_id ); ?>" onclick="return ! window.open( this.href, twitter, 'width=500, height=500' )">
		<svg version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M492,109.5c-17.4,7.7-36,12.9-55.6,15.3c20-12,35.4-31,42.6-53.6c-18.7,11.1-39.4,19.2-61.5,23.5  C399.8,75.8,374.6,64,346.8,64c-53.5,0-96.8,43.4-96.8,96.9c0,7.6,0.8,15,2.5,22.1C172,179,100.6,140.4,52.9,81.7  c-8.3,14.3-13.1,31-13.1,48.7c0,33.6,17.1,63.3,43.1,80.7C67,210.7,52,206.3,39,199c0,0.4,0,0.8,0,1.2c0,47,33.4,86.1,77.7,95  c-8.1,2.2-16.7,3.4-25.5,3.4c-6.2,0-12.3-0.6-18.2-1.8c12.3,38.5,48.1,66.5,90.5,67.3c-33.1,26-74.9,41.5-120.3,41.5  c-7.8,0-15.5-0.5-23.1-1.4C62.9,432,113.8,448,168.4,448C346.6,448,444,300.3,444,172.2c0-4.2-0.1-8.4-0.3-12.5  C462.6,146,479,128.9,492,109.5z"/></svg>	   
	</a>
		</li>
	<?php } ?>

	<?php if( in_array( 'pinterest', $social_share ) ) { ?>
		<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&amp;media=<?php echo $media;   ?>&amp;description=<?php echo esc_html( $title ); ?>" onclick="return ! window.open( this.href, pinterest, 'width=500, height=500' )">
			<svg viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M12.486,4.771c-4.23,0-6.363,3.033-6.363,5.562c0,1.533,0.581,2.894,1.823,3.401c0.205,0.084,0.387,0.004,0.446-0.221   c0.041-0.157,0.138-0.553,0.182-0.717c0.061-0.221,0.037-0.3-0.127-0.495c-0.359-0.422-0.588-0.972-0.588-1.747   c0-2.25,1.683-4.264,4.384-4.264c2.392,0,3.706,1.463,3.706,3.412c0,2.568-1.137,4.734-2.824,4.734   c-0.932,0-1.629-0.77-1.405-1.715c0.268-1.13,0.786-2.347,0.786-3.16c0-0.729-0.392-1.336-1.2-1.336   c-0.952,0-1.718,0.984-1.718,2.304c0,0.841,0.286,1.409,0.286,1.409s-0.976,4.129-1.146,4.852c-0.34,1.44-0.051,3.206-0.025,3.385   c0.013,0.104,0.149,0.131,0.21,0.051c0.088-0.115,1.223-1.517,1.607-2.915c0.111-0.396,0.627-2.445,0.627-2.445   c0.311,0.589,1.213,1.108,2.175,1.108c2.863,0,4.804-2.608,4.804-6.103C18.123,7.231,15.886,4.771,12.486,4.771z"/></g></svg>
		</a>

		</li>
	<?php } ?>

	<?php if( in_array( 'linkedin', $social_share ) ) { ?>
		<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo esc_html( $title ); ?>" onclick="return ! window.open( this.href, linkedin, 'width=500, height=500' )">
		<svg baseProfile="tiny" version="1.2" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M8,19H5V9h3V19z M19,19h-3v-5.342c0-1.392-0.496-2.085-1.479-2.085c-0.779,0-1.273,0.388-1.521,1.165C13,14,13,19,13,19h-3   c0,0,0.04-9,0-10h2.368l0.183,2h0.062c0.615-1,1.598-1.678,2.946-1.678c1.025,0,1.854,0.285,2.487,1.001   C18.683,11.04,19,12.002,19,13.353V19z"/></g><g><ellipse cx="6.5" cy="6.5" rx="1.55" ry="1.5"/></g></svg>
		</a>
		</li>
	<?php } ?>
	<?php if( in_array( 'email', $social_share ) ) { ?>
		<li><a href="mailto:?subject=<?php echo esc_attr( $title ); ?>&body=<?php echo $title . " " . $url; ?>" target="_blank">
		    <svg version="1.1" viewBox="0 0 100.354 100.352" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M93.09,76.224c0.047-0.145,0.079-0.298,0.079-0.459V22.638c0-0.162-0.032-0.316-0.08-0.462  c-0.007-0.02-0.011-0.04-0.019-0.06c-0.064-0.171-0.158-0.325-0.276-0.46c-0.008-0.009-0.009-0.02-0.017-0.029  c-0.005-0.005-0.011-0.007-0.016-0.012c-0.126-0.134-0.275-0.242-0.442-0.323c-0.013-0.006-0.023-0.014-0.036-0.02  c-0.158-0.071-0.33-0.111-0.511-0.123c-0.018-0.001-0.035-0.005-0.053-0.005c-0.017-0.001-0.032-0.005-0.049-0.005H8.465  c-0.017,0-0.033,0.004-0.05,0.005c-0.016,0.001-0.032,0.004-0.048,0.005c-0.183,0.012-0.358,0.053-0.518,0.125  c-0.01,0.004-0.018,0.011-0.028,0.015c-0.17,0.081-0.321,0.191-0.448,0.327c-0.005,0.005-0.011,0.006-0.016,0.011  c-0.008,0.008-0.009,0.019-0.017,0.028c-0.118,0.135-0.213,0.29-0.277,0.461c-0.008,0.02-0.012,0.04-0.019,0.061  c-0.048,0.146-0.08,0.3-0.08,0.462v53.128c0,0.164,0.033,0.32,0.082,0.468c0.007,0.02,0.011,0.039,0.018,0.059  c0.065,0.172,0.161,0.327,0.28,0.462c0.007,0.008,0.009,0.018,0.016,0.026c0.006,0.007,0.014,0.011,0.021,0.018  c0.049,0.051,0.103,0.096,0.159,0.14c0.025,0.019,0.047,0.042,0.073,0.06c0.066,0.046,0.137,0.083,0.21,0.117  c0.018,0.008,0.034,0.021,0.052,0.028c0.181,0.077,0.38,0.121,0.589,0.121h83.204c0.209,0,0.408-0.043,0.589-0.121  c0.028-0.012,0.054-0.03,0.081-0.044c0.062-0.031,0.124-0.063,0.181-0.102c0.03-0.021,0.057-0.048,0.086-0.071  c0.051-0.041,0.101-0.082,0.145-0.129c0.008-0.008,0.017-0.014,0.025-0.022c0.008-0.009,0.01-0.021,0.018-0.03  c0.117-0.134,0.211-0.288,0.275-0.458C93.078,76.267,93.083,76.246,93.09,76.224z M9.965,26.04l25.247,23.061L9.965,72.346V26.04z   M61.711,47.971c-0.104,0.068-0.214,0.125-0.301,0.221c-0.033,0.036-0.044,0.083-0.073,0.121l-11.27,10.294L12.331,24.138h75.472  L61.711,47.971z M37.436,51.132l11.619,10.613c0.287,0.262,0.649,0.393,1.012,0.393s0.725-0.131,1.011-0.393l11.475-10.481  l25.243,23.002H12.309L37.436,51.132z M64.778,49.232L90.169,26.04v46.33L64.778,49.232z"/></svg></a>
		</li>
	<?php } ?>


</ul>