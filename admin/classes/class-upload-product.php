<?php
namespace upload_product;
use listing_product\Listing_product;

use Google\Exception;

/**
 * Class Upload_Product
 * @return $array_val
 *@since 1.0.0
 * @package upload_product
 */
class Upload_Product{



    /**
     * Get listing state of each product from etsy shop
     * @param $Product_listing_id
     * @return state
     * @since 1.0.0
     */
    public function get_listing_state( $Product_listing_id ) {
        $etsy_auth_obj = new \Etsy_Authorization();
        $api_key = $etsy_auth_obj->get_consumer_key();

        // Make sure you define API_KEY to be your unique, registered key
        $url = "https://openapi.etsy.com/v2//listings/$Product_listing_id?api_key=$api_key";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_body = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (intval($status) != 200) throw new Exception("HTTP $status\n$response_body");
        $response = json_decode($response_body);
        $state = $response->results[0]->state;

        return $state;
    }

    /**
     * Update product
     * @param $id
     * @return array
     * @since 1.0.0
     */
    public function update_product($etsy2,$put_listing_array){

        try {
            $etsy2->makeRequest('PUT', '/listings/:listing_id', $put_listing_array);
        }catch (Exception $e){
            print_r($e,1);
        }
    }

    /**
     * Insert product
     * @param $etsy2
     * @param $post_listing_array
     * @return mixed
     * @since 1.0.0
     */
    public function insert_product($etsy2,$post_listing_array){
        try {
            $listing_obj = $etsy2->makeRequest('POST', '/listings', $post_listing_array);
        }catch (Exception $e){
            print_r($e,1);
        }
        return $listing_obj;
    }

}
