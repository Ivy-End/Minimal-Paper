                <?php get_sidebar(); ?>
            </div>

            <footer id="footer" role="contentinfo">
                <div id="copyright">
                    &copy; <?php echo esc_html( date_i18n('Y') ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </div>
            </footer>
        </div>

        <?php wp_footer(); ?>
    </body>
</html>