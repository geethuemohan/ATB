<?php
/**
 * Page template for ATB Corporate WordPress theme
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
                <span aria-current="page"><?php the_title(); ?></span>
            </nav>
            <h1><?php the_title(); ?></h1>
            <?php if ( get_the_excerpt() ) : ?>
                <p class="page-hero__sub"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section section--white">
    <div class="container">
        <div class="prose">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php
get_footer();