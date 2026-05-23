<?php
/**
 * Header template for ATB Corporate WordPress theme
 * @package ATB_Corporate
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- ═══════════ TOP BAR ═══════════ -->
    <div class="topbar">
        <div class="container">
            <div class="topbar__inner">
                <span class="topbar__hours">Monday – Friday &nbsp;|&nbsp; 09:00 – 18:00</span>
                <div class="topbar__right">
                    <a href="https://www.linkedin.com/company/atb-accounting-and-tax-consulting-and-services-llc/" target="_blank" rel="noopener" class="topbar__linkedin" aria-label="ATB Corporate on LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ═══════════ HEADER / NAV ═══════════ -->
    <header class="site-header" id="site-header">
        <div class="container">
            <nav class="nav" aria-label="Primary navigation">
                <a href="<?php echo home_url('/'); ?>" class="logo" aria-label="ATB Corporate — Home">
                    <div class="logo__mark"><span><?php bloginfo('name'); ?></span></div>
                    <div class="logo__text">
                        <span class="logo__name"><?php bloginfo('name'); ?></span>
                        <span class="logo__sub">Advisory &amp; Structuring</span>
                    </div>
                </a>
                
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'nav__links',
                    'fallback_cb' => 'wp_page_menu',
                    'depth' => 3,
                ]);
                ?>
                
                <button class="nav__toggle" id="nav-toggle" aria-label="Open navigation">
                    <svg width="24" height="16" viewBox="0 0 24 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <line x1="0" y1="2" x2="24" y2="2"/>
                        <line x1="0" y1="8" x2="24" y2="8"/>
                        <line x1="0" y1="14" x2="24" y2="14"/>
                    </svg>
                </button>
            </nav>
        </div>
    </header>
    
    <!-- ═══════════ MOBILE NAV ═══════════ -->
    <div class="mobile-nav" id="mobile-nav">
        <button class="mobile-nav__close" id="mobile-nav-close" aria-label="Close navigation">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round">
                <line x1="5" y1="5" x2="19" y2="19"/>
                <line x1="19" y1="5" x2="5" y2="19"/>
            </svg>
        </button>
        <?php
        wp_nav_menu([
            'theme_location' => 'mobile',
            'fallback_cb' => 'wp_page_menu',
            'depth' => 3,
        ]);
        ?>
    </div>
    
    <main id="main-content">