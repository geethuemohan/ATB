<?php
/**
 * Insights archive template for ATB Corporate WordPress theme
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
                <span aria-current="page">Insights</span>
            </nav>
            <h1>Market <em>Insights</em> &amp; Research</h1>
            <p class="page-hero__sub">Market research, strategic intelligence and insights on India–UAE business entry and cross-border expansion.</p>
        </div>
    </div>
</section>

<section class="section section--white">
    <div class="container">
        <div class="insights-grid">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article class="insight-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="insight-card__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="insight-card__content">
                            <span class="insight-card__date"><?php echo get_the_date('F j, Y'); ?></span>
                            <h3 class="insight-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="insight-card__excerpt"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="link-arr">Read more</a>
                        </div>
                    </article>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
        
        <?php the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => esc_html__('Previous', 'atb-corporate'),
            'next_text' => esc_html__('Next', 'atb-corporate'),
        ]); ?>
    </div>
</section>

<?php
get_footer();