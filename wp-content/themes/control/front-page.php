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
        <main id="main" class="site-main container-fluid" role="main">
            <div class="row">

                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
                <section class="container-fluid new-media">
                    <div class="row">
                        <header class="entry-header container-fluid">
                            <h1 class="entry-title container">new media</h1>
                        </header>
                        <div class="gallery container">
                            <ul class="row gallery-list">
                                <?php
                                    $args = array(
                                        'post_type' => 'videos',
                                        'orderby'=>'post_date',
                                        'posts_per_page' => 6,
                                    );
                                    $videoPosts = new WP_Query($args);
                                    if ( $videoPosts->have_posts() ) :
                                        while ($videoPosts->have_posts()) : $videoPosts->the_post();
                                ?>

                                <li class="col-sm-4 gallery-item">
                                    <?php
                                    if (has_post_thumbnail()) { ?>
                                    <a data-fancybox="gallery" href="<?php echo get_the_content(); ?>" title="<?php the_title_attribute(); ?>" >
                                        <?php the_post_thumbnail('', array(
                                            'class' => "img-responsive video-thumbnail",
                                            'alt' => 'photo')); ?>
                                    </a>
                                       <p class="text-left thumnbnail-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt;?></p>
                                        <?php } ?>
                                </li>
                                        <?php endwhile;?>
                                    <?php endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
