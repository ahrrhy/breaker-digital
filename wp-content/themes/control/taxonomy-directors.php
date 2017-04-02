<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package control
 */

get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main container-fluid" role="main">
            <div class="row">
                <header class="entry-header container-fluid">
                    <h1 class="entry-title container"> <?php
                        $tax = get_taxonomy( get_queried_object()->taxonomy );
                        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
                        $title = $tax->labels->singular_name;
                        echo $title;?></h1>
                </header>

                <?php
                if ( have_posts() ) : ?>
                    <article class="about-director container">
                        <div class="row">

                            <header class="col-sm-3 director-header">
                                <img class="directors-photo" src="<?php echo get_term_meta( $term->term_id, 'photo-directed', 1 ); ?>">
                                <h3 class="directors-title">
                                <span class="border">
                                    <?php
                                    $terms = get_the_terms( $post->ID, 'directors' );
                                    if( $terms ){
                                    $term = array_shift( $terms );

                                    // теперь можно можно вывести название термина
                                    echo $term->name;
                                    ?>
                                </span>
                                </h3>
                            </header>
                            <div class="entry-content col-sm-9">
                               <p class="director-description">
                                   <?php echo $term->description; ?>
                               </p>
                                <?php
                                if ( have_posts() ) : ?>
                                <p class="director-work">Work:</p>
                                    <ul class="work-list">
                                        <?php while ( have_posts() ) : the_post();?>
                                            <li class="work-item">
                                                <a class="popup-youtube" href="<?php echo get_the_content(); ?>" data-fancybox="gallery">
                                                    <?php the_title();?>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>


                                <?php else :
                                    get_template_part( 'template-parts/content', 'none' );
                                endif; ?>
                            </div>

                            <?php } ?>

                        </div>
                    </article>

                    <?php
                    /* Start the Loop */

                endif; ?>

            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
