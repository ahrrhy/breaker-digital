<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package control
 */

?>

<article class="container-fluid" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <?php if (! is_front_page()){ ?>
            <header class="entry-header container-fluid">
               <div class="row">
                   <?php
                   the_title( '<h1 class="entry-title container">', '</h1>' );
                   ?>
               </div>
            </header><!-- .entry-header -->
        <?php  } ?>

        <div class="entry-content container">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'control' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->

        <?php if ( get_edit_post_link() ) : ?>
            <footer class="entry-footer">

            </footer><!-- .entry-footer -->
        <?php endif; ?>
    </div>
</article><!-- #post-## -->
