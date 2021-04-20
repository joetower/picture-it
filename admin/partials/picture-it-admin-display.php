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

//Admin page html callback
//Print out html for admin page
  // check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }

  //Get the active tab from the $_GET param
  $default_tab = null;
  $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>

<div class="wrap picture-it--options">
  <h1>
    <?php echo get_admin_page_title();?>
  </h1>
  <!-- Here are our tabs -->
  <nav class="nav-tab-wrapper">
    <a href="?page=picture-it" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Image Sizes</a>
    <a href="?page=picture-it&tab=breakpointgroup"
      class="nav-tab <?php if($tab==='breakpointgroup'):?>nav-tab-active<?php endif; ?>">Breakpoint Groups</a>
    <a href="?page=picture-it&tab=breakpointmap"
      class="nav-tab <?php if($tab==='breakpointmap'):?>nav-tab-active<?php endif; ?>">Breakpoint Image Mapping</a>
  </nav>
  <div class="tab-content">
    <form method="post" action="options.php">
      <?php switch($tab) :
        case 'breakpointgroup':
          settings_fields('pi-breakpoint-group-section');
          do_settings_sections('pi-settings-page-bp-group');
          break;
        case 'breakpointmap':
          settings_fields('pi-picture-mapping-section');
          do_settings_sections('pi-settings-page-bp-map');
          break;
        default:
          settings_fields('pi-settings-page-options-group');
          do_settings_sections('pi-settings-page');
          break;
      endswitch; ?>
      <?php submit_button();?>

    </form>
  </div>
</div>
