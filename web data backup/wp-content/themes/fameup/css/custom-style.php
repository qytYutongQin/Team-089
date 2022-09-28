<?php 
function fameup_custom_style()
{
$fameup_theme_sidebar_width = get_theme_mod('fameup_theme_sidebar_width');
$fameup_header_overlay_size = get_theme_mod('fameup_header_overlay_size',200);
if($fameup_theme_sidebar_width)
{
?>
<style>
.sidebar-right
 {
	flex: 100;
    width:<?php echo esc_attr(get_theme_mod('fameup_theme_sidebar_width',355)).'px'; ?> !important;
 }

 .content-right
 {
 	width: calc((1130px - <?php echo esc_attr(get_theme_mod('fameup_theme_sidebar_width',355)).'px'; ?>)) !important;
 }

 </style>
<?php } ?>
<style>
    .bs-default .bs-header-main .inner{ height:<?php echo esc_attr(get_theme_mod('fameup_header_overlay_size',400)).'px'; ?> !important; }
    .site-title { font-family:<?php echo esc_attr(get_theme_mod('fameup_title_fontfamily', 'Vollkorn')); ?> !important; }
    .widget_block h2, .bs-widget-title .title ,.bs-sec-title .title{
        font-family:<?php echo esc_attr(get_theme_mod('fameup_widget_title_fontfamily', 'Vollkorn')); ?> !important; 
        font-size: <?php echo esc_attr(get_theme_mod('sidebar_widgets_title_fontsize')); ?>px !important; 
        line-height: <?php echo esc_attr(get_theme_mod('sidebar_widgets_title_line_height')); ?>px !important; 
    }
</style>
<?php } add_action('wp_head','fameup_custom_style',10,0); 
