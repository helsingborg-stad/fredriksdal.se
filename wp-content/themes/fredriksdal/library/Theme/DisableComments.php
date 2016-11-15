<?php

namespace Fredriksdal\Theme;

class DisableComments
{
    public function __construct()
    {
        add_filter('comments_open', '__return_false');
        add_filter('pings_open', '__return_false');
        add_filter('comments_array', array($this, 'emptyArray'));

        add_action('admin_menu', array($this, 'adminMenu'));
        add_action('admin_init', array($this, 'disableComments'));
        add_action('admin_init', array($this, 'adminRedirect'));
        add_action('admin_init', array($this, 'adminDashboard'));

        add_action('init', array($this, 'adminBar'));
    }

    /**
     * Removes comments support for post types
     * @return void
     */
    public function disableComments()
    {
        $postTypes = apply_filters('Fredriksdal/disable_comments_for_post_types', get_post_types());

        foreach ($postTypes as $postType) {
            remove_post_type_support($postType, 'comments');
            remove_post_type_support($postType, 'trackbacks');
        }
    }

    /**
     * Remove comments from admin bar
     * @return void
     */
    public function adminBar()
    {
        if (!is_admin_bar_showing()) {
            return;
        }

        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }

    /**
     * Remove comments from admin dashbaord
     * @return void
     */
    public function adminDashboard()
    {
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    }

    /**
     * Redirect users from edit-comments admin page if they somehow reaches it
     * @return void
     */
    public function adminRedirect()
    {
        global $pagenow;

        if ($pagenow === 'edit-comments.php') {
            wp_redirect(admin_url());
            exit;
        }
    }

    /**
     * Remove edit comments from admin menu
     * @return void
     */
    public function adminMenu()
    {
        remove_menu_page('edit-comments.php');
    }

    /**
     * Return empty array
     * @return array
     */
    public function emptyArray($what)
    {
        return array();
    }
}
