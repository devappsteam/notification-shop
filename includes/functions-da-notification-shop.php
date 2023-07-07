<?php

if (!function_exists('dans_get_view')) {
    function dans_get_view($view, $is_admin = false, $args = array())
    {
        $path = dans_get_path_public_or_admin($is_admin) . $view . '.php';

        extract($args);
        if (file_exists($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        }
    }
}

if (!function_exists('dans_get_view_string')) {
    function dans_get_view_string($view, $is_admin = false, $args = array())
    {
        $path = dans_get_path_public_or_admin($is_admin) . $view . '.php';

        extract($args);
        if (file_exists($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        }
    }
}

if (!function_exists('dans_get_path_public_or_admin')) {
    function dans_get_path_public_or_admin($is_admin = false)
    {
        return $is_admin ? trailingslashit(DA_NOTIFICATION_SHOP_ADMIN_VIEWS_PATH) : trailingslashit(DA_NOTIFICATION_SHOP_PUBLIC_VIEWS_PATH);
    }
}


if (!function_exists('dans_log')) {
    function dans_log($data)
    {
        $log_entry = print_r($data, true);
        error_log($log_entry);
    }
}
