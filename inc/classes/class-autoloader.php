<?php
/**
 * Bootstraps the plugin.
 */

namespace BULK_IMPORT\Inc;

use BULK_IMPORT\Inc\Traits\Singleton;

class Autoloader {
    use Singleton;

    protected function __construct() {

        // load class.
        Enqueue_Assets::get_instance();

    }
}