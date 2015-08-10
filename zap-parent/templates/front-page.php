<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?><!-------------THISWORKED---------------->
<?php wp_enqueue_style( 'zapstyle', plugin_dir_url( __FILE__ ).'../css/zapstyle.css', null, 1.0001, null ); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<article id="front-page" class="front-page page type-page status-publish hentry">
<div class="entry-content">
<!------get zaps------>
<table class="zaptable">
<?php
$args = array(

	'post_type'        => 'zap',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);

$zaps = get_posts( $args );
foreach ($zaps as $zap){
echo '<tr class="zaprow"><td>';
echo zlc_print_votes($zap->ID);
echo '</td><td>'.$zap->post_excerpt.'</td></tr>';	
	
}
?>
</table>


	
</div>
</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>