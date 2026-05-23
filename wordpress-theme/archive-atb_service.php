<?php
/**
 * Services archive template for ATB Corporate WordPress theme
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
                <span aria-current="page">Our Services</span>
            </nav>
            <h1>Cross-Border <em>Advisory</em> Services</h1>
            <p class="page-hero__sub">For businesses, investors and family offices across the UAE and India — structuring, transactions, tax, trade and market research.</p>
        </div>
    </div>
</section>

<section class="section section--white" id="services">
    <div class="container">
        <div class="section-header section-header--center">
            <span class="overline">Our Services</span>
            <div class="gold-rule gold-rule--center"></div>
            <h2 class="section-heading section-heading--center">Specialist Advisory Services</h2>
        </div>
        
        <div class="feature-grid">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <div class="feature-card">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="link-arr">Read more</a>
                    </div>
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