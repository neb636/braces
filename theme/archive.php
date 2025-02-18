<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage braces
 * @author Oomph, Inc.
 * @link http://www.oomphinc.com
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) { ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) {
							single_cat_title();
						}
						elseif ( is_tag() ) {
							single_tag_title();
						}
						elseif ( is_author() ) {
							printf( __( 'Author: %s', 'braces' ), '<span class="vcard">' . get_the_author() . '</span>' );
						}
						elseif ( is_day() ) {
							printf( __( 'Day: %s', 'braces' ), '<span>' . get_the_date() . '</span>' );
						}
						elseif ( is_month() ) {
							printf( __( 'Month: %s', 'braces' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
						}
						elseif ( is_year() ) {
							printf( __( 'Year: %s', 'braces' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
						}
						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
							_e( 'Asides', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
							_e( 'Galleries', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
							_e( 'Images', 'braces');
						}
						elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
							_e( 'Videos', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
							_e( 'Quotes', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
							_e( 'Links', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
							_e( 'Statuses', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
							_e( 'Audios', 'braces' );
						}
						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
							_e( 'Chats', 'braces' );
						}
						else {
							_e( 'Archives', 'braces' );
						}	?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) {
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					}
				?>
			</header><!-- .page-header -->

			<?php
				while ( have_posts() ) {
					the_post();

					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				}

				braces_paging_nav();
			}
			else {
				get_template_part( 'content', 'none' );
			} ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
