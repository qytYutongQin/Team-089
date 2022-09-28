<?php
if (!function_exists('fameup_side_menu_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_side_menu_section()
{
?>
<div class="sidenav offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> </h5>
    <span class="btn_close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times"></i></span>
  </div>
  <div class="offcanvas-body">
      <?php if( is_active_sidebar('menu-sidebar-content')){
    get_template_part('sidebar','fameupmenu');
  } else { echo esc_html_e('No Widgets found in the Sidebar','fameup'); } ?>
  </div>
</div>
<?php 
} endif;
add_action('fameup_action_side_menu_section', 'fameup_side_menu_section', 5);