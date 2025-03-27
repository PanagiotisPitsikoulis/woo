<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _tw
 */

?>

	</div><!-- #content -->

	<footer class="footer p-10 bg-neutral text-neutral-content">
		<div class="container mx-auto">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
				<div class="flex flex-col items-start gap-4">
					<?php 
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
					if ($logo) : ?>
						<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="h-12 w-auto">
					<?php else : ?>
						<h2 class="footer-title"><?php bloginfo('name'); ?></h2>
					<?php endif; ?>
					
					<?php
					$tw_description = get_bloginfo('description', 'display');
					if ($tw_description || is_customize_preview()) :
						?>
						<p class="text-sm opacity-80"><?php echo $tw_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div>
				
				<div>
					<h2 class="footer-title"><?php esc_html_e('Shop', 'tw'); ?></h2> 
					<ul>
						<li><a href="<?php echo esc_url(home_url('/shop/')); ?>" class="link link-hover"><?php esc_html_e('All Products', 'tw'); ?></a></li>
						<li><a href="<?php echo esc_url(home_url('/cart/')); ?>" class="link link-hover"><?php esc_html_e('Cart', 'tw'); ?></a></li>
						<li><a href="<?php echo esc_url(home_url('/checkout/')); ?>" class="link link-hover"><?php esc_html_e('Checkout', 'tw'); ?></a></li>
						<li><a href="<?php echo esc_url(home_url('/my-account/')); ?>" class="link link-hover"><?php esc_html_e('My Account', 'tw'); ?></a></li>
					</ul>
				</div> 
				
				<div>
					<h2 class="footer-title"><?php esc_html_e('Information', 'tw'); ?></h2> 
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'footer-menu',
							'container'      => '',
							'items_wrap'     => '<ul>%3$s</ul>',
							'fallback_cb'    => false,
							'depth'          => 1,
							'walker'         => new WP_Tailwind_Navwalker(),
						)
					);
					?>
				</div> 
				
				<div>
					<h2 class="footer-title"><?php esc_html_e('Connect With Us', 'tw'); ?></h2> 
					<div class="grid grid-flow-col gap-4">
						<?php
						$social_platforms = array(
							'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg>',
							'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>',
							'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
							'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path></svg>',
							'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>',
							'tiktok' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>'
						);

						$icons_color = get_theme_mod('tw_social_icons_color', 'base-content');
						
						foreach ($social_platforms as $platform => $icon) {
							$url = get_theme_mod("tw_social_{$platform}");
							if ($url) {
								echo '<a href="' . esc_url($url) . '" class="text-' . esc_attr($icons_color) . ' hover:text-primary transition-colors" target="_blank" rel="noopener noreferrer">' . $icon . '</a>';
							}
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="mt-10 pt-6 border-t border-base-300">
				<p class="text-sm opacity-80">&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'tw'); ?></p>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
