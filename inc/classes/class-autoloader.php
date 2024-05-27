<?php
/**
 * Bootstraps the plugin.
 */

namespace AUTOLOADER\Inc;

use AUTOLOADER\Inc\Traits\Singleton;

class Autoloader {
    use Singleton;

    protected function __construct() {

        // load class.
        Enqueue_Assets::get_instance();

    }
}