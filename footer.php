    </div><!-- #content -->

    <!-- ═══════════════════════════════════════
         FOOTER — SYSTEM INFO
    ═══════════════════════════════════════ -->
    <footer id="colophon" class="site-footer" role="contentinfo">

        <div class="footer-sysinfo">

            <div class="footer-sysinfo-grid">

                <!-- Column 1: Host info -->
                <div class="sysinfo-col">
                    <div class="sysinfo-label">// SYSTEM</div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">HOST</span>
                        <span class="sysinfo-val"><?php echo esc_html( parse_url( home_url(), PHP_URL_HOST ) ); ?></span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">KERNEL</span>
                        <span class="sysinfo-val">DeepQuest-Terminal v1.5.1</span>
                    </div>
                </div>

                <!-- Column 2: Database / content stats -->
                <div class="sysinfo-col">
                    <div class="sysinfo-label">// DATABASE</div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">POSTS</span>
                        <span class="sysinfo-val"><?php echo (int) wp_count_posts()->publish; ?></span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">CATEGORIES</span>
                        <span class="sysinfo-val"><?php echo (int) wp_count_terms( 'category' ); ?></span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">COMMENTS</span>
                        <span class="sysinfo-val"><?php echo (int) wp_count_comments()->approved; ?></span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">USERS</span>
                        <span class="sysinfo-val"><?php echo (int) count_users()['total_users']; ?></span>
                    </div>
                </div>

                <!-- Column 3: Session / network -->
                <div class="sysinfo-col">
                    <div class="sysinfo-label">// SESSION</div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">DATE</span>
                        <span class="sysinfo-val"><?php echo date( 'Y-m-d' ); ?></span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">TIME</span>
                        <span class="sysinfo-val" id="footerClock"><?php echo date( 'H:i:s' ); ?> UTC</span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">UPTIME</span>
                        <span class="sysinfo-val" style="color:var(--green-bright)">[ONLINE]</span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">STATUS</span>
                        <span class="sysinfo-val" style="color:var(--green-bright)">OK</span>
                    </div>
                </div>

                <!-- Column 4: Copyright / links -->
                <div class="sysinfo-col">
                    <div class="sysinfo-label">// INFO</div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">COPY</span>
                        <span class="sysinfo-val">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></span>
                    </div>
                    <div class="sysinfo-row">
                        <span class="sysinfo-key">LICENSE</span>
                        <span class="sysinfo-val">EDU_USE_ONLY</span>
                    </div>
                    <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <div class="footer-nav-wrap">
                        <?php wp_nav_menu( [
                            'theme_location' => 'footer',
                            'container'      => false,
                            'depth'          => 1,
                            'menu_class'     => 'footer-menu',
                            'fallback_cb'    => false,
                        ] ); ?>
                    </div>
                    <?php endif; ?>
                </div>

            </div><!-- .footer-sysinfo-grid -->

        </div><!-- .footer-sysinfo -->

        <!-- Bottom bar -->
        <div class="footer-bottom-bar">
            <span>EOF</span>
            <span>|</span>
            <span>SESSION_TERMINATED</span>
            <span>|</span>
            <span>root@<?php echo esc_html( parse_url( home_url(), PHP_URL_HOST ) ); ?>:~#</span>
            <span class="footer-cursor">_</span>
        </div>

    </footer><!-- #colophon -->

</div><!-- #page -->

<script>
(function() {
    // ─── Defacement counter roll-up animation ───
    var counter = document.getElementById('defacementCounter');
    if (counter) {
        var target   = parseInt(counter.getAttribute('data-target'), 10) || 0;
        var numEl    = counter.querySelector('.counter-num');
        var duration = 2000;
        var startTime = null;
        var digits   = String(target).length;

        function pad(n) {
            return String(n).padStart(Math.max(digits, 4), '0');
        }

        function animateCounter(ts) {
            if (!startTime) startTime = ts;
            var progress = Math.min((ts - startTime) / duration, 1);
            var ease     = 1 - Math.pow(1 - progress, 3);
            numEl.textContent = pad(Math.floor(ease * target));
            if (progress < 1) {
                requestAnimationFrame(animateCounter);
            } else {
                numEl.textContent = pad(target);
            }
        }

        if ('IntersectionObserver' in window) {
            var obs = new IntersectionObserver(function(entries) {
                if (entries[0].isIntersecting) {
                    requestAnimationFrame(animateCounter);
                    obs.disconnect();
                }
            }, { threshold: 0.3 });
            obs.observe(counter);
        } else {
            requestAnimationFrame(animateCounter);
        }
    }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
