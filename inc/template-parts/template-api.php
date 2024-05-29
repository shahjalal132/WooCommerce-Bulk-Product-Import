<?php
$client_id     = get_option( 'be-client-id' ) ?? '';
$client_secret = get_option( 'be-client-secret' ) ?? '';
?>

<!-- api credentials -->
<div class="container-fluid api-credentials">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-center mb-3">
                <?php _e( 'WooCommerce API Credentials', 'bulk-product-import' ); ?>
            </h4>
            <form id="client-credentials-form">
                <div class="d-flex align-items-center mt-2">
                    <label class="form-label" for="client-id"><?php _e( 'Client ID', 'bulk-product-import' ); ?></label>
                    <input type="text" class="form-control" style="width: 60% !important; margin-left: 4.7rem;"
                        name="client-id" id="client-id" value="<?php echo esc_attr( $client_id ); ?>"
                        placeholder="<?php _e( 'Client ID', 'bulk-product-import' ); ?>" required>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <label class="form-label"
                        for="client-secret"><?php _e( 'Client Secret', 'bulk-product-import' ); ?></label>
                    <input type="text" class="form-control ms-5" style="width: 60% !important" name="client-secret"
                        id="client-secret" value="<?php echo esc_attr( $client_secret ); ?>"
                        placeholder="<?php _e( 'Client Secret', 'bulk-product-import' ); ?>" required>
                </div>

                <input type="submit" class="btn btn-primary mt-3" id="credential-save"
                    value="<?php _e( 'Save', 'bulk-product-import' ); ?>">
            </form>
        </div>
    </div>
</div>