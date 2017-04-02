<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package control
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main container-fluid" role="main">
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

                <section class="contact-section">

                    <ul class="row contact-list">
                        <?php
                        $args = array(
                            'post_type' => 'contacts',
                            'orderby'=>'menu_order',
                            'posts_per_page' => 3,
                        );
                        $contacts = new WP_Query($args);
                        if ( $contacts->have_posts() ) :
                            while ($contacts->have_posts()) : $contacts->the_post();
                                ?>
                                <li class="col-xs-6 col-sm-4 contact-item">
                                    <?php the_post_thumbnail('', array( 'src' => $src,
                                        'class' => "location-photo",
                                        'alt' => 'photo')); ?>
                                    <h3 class="directors-title">
                                         <span class="border">
                                             <?php the_terms( $post->ID, 'locations' );  ?>
                                         </span>
                                    </h3>
                                    <div class="content">
                                        <p class="contact-title">
                                            <?php the_title();; ?>
                                        </p>
                                        <?php
                                            the_content();
                                        ?>
                                    </div>
                                </li>
                            <?php endwhile;?>
                        <?php endif;
                            wp_reset_postdata();
                        ?>
                        <?php
                            $executiveProducer = new WP_Query(array(
                                'post_type' => 'contacts',
                                'locations'    => 'executive-producer'
                            ) );
                            if ( $executiveProducer->have_posts() ) :
                                while ($executiveProducer->have_posts()) : $executiveProducer->the_post();
                        ?>
                        <li class="col-sm-12 contact-executive-item">
                            <h3 class="directors-title">
                                         <span class="border">
                                            <?php the_terms( $post->ID, 'locations' );  ?>
                                         </span>
                            </h3>
                            <div class="content">
                                <p class="contact-title">
                                    <?php the_title();; ?>
                                </p>
                                <?php
                                    the_content();
                                ?>
                            </div>
                        </li>
                                <?php endwhile;?>
                        <?php endif;
                        wp_reset_postdata();
                        ?>
                    </ul>

                </section>

            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
