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
<?php 
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( isset( $_POST ) && ! empty ( $_POST ) ) {
  // var_dump($_POST);
  update_option(
    'pi_image_size_width', 
    sanitize_text_field($_POST['pi-image-size-width'])
  );
  update_option(
    'pi_image_size_height', sanitize_text_field($_POST['pi-image-size-height'])
  );

  add_option('pi_add_another_size', sanitize_text_field($_POST['pi-add-another-size'])
  );
  add_option('pi_add_another_bp', sanitize_text_field($_POST['pi-add-another-bp'])
  );
  add_option('pi_add_another_bpg', sanitize_text_field($_POST['pi-add-another-bpg'])
  );
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap picture-it--options">
  <h1>Picture It Media Settings</h1>

  <form method="post" action="">
   
    <div class="defaults image-sizes__wrap">

      <div class="info-box">
        <h2 class="title">Image sizes</h2>
        <p>The sizes listed below determine the maximum dimensions in pixels to use when adding an image to the Media Library.</p>
      </div>

      <div class="size-box size-box__image-size">
        <p>
          <strong>
            Thumbnail size
          </strong>
        </p>
        <fieldset>
          <legend class="screen-reader-text">
            <span>Thumbnail size</span>
          </legend>
          <label for="pi-image-size-width">
            Width
          </label>
          <input 
            name="pi-image-size-width"
            type="number"
            step="1"
            min="0"
            id="pi-image-size-width" 
            value="<?php echo get_option('pi_image_size_width') ?>" 
            class="small-text"
          >
            <br>
          <label for="pi-image-size-height">
            Height
          </label>
          <input 
            name="pi-image-size-height" 
            type="number"
            step="1"
            min="0"
            id="pi-image-size-height" 
            value="<?php echo get_option('pi_image_size_height') ?>" 
            class="small-text"
          >
          <input name="thumbnail_crop" type="checkbox" id="thumbnail_crop" value="1">
          <label for="thumbnail_crop">Crop thumbnail to exact dimensions (normally thumbnails are proportional)</label>
        </fieldset>
      </div>
      
      <!-- add another image size -->
      <div class="size-box size-box__more">
        <p class="submit add-another">      
          <input type="submit" name="submit" id="pi-add-another-size" class="button button-secondary" value="Add Another Size">
        </p>
      </div>
    </div>

    <div class="defaults breakpoint-group__wrap">
      <div class="info-box">
        <h2 class="title">Breakpoint Groups</h2>
        <p>Add a new breakpoint group and include image sizes defined above.</p>

        <p><strong>Defining breakpoints</strong></p>
        <p>In the text box below allows you to specify whether you would like your breakpoint query to use max-width(300px) or max-width(300px);
      </div>

      <h3>Default Breakpoint Group</h3>
      <div class="size-box size-box__breakpoint">
        <h4>Small</h4>
        <span class="screen-reader-text">
          <span>Small</span>
        </span>
        <label for="bp-min-width">
          Breakpoint Width
        </label>
        <input name="bp-min-width" type="number" id="bp-min-width-1" value="300" class="small-text" step="1" min="0">
      </div>
      <div class="size-box size-box__breakpoint">
        <h4>Medium</h4>
        <legend class="screen-reader-text">
          <span>Medium</span>
        </legend>
        <label for="bp-min-width-2">
          Breakpoint Width
        </label>
        <input name="bp-min-width-2" type="number" id="bp-min-width-2" value="768" class="small-text" step="1" min="0">
      </div>
      <div class="size-box size-box__breakpoint">
        <h4>Large</h4>
        <legend class="screen-reader-text">
          <span>Large</span>
        </legend>
        <label for="bp-min-width-3">
          Breakpoint Width
        </label>
        <input name="bp-min-width-3" type="number" id="bp-min-width-3" value="1024" class="small-text" step="1" min="0">
      </div>

      <div class="size-box size-box__breakpoint">
        <h4>X-Large</h4>
        <legend class="screen-reader-text">
          <span>X-Large</span>
        </legend>
        <label for="bp-min-width-4">
          Breakpoint Width
        </label>
        <input name="bp-min-width-4" type="number" id="bp-min-width-4" value="1440" class="small-text" step="1" min="0">
      </div>

      <!-- add another breakpoint to the group -->
      <div class="more">
        <p class="submit add-another">
          <input type="submit" name="submit" id="pi-add-another-bp" class="button button-secondary" value="Add Another Breakpoint">
        </p>
      </div>

      <hr />

      <!-- add another breakpoint group -->
      <div class="more">
        <p class="submit add-another">
          <input type="submit" name="submit" id="pi-add-another-bpg" class="button button-secondary" value="Add Another Breakpoint Group">
        </p>
      </div>

      <!-- submit & save changes -->
      <?php submit_button();?> 
  </form>

</div>