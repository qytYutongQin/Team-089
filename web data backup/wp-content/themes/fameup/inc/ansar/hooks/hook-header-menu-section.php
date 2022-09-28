<?php
if (!function_exists('fameup_header_menu_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_header_menu_section()
{
?>
<div class="bs-menu-full">
            <nav class="navbar navbar-expand-lg navbar-wp">
              <div class="container">
                <!-- left btn -->
                <?php $sidebar_menu = get_theme_mod('sidebar_menu','true'); 
                if($sidebar_menu == true)
                {
                ?>
                 <span class="offcbtn d-none d-lg-block" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button" aria-controls="offcanvas-start" aria-expanded="false"><i class="fas fa-bars"></i></span>
                <?php } ?>
                <!-- /left btn -->
                <!-- Right nav -->
                <div class="m-header align-items-center">
                  <!-- navbar-toggle -->
                  <button  class="offcbtn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button" aria-controls="offcanvas-start" aria-expanded="false"><i class="fas fa-bars"></i></button>
                   <button class="navbar-toggler collapsed ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbar-wp" aria-controls="navbar-wp" aria-expanded="false"
                aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     <span class="my-1 mx-2 close fa fa-times"></span>
                  </button>
                  <!-- /navbar-toggle -->
                  <?php $fameup_menu_search  = get_theme_mod('fameup_menu_search','true'); 
                  if($fameup_menu_search == true) {
                  ?>
                  <div class="dropdown bs-search-box">
                <a class="dropdown-toggle msearch ml-auto" href="#" role="button" id="dropdownMenuLink"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-search"></i>
                </a>
                  <div class="dropdown-menu searchinner" aria-labelledby="dropdownMenuLink">
                    <?php get_search_form(); ?>
                  </div>
              </div>
                <?php } if ( wp_is_mobile() ) {
                $fameup_lite_dark_switcher = get_theme_mod('fameup_lite_dark_switcher','true');
                if($fameup_lite_dark_switcher == true){ ?>
                  <label  class="switch" for="switch">
                    <input type="checkbox" name="theme" id="switch">
                    <span class="slider"></span>
                  </label>
                  <?php } } ?>
                </div>
                <!-- /Right nav -->
                <div class="collapse navbar-collapse" id="navbar-wp">
                  <?php 
                  if(is_rtl()) { wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'  => 'nav-collapse collapse navbar-inverse-collapse',
                        'menu_class' => 'nav navbar-nav sm-rtl',
                        'fallback_cb' => 'fameup_fallback_page_menu',
                        'walker' => new fameup_nav_walker()
                      ) ); 
                      } else
                      {
                         wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'  => 'nav-collapse collapse navbar-inverse-collapse',
                        'menu_class' => 'mx-auto nav navbar-nav',
                        'fallback_cb' => 'fameup_fallback_page_menu',
                        'walker' => new fameup_nav_walker()
                      ) );

                      }
                    ?>
              </div>
              <!-- Right nav -->
              <?php $fameup_menu_search  = get_theme_mod('fameup_menu_search','true');
                    $fameup_menu_subscriber  = get_theme_mod('fameup_menu_subscriber','true');
              ?>
            <div class="desk-header pl-3 ml-auto my-2 my-lg-0 position-relative align-items-center">
              <?php if($fameup_menu_subscriber == true) { 
                $fameup_subsc_title = get_theme_mod('fameup_subsc_title',__('Subscribe','fameup'));
                $fameup_subsc_link = get_theme_mod('fameup_subsc_link','#');
                ?>
              <a href="<?php echo esc_url($fameup_subsc_link); ?>" class="btn btn-subscribe"><i class="fas fa-bell me-1"></i><?php echo esc_html($fameup_subsc_title); ?></a>
              <?php } if($fameup_menu_search == true) { ?>
              <div class="dropdown bs-search-box">
                <a class="dropdown-toggle msearch ml-auto" href="#" role="button" id="dropdownMenuLink"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-search"></i>
                </a>
                  <div class="dropdown-menu searchinner" aria-labelledby="dropdownMenuLink">
                    <?php get_search_form(); ?>

                  </div>
              </div>
               <?php } $fameup_lite_dark_switcher = get_theme_mod('fameup_lite_dark_switcher','true');
                if($fameup_lite_dark_switcher == true){ ?> 
                  <label  class="switch ms-2" for="switch">
                    <input type="checkbox" name="theme" id="switch">
                    <span class="slider"></span>
                  </label>
            <?php } ?>
            </div>
            <!-- /Right nav -->
          </div>
      </nav> <!-- /Navigation -->
    </div>
<?php 
}
endif;
add_action('fameup_action_header_menu_section', 'fameup_header_menu_section', 6);