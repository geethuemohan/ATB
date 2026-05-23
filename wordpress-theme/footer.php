<?php
/**
 * Footer template for ATB Corporate WordPress theme
 * @package ATB_Corporate
 */
?>
    </main>
    
    <!-- ═══════════ FOOTER ═══════════ -->
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div>
                    <div class="footer__brand-name"><?php bloginfo('name'); ?></div>
                    <div class="footer__brand-sub">India–UAE Market Entry &amp; Cross-Border Advisory.</div>
                    <a href="https://www.linkedin.com/company/atb-accounting-and-tax-consulting-and-services-llc/" target="_blank" rel="noopener" class="footer__linkedin" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                </div>
                <div>
                    <div class="footer__col-head">Services</div>
                    <ul class="footer__nav">
                        <li><a href="<?php echo home_url('/uae'); ?>">UAE Advisory</a></li>
                        <li><a href="<?php echo home_url('/india'); ?>">India Advisory</a></li>
                        <li><a href="<?php echo home_url('/adgm-difc-gift-city'); ?>">ADGM, DIFC &amp; GIFT City</a></li>
                        <li><a href="<?php echo home_url('/global-capability-centres'); ?>">Global Capability Centres</a></li>
                        <li><a href="<?php echo home_url('/transaction-advisory'); ?>">Transaction Advisory</a></li>
                        <li><a href="<?php echo home_url('/cross-border-trade'); ?>">Cross-Border Trade</a></li>
                        <li><a href="<?php echo home_url('/market-intelligence'); ?>">Market Intelligence</a></li>
                        <li><a href="<?php echo home_url('/outsourced-finance'); ?>">Outsourced Finance</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer__col-head">Company</div>
                    <ul class="footer__nav">
                        <li><a href="<?php echo home_url('/about'); ?>">About ATB</a></li>
                        <li><a href="<?php echo home_url('/about#team'); ?>">Our Team</a></li>
                        <li><a href="<?php echo home_url('/insights'); ?>">Insights</a></li>
                        <li><a href="<?php echo home_url('/contact'); ?>">Contact Us</a></li>
                    </ul>
                    <ul class="footer__nav footer__nav--quiet" style="margin-top:1.1rem;">
                        <li><a href="<?php echo home_url('/selected-work'); ?>">Selected Work</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer__col-head">Contact</div>
                    <div class="footer__contact-item">
                        <div class="footer__country">UAE</div>
                        <div class="footer__addr">
                            ATB Accounting and Tax Consulting<br>and Services LLC SPC<br>
                            Office 1325, Dar Al Salam Building<br>Corniche, P.O. Box 6157, Abu Dhabi<br>
                            <a href="tel:+97128869955">+971 2 886 9955</a>
                        </div>
                    </div>
                    <div class="footer__contact-item">
                        <div class="footer__country">India</div>
                        <div class="footer__addr">
                            ATB Corporate Advisory<br>7th Floor, Raheja Tower<br>MG Road, Bengaluru 560001<br>
                            <a href="tel:+919535704400">+91 95357 04400</a>
                        </div>
                    </div>
                    <div class="footer__addr">
                        <a href="mailto:info@atbcorporate.com">info@atbcorporate.com</a>
                    </div>
                </div>
            </div>
            <p class="footer__disclaimer">The information on this website is general in nature and does not constitute legal, tax or financial advice, and should not be relied upon for any specific decision without professional advice.</p>
            <div class="footer__bottom">
                <span>&copy; <?php echo date('Y'); ?> ATB Corporate. All rights reserved.</span>
                <ul class="footer__legal">
                    <li><a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo home_url('/terms-of-use'); ?>">Terms of Use</a></li>
                </ul>
            </div>
        </div>
    </footer>
    
    <!-- ═══════════ FLOATING ACTION BUTTON ═══════════ -->
    <div class="fab" id="fab" role="complementary" aria-label="Contact options">
        <div class="fab__panel" id="fab-panel">
            <a href="tel:+97128869955" class="fab__action" aria-label="Call UAE office">
                <span class="fab__label">+971 2 886 9955</span>
                <span class="fab__icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.28h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7 2 2 0 0 1 1.72 2z"/></svg></span>
            </a>
            <a href="https://wa.me/919535704400?text=Hello%20ATB%20%E2%80%94%20I%20would%20like%20to%20discuss%20" target="_blank" rel="noopener noreferrer" class="fab__action" aria-label="WhatsApp">
                <span class="fab__label">WhatsApp</span>
                <span class="fab__icon"><svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.413-2.393-1.476-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51-.173-.008-.371 0-.57 0-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a6.963 6.963 0 0 0-7.145 7.136c0 1.327.264 2.605.764 3.783l-1.196 4.372 4.473-1.173c1.125.622 2.374.982 3.704.982 3.863 0 7.001-3.125 7.001-6.979 0-1.862-.697-3.61-1.962-4.9-1.265-1.29-2.953-2.021-4.635-2.021m5.904 13.742c-.923.804-2.21 1.257-3.522 1.257-.992 0-1.927-.26-2.733-.72l-.192-.103-1.993.522.531-1.942-.125-.198a5.993 5.993 0 0 1-.922-3.22c0-3.315 2.692-6.01 6.01-6.01 1.605 0 3.113.624 4.25 1.757 1.137 1.133 1.764 2.641 1.764 4.247 0 3.315-2.692 6.01-6.01 6.01"/></svg></span>
            </a>
            <a href="mailto:info@atbcorporate.com" class="fab__action" aria-label="Email">
                <span class="fab__label">info@atbcorporate.com</span>
                <span class="fab__icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </a>
        </div>
        <button class="fab__trigger" id="fab-trigger" aria-label="Contact options" aria-expanded="false" aria-controls="fab-panel">
            <svg class="fab__ico-chat" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9 8.5 8.5 0 0 1 8.5 8.5z"/></svg>
        </button>
    </div>
    
    <?php wp_footer(); ?>
</body>
</html>