<?php
/**
 * The template part for header
 *
 * @package VW Furniture Carpenter 
 * @subpackage vw_furniture_carpenter
 * @since VW Furniture Carpenter 1.0
 */
?>

<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-furniture-carpenter'); ?></a></div>
<div id="header" class="menubar">
	<div class="nav">
		<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
	</div>
</div>