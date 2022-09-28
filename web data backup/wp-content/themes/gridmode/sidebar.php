<?php
/**
* The file for displaying the sidebars.
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php if ( is_singular() ) { ?>

<?php if(!is_page_template(array( 'template-full-width-page.php', 'template-full-width-post.php' ))) { ?>
<div class="gridmode-sidebar-one-wrapper gridmode-sidebar-widget-areas gridmode-clearfix" id="gridmode-sidebar-one-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="gridmode-sidebar-one-wrapper-inside gridmode-clearfix">

<?php gridmode_sidebar_one(); ?>

</div>
</div>
</div><!-- /#gridmode-sidebar-one-wrapper-->
<?php } ?>

<?php } ?>