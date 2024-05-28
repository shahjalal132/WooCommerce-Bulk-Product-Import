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
        add_action( 'wp_ajax_save_table_prefix', [ $this, 'save_table_prefix' ] );
    }

    public function register_admin_menu() {
        add_menu_page(
            __( 'Bulk Product Import', 'bulk-product-import' ),
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
        $table_prefix  = get_option( 'be-table-prefix' ) ?? '';

        ?>

        <div class="entry-header">
            <h1 class="entry-title text-center mt-3" style="color: #2271B1">
                <?php _e( 'WooCommerce Bulk Product Import', 'bulk-product-import' ); ?>
            </h1>
        </div>

        <div id="be-tabs" class="mt-3">
            <div id="tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="#api"
                            class="nav-link be-nav-links"><?php _e( 'API', 'bulk-product-import' ); ?></a></li>
                    <li class="nav-item"><a href="#product"
                            class="nav-link be-nav-links"><?php _e( 'Product', 'bulk-product-import' ); ?></a></li>
                    <li class="nav-item"><a href="#options"
                            class="nav-link be-nav-links"><?php _e( 'Options', 'bulk-product-import' ); ?></a></li>
                    <li class="nav-item"><a href="#tables"
                            class="nav-link be-nav-links"><?php _e( 'Tables', 'bulk-product-import' ); ?></a></li>
                    <li class="nav-item"><a href="#endpoints"
                            class="nav-link be-nav-links"><?php _e( 'Endpoints', 'bulk-product-import' ); ?></a></li>
                </ul>

                <div id="api">
                    <!-- api credentials -->
                    <div class="container-fluid api-credentials">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-center mb-3">
                                    <?php _e( 'WooCommerce API Credentials', 'bulk-product-import' ); ?>
                                </h4>
                                <form id="client-credentials-form">
                                    <div class="d-flex align-items-center mt-2">
                                        <label class="form-label"
                                            for="client-id"><?php _e( 'Client ID', 'bulk-product-import' ); ?></label>
                                        <input type="text" class="form-control"
                                            style="width: 60% !important; margin-left: 4.7rem;" name="client-id" id="client-id"
                                            value="<?php echo esc_attr( $client_id ); ?>"
                                            placeholder="<?php _e( 'Client ID', 'bulk-product-import' ); ?>" required>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <label class="form-label"
                                            for="client-secret"><?php _e( 'Client Secret', 'bulk-product-import' ); ?></label>
                                        <input type="text" class="form-control ms-5" style="width: 60% !important"
                                            name="client-secret" id="client-secret"
                                            value="<?php echo esc_attr( $client_secret ); ?>"
                                            placeholder="<?php _e( 'Client Secret', 'bulk-product-import' ); ?>" required>
                                    </div>

                                    <input type="submit" class="btn btn-primary mt-3" id="credential-save"
                                        value="<?php _e( 'Save', 'bulk-product-import' ); ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="product">
                    <p><?php _e( 'Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.', 'bulk-product-import' ); ?>
                    </p>
                </div>

                <div id="options">
                    <p><?php _e( 'Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.', 'bulk-product-import' ); ?>
                    </p>
                </div>

                <div id="tables">
                    <div id="db-tables" class="common-shadow">
                        <form action="" method="post">
                            <div class="d-flex align-items-center">
                                <label class="form-label"
                                    for="table-prefix"><?php _e( 'Table Prefix', 'bulk-product-import' ); ?></label>
                                <input type="text" class="form-control w-50 ms-5" name="table-prefix" id="table-prefix"
                                    placeholder="Enter Table Prefix" value="<?php echo esc_attr( $table_prefix ); ?>">
                            </div>
                            <input type="submit" class="btn btn-primary mt-3" id="save-table-prefix" value="Save">
                        </form>
                    </div>
                </div>

                <div id="endpoints">
                    <div id="api-endpoints">
                        <p>
                            <?php _e( 'API Endpoints', 'bulk-product-import' ); ?>
                        </p>
                    </div>
                </div>

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

    public function save_table_prefix() {

        check_ajax_referer( 'bulk_product_import_nonce', 'nonce' );

        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'Unauthorized user', 'bulk-product-import' ) );
        }

        $table_prefix = sanitize_text_field( $_POST['table_prefix'] );
        update_option( 'be-table-prefix', $table_prefix );

        wp_send_json_success( __( 'Table prefix saved successfully', 'bulk-product-import' ) );
    }
}
