<?php

namespace BULK_IMPORT\Inc;

use BULK_IMPORT\Inc\Traits\Singleton;

class Admin_Menu {

    use Singleton;

    public function __construct() {
        $this->setup_hooks();
    }

    public function setup_hooks() {
        add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
        add_action( 'wp_ajax_save_client_credentials', [ $this, 'save_client_credentials' ] );
    }

    public function register_admin_menu() {
        add_menu_page(
            __( 'bulk-product-import', 'bulk-product-import' ),
            __( 'Bulk Product Import', 'bulk-product-import' ),
            'manage_options',
            'bulk_product_import',
            [ $this, 'bulk_product_import_page_html' ],
            'dashicons-cloud-upload',
            80
        );
    }

    public function bulk_product_import_page_html() {

        $client_id     = get_option( 'be-client-id' ) ?? '';
        $client_secret = get_option( 'be-client-secret' ) ?? '';

        ?>

        <div class="entry-header">
            <h1 class="entry-title text-center mt-3" style="color: #2271B1">
                <?php _e( 'WooCommerce Bulk Product Import', 'bulk-product-import' ); ?>
            </h1>
        </div>

        <!-- api credentials -->
        <div class="container-fluid api-credentials">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <form id="client-credentials-form">
                        <div class="d-flex align-items-center">
                            <label for="client-id"><?php _e( 'Client ID', 'bulk-product-import' ); ?></label>
                            <input type="text" class="form-control" style="width: 30% !important; margin-left: 4.7rem;"
                                name="client-id" id="client-id" value="<?php echo $client_id; ?>"
                                placeholder="<?php _e( 'Client ID', 'bulk-product-import' ); ?>" required>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <label for="client-secret"><?php _e( 'Client Secret', 'bulk-product-import' ); ?></label>
                            <input type="text" class="form-control ms-5" style="width: 30% !important" name="client-secret"
                                id="client-secret" value="<?php echo $client_secret; ?>"
                                placeholder="<?php _e( 'Client Secret', 'bulk-product-import' ); ?>" required>
                        </div>

                        <input type="submit" class="btn btn-primary mt-3" id="credential-save"
                            value="<?php _e( 'Save', 'bulk-product-import' ); ?>">
                    </form>
                </div>
            </div>
        </div>

        <div id="tabs">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#tabs-1" class="nav-link">API</a></li>
                <li class="nav-item"><a href="#tabs-2" class="nav-link">Product</a></li>
                <li class="nav-item"><a href="#tabs-3" class="nav-link">Options</a></li>
            </ul>
            <div id="tabs-1">
                <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi
                    sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus
                    auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci.
                    Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius
                    sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
            </div>
            <div id="tabs-2">
                <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc.
                    Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut
                    tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam.
                    Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc.
                    Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat,
                    tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris
                    consectetur tortor et purus.</p>
            </div>
            <div id="tabs-3">
                <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula
                    accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti
                    sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel
                    enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium
                    nec, feugiat nec, luctus a, lacus.</p>
                <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla
                    facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec
                    mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam
                    scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor,
                    tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo.
                    Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
            </div>
        </div>

        <?php
    }

    public function save_client_credentials() {
        check_ajax_referer( 'bulk_product_import_nonce', 'nonce' );

        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'Unauthorized user', 'bulk-product-import' ) );
        }

        $client_id     = sanitize_text_field( $_POST['client_id'] );
        $client_secret = sanitize_text_field( $_POST['client_secret'] );

        update_option( 'be-client-id', $client_id );
        update_option( 'be-client-secret', $client_secret );

        wp_send_json_success( __( 'Credentials saved successfully', 'bulk-product-import' ) );
    }
}
