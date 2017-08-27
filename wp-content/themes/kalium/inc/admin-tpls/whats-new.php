<?php
/**
 *	Whats New
 *	
 *	Laborator.co
 *	www.laborator.co 
 */
$version = kalium()->getVersion();
?>
<div class="kalium-whats-new">
	
	<?php if ( kalium()->get( 'welcome', true ) ) : ?>
	<div class="kalium-activated">
		<h3>
			Thanks for choosing Kalium theme!
			<br>
			<small>Here are the first steps to setup the theme:</small>
		</h3>
		
		<ol>
			<li>Install and activate required plugins by <a href="<?php echo admin_url('themes.php?page=kalium-install-plugins' ); ?>" target="_blank">clicking here</a></li>
			<?php if ( ! kalium()->theme_license->isValid() ) : ?>
			<li>Activate the theme on <a href="<?php echo admin_url( 'admin.php?page=kalium-product-registration' ); ?>" target="_blank">Product Registration</a> tab</li>
			<?php endif; ?>
			<li>Install demo content via <a href="<?php echo admin_url( 'admin.php?page=laborator-demo-content-installer' ); ?>" target="_blank">One-Click Demo Content</a> installer (requires <a href="http://documentation.laborator.co/kb/kalium/activating-the-theme/" target="_blank">theme activation</a>)</li>
			<li>Configure <a href="<?php echo admin_url( 'admin.php?page=laborator_options' ); ?>" target="_blank">theme options</a> (optional)</li>
			<li>Refer to our <a href="<?php echo admin_url( 'admin.php?page=laborator-docs' ); ?>">theme documentation</a> and learn how to setup Kalium (recommended)</li>
		</ol>
	</div>
	<?php endif; ?>
	
	<div class="kalium-version">
		<div class="kalium-version-gradient">
			<span class="numbers-<?php echo strlen( str_replace( '.', '', $version ) ); ?>"><?php echo $version; ?></span>
		</div>
		
		<div class="kalium-version-info">
			<h2>Kalium 2: What’s New!</h2>
			<p>
				Kalium Two comes with tons of new features, improvements and bug fixes.<br>
				It is faster, richer in options, plugin compatibilities and more intuitive than ever before.
			</p>
		</div>
	</div>
	
	<div class="feature-section two-col">
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/blog-structure.jpg' ); ?>">
			<h3>Blog refactoring</h3>
			<p>
				Blog section has been totally refactored with new code structure but keeping the same functionality. It works faster, has smaller CSS size, new/better template files and customize hooks.
				<br>
				<a href="http://documentation.laborator.co/kb/kalium/kalium-v2-1-release-notes/#new-blog-structure" target="_blank">Read update notes &raquo;</a>
			</p>
		</div>
		<div class="col">
			<a href="https://demo.kaliumtheme.com/travel" target="_blank"><img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/travel-demo.jpg' ); ?>"></a>
			<h3>Travel demo</h3>
			<p>
				Are you ready for Summer? In this update we bring you the Travel demo site. New professional demo for Travel agencies that want to showcase their services in the best way possible.
				<br>
				<a href="https://demo.kaliumtheme.com/travel" target="_blank">Click to preview &raquo;</a>
			</p>
		</div>
	</div>
	
	
	<div class="whats-new-secondary feature-section three-col">
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/better-performance.jpg' ); ?>">
			<h3>Better performace</h3>
			<p>Kalium works faster than ever before, the average execution time is lower than ~0.2 seconds depending the type of website.</p>
		</div>
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/security-fixes.jpg' ); ?>">
			<h3>Security fixes</h3>
			<p>Two important security fixes were added in this version (2.1). Special thanks to <a href="https://wphutte.com" target="_blank">WPHutte</a> for reporting these issues.</p>
		</div>
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/sidebar-styles.jpg' ); ?>">
			<h3>New sidebar styles</h3>
			<p>Two new sidebar styles are added: bordered widgets and background filled widgets. Manage sidebar style on Theme Options &raquo; Other Settings.</p>
		</div>
	</div>
	
	
	<div class="whats-new-secondary feature-section three-col">
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/php7-compatible.jpg' ); ?>">
			<h3>PHP 7 compatibility</h3>
			<p>
				Kalium is now friendly with PHP version 7 and 7.1. 
				<?php if ( ! function_exists( 'phpversion' ) || version_compare( phpversion(), '7.0', '<' ) ) : ?>
				We recommend you to switch to PHP 7 and see the magic.
				<?php else : ?>
				Its made to work with your hosting environment.
				<?php endif; ?>
			</p>
		</div>
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/finnish-translation.jpg' ); ?>">
			<h3>Finnish translation</h3>
			<p>
				New front-end translation in Finnish language is now available for Kalium. Thanks to <abbr title="A happy customer that uses Kalium">Okko Alitalo</abbr> for contributing this translation.
			</p>
		</div>
		<div class="col">
			<img src="<?php echo kalium()->assetsUrl( 'images/admin/whats-new/custom-sidebars.jpg' ); ?>">
			<h3>Custom sidebars</h3>
			<p>Full compatibility with Custom Sidebars plugin. Widgets sections won't disappear even if you disable the plugin.</p>
		</div>
	</div>
	
	<a href="http://documentation.laborator.co/kb/kalium/kalium-changelog/" target="_blank" class="view-changelog">See full changelog &#65515;</a>
	
</div>