<?php
use Etsy\Etsy;
use League\OAuth1\Client\Credentials\TemporaryCredentials;


class Etsy_Authorization
{
    /**
     * get consumer key form database
     * since 1.0.0
     * @return consumer key
     */
    public function get_consumer_key(){
        $temp_cred_ar = get_option('temp_cred');
        $consumer_key = $temp_cred_ar['consumer_key'];
        return $consumer_key;
    }

    /**
     * Make auth with temp cred and get etsy class
     * @return Etsy
     * @version 1.0.0
     * @throws \Etsy\Exception\ApiException
     */
    public function get_auth_etsy_class(){
        $temp_cred_ar = get_option('temp_cred');
        $consumer_key = $temp_cred_ar['consumer_key'];
        $consumer_secret = $temp_cred_ar['consumer_secret'];

        //get access key,access secret
        $access = get_option('access_key_secret');
        $access_key = $access['access_key'];
        $access_secret = $access['access_secret'];

        Etsy::setConfig([
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
            'access_key' => $access_key,
            'access_secret' => $access_secret,
        ]);
        $etsy = new Etsy;
        return $etsy;
    }

    /**
     * get authorization url
     * @param $consumer_key
     * @param $consumer_secret
     * @return Etsy
     * @since 1.0.0
     * @throws \Etsy\Exception\ApiException
     */
    public function get_etsy_onsubmit($consumer_key,$consumer_secret){

        Etsy::setConfig([
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
            'scope' => ['listings_r', 'listings_w', 'listings_d'],
            'callback_uri' => admin_url('admin.php?page=etsy-api-settings'),
        ]);

        $etsy = new Etsy;
        return $etsy;
    }

    /**
     * Set config and create etsy object
     * @return object
     * @since    1.0.0
     */
    public function get_etsy(){
        $temp_cred_ar = get_option('temp_cred');
        $consumer_key = $temp_cred_ar['consumer_key'];
        $consumer_secret = $temp_cred_ar['consumer_secret'];

        Etsy::setConfig([
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
            'scope' => ['listings_r', 'listings_w', 'listings_d'],
        ]);
        $etsy = new Etsy();
        return $etsy;
    }

    /**
     * get auth token and auth verifire from url
     * get access key and access secret and save in database
     * @return bool
     * @since 1.0.0
     */
    public function authorize() {
        $temp_cred_ar = get_option('temp_cred');
        $temp_cred = $temp_cred_ar['temp_credentials'];
        $token = isset($_GET['oauth_token']) ? $_GET['oauth_token'] : '';
        $verifier = isset($_GET['oauth_verifier']) ? $_GET['oauth_verifier'] : '';

        if($token && $verifier) {
            $etsy = $this->get_etsy();
            $token_credentials = $etsy->getTokenCredentials($temp_cred, $token, $verifier);
            $access_key = $token_credentials->getIdentifier();
            $access_secret = $token_credentials->getSecret();

            $setup_data = array(
                'access_key' => $access_key,
                'access_secret' => $access_secret,
            );

            update_option('access_key_secret', $setup_data);
            update_option('is_etsy_authorized', 'yes');

            if($setup_data!=null){
                return true;
            }else{
                return false;
            }

        }
    }

    /**
     * get all product
     * @since 1.0.0
     * @return int[]|WP_Post[]
     */
    public function get_all_products(){
        $product_ids = get_posts(array(
            'post_type' => array('product', 'variation'),
            'numberposts' => -1,
            'post_status' => 'publish',
            'fields' => 'ids',
        ));
        return $product_ids;
    }
}