<?php $table_prefix = get_option( 'be-table-prefix' ) ?? ''; ?>

<div id="db-tables" class="common-shadow">
    <form action="" method="post">
        <div class="d-flex align-items-center">
            <label class="form-label" for="table-prefix"><?php _e( 'Table Prefix', 'bulk-product-import' ); ?></label>
            <input type="text" class="form-control w-50 ms-5" name="table-prefix" id="table-prefix"
                placeholder="Enter Table Prefix" value="<?php echo esc_attr( $table_prefix ); ?>">
        </div>
        <input type="submit" class="btn btn-primary mt-3" id="save-table-prefix" value="Save">
    </form>
</div>