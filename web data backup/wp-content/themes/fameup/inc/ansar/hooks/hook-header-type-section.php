<?php
if (!function_exists('fameup_header_type_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_header_type_section()
{
    do_action('fameup_action_side_menu_section');
?> 
    <header class="bs-default">
    <?php do_action('fameup_action_header_section');
        do_action('fameup_action_header_logo_section');
        do_action('fameup_action_header_menu_section');  ?>
    </header>
<?php }
endif;
add_action('fameup_action_fameup_header_type_section', 'fameup_header_type_section', 6);