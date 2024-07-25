<?php

/**
 * Dump and die
 *
 * @param string $value
 * @return never
 */
function dd( $value ) {
    var_dump( $value );
    die();
}

/**
 * Print and die
 *
 * @param array $value
 * @return never
 */
function pd( $value ) {
    echo '<pre>';
    print_r( $value );
    die();
}

/**
 * Function to save response data to a file.
 *
 * @param string $data The response data to be saved.
 */
function put_program_logs( $data ) {

    // Ensure directory exists to store response data
    $directory = BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/program_logs/';
    if ( !file_exists( $directory ) ) {
        mkdir( $directory, 0777, true );
    }

    // Construct file path for response data
    $file_name = $directory . 'program_logs.log';

    // Get the current date and time
    $current_datetime = date( 'Y-m-d H:i:s' );

    // Append current date and time to the response data
    $data = $data . ' - ' . $current_datetime;

    // Append new response data to the existing file
    if ( file_put_contents( $file_name, $data . "\n\n", FILE_APPEND | LOCK_EX ) !== false ) {
        return "Data appended to file successfully.";
    } else {
        return "Failed to append data to file.";
    }
}