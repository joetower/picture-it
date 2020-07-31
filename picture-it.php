<?php
/*
   Plugin Name: Picture It
   Plugin URI: https://github.com/joetower/picture-it
   description: Better responsive images in WordPress - manage breakpoint groups of responsive image sizes and serve responsive images using the Picture element. 
   Version: 1.0
   Author: Joe Tower
   Author URI: https://joetower.com
   License: GPL2
   */

// register the settings page
add_action('admin_menu', 'picture_it_add_admin_menu');
add_action('admin_init', 'picture_it_settings_init');

function picture_it_add_admin_menu()
{
  add_options_page('Picture It Configuration', 'Picture It Configuration', 'manage_options', 'settings-api-page', 'picture_it_options_page');
}

function picture_it_settings_init()
{
  register_setting('stpPlugin', 'picture_it_settings');
  add_settings_section(
    'picture_it_stpPlugin_section',
    __('Enter image size - e.g. 1200, 600', 'wordpress'),
    'picture_it_settings_section_callback',
    'stpPlugin'
  );

  add_settings_field(
    'picture_it_text_field_0',
    __('Size in pixels', 'wordpress'),
    'picture_it_text_field_0_render',
    'stpPlugin',
    'picture_it_stpPlugin_section'
  );

  add_settings_field(
    'picture_it_select_field_1',
    __('Our Field 1 Title', 'wordpress'),
    'picture_it_select_field_1_render',
    'stpPlugin',
    'picture_it_stpPlugin_section'
  );
}

function picture_it_text_field_0_render()
{
  $options = get_option('picture_it_settings');
?>
  <input type='text' name='picture_it_settings[picture_it_text_field_0]' value='<?php echo $options['picture_it_text_field_0']; ?>'>
<?php
}

function picture_it_select_field_1_render()
{
  $options = get_option('picture_it_settings');
?>
  <select name='picture_it_settings[picture_it_select_field_1]'>
    <option value='1' <?php selected($options['picture_it_select_field_1'], 1); ?>>Option 1</option>
    <option value='2' <?php selected($options['picture_it_select_field_1'], 2); ?>>Option 2</option>
  </select>

<?php
}

function picture_it_settings_section_callback()
{
  echo __('Set Image size', 'wordpress');
}

function picture_it_options_page()
{
?>
  <form action='options.php' method='post'>

    <h2>Picture It Configuration Page</h2>

    <?php
    settings_fields('stpPlugin');
    do_settings_sections('stpPlugin');
    submit_button();
    ?>

  </form>
<?php
}
