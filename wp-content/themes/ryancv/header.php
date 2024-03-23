<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until content block
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ryancv
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php
	$theme_ui = get_field( 'theme_ui', 'options' );
	$theme_ui_class = '';
	if ($theme_ui == 1) {
		$theme_ui_class = 'body-style-dark';
	}
?>

<body <?php body_class($theme_ui_class); ?>>
	<?php wp_body_open(); ?>

	<?php
		$sidebar_disable = get_field( 'sidebar_disable', 'options' );
		$switcher_ui = get_field( 'switcher_ui', 'options' );
		$cart_disable = get_field( 'cart_disable', 'options' );
		$layout_type = get_field( 'layout_type', 'options' );
		$onepage = get_field( 'onepage', 'options' );
		$simple_vcard = get_field( 'simple_vcard', 'options' );
		$mobile_vcard = get_field( 'mobile_vcard', 'options' );
		$sticky_menu = get_field( 'sticky_menu', 'options' );
		$theme_bg = get_field( 'theme_bg', 'options' );
		$animation = get_field( 'theme_animation', 'options' );
		$animation_in = 'fadeInLeft';
		$animation_out = 'fadeOutLeft';
		$theme_type = get_field( 'theme_type', 'options' );
		$theme_style = get_field( 'theme_style', 'options' );
		$theme_ui = get_field( 'theme_ui', 'options' );
		$menu_style = get_field( 'menu_type', 'options' );
		$icons_style = get_field( 'icons_type', 'options' );
		$preloader_hide = get_field( 'preloader_hide', 'options' );
		$preloader_type = get_field( 'preloader_type', 'options' );
		$preloader_bgcolor = get_field( 'preloader_bgcolor', 'options' );

		$theme_type_size = get_field( 'theme_type_size', 'options' );
		$vcard_layout = get_field( 'vcard_layout', 'options' );
		$vcard_bts_glitch = get_field( 'vcard_bts_glitch', 'options' );

		switch ( $animation ) {
			case 0 :
				$animation_in = 'fadeInLeft';
				$animation_out = 'fadeOutLeft';
				break;
			case 1 :
				$animation_in = 'rotateInUpLeft';
				$animation_out = 'rotateOutUpLeft';
				break;
			case 2 :
				$animation_in = 'rollIn';
				$animation_out = 'rollOut';
				break;
			case 3 :
				$animation_in = 'jackInTheBox';
				$animation_out = 'jackOutTheBox';
				break;
			case 4 :
				$animation_in = 'fadeIn';
				$animation_out = 'fadeOut';
				break;
			case 5 :
				$animation_in = 'fadeInUp';
				$animation_out = 'fadeOutUp';
				break;
		}
	?>

	<div class="page page_wrap<?php if ( $simple_vcard ) : ?> simplecard-wrap-enabled<?php endif; ?><?php if ( $theme_style == 1 ) : ?> theme-style-classic<?php endif; ?><?php if ( $theme_style == 2 ) : ?> theme-style-textured<?php endif; ?><?php if ( $theme_type ) : ?> theme-style-blured<?php endif; ?><?php if ( $theme_type == 2 ) : ?> theme-style-blured theme-style-cyber<?php endif; ?><?php if ( $theme_ui ) : ?> theme-style-dark<?php endif; ?><?php if ( ! $switcher_ui ) : ?> switcher-ui-disabled<?php endif; ?>">

		<!-- Preloader -->
		<div class="preloader<?php if ( $preloader_hide == 1 ) : ?> is-disabled<?php endif; ?>"<?php if ( $preloader_bgcolor ) : ?> style="background-color: <?php echo esc_attr( $preloader_bgcolor ); ?>;"<?php endif; ?>>
			<div class="centrize full-width">
				<div class="vertical-center">
					<div class="spinner <?php if ( $preloader_type == 1 || !$preloader_type ) : ?>default-circle<?php endif; ?><?php echo esc_attr($preloader_type ); ?>"></div>
				</div>
			</div>
		</div>

		<!-- background -->
		<?php if ( !empty( $theme_bg ) ) : ?>
		<?php if ( $theme_bg['type'] == 1 || $theme_bg['type'] == 2 || $theme_bg['type'] == 3 ) : ?>
		<div class="background <?php if ( $theme_bg['type'] == 2 ) : ?>gradient<?php endif; ?>">
			<?php if ( $theme_bg['type'] == 2 ) : ?>
			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<?php endif; ?>
		</div>
		<?php else : ?>
			<?php if ( class_exists( 'RyanCVAdvancedBackground' ) ) : echo do_shortcode( '[ryancv-advanced-background-html]' ); endif; ?>
		<?php endif; ?>
		<?php endif; ?>

		<!--
			Container
		-->
		<div class="container opened<?php if ( $simple_vcard ) : ?> simplecard-enabled<?php endif; ?><?php if ( $mobile_vcard ) : ?> hide-mobile-vcard<?php endif; ?><?php if ( $sidebar_disable ) : ?> disable-sidebar<?php endif; ?><?php if ( ! $sticky_menu ) : ?> no-sticky-menu<?php endif; ?><?php if ( $layout_type == 1 ) : ?> layout-rounded-style<?php endif; ?><?php if ( $layout_type == 2 ) : ?> layout-boxed-style<?php endif; ?><?php if ( $icons_style == 1 ) : ?> solid-icons-style<?php endif; ?><?php if ( $icons_style == 4 ) : ?> solid-icons-style cyber-icons-style<?php endif; ?><?php if ( $icons_style == 5 ) : ?> solid-icons-style textured-icons-style<?php endif; ?><?php if ( $icons_style == 2 ) : ?> border-icons-style<?php endif; ?><?php if ( $icons_style == 3 ) : ?> minimal-icons-style<?php endif; ?><?php if ( $vcard_layout == 1 ) : ?> layout-futurism-style<?php endif; ?><?php if ( $theme_type_size == 1 ) : ?> layout-fully-style<?php endif; ?><?php if ( $vcard_bts_glitch == 1 ) : ?> cyber-glitch-lnk<?php endif; ?>" data-animation-in="<?php echo esc_attr( $animation_in ); ?>" data-animation-out="<?php echo esc_attr( $animation_out ); ?>">
			<?php
				$vcard_bg = get_field( 'vcard_bg', 'options' );
				$vcard_bg_type = get_field( 'vcard_bg_type', 'options' );
				$vcard_img_layout = get_field( 'vcard_img_layout', 'options' );
				$vcard_bg_video = get_field( 'vcard_bg_video', 'options' );
				$vcard_bg_images = get_field( 'vcard_bg_images', 'options' );
				$vcard_photo = get_field( 'vcard_photo', 'options' );
				$vcard_title = get_field( 'vcard_title', 'options' );
				if ( empty( $vcard_title ) ) {
					$vcard_title = get_bloginfo( 'name' );
				}
				$vcard_subtitle = get_field( 'vcard_subtitle', 'options' );
				if ( empty( $vcard_subtitle ) ) {
					$vcard_subtitle = get_bloginfo( 'description' );
				}
				$vcard_subtitle_type = get_field( 'vcard_subtitle_type', 'options' );
				$vcard_subtitles = get_field( 'vcard_subtitles', 'options' );
				$vcard_subtitle_glitch = get_field( 'vcard_subtitle_glitch', 'options' );
				$vcard_social = get_field( 'vcard_social', 'options' );
				$vcard_bts = get_field( 'vcard_bts', 'options' );
				$vcard_bts_style = get_field( 'vcard_bts_style', 'options' );
			?>

			<!--
				Header
			-->
			<header class="header">

				<!-- header profile -->
				<div class="profile">
					<?php if ( $vcard_photo ) : ?>
					<div class="image">
						<a href="<?php echo esc_url( home_url() ); ?>">
							<img src="<?php echo esc_url( $vcard_photo['sizes']['ryancv_140x140'] ); ?>" alt="<?php echo esc_attr( $vcard_title ); ?>" /></a>
						</a>
					</div>
					<?php endif; ?>

					<?php if ( $vcard_title ) : ?>
					<div class="title"><?php echo esc_html( $vcard_title ); ?></div>
					<?php endif; ?>

					<?php if ( $vcard_subtitle ||  $vcard_subtitles) : ?>
						<?php if( $vcard_subtitle_type == 2 ) : ?>
							<div class="subtitle subtitle-typed">
								<div class="typing-title">
									<?php foreach( $vcard_subtitles as $item ) { ?>
										<p><?php echo esc_html( $item['text'] ); ?></p>
									<?php } ?>
								</div>
								<span class="r-typed"></span>
							</div>
						<?php else : ?>
							<div class="subtitle">
								<?php echo esc_html( $vcard_subtitle ); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				
				<?php if ( ! $sidebar_disable ) : ?>
				<!-- menu btn -->
				<a href="#" class="menu-btn<?php if ( $switcher_ui || ( !$cart_disable && class_exists( 'WooCommerce' ) ) ) : ?> btn-next-visible<?php endif; ?>"><span></span></a>
				<?php endif; ?>
				
				<?php if ( $switcher_ui ) : ?>
				<!-- switch btn -->
				<div class="mode-switch-btn<?php if ( !$cart_disable && class_exists( 'WooCommerce' ) ) : ?> btn-next-visible<?php endif; ?>" data-ui="<?php echo esc_attr( $theme_ui ); ?>"  data-ui-dir="<?php echo esc_attr( get_template_directory_uri() ); ?>">
					<input class="tgl" id="mode-switch-radio" type="checkbox"<?php if ( $theme_ui == 1 ) : ?> checked<?php endif; ?>>
					<label class="mode-swich-label" for="mode-switch-radio">
						<span class="sw-before">
							<svg xmlns="http://www.w3.org/2000/svg" width="22.22" height="22.313" viewbox="0 0 22.22 22.313">
								<path id="Light_Theme" data-name="Light Theme" fill="#fff" d="M1752.49,105.511a5.589,5.589,0,0,0-3.94-1.655,5.466,5.466,0,0,0-3.94,1.655,5.61,5.61,0,0,0,3.94,9.566,5.473,5.473,0,0,0,3.94-1.653,5.643,5.643,0,0,0,1.65-3.957A5.516,5.516,0,0,0,1752.49,105.511Zm-1.06,6.85a4.1,4.1,0,0,1-5.76,0,4.164,4.164,0,0,1,0-5.788A4.083,4.083,0,0,1,1751.43,112.361Zm7.47-3.662h-2.27a0.768,0.768,0,0,0,0,1.536h2.27A0.768,0.768,0,0,0,1758.9,108.7Zm-10.35,8.12a0.777,0.777,0,0,0-.76.769v2.274a0.777,0.777,0,0,0,.76.767,0.786,0.786,0,0,0,.77-0.767v-2.274A0.786,0.786,0,0,0,1748.55,116.819Zm7.85-.531-1.62-1.624a0.745,0.745,0,0,0-1.06,0,0.758,0.758,0,0,0,0,1.063l1.62,1.625a0.747,0.747,0,0,0,1.06,0A0.759,0.759,0,0,0,1756.4,116.288ZM1748.55,98.3a0.777,0.777,0,0,0-.76.768v2.273a0.778,0.778,0,0,0,.76.768,0.787,0.787,0,0,0,.77-0.768V99.073A0.786,0.786,0,0,0,1748.55,98.3Zm7.88,3.278a0.744,0.744,0,0,0-1.06,0l-1.62,1.624a0.758,0.758,0,0,0,0,1.063,0.745,0.745,0,0,0,1.06,0l1.62-1.624A0.758,0.758,0,0,0,1756.43,101.583Zm-15.96,7.116h-2.26a0.78,0.78,0,0,0-.77.768,0.76,0.76,0,0,0,.77.768h2.26A0.768,0.768,0,0,0,1740.47,108.7Zm2.88,5.965a0.745,0.745,0,0,0-1.06,0l-1.62,1.624a0.759,0.759,0,0,0,0,1.064,0.747,0.747,0,0,0,1.06,0l1.62-1.625A0.758,0.758,0,0,0,1743.35,114.664Zm0-11.457-1.62-1.624a0.744,0.744,0,0,0-1.06,0,0.758,0.758,0,0,0,0,1.063l1.62,1.624a0.745,0.745,0,0,0,1.06,0A0.758,0.758,0,0,0,1743.35,103.207Z" transform="translate(-1737.44 -98.313)"></path>
							</svg>
						</span>
						<span class="sw-after">
							<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewbox="0 0 23 23">
								<path id="Dark_Theme" data-name="Dark Theme" fill="#fff" d="M1759.46,111.076a0.819,0.819,0,0,0-.68.147,8.553,8.553,0,0,1-2.62,1.537,8.167,8.167,0,0,1-2.96.531,8.655,8.655,0,0,1-8.65-8.682,9.247,9.247,0,0,1,.47-2.864,8.038,8.038,0,0,1,1.42-2.54,0.764,0.764,0,0,0-.12-1.063,0.813,0.813,0,0,0-.68-0.148,11.856,11.856,0,0,0-6.23,4.193,11.724,11.724,0,0,0,1,15.387,11.63,11.63,0,0,0,19.55-5.553A0.707,0.707,0,0,0,1759.46,111.076Zm-4.5,6.172a10.137,10.137,0,0,1-14.29-14.145,10.245,10.245,0,0,1,3.38-2.836c-0.14.327-.29,0.651-0.41,1.006a9.908,9.908,0,0,0-.56,3.365,10.162,10.162,0,0,0,10.15,10.189,9.776,9.776,0,0,0,3.49-.62,11.659,11.659,0,0,0,1.12-.473A10.858,10.858,0,0,1,1754.96,117.248Z" transform="translate(-1737 -98)"></path>
							</svg>
						</span>
					</label>
				</div>
				<?php endif; ?>

				<?php if ( ! $cart_disable ) : ?>
				<!-- Woocommerce cart -->
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<?php if ( true == get_theme_mod( 'cart_shop', true ) ) : ?>
						<div class="cart-btn">
							<div class="cart-icon">
								<span class="ion ion-android-cart"></span>
								<span class="cart-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'ryancv' ), WC()->cart->get_cart_contents_count() ); ?></span>
							</div>
							<div class="cart-widget">
								<?php woocommerce_mini_cart(); ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>

				<?php if ( $sticky_menu ) : ?>
				<!-- menu -->
				<?php if ( $onepage ) : ?>
					<div class="top-menu top-menu-onepage<?php if ( $menu_style == 1 ) : ?> menu-minimal<?php endif; ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'walker' => new Ryancv_Onepage_Walker()
							) );
						?>
					</div>
				<?php else : ?>
					<div class="top-menu<?php if ( $menu_style == 1 ) : ?> menu-minimal<?php endif; ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary'
							) );
						?>
					</div>
				<?php endif; ?>
				<?php endif; ?>

			</header>

			<!--
				Card - Started
			-->
			<div class="card-started<?php if ( $vcard_img_layout == 7 ) : ?> full-style-cyber<?php endif; ?><?php if ( $vcard_img_layout == 8 ) : ?> full-style-textured<?php endif; ?>" id="home-card">

				<!--
					Profile
				-->
				<div class="profile<?php if ( ! $vcard_photo ) : ?> no-photo<?php endif; ?><?php if ( $vcard_img_layout == 1 ) : ?> boxed-style<?php endif; ?><?php if ( $vcard_img_layout == 2 ) : ?> rounded-style-1<?php endif; ?><?php if ( $vcard_img_layout == 3 ) : ?> rounded-style-2<?php endif; ?><?php if ( $vcard_img_layout == 4 ) : ?> rabbet-style<?php endif; ?><?php if ( $vcard_img_layout == 5 ) : ?> trapezoid-style<?php endif; ?><?php if ( $vcard_img_layout == 6 || $vcard_img_layout == 7 || $vcard_img_layout == 8 ) : ?> full-style<?php endif; ?>">
					<div class="profile-content">

						<?php if ( $vcard_bg_type == 0 || !$vcard_bg_type ) : ?>
						<!-- profile image -->
						<div class="slide"
							<?php if ( $vcard_bg ) : ?>style="background-image: url(<?php echo esc_url( $vcard_bg['url'] ); ?>);"<?php endif; ?>
						>
							<?php if ( $vcard_img_layout == 8 ) : ?>
							<svg class="rprof-before" xmlns="http://www.w3.org/2000/svg" width="1804px" height="364px" viewBox="0 0 1800 560" y="0" x="0">
								<path fill-rule="evenodd"  fill="rgb(200, 243, 132)" d="M-0.000,350.539 L9.458,348.563 L16.086,350.750 L23.185,350.018 L30.230,349.734 L36.882,351.741 L43.517,353.816 L50.833,351.882 L56.676,358.747 L64.031,356.379 L70.742,358.040 L77.740,357.587 L84.242,361.216 L90.990,363.296 L98.212,359.310 L104.949,361.819 L111.843,362.783 L118.333,364.000 L124.897,361.289 L131.439,362.813 L138.064,362.833 L144.184,359.692 L149.787,355.430 L158.880,360.563 L166.168,356.166 L174.233,356.656 L180.368,351.519 L187.481,352.114 L194.011,349.370 L200.661,347.318 L207.816,348.012 L214.695,346.563 L221.816,346.758 L228.832,348.941 L235.813,344.611 L242.899,348.781 L249.950,349.209 L256.822,345.126 L263.954,347.393 L270.770,343.781 L278.127,348.545 L284.675,342.117 L292.043,345.944 L298.641,341.255 L305.863,342.935 L313.229,345.452 L319.683,340.358 L327.056,342.533 L333.916,340.812 L340.981,340.484 L348.123,340.555 L354.043,333.396 L361.695,336.400 L367.774,330.704 L374.917,330.768 L381.890,329.887 L388.415,326.863 L395.399,326.034 L402.817,327.027 L410.360,328.363 L417.089,326.224 L423.999,324.811 L429.401,317.623 L436.183,315.860 L443.369,315.559 L450.270,314.167 L457.835,315.025 L464.183,311.865 L470.856,312.438 L476.937,309.913 L482.832,306.436 L488.886,303.146 L496.660,300.704 L504.811,302.142 L513.157,305.588 L519.279,298.365 L526.641,302.615 L533.064,297.912 L539.868,296.817 L546.745,296.449 L553.785,298.007 L560.941,301.280 L567.262,294.012 L574.451,298.233 L581.418,299.839 L587.930,293.497 L594.940,296.103 L601.803,296.039 L608.647,295.365 L615.546,297.316 L622.382,296.660 L629.233,295.103 L636.050,298.464 L642.933,296.247 L649.759,297.012 L656.817,292.838 L663.349,298.995 L670.638,293.098 L677.329,293.675 L683.437,295.626 L689.574,293.676 L695.895,294.788 L702.374,297.469 L708.171,291.881 L714.363,291.293 L720.525,290.465 L726.743,290.224 L734.344,294.174 L740.921,288.414 L748.260,291.044 L755.331,290.142 L762.414,289.061 L769.571,290.544 L776.692,292.485 L783.782,288.715 L790.860,293.139 L798.022,288.669 L804.174,293.651 L810.420,293.174 L816.653,293.834 L822.905,292.917 L829.836,288.991 L836.639,292.303 L843.443,287.228 L850.231,287.114 L857.197,291.522 L864.081,291.965 L870.901,291.115 L877.455,286.804 L884.735,292.078 L891.365,289.199 L898.179,288.509 L904.711,285.319 L911.283,282.745 L918.518,285.666 L924.982,282.349 L931.733,281.326 L938.789,282.437 L945.179,278.894 L952.089,278.934 L959.512,282.184 L966.122,280.191 L972.845,278.916 L979.464,277.038 L986.469,277.546 L992.393,271.348 L999.383,271.721 L1006.200,271.061 L1012.631,267.939 L1020.040,270.971 L1026.762,269.706 L1033.124,266.016 L1039.865,264.821 L1046.888,265.555 L1053.555,263.834 L1060.381,263.179 L1067.804,261.297 L1075.287,260.065 L1082.983,260.959 L1090.650,258.212 L1098.786,261.559 L1105.457,257.770 L1113.397,260.134 L1120.467,258.414 L1126.739,253.732 L1133.311,250.027 L1141.176,252.153 L1148.504,253.202 L1155.425,252.668 L1161.809,249.474 L1168.748,247.314 L1174.085,253.542 L1181.178,253.157 L1187.248,256.766 L1194.939,253.142 L1201.394,254.867 L1207.435,259.195 L1214.496,257.425 L1220.542,263.031 L1227.162,265.076 L1234.053,264.292 L1240.959,262.615 L1247.644,266.067 L1254.377,260.749 L1260.615,262.626 L1266.192,258.588 L1273.178,263.522 L1278.139,256.612 L1285.796,254.052 L1294.657,256.759 L1302.408,254.306 L1307.895,248.951 L1314.684,247.290 L1321.829,246.674 L1329.200,246.796 L1334.758,241.563 L1341.077,238.522 L1348.805,239.893 L1354.550,234.994 L1360.864,231.840 L1367.427,229.426 L1374.455,228.705 L1380.854,225.634 L1388.512,227.624 L1395.704,228.023 L1401.487,221.967 L1409.258,225.504 L1415.464,221.018 L1421.951,217.522 L1429.285,219.646 L1435.434,218.004 L1441.899,219.184 L1448.025,216.949 L1454.855,216.692 L1461.564,214.927 L1468.757,218.930 L1475.381,216.208 L1481.723,210.879 L1488.845,213.470 L1495.685,213.217 L1502.145,209.558 L1508.929,208.836 L1516.055,210.902 L1522.769,209.523 L1529.200,206.009 L1536.317,207.806 L1543.496,209.897 L1550.284,209.061 L1556.500,204.105 L1562.894,200.518 L1570.236,203.603 L1577.011,202.689 L1584.067,203.696 L1590.484,200.314 L1597.052,197.977 L1603.878,197.420 L1610.338,194.266 L1618.000,199.564 L1624.432,196.283 L1630.816,192.649 L1637.891,193.981 L1644.745,193.663 L1652.473,188.945 L1661.705,192.355 L1667.328,186.211 L1674.892,189.106 L1680.205,182.268 L1687.750,184.598 L1692.984,178.172 L1700.294,181.488 L1705.306,176.941 L1711.409,175.955 L1717.699,175.195 L1722.374,168.528 L1729.895,169.049 L1736.562,167.611 L1743.787,168.845 L1750.214,166.831 L1756.579,163.923 L1763.166,161.841 L1769.804,159.853 L1776.400,157.225 L1783.808,162.836 L1790.376,159.931 L1797.287,160.454 L1804.000,158.218 L1804.000,0.000 L-0.000,0.000 L-0.000,350.539 Z"/>
							</svg>
							<svg class="rprof-after" xmlns="http://www.w3.org/2000/svg" width="1867px" height="419px" viewBox="0 0 1800 210">
								<filter id="noiset" x="0" y="0">
									<feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/>
									<feComposite operator="in" in="ripples" in2="SourceGraphic"/>
								</filter>
								<path fill-rule="evenodd" fill="rgb(200, 243, 132)" d="M1861.000,26.692 L1851.338,28.706 L1844.567,26.477 L1837.313,27.224 L1830.117,27.513 L1823.321,25.468 L1816.542,23.353 L1809.069,25.324 L1803.099,18.328 L1795.584,20.741 L1788.728,19.048 L1781.580,19.510 L1774.937,15.811 L1768.043,13.692 L1760.664,17.754 L1753.782,15.197 L1746.739,14.215 L1740.108,12.974 L1733.404,15.737 L1726.719,14.184 L1719.952,14.164 L1713.699,17.364 L1707.975,21.708 L1698.685,16.477 L1691.240,20.958 L1683.001,20.459 L1676.732,25.694 L1669.466,25.088 L1662.795,27.884 L1656.001,29.976 L1648.692,29.267 L1641.664,30.745 L1634.389,30.545 L1627.221,28.321 L1620.089,32.733 L1612.850,28.484 L1605.646,28.048 L1598.626,32.209 L1591.340,29.899 L1584.376,33.579 L1576.860,28.725 L1570.171,35.275 L1562.644,31.375 L1555.903,36.153 L1548.525,34.442 L1540.999,31.876 L1534.406,37.068 L1526.874,34.851 L1519.865,36.605 L1512.648,36.939 L1505.351,36.867 L1499.303,44.163 L1491.486,41.101 L1485.275,46.906 L1477.978,46.841 L1470.854,47.738 L1464.189,50.820 L1457.053,51.665 L1449.475,50.653 L1441.769,49.291 L1434.894,51.472 L1427.835,52.912 L1422.316,60.237 L1415.388,62.033 L1408.046,62.340 L1400.996,63.759 L1393.267,62.884 L1386.783,66.105 L1379.965,65.521 L1373.752,68.094 L1367.730,71.637 L1361.545,74.990 L1353.603,77.479 L1345.276,76.014 L1336.749,72.501 L1330.494,79.862 L1322.973,75.531 L1316.411,80.324 L1309.461,81.441 L1302.435,81.815 L1295.244,80.227 L1287.933,76.891 L1281.475,84.299 L1274.131,79.997 L1267.013,78.360 L1260.360,84.823 L1253.199,82.168 L1246.187,82.233 L1239.195,82.920 L1232.147,80.932 L1225.163,81.600 L1218.164,83.187 L1211.200,79.762 L1204.167,82.021 L1197.194,81.241 L1189.984,85.495 L1183.310,79.220 L1175.863,85.230 L1169.028,84.642 L1162.789,82.654 L1156.518,84.641 L1150.060,83.508 L1143.442,80.776 L1137.519,86.470 L1131.194,87.070 L1124.898,87.913 L1118.546,88.158 L1110.780,84.133 L1104.061,90.004 L1096.564,87.323 L1089.340,88.242 L1082.103,89.344 L1074.792,87.833 L1067.517,85.854 L1060.274,89.697 L1053.043,85.188 L1045.726,89.743 L1039.441,84.666 L1033.060,85.152 L1026.692,84.480 L1020.305,85.415 L1013.224,89.416 L1006.274,86.040 L999.323,91.212 L992.388,91.328 L985.272,86.836 L978.239,86.385 L971.271,87.251 L964.576,91.644 L957.138,86.270 L950.365,89.204 L943.403,89.907 L936.731,93.158 L930.016,95.781 L922.625,92.804 L916.021,96.184 L909.124,97.227 L901.915,96.094 L895.388,99.705 L888.328,99.664 L880.745,96.352 L873.992,98.384 L867.124,99.682 L860.361,101.596 L853.205,101.079 L847.153,107.395 L840.012,107.015 L833.048,107.688 L826.477,110.869 L818.908,107.779 L812.040,109.069 L805.542,112.829 L798.655,114.047 L791.479,113.299 L784.669,115.052 L777.695,115.720 L770.112,117.639 L762.466,118.894 L754.605,117.983 L746.772,120.782 L738.459,117.371 L731.644,121.233 L723.533,118.823 L716.310,120.576 L709.903,125.348 L703.188,129.123 L695.154,126.957 L687.667,125.888 L680.597,126.431 L674.074,129.687 L666.986,131.888 L661.533,125.541 L654.286,125.933 L648.085,122.255 L640.229,125.949 L633.634,124.191 L627.462,119.781 L620.248,121.584 L614.071,115.871 L607.309,113.787 L600.268,114.586 L593.213,116.295 L586.383,112.777 L579.506,118.197 L573.132,116.284 L567.435,120.399 L560.298,115.370 L555.230,122.412 L547.407,125.021 L538.355,122.262 L530.436,124.762 L524.830,130.220 L517.895,131.913 L510.595,132.541 L503.064,132.416 L497.386,137.749 L490.931,140.847 L483.036,139.450 L477.166,144.443 L470.716,147.658 L464.011,150.118 L456.831,150.852 L450.294,153.982 L442.471,151.954 L435.123,151.547 L429.215,157.719 L421.276,154.114 L414.936,158.686 L408.308,162.249 L400.816,160.084 L394.534,161.758 L387.929,160.555 L381.671,162.832 L374.692,163.095 L367.839,164.894 L360.491,160.814 L353.724,163.588 L347.244,169.018 L339.968,166.378 L332.980,166.636 L326.381,170.365 L319.450,171.100 L312.170,168.996 L305.311,170.401 L298.741,173.982 L291.470,172.150 L284.136,170.019 L277.201,170.871 L270.851,175.922 L264.319,179.578 L256.817,176.433 L249.896,177.365 L242.688,176.338 L236.132,179.785 L229.422,182.167 L222.448,182.735 L215.849,185.949 L208.021,180.550 L201.451,183.893 L194.928,187.596 L187.700,186.239 L180.698,186.563 L172.803,191.371 L163.371,187.896 L157.626,194.158 L149.899,191.207 L144.471,198.176 L136.763,195.801 L131.417,202.349 L123.948,198.970 L118.827,203.605 L112.593,204.609 L106.167,205.383 L101.391,212.178 L93.707,211.647 L86.896,213.113 L79.515,211.855 L72.949,213.907 L66.446,216.871 L59.717,218.993 L52.936,221.019 L46.197,223.697 L38.628,217.979 L31.919,220.939 L24.858,220.407 L18.000,222.685 L18.000,383.923 L1861.000,383.923 L1861.000,26.692 Z"/>
								<path fill-rule="evenodd" fill="rgb(19, 19, 22)" d="M0.000,418.1000 L1867.000,418.1000 L1867.000,0.000 L1859.622,0.883 L1853.228,6.080 L1844.149,2.900 L1838.159,8.219 L1830.608,8.164 L1823.698,10.587 L1815.988,9.370 L1808.690,9.302 L1802.276,15.023 L1794.806,13.676 L1787.556,13.473 L1780.431,12.693 L1773.601,16.095 L1766.453,15.004 L1759.387,15.070 L1752.511,17.781 L1745.656,20.797 L1738.145,14.655 L1731.345,18.441 L1724.178,17.081 L1717.431,21.715 L1710.266,20.327 L1703.332,22.396 L1696.347,23.712 L1689.175,22.126 L1682.871,22.945 L1676.572,23.879 L1669.816,23.064 L1666.120,28.979 L1659.561,25.334 L1654.331,28.918 L1649.316,34.390 L1642.875,35.119 L1638.674,40.837 L1629.839,37.256 L1624.775,45.134 L1617.085,44.090 L1611.729,50.387 L1604.962,48.601 L1598.706,45.286 L1591.146,50.216 L1583.055,47.543 L1575.244,48.849 L1567.325,48.641 L1559.373,47.956 L1552.842,54.687 L1545.575,50.753 L1538.933,55.854 L1531.869,54.870 L1525.361,54.781 L1519.005,56.889 L1512.485,56.632 L1505.828,54.391 L1499.140,51.724 L1492.117,52.402 L1484.720,52.231 L1478.196,58.784 L1472.249,60.922 L1466.707,62.919 L1461.248,65.406 L1453.430,63.840 L1445.718,65.967 L1437.527,65.745 L1430.263,68.092 L1422.655,70.829 L1414.953,73.229 L1407.142,74.929 L1399.330,72.422 L1391.762,67.644 L1384.736,73.975 L1378.371,68.453 L1371.579,72.342 L1365.030,72.749 L1358.517,72.748 L1349.875,71.096 L1341.122,67.699 L1334.134,75.164 L1326.326,70.822 L1318.710,69.228 L1311.665,75.876 L1303.984,73.361 L1296.629,73.637 L1289.318,74.600 L1281.825,72.937 L1274.518,74.053 L1267.534,75.868 L1260.503,72.322 L1253.272,74.612 L1246.005,74.300 L1239.563,79.506 L1232.132,74.251 L1225.923,81.480 L1219.001,82.060 L1211.918,80.224 L1205.008,82.100 L1198.048,80.420 L1191.173,76.654 L1183.242,80.760 L1175.856,78.733 L1167.592,80.425 L1165.684,83.704 L1159.018,84.411 L1152.660,86.887 L1146.339,85.774 L1138.638,87.452 L1131.552,88.819 L1124.643,89.958 L1117.396,90.381 L1112.950,97.239 L1105.446,94.787 L1098.580,99.978 L1091.039,95.462 L1083.887,96.573 L1076.655,96.527 L1069.532,98.098 L1061.791,102.536 L1054.108,98.725 L1045.465,103.056 L1037.878,102.923 L1031.296,98.984 L1025.186,98.976 L1019.477,99.339 L1010.864,99.966 L1002.651,94.761 L995.990,97.613 L989.147,98.114 L982.470,101.128 L975.741,103.441 L968.631,100.007 L961.955,103.000 L954.391,103.632 L946.672,102.006 L939.286,105.185 L931.639,104.608 L923.757,100.664 L916.255,102.156 L908.699,102.887 L901.761,104.024 L894.347,103.066 L889.280,110.180 L883.431,111.708 L878.146,114.588 L874.096,119.638 L865.218,118.451 L857.867,119.654 L850.287,122.680 L842.693,123.124 L835.069,121.847 L827.630,123.181 L819.866,122.992 L812.121,123.839 L804.667,124.559 L796.519,123.165 L788.477,125.564 L780.581,121.362 L774.124,124.488 L767.186,120.800 L760.550,121.071 L753.738,123.768 L746.504,124.533 L740.275,119.958 L732.768,118.434 L725.675,120.160 L720.049,125.543 L714.414,130.619 L706.407,127.542 L700.660,130.937 L694.135,129.686 L690.454,136.711 L684.596,139.774 L676.836,138.022 L669.840,140.281 L663.300,135.060 L655.191,134.638 L647.854,136.434 L641.451,137.129 L635.801,132.017 L628.294,136.943 L621.337,134.573 L614.015,138.517 L605.851,133.061 L598.802,139.827 L591.241,141.490 L583.258,137.323 L575.678,138.276 L568.083,141.755 L559.701,139.755 L552.365,136.625 L545.208,134.264 L538.532,138.190 L531.619,139.763 L523.489,136.432 L515.768,139.914 L508.077,141.806 L502.233,143.492 L495.791,144.156 L489.971,148.045 L481.876,147.112 L473.960,146.359 L466.220,151.533 L457.945,146.631 L450.477,150.380 L446.724,154.641 L440.306,154.561 L432.133,157.535 L426.045,158.098 L422.073,162.488 L415.155,165.882 L408.727,170.372 L398.838,169.614 L390.218,172.256 L382.876,177.594 L374.985,174.732 L367.284,174.830 L361.051,177.874 L354.813,177.197 L348.993,174.251 L342.983,174.831 L335.695,177.108 L328.475,174.457 L320.998,171.815 L313.802,172.226 L306.310,177.243 L299.654,181.617 L291.140,181.844 L281.154,184.111 L273.919,182.601 L267.035,185.625 L260.053,187.546 L252.935,187.601 L246.002,190.345 L238.490,184.302 L231.562,187.178 L224.662,190.430 L217.423,188.537 L210.295,188.378 L203.440,192.250 L195.996,187.488 L188.849,192.869 L181.196,188.565 L174.219,194.697 L166.260,191.670 L159.352,199.024 L149.253,196.949 L141.245,200.715 L132.110,202.293 L124.933,201.629 L118.054,206.382 L110.824,203.583 L103.589,203.380 L96.846,202.973 L92.801,205.628 L86.466,208.909 L79.712,211.084 L72.789,212.918 L65.082,215.415 L56.783,209.469 L49.101,212.346 L41.166,211.646 L33.732,214.341 L26.294,216.947 L18.296,211.546 L10.760,212.839 L3.292,215.045 L0.000,214.421 L0.000,418.1000 Z"/>
								<path fill-rule="nonzero" filter="url(#noiset)" opacity="0.2" d="M0.000,418.1000 L1867.000,418.1000 L1867.000,0.000 L1859.622,0.883 L1853.228,6.080 L1844.149,2.900 L1838.159,8.219 L1830.608,8.164 L1823.698,10.587 L1815.988,9.370 L1808.690,9.302 L1802.276,15.023 L1794.806,13.676 L1787.556,13.473 L1780.431,12.693 L1773.601,16.095 L1766.453,15.004 L1759.387,15.070 L1752.511,17.781 L1745.656,20.797 L1738.145,14.655 L1731.345,18.441 L1724.178,17.081 L1717.431,21.715 L1710.266,20.327 L1703.332,22.396 L1696.347,23.712 L1689.175,22.126 L1682.871,22.945 L1676.572,23.879 L1669.816,23.064 L1666.120,28.979 L1659.561,25.334 L1654.331,28.918 L1649.316,34.390 L1642.875,35.119 L1638.674,40.837 L1629.839,37.256 L1624.775,45.134 L1617.085,44.090 L1611.729,50.387 L1604.962,48.601 L1598.706,45.286 L1591.146,50.216 L1583.055,47.543 L1575.244,48.849 L1567.325,48.641 L1559.373,47.956 L1552.842,54.687 L1545.575,50.753 L1538.933,55.854 L1531.869,54.870 L1525.361,54.781 L1519.005,56.889 L1512.485,56.632 L1505.828,54.391 L1499.140,51.724 L1492.117,52.402 L1484.720,52.231 L1478.196,58.784 L1472.249,60.922 L1466.707,62.919 L1461.248,65.406 L1453.430,63.840 L1445.718,65.967 L1437.527,65.745 L1430.263,68.092 L1422.655,70.829 L1414.953,73.229 L1407.142,74.929 L1399.330,72.422 L1391.762,67.644 L1384.736,73.975 L1378.371,68.453 L1371.579,72.342 L1365.030,72.749 L1358.517,72.748 L1349.875,71.096 L1341.122,67.699 L1334.134,75.164 L1326.326,70.822 L1318.710,69.228 L1311.665,75.876 L1303.984,73.361 L1296.629,73.637 L1289.318,74.600 L1281.825,72.937 L1274.518,74.053 L1267.534,75.868 L1260.503,72.322 L1253.272,74.612 L1246.005,74.300 L1239.563,79.506 L1232.132,74.251 L1225.923,81.480 L1219.001,82.060 L1211.918,80.224 L1205.008,82.100 L1198.048,80.420 L1191.173,76.654 L1183.242,80.760 L1175.856,78.733 L1167.592,80.425 L1165.684,83.704 L1159.018,84.411 L1152.660,86.887 L1146.339,85.774 L1138.638,87.452 L1131.552,88.819 L1124.643,89.958 L1117.396,90.381 L1112.950,97.239 L1105.446,94.787 L1098.580,99.978 L1091.039,95.462 L1083.887,96.573 L1076.655,96.527 L1069.532,98.098 L1061.791,102.536 L1054.108,98.725 L1045.465,103.056 L1037.878,102.923 L1031.296,98.984 L1025.186,98.976 L1019.477,99.339 L1010.864,99.966 L1002.651,94.761 L995.990,97.613 L989.147,98.114 L982.470,101.128 L975.741,103.441 L968.631,100.007 L961.955,103.000 L954.391,103.632 L946.672,102.006 L939.286,105.185 L931.639,104.608 L923.757,100.664 L916.255,102.156 L908.699,102.887 L901.761,104.024 L894.347,103.066 L889.280,110.180 L883.431,111.708 L878.146,114.588 L874.096,119.638 L865.218,118.451 L857.867,119.654 L850.287,122.680 L842.693,123.124 L835.069,121.847 L827.630,123.181 L819.866,122.992 L812.121,123.839 L804.667,124.559 L796.519,123.165 L788.477,125.564 L780.581,121.362 L774.124,124.488 L767.186,120.800 L760.550,121.071 L753.738,123.768 L746.504,124.533 L740.275,119.958 L732.768,118.434 L725.675,120.160 L720.049,125.543 L714.414,130.619 L706.407,127.542 L700.660,130.937 L694.135,129.686 L690.454,136.711 L684.596,139.774 L676.836,138.022 L669.840,140.281 L663.300,135.060 L655.191,134.638 L647.854,136.434 L641.451,137.129 L635.801,132.017 L628.294,136.943 L621.337,134.573 L614.015,138.517 L605.851,133.061 L598.802,139.827 L591.241,141.490 L583.258,137.323 L575.678,138.276 L568.083,141.755 L559.701,139.755 L552.365,136.625 L545.208,134.264 L538.532,138.190 L531.619,139.763 L523.489,136.432 L515.768,139.914 L508.077,141.806 L502.233,143.492 L495.791,144.156 L489.971,148.045 L481.876,147.112 L473.960,146.359 L466.220,151.533 L457.945,146.631 L450.477,150.380 L446.724,154.641 L440.306,154.561 L432.133,157.535 L426.045,158.098 L422.073,162.488 L415.155,165.882 L408.727,170.372 L398.838,169.614 L390.218,172.256 L382.876,177.594 L374.985,174.732 L367.284,174.830 L361.051,177.874 L354.813,177.197 L348.993,174.251 L342.983,174.831 L335.695,177.108 L328.475,174.457 L320.998,171.815 L313.802,172.226 L306.310,177.243 L299.654,181.617 L291.140,181.844 L281.154,184.111 L273.919,182.601 L267.035,185.625 L260.053,187.546 L252.935,187.601 L246.002,190.345 L238.490,184.302 L231.562,187.178 L224.662,190.430 L217.423,188.537 L210.295,188.378 L203.440,192.250 L195.996,187.488 L188.849,192.869 L181.196,188.565 L174.219,194.697 L166.260,191.670 L159.352,199.024 L149.253,196.949 L141.245,200.715 L132.110,202.293 L124.933,201.629 L118.054,206.382 L110.824,203.583 L103.589,203.380 L96.846,202.973 L92.801,205.628 L86.466,208.909 L79.712,211.084 L72.789,212.918 L65.082,215.415 L56.783,209.469 L49.101,212.346 L41.166,211.646 L33.732,214.341 L26.294,216.947 L18.296,211.546 L10.760,212.839 L3.292,215.045 L0.000,214.421 L0.000,418.1000 Z"/>
							</svg>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php if ( $vcard_bg_type == 1 ) : ?>
						<!-- profile video -->
						<div class="slide">
							<?php if ( $vcard_bg_video ) : ?>
							<video autoplay muted loop controls playsinline id="myVideo">
								<source src="<?php echo esc_url( $vcard_bg_video ); ?>" type="video/mp4">
							</video>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<!-- profile slideshow -->
						<?php if ( $vcard_bg_type == 2 ) : ?>
						<div class="slide">
							<?php if ( $vcard_bg_images ) : ?>
							<div class="swiper-container ryan-slideshow">
								<div class="swiper-wrapper">
									<?php foreach ( $vcard_bg_images as $slide ) : $slide_url = wp_get_attachment_image_url( $slide['image'], 'ryancv_600xauto' ); ?>
									<div class="swiper-slide">
										<img src="<?php echo esc_url( $slide_url ); ?>" alt="<?php echo esc_attr( $vcard_title ); ?>" class="ryan-banner-cover" data-swiper-parallax-y="-30" data-swiper-parallax-scale="1.2">
									</div>
									<?php endforeach; ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php if ( $vcard_photo ) : ?>
						<!-- profile photo -->
						<div class="image">
							<a href="<?php echo esc_url( home_url() ); ?>">
								<img src="<?php echo esc_url( $vcard_photo['sizes']['ryancv_280x280'] ); ?>" alt="<?php echo esc_attr( $vcard_title ); ?>" />
							</a>
						</div>
						<?php endif; ?>

						<!-- profile titles -->
						<?php if ( $vcard_title ) : ?>
						<div class="title"><?php echo wp_kses_post( $vcard_title ); ?></div>
						<?php endif; ?>

						<?php if ( $vcard_subtitle ||  $vcard_subtitles) : ?>
						<?php if( $vcard_subtitle_type == 2 ) : ?>
						<div class="subtitle subtitle-typed">
							<div class="typing-title">
								<?php foreach( $vcard_subtitles as $item ) { ?>
									<p><?php echo wp_kses_post( $item['text'] ); ?></p>
								<?php } ?>
							</div>
							<span class="r-typed<?php if ( $vcard_subtitle_glitch == 1 ) : ?> cyber-glitch<?php endif; ?>"></span>
						</div>
						<?php else : ?>
						<div class="subtitle<?php if ( $vcard_subtitle_glitch == 1 ) : ?> cyber-glitch<?php endif; ?>">
							<?php echo esc_html( $vcard_subtitle ); ?>
						</div>
						<?php endif; ?>
						<?php endif; ?>

						<?php if ( $vcard_social ) : ?>
						<!-- profile socials -->
						<div class="social">
							<?php foreach ( $vcard_social as $item ) { ?>
							<a target="_blank" href="<?php echo esc_url( $item['url'] ); ?>">
								<span class="<?php echo esc_attr( $item['icon'] ); ?>"></span>
							</a>
							<?php } ?>
						</div>
						<?php endif; ?>

					</div>

					<?php if ( $vcard_bts && $sticky_menu || $simple_vcard ) : ?>
					<!-- profile buttons -->
					<div class="lnks<?php if ( $vcard_bts_glitch == 1 ) : ?> cyber-glitch-lnks<?php endif; ?>">
						<?php foreach ( $vcard_bts as $item ) { ?>
						<?php if ( $item['url'] ) : ?>
						<a href="<?php echo esc_url( $item['url']['url'] ); ?>" class="lnk<?php if( $vcard_bts_style == 1 ) : ?> solid-style<?php endif; ?>" <?php if ( $item['url']['target'] ) : ?>target="<?php echo esc_attr( $item['url']['target'] ); ?>"<?php endif; ?>>
							<span class="text"><?php echo esc_html( $item['text'] ); ?></span>
							<?php if ( $item['icon'] != 'ion-none' ) : ?>
							<span class="ion <?php echo esc_attr( $item['icon'] ); ?>"></span>
							<?php endif; ?>
						</a>
						<?php else : ?>
						<a href="#" class="lnk">
							<span class="text"><?php echo esc_html( $item['text'] ); ?></span>
							<?php if ( $item['icon'] != 'ion-none' ) : ?>
							<span class="ion <?php echo esc_attr( $item['icon'] ); ?>"></span>
							<?php endif; ?>
						</a>
						<?php endif; ?>
						<?php } ?>
					</div>
					<?php else : ?>
					<!-- default menu -->
					<div class="main-menu-fixed">
						<div class="main-menu">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary'
								) );
							?>
						</div>
					</div>
					<!-- menu button -->
					<div class="lnks">
						<a href="#" class="lnk lnk-view-menu">
							<span class="ion ion-android-more-horizontal"></span>
							<span class="text" data-text-open="<?php echo esc_attr__( 'Close', 'ryancv' ); ?>"><?php echo esc_html__( 'Menu', 'ryancv' ); ?></span>
						</a>
					</div>
					<?php endif; ?>

				</div>

			</div>

			<div class="s_overlay"></div>
			<div class="content-sidebar">
				<div class="sidebar-wrap">
					<?php if ( ! $sticky_menu ) : ?>
					<div class="main-menu">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary'
							) );
						?>
					</div>
					<?php endif; ?>

					<?php if ( ! $sidebar_disable && is_active_sidebar( 'sidebar-1' ) ) : ?>
						<?php get_sidebar(); ?>
					<?php endif; ?>
				</div>

				<span class="close"></span>
			</div>
