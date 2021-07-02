<?php

/* ONLY in dev mod */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* App path */
define("APP_PATH",realpath(dirname(__FILE__)));

/* Controllers path */
define("CONTROLLERS_NAMESPACE","AGENCE_VOYAGE\\Controllers\\");

/* Views path */
define("VIEWS_PATH",APP_PATH . "/views/");

/* Images path */
define("IMAGES_PATH","/app/views/assets/images/");

/* Css path */
define("CSS_PATH","/app/views/assets/css/");

/* Js path */
define("JS_PATH","/app/views/assets/js/");
/* Fonts path */
define("FONT_PATH","/app/views/assets/fonts/");

/* Gallerie path */
define("GALLERIE_PATH","/var/www/html/app/views/gallerie/images/");

/* Admin assets paths */
define("CSS_PATH_ADMIN","/app/views/assets/admin/dist/css/");
define("JS_PATH_ADMIN","/app/views/assets/admin/dist/js/");
define("IMAGES_PATH_ADMIN","/app/views/assets/admin/dist/img/");
define("FONTS_PATH_ADMIN","/app/views/assets/admin/dist/fonts/css/");
define("PLUGINS_PATH_ADMIN","/app/views/assets/admin/plugins/");

/* some constant strings*/
define("NOT_FOUND_CONTROLLER","NotFoundController");
define("NOT_FOUND_ACTION","notFoundAction");
?>