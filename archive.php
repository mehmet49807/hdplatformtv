<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/news.php'); ?>

<section id="main">

<?php include (TEMPLATEPATH . '/sidebar_left.php'); ?>

	<div id="content" role="main">
	<?php if ( have_posts() ) : ?>
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2><?php single_cat_title(); ?></h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2><?php single_tag_title(); ?></h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2>Archive for <?php the_time('F, Y'); ?></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2>Archive for <?php the_time('Y'); ?></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2>Author Archive</h2>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2>Blog Archives</h2>
			<?php } ?>
		<?php if ( isset($options['f300250_banner']) && ($options['f300250_banner']!="") ){ ?>
		<div class="mainad">
			<?php echo(stripslashes ($options['f300250_banner']));?>
		</div>
		<?php } else { ?>
		<?php } ?>
		
		<div class="rightpro">
		<?php while ( have_posts() ) : the_post(); ?>
			
		<article id="posts">
			<div class="postthumb">
			<?php if( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'index-thumb' ); ?></a>
			<?php } else { ?>
				<a href="<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/defaultthumb.png" alt="<?php the_title(); ?>" /></a>
			<?php } ?>
			</div>
			<div class="post-link">
				<a href="<?php the_permalink() ?>"><?php $tit = the_title('','',FALSE); echo substr($tit, 0, 14); if (strlen($tit) > 14) echo " ..."; ?></a>
			</div>	
		</article>			
				
		<?php endwhile; ?>
		</div>
		<div class="clear"></div>
		<div class="pagination">
<?php
global $wp_query;
$big = 999999999; // need an unlikely integer
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages
) );
?>
		</div>
		
		<?php else : ?>
		
		<h2><?php _e("Nothing Found", "SamTv"); ?></h2>
		<article id="post">
			<div class="post-entry">
			<p><?php _e("Apologies, but no results were found. Perhaps searching will help find a related channel.", "SamTv"); ?></p>
			</div>	
		</article>	

		<?php endif; ?>

	</div>
		
<?php include (TEMPLATEPATH . '/sidebar_right.php'); ?>

</section>

<?php get_footer(); ?>