<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CRS_Post_Title_Shortener
 * @subpackage CRS_Post_Title_Shortener/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CRS_Post_Title_Shortener
 * @subpackage CRS_Post_Title_Shortener/public
 * @author     Stefan Bergfeldt <stefan@crswebb.se>
 */
class CRS_Post_Title_Shortener_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $crs_post_title_shortener    The ID of this plugin.
     */
    private $crs_post_title_shortener;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $crs_post_title_shortener       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($crs_post_title_shortener, $version)
    {

        $this->plugin_name = $crs_post_title_shortener;
        $this->version = $version;
        $this->crs_post_title_options = get_option($this->plugin_name);

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in CRS_Post_Title_Shortener_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The CRS_Post_Title_Shortener_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/crs-post-title-shortener-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in CRS_Post_Title_Shortener_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The CRS_Post_Title_Shortener_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/crs-post-title-shortener-public.js', array('jquery'), $this->version, false);

    }

    public function save_post_crs_post_title_shortener($post_id, $post_object)
    {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        remove_action('save_post', 'save_post_crs_post_title_shortener');

        // Call wp_update_post update, which calls save_post again.
        if ($this->is_in_handled_category($post_id)) {
            // Update post
            $my_post = array(
                'ID' => $post_id,
                'post_title' => $this->get_new_title($post_object->post_title),
                'post_name' => '');

            // Update the post into the database
            if ($post_object->post_title != $my_post['post_title']) {
                wp_update_post($my_post);
            }
        }

        add_action('save_post', 'save_post_crs_post_title_shortener', 10, 2);
    }

    public function get_new_title($old_title)
    {
        $max_length = $this->crs_post_title_options['length'];
        if (strlen($old_title) <= $max_length) {
            return $old_title;
        }

        $title_delimiters = str_split($this->crs_post_title_options['delimiters']);
        if ($this->strposa($old_title, $title_delimiters) == 0) {
            $new_title = $old_title;
        } else {
            $new_title = substr($old_title, 0, $this->strposa($old_title, $title_delimiters) + 1);
        }
        //$new_title = $max_length . $new_title;
        if (strlen($new_title) > $max_length) {
            $new_title = substr($new_title, 0, $max_length);
            $new_title = substr($new_title, 0, strrpos($new_title, ' ', -1));
            $new_title = $new_title . '[...]';
        }
        return $new_title;
    }

    public function is_in_handled_category($post_id)
    {
        if ($this->crs_post_title_options['categories'] == -1) {
            return true;
        }
        $categories = explode(',', $this->crs_post_title_options['categories']);
        foreach ($categories as $category) {
            if (in_category($category, $post_id)) {
                return true;
            }
        }
        return false;
    }

    public function strposa($haystack, $needles = array(), $offset = 0)
    {
        $chr = array();
        foreach ($needles as $needle) {
            $res = strpos($haystack, $needle, $offset);
            if ($res !== false) {
                $chr[$needle] = $res;
            }
        }
        if (empty($chr)) {
            return false;
        }
        return min($chr);
    }

}
