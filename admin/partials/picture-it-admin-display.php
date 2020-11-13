<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Picture_It
 * @subpackage Picture_It/admin/partials
 */
?>

<div class="wrap picture-it--options">
  <h1>
    <?php echo get_admin_page_title();?>
  </h1>
  
  <form method="post" action="options.php">
   <!-- // display section -->
    <?php 
      // security
      settings_fields('pi-settings-page-options-group');

      // Display Section
      do_settings_sections('pi-settings-page');
    ?>

    <div class="defaults image-sizes__wrap">

    </div>
      <!-- submit & save changes -->
      <?php submit_button();?> 
  </form>

</div>