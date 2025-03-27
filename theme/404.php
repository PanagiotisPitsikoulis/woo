<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _tw
 */

get_header();
?>

<div class="min-h-screen bg-base-100">
	<div class="container mx-auto py-16 px-4">
		<div class="max-w-md mx-auto text-center">
			<h1 class="text-5xl font-bold mb-6"><?php esc_html_e('404', 'tw'); ?></h1>
			<p class="text-2xl font-semibold mb-4"><?php esc_html_e('Page Not Found', 'tw'); ?></p>
			<div class="mb-8">
				<p class="mb-4"><?php esc_html_e('This page could not be found. It might have been removed or renamed, or it may never have existed.', 'tw'); ?></p>
			</div>
			<div class="flex flex-col md:flex-row justify-center gap-4">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn">
					<?php esc_html_e('Back to Homepage', 'tw'); ?>
				</a>
				<div class="divider divider-horizontal hidden md:flex">OR</div>
				<div class="divider md:hidden">OR</div>
				<div class="form-control w-full max-w-xs mx-auto">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
