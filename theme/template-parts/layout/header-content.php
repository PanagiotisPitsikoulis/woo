<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */

?>

<header class="sticky top-0 z-50 bg-base-100 shadow-md">
	<div class="navbar container mx-auto">
		<div class="navbar-start">
			<div class="dropdown">
				<div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
				</div>
				<ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu-mobile',
							'container'      => '',
							'items_wrap'     => '%3$s',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul>
			</div>
			<?php 
			$custom_logo_id = get_theme_mod('custom_logo');
			$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
			?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3">
				<?php if ($logo) : ?>
					<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="h-8 w-auto">
				<?php endif; ?>
				<span class="text-xl font-bold"><?php bloginfo('name'); ?></span>
			</a>
		</div>
		
		<div class="navbar-center hidden lg:flex">
			<ul class="menu menu-horizontal px-1">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu-desktop',
						'container'      => '',
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
					)
				);
				?>
			</ul>
		</div>
		
		<div class="navbar-end">
			<?php if (class_exists('WooCommerce')) : ?>
				<div class="dropdown dropdown-end mr-2">
					<div tabindex="0" role="button" class="btn btn-ghost btn-circle">
						<div class="indicator">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
							<span class="badge badge-sm indicator-item"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</div>
					</div>
					<div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
						<div class="card-body">
							<span class="font-bold text-lg"><?php echo sprintf(_n('%d προϊόν', '%d προϊόντα', WC()->cart->get_cart_contents_count(), 'tw'), WC()->cart->get_cart_contents_count()); ?></span>
							<span class="text-info"><?php echo WC()->cart->get_cart_total(); ?></span>
							<div class="card-actions">
								<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn-block"><?php esc_html_e('Προβολή καλαθιού', 'tw'); ?></a>
							</div>
						</div>
					</div>
				</div>
				
				<div class="dropdown dropdown-end">
					<div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
						<div class="w-10 rounded-full">
							<?php if (is_user_logged_in()) : 
								$current_user = wp_get_current_user();
								$avatar = get_avatar_url($current_user->ID);
							?>
								<img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" />
							<?php else : ?>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
								</svg>
							<?php endif; ?>
						</div>
					</div>
					<ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
						<?php if (is_user_logged_in()) : ?>
							<li><a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>"><?php esc_html_e('My Account', 'tw'); ?></a></li>
							<li><a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>"><?php esc_html_e('Orders', 'tw'); ?></a></li>
							<li><a href="<?php echo esc_url(wp_logout_url(get_permalink())); ?>"><?php esc_html_e('Logout', 'tw'); ?></a></li>
						<?php else : ?>
							<li><a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Login / Register', 'tw'); ?></a></li>
						<?php endif; ?>
					</ul>
				</div>
			<?php endif; ?>
			
			<?php if (get_theme_mod('tw_show_search', true)) : ?>
				<button class="btn btn-ghost btn-circle ml-2" aria-label="<?php esc_attr_e('Search', 'tw'); ?>">
					<a href="<?php echo esc_url(home_url('/?s=')); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
					</a>
				</button>
			<?php endif; ?>
			
			<!-- Theme Selector -->
			<div class="dropdown dropdown-end ml-2">
				<div tabindex="0" role="button" class="btn btn-ghost btn-circle">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
					</svg>
				</div>
				<div tabindex="0" class="dropdown-content z-[1] shadow bg-base-100 rounded-box mt-3 p-2 w-56">
					<div class="p-2">
						<h3 class="font-bold text-lg mb-3"><?php esc_html_e('Επιλογή Θέματος', 'tw'); ?></h3>
						<div class="grid grid-cols-2 gap-2 max-h-80 overflow-y-auto pr-1">
							<?php
							$themes = array(
								'light' => 'Φωτεινό',
								'dark' => 'Σκοτεινό',
								'cupcake' => 'Cupcake',
								'bumblebee' => 'Bumblebee',
								'emerald' => 'Emerald',
								'corporate' => 'Corporate',
								'synthwave' => 'Synthwave',
								'retro' => 'Retro',
								'cyberpunk' => 'Cyberpunk',
								'valentine' => 'Valentine',
								'halloween' => 'Halloween',
								'garden' => 'Garden',
								'forest' => 'Forest',
								'aqua' => 'Aqua',
								'lofi' => 'Lo-Fi',
								'pastel' => 'Pastel',
								'fantasy' => 'Fantasy',
								'wireframe' => 'Wireframe',
								'black' => 'Black',
								'luxury' => 'Luxury',
								'dracula' => 'Dracula',
								'cmyk' => 'CMYK',
								'autumn' => 'Autumn',
								'business' => 'Business',
								'acid' => 'Acid',
								'lemonade' => 'Lemonade',
								'night' => 'Night',
								'coffee' => 'Coffee',
								'winter' => 'Winter',
								'dim' => 'Dim',
								'nord' => 'Nord',
								'sunset' => 'Sunset'
							);
							$current_theme = get_theme_mod('tw_theme_style', 'winter');
							
							foreach ($themes as $value => $label) :
								$is_active = ($value === $current_theme) ? ' bg-primary text-primary-content' : ' bg-base-200 hover:bg-base-300';
							?>
								<button class="btn btn-sm justify-start normal-case theme-item<?php echo $is_active; ?>" data-theme="<?php echo esc_attr($value); ?>">
									<?php echo esc_html($label); ?>
									<?php if ($value === $current_theme) : ?>
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-auto">
											<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
										</svg>
									<?php endif; ?>
								</button>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
