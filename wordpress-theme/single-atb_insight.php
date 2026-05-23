<?php
/**
 * Single insight template for ATB Corporate WordPress theme
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
                <a href="<?php echo home_url('/insights'); ?>">Insights</a>
                <span class="sep">/</span>
                <span aria-current="page"><?php the_title(); ?></span>
            </nav>
            <h1><?php the_title(); ?></h1>
            <p class="page-hero__meta">
                Published on <?php echo get_the_date('F j, Y'); ?> | 
                <?php
                $categories = get_the_terms(get_the_ID(), 'insight_category');
                if ( $categories && !is_wp_error($categories) ) {
                    echo implode(', ', wp_list_pluck($categories, 'name'));
                }
                ?>
            </p>
        </div>
    </div>
</section>

<section class="section section--white">
    <div class="container container--narrow">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="insight-featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        
        <div class="prose">
            <?php the_content(); ?>
        </div>
        
        <div class="insight-meta" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border);">
            <p class="insight-author" style="font-size: var(--fs-sm); color: var(--text-mid);">
                <strong>About the author:</strong><br>
                <?php the_author(); ?>
            </p>
        </div>
    </div>
</section>

<!-- ═══════════ RELATED INSIGHTS ═══════════ -->
<section class="section section--grey">
    <div class="container">
        <h2>Related Insights</h2>
        <div class="related-grid">
            <?php
            $related_insights = new WP_Query([
                'post_type' => 'atb_insight',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'orderby' => 'date',
                'order' => 'DESC',
            ]);
            
            if ( $related_insights->have_posts() ) :
                while ( $related_insights->have_posts() ) :
                    $related_insights->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="related-card">
                        <span class="related-card__label"><?php echo get_the_date('M d, Y'); ?></span>
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