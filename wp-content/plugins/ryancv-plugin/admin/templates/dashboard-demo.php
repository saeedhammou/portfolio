<?php
/**
* Template for theme dashboard demo content page
*/
?>

<div class="ryancv-dashboard-plugins">
  <div class="image-container">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_amiibtte.json"  background="transparent"  speed="1"  style="width: 100%; height: auto;"  loop  autoplay></lottie-player>
  </div>
  <div class="content-container">
    <div class="notice updated">
      <p><?php echo sprintf( __( 'Cool ;) One click demo install are available for install!', 'ryancv-plugin' ) );?></p>
    </div>
    <h2><?php echo esc_html__( 'Demo Import Status', 'ryancv-plugin' ); ?></h2>
    <div class="ryancv-dashboard-list">
      <ul>
        <li>
           <strong><span class="dashicons dashicons-yes"></span></strong>
           <?php echo esc_html__( 'One Click Demo Import', 'ryancv-plugin' ); ?>
        </li>
        <li>
           <strong><span class="dashicons dashicons-yes"></span></strong>
           <?php echo esc_html__( 'Theme Settings Import', 'ryancv-plugin' ); ?>
        </li>
      </ul>
    </div>
    <div class="buttons">
      <p>
        <a href="<?php echo admin_url( 'themes.php?page=one-click-demo-import' ); ?>" class="button button-primary"><?php echo esc_html__( 'Install / Select Demo', 'ryancv-plugin' ); ?></a>
      </p>
    </div>
  </div>
</div>
