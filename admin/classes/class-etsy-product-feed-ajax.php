<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Variation_Swatches_For_Woocommerce
 * @subpackage Variation_Swatches_For_Woocommerce/admin
 */
use listing_product\Listing_product;
use upload_product\Upload_Product;

/**
 * @since      1.0.0
 * Class Etsy_Product_Feed_Ajax
 */
class Etsy_Product_Feed_Ajax
{
    protected $background_process;
    protected $validations;
    protected $etsy_authorization;

    /**
     * Conatins existing shipping tenplate infos
     * @var array
     */
    protected $existing_data = [];

    protected $ar=[];

    /**
     * Etsy_Product_Feed_Ajax constructor.
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->background_process = new WP_Etsy_Background_Process();
        $this->etsy_authorization = new Etsy_Authorization();

    }

    /**
     * initialization of ajax callback function
     * @since      1.0.0
     */
    public function init()
    {

        /**
         * Validations
         **/
        $validations = array(
            'logged_in' => true,
            'user_can' => 'manage_options',
        );

        /**
         * complete authorization
         */
        wp_ajax_helper()->handle('authorize')
            ->with_callback(array($this, 'auth_credential_submit'))
            ->with_validation($validations);

        /**
         * send data to etsy
         */
        wp_ajax_helper()->handle('send_to_etsy')
            ->with_callback(array($this, 'send_products_to_etsy'))
            ->with_validation($validations);

        /**
         * delete all data from etsty
         */
        wp_ajax_helper()->handle('delete_from_etsy')
            ->with_callback(array($this, 'delete_products_from_etsy'))
            ->with_validation($validations);

        /**
         * stop background process
         */
        wp_ajax_helper()->handle('clear_etsy_batch')
            ->with_callback(array($this, 'clear_batch'))
            ->with_validation($validations);

        /**
         * generate shipping template id
         */
        wp_ajax_helper()->handle('get_shipping_template_id')
            ->with_callback(array($this, 'generate_shipping_template_id'))
            ->with_validation($validations);

        /**
         * get shipping template id infos
         */
        wp_ajax_helper()->handle('get_shipping_infos')
            ->with_callback(array($this, 'get_shipping_template_id_infos'))
            ->with_validation($validations);

        /**
         * update sending status
         */
        wp_ajax_helper()->handle('update_sending_status')
            ->with_callback(array($this, 'update_shipping_status'))
            ->with_validation($validations);

        /**
         * update sending status
         */
        wp_ajax_helper()->handle('delete_shipping_template_id')
            ->with_callback(array($this, 'delete_shipping_id'))
            ->with_validation($validations);

        /**
         * update sending status
         */
        wp_ajax_helper()->handle('remove_admin_notice')
            ->with_callback(array($this, 'remove_admin_notice'))
            ->with_validation($validations);

    }

    /**
     * Generate authorization url
     * @param $payload
     * @throws \Etsy\Exception\ApiException
     * @since 1.0.0
     */
    function auth_credential_submit($payload)
    {
        $consumer_key = sanitize_text_field($payload['key']);
        $consumer_secret = sanitize_text_field($payload['secret']);

        setcookie('c_key', $consumer_key, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('c_secret', $consumer_secret, time() + (86400 * 30), "/"); // 86400 = 1 day

        if ($consumer_key && $consumer_secret) {
            //get consumer key secret from input
            $etsy_obj = new Etsy_Authorization();
            $etsy = $etsy_obj->get_etsy_onsubmit($consumer_key, $consumer_secret);
        }
        $temp_credentials = $etsy->getTemporaryCredentials();
        $redirect_url = $etsy->getAuthorizationUrl($temp_credentials);

        error_log("etsy url");
        error_log(print_r($redirect_url,1));

        if ($redirect_url) {
            $setup_data = array(
                'temp_credentials' => $temp_credentials,
                'consumer_key' => $consumer_key,
                'consumer_secret' => $consumer_secret,
            );
            update_option('temp_cred', $setup_data);
            update_option('istokencreated', 'yes');
        }

        $response = array(
            'status' => 'success',
            'message' => 'Successfully Saved',
            'url' => $redirect_url
        );
        wp_send_json($response);
    }

    /**
     * Send products to etsy shop
     * @param $selected
     * @since 1.0.0
     */
    function send_products_to_etsy($selected_array)
    {
        update_option("remove_notice",'show_notice');

        error_log("in ajax");
        error_log(print_r($selected_array,1));

        //get selected and who made
        $selected = $selected_array['selected'];
        $who_made = $selected_array['who_made'];
        $when_made = $selected_array['when_made'];
        $shipping_id = $selected_array['shipping_id'];
        $texonomy_id = $selected_array['texonomy_id'];

        error_log("type");

        //check type and unserialize value
        if (gettype($selected) === 'string') {
            $selected = unserialize($selected);
        }

        //chunk array
        $product_array_size = sizeof($selected);
        $chunked_array = array();//initialize array
        $batch = 1;
        if($product_array_size>30){
            $selected = array_chunk($selected, 30,true);
            $batch++;
        }
        $other_val = array(
            'who_made'=>$who_made,
            'when_made'=>$when_made,
            'shipping_id'=>$shipping_id,
            'texonomy_id'=>$texonomy_id
        );

        //push array into queue
        if($batch===1){
            array_push($selected,$other_val);
            $this->background_process->push_to_queue($selected);

        }elseif($batch>1){
            for($i=0;$i<sizeof($selected);$i++){
                array_push($selected[$i],$other_val);
            }
            for($i=0;$i<sizeof($selected);$i++){
                $this->background_process->push_to_queue($selected[$i]);
            }
        }

        update_option("sending_status","sending");
        $this->background_process->save()->dispatch();

        $response = array(
            'status' => 'success',
            'message' => 'Data sending on background please wait..',
            'selected_val' => $selected,
        );
        wp_send_json($response);
    }

    /**
     * Delete all product
     * @param $selected
     * @throws \Etsy\Exception\ApiException
     * @throws \Etsy\Exception\RequestException
     * @since 1.0.0
     */
    function delete_products_from_etsy($selected){
        if (gettype($selected) === 'string') {
            $selected = unserialize($selected);
        }

        //get etsy class
        $etsy_obj = new Etsy_Authorization();
        $etsy2 = $etsy_obj->get_auth_etsy_class();
        foreach($selected as $selected){
            $product_listing_id=get_post_meta($selected,'_product_listing_id',true);
            $ar = array(
                'listing_id' => $product_listing_id,
            );
            $dl = new Upload_Product();
            $state = $dl->get_listing_state( $product_listing_id );
            if($state == 'draft') {
                $test = $etsy2->makeRequest('DELETE', '/listings/:listing_id',$ar);
            }

        }

        $response = array(
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'selected_val' => $selected,
        );
        wp_send_json($response);

    }

    /**
     * Stop background process
     * Clear batch
     * @since 1.0.0
     * @param $payload
     */
    function clear_batch($payload){
     /**
         * https://stackoverflow.com/questions/55952451/wordpress-stop-process-for-wp-background-processing
         */
        global $wpdb;

        $sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
            FROM  $wpdb->options
            WHERE `option_name` LIKE %s
            ORDER BY `option_name`";
        $wild = '%';
        $find = 'send_product_process';
        $like = $wild . $wpdb->esc_like( $find ) . $wild;

        $results = $wpdb->get_results( $wpdb->prepare($sql,$like) );
        foreach ( $results as $result ){
            delete_option( $result->name );
        }
        $this->background_process->cancel_process();
        $response = array(
            'status' => 'Batch cleared successfully',
            'message' => 'Batch ',
        );
        wp_send_json_success($response);
    }

    /**
     * genereate shipping template id
     * @param $payload
     * @since 1.0.0
     * @throws \Etsy\Exception\ApiException
     */
    function generate_shipping_template_id($payload){
        //get val
        $shiiping_title=$payload['shipping_title'];
        $origin_country_id=$payload['origin_country_id'];
        $primary_cost=$payload['primary_cost'];
        $secondary_cost=$payload['secondary_cost'];
        $min_processing_days=$payload['min_processing_days'];
        $max_processing_days=$payload['max_processing_days'];

        $etsy2 = $this->etsy_authorization->get_auth_etsy_class();//get etsy class

        $array_val = array(
            'title' => $shiiping_title,
            'origin_country_id' =>$origin_country_id,
            'primary_cost' => number_format($primary_cost,2),
            'secondary_cost' => number_format($secondary_cost,4),
            'min_processing_days' => $min_processing_days,
            'max_processing_days' => $max_processing_days,
        );

        try {

            $templte_id_obj = $etsy2->makeRequest('POST', '/shipping/templates',$array_val);
            $shipping_template_id = $templte_id_obj->results[0]->shipping_template_id;
            $existing = get_option('shipping_template_infos');


            if(!empty($existing)){
                foreach ($existing as $ex){
                    array_push($this->existing_data,$ex);
                }
            }

            $shippin_data = array(
                'shipping_template_id' => $shipping_template_id,
                'shipping_title' => $shiiping_title,
            );
            array_push($this->existing_data,$shippin_data);
            update_option("shipping_template_infos" ,$this->existing_data);

            $shipping_info  = get_option('shipping_template_infos');

            $response = array(
                'shipping_infos'=>$shipping_info,
                'shipping_template_id' => $shipping_template_id,
                'status' => 'success',
            );

        }catch (Exception $e){
            $response = array(
                'status' => 'failed',
                'message' => 'Batch ',
            );

        }
        wp_send_json_success($response);
    }

    /**
     * Show shipping template infos after refresh interval
     * @param $payload
     * @since 1.0.0
     */
    function get_shipping_template_id_infos($payload){
        error_log("in get ");
        $shipping_infos = get_option('shipping_template_infos');
        $response = array(
            'shipping_infos' => $shipping_infos,
            'status' => 'success',
        );
        wp_send_json_success($response);

    }

    /*
     * Delete shipping template id
     * @param $payload
     * @since 1.0.0
     */
    function delete_shipping_id($payload){


        $shipping_template_updated_info = [];
        $shipping_infos = get_option('shipping_template_infos');
        $shipping_id =$payload['shipping_id'];


        foreach ($shipping_infos as $key){
            if($key['shipping_template_id']!=$shipping_id){
                $shipping_template_updated_info[]=$key;
            }
        }
        update_option('shipping_template_infos',$shipping_template_updated_info);

        $ar = array(
            'shipping_template_id' => $shipping_id
        );

        try {
            $this->etsy_authorization->get_auth_etsy_class()->makeRequest('DELETE', '/shipping/templates/:shipping_template_id',$ar);
        }catch (Exception $e){
            error_log(print_r($e->getMessage(),1));
        }

        $shipping_info = get_option('shipping_template_infos');

        $response = array(
            'status' => 'success',
            'shipping_infos'=>$shipping_info,
        );
        wp_send_json_success($response);

    }

    /**
     * update shipping status for notice
     * @since 1.0.0
     */
    function update_shipping_status($payload){
        update_option("sending_status",$payload);
        $response = array(
            'status' => 'success',
        );
        wp_send_json_success($response);

    }

    /**
     * update shipping status for notice
     * @since 1.0.0
     */
    function remove_admin_notice($payload){
        //error_log(print_r($payload,1));
        update_option("remove_notice",$payload);
        $response = array(
            'status' => 'success',
        );
        wp_send_json_success($response);

    }


}
