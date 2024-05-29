<?php $base_url = get_option( 'home' ) ?? ''; ?>

<table>
    <tr>
        <th><?php _e( 'Endpoint', 'bulk-product-import' ); ?></th>
        <th><?php _e( 'Name', 'bulk-product-import' ); ?></th>
        <th><?php _e( 'Action', 'bulk-product-import' ); ?></th>
    </tr>
    <tr>
        <?php $server_status = $base_url . "/wp-json/bulk-import/v1/server-status"; ?>
        <td id="status-api"><?php echo $server_status; ?></td>
        <td><?php _e( 'Server Status', 'bulk-product-import' ) ?></td>
        <td><button type="button" id="status-cp"
                class="btn btn-primary btn-sm"><?php _e( 'Copy', 'bulk-product-import' ) ?></button>
        </td>
    </tr>
    <tr>
        <?php $delete_products = $base_url . "/wp-json/bulk-import/v1/delete-products"; ?>
        <td id="delete-api"><?php echo $delete_products; ?></td>
        <td><?php _e( 'Delete Products', 'bulk-product-import' ) ?></td>
        <td><button type="button" id="delete-cp"
                class="btn btn-primary btn-sm"><?php _e( 'Copy', 'bulk-product-import' ) ?></button>
        </td>
    </tr>
    <tr>
        <?php $delete_trash_products = $base_url . "/wp-json/bulk-import/v1/delete-trash-products"; ?>
        <td id="delete-trash-api"><?php echo $delete_trash_products; ?></td>
        <td><?php _e( 'Delete Trash Products', 'bulk-product-import' ) ?></td>
        <td><button type="button" id="delete-trash-cp"
                class="btn btn-primary btn-sm"><?php _e( 'Copy', 'bulk-product-import' ) ?></button>
        </td>
    </tr>
    <tr>
        <?php $delete_woo_cats = $base_url . "/wp-json/bulk-import/v1/delete-woo-cats"; ?>
        <td id="delete-woo-cats-api"><?php echo $delete_woo_cats; ?></td>
        <td><?php _e( 'Delete Woo Categories', 'bulk-product-import' ) ?></td>
        <td><button type="button" id="delete-woo-cats-cp"
                class="btn btn-primary btn-sm"><?php _e( 'Copy', 'bulk-product-import' ) ?></button>
        </td>
    </tr>
</table>