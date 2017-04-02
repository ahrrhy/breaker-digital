<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package control
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
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

                        <div class="entry-content container-fluid">
                            <div class="row">


                                <?php

                                $args = array(
                                    'taxonomy' => array( 'directors' ),
                                    'fields' => 'all',
                                );

                                $directed_query = new WP_Term_Query( $args );

                                if ( $directed_query->terms ) :?>
                                    <ul class="directors-list row" >
                                        <?php foreach( $directed_query->terms as $directed ){
                                            ?>
                                            <li class="col-sm-12 director-list-item">
                                                <h3 class="col-sm-3 directors-title">
                                                    <span class="border">
                                                        <?php echo $directed->name; ?>
                                                    </span>
                                                </h3>
                                                <?php
                                                $args_video = array(
                                                    'post_type' => 'videos',
                                                    'posts_per_page' => 1,
                                                    'directors' => $directed ->slug,
                                                    'meta_value' => 'added',
                                                );
                                                $videoStories = new WP_Query($args_video);

                                                while ( $videoStories->have_posts() ) : $videoStories->the_post();?>
                                                    <a class="col-sm-6 video-thumbnail" data-fancybox="gallery" href="<?php echo get_the_content(); ?>" title="<?php the_title_attribute(); ?>" >
                                                        <?php the_post_thumbnail('', array(
                                                            'class' => "img-responsive video-thumbnail",
                                                            'alt' => 'photo')); ?>
                                                    </a>
                                                <?php endwhile;

                                                wp_reset_postdata();
                                                ?>

                                                <a class="col-sm-3 directors-bio-link" href="<?php echo get_term_link($directed);?>"><?php echo $directed->name; ?> Bio <span class="arrow">→</span></a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php endif;?>
                                <?php wp_reset_postdata();?>

                            </div>
                        </div><!-- .entry-content -->

                        <?php if ( get_edit_post_link() ) : ?>
                            <footer class="entry-footer">

                            </footer><!-- .entry-footer -->
                        <?php endif; ?>
                    </div>
                </article><!-- #post-## -->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
