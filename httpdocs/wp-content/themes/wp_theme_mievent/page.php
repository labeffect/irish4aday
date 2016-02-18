<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Mtheme
 * @since Mtheme 1.0
 */
get_header();
the_post();

$content_wrapper="main-content";
$pageId=get_the_ID();
$event_slider= intval(MthemeCore::getPostMeta($pageId, 'page_event_slider'));
if(!empty($event_slider))
{
	echo '<div id="home_slider">';
	echo do_shortcode('[hero_background slider_id="'.$event_slider.'"]');
	echo '</div>';
	$content_wrapper="";
}

$page_title= MthemeCore::getPostMeta($pageId, 'page_title','true');
$content_post = get_post($pageId);
$content = $content_post->post_content;
?>

 
<div class="<?php echo $content_wrapper?>">
	<div class="container">
		<div class="row">
			<?php if(!empty($page_title) && $page_title=='true'){ ?>
			<section class="page-heading">
				<h1 class="h1-72"><?php echo $content_post->post_title; ?></h1>
			</section>
			<?php }?>		
			<?php echo do_shortcode($content); ?>
			</div><!-- #row -->
	</div><!-- #container -->
	
</div><!-- #main-content -->

<?php get_footer(); ?>