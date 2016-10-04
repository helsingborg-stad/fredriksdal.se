<?php

/**
 * Tell WordPress to save the cookie on the domain
 * @var bool
 */

if (strpos($_SERVER['HTTP_HOST'], "fredriksdal.dev") !== false) {
    define('COOKIE_DOMAIN', ".fredriksdal.dev");
} else {
    define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
}
