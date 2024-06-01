<?php

if ( file_exists( BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/vendor/autoload.php' ) ) {
    require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/vendor/autoload.php';
}

class Sheet_Import {
    private $client;
    private $service;
    private $spreadsheetID;
    private $sheetRange;
    private $credentialsPath = __DIR__ . '/credentials.json';

    public function __construct() {
        $this->client = new Google\Client();
        $this->client->setApplicationName( "goglesheetapi" );
        $this->client->setScopes( [ \Google_Service_Sheets::SPREADSHEETS ] );
        $this->client->setAccessToken( 'offline' );
        $this->client->setAuthConfig( $this->credentialsPath );
        $this->service       = new Google_Service_Sheets( $this->client );
        $this->spreadsheetID = '1igZQ5L-FlY7FTzqMpxPOzbscWLYo15hLW5s9YHwPRD4';
        $this->sheetRange    = 'products!A:G';
    }

    public function fetchProductsFromSheets() {
        $response = $this->service->spreadsheets_values->get( $this->spreadsheetID, $this->sheetRange );
        return $response->getValues();
    }
}

/* $sheetProducts = new Sheet_Import();
$products      = $sheetProducts->fetchProductsFromSheets();
echo '<pre>';
print_r( $products );
echo '</pre>'; */