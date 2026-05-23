<?php
/**
 * Single service template for ATB Corporate WordPress theme
 * @package ATB_Corporate
 */

get_header(); ?>

<section class="page-hero">
    <div class="page-hero__grid"></div>
    <div class="page-hero__glow"></div>
    <div class="container">
        <div class="page-hero__inner">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo home_url('/'); ?>">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo home_url('/services'); ?>">Services</a>
                <span class="sep">/</span>
                <span aria-current="page"><?php the_title(); ?></span>
            </nav>
            <h1><?php the_title(); ?></h1>
            <?php if ( get_the_excerpt() ) : ?>
                <p class="page-hero__sub"><?php the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section section--white">
    <div class="container">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="service-featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        
        <div class="prose">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<!-- ═══════════ RELATED SERVICES ═══════════ -->
<section class="section section--warm">
    <div class="container">
        <h2>Related Services</h2>
        <div class="related-grid">
            <?php
            $related_services = new WP_Query([
                'post_type' => 'atb_service',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'orderby' => 'rand',
            ]);
            
            if ( $related_services->have_posts() ) :
                while ( $related_services->have_posts() ) :
                    $related_services->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="related-card">
                        <span class="related-card__title"><?php the_title(); ?></span>
                        <span class="related-card__desc"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></span>
                        <span class="related-card__more">Read more</span>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();