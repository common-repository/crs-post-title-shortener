<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CRS_Post_Title_Shortener
 * @subpackage CRS_Post_Title_Shortener/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <h2><?php echo $this->plugin_name; ?></h2>
    
    <form method="post" name="cleanup_options" action="options.php">
    
        <?php
            //Grab all options
            $options = get_option($this->plugin_name);

            // Cleanup
            $length = $options['length'];
            $delimiters = $options['delimiters'];
            $categories = $options['categories'];
        ?>

        <?php
            settings_fields($this->plugin_name);
        ?>

        <!-- set maximum title length -->
        <fieldset>
            <legend class="screen-reader-text"><span>Maximum title length</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-length">
                <input type="number" id="<?php echo $this->plugin_name; ?>-length" name="<?php echo $this->plugin_name; ?>[length]"  min="1" max="250" value="<?php if(!empty($length)) echo $length; ?>"/>
                <span><?php esc_attr_e('Maximum title length', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <!-- define delimiter characters -->
        <fieldset>
            <legend class="screen-reader-text"><span>Define delimiter characters</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-delimiters">
                <input type="text" id="<?php echo $this->plugin_name; ?>-delimiters" name="<?php echo $this->plugin_name; ?>[delimiters]" value="<?php if(!empty($delimiters)) echo $delimiters; ?>"/>
                <span><?php esc_attr_e('Define delimiter characters', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <!-- enable for categories -->
        <fieldset>
            <legend class="screen-reader-text"><span>Enable for categories</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-categories">
                <input type="text" id="<?php echo $this->plugin_name; ?>-categories" name="<?php echo $this->plugin_name; ?>[categories]" value="<?php if(!empty($categories)) echo $categories; ?>" />
                <span><?php esc_attr_e('Enable for categories', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>