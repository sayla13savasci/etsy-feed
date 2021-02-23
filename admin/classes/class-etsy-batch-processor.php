<?php

use Google\Exception;
use listing_product\Listing_product;
use upload_product\Upload_Product;
use upload_images\Upload_images;

class WP_Etsy_Background_Process extends WP_Background_Process
{
    /**
     * @var array
     */
    public $listing_ids= array();


    /**
     * @var string
     */
    protected $action = 'send_product_process';


    /**
     * Task
     *
     * Override this method to perform any actions required on each
     * queue item. Return the modified item for further processing
     * in the next pass through. Or, return false to remove the
     * item from the queue.
     *
     * @param mixed $item Queue item to iterate over
     *
     * @return mixed
     */
    protected function task($selected_ids)
    {
        error_log("in task");
        error_log(print_r($selected_ids,1));


        $other_val = array();
        foreach ($selected_ids as $selected_id){
            if(is_array($selected_id)==TRUE)
            {
                array_push($other_val,$selected_id);
            }
        }

        $etsy_obj = new Etsy_Authorization();  //get etsy authorization obj
        $etsy2 = $etsy_obj->get_auth_etsy_class();//get etsy class
        $product_listings = new Listing_product();  //get listing object
        $upload_product_obj = new Upload_Product(); //get upload product object
        $upload_img_obj = new Upload_images();//create upload image obj

        foreach ($selected_ids as $selected_id){
            if(is_array($selected_id)==false){ //discard other val
                $product = wc_get_product($selected_id);
                $product_type = $product->get_type();
                $product_price = $product->get_price();

                if($product_type==='simple'||$product_type==='variation'||$product_type==='variable')//check product type
                {
                    if($product_price>=0.2){
                        $product_listing_id=get_post_meta($selected_id,'_product_listing_id',true);//get listing id for product
                        if(!empty($product_listing_id)){
                            $state = $upload_product_obj->get_listing_state( $product_listing_id );
                            if($state=='draft'){
                                error_log("in draft");
                                $put_listing_array = $product_listings->get_put_listings($product_listing_id,$selected_id,$other_val);
                                update_option('sending_status','sending_status_error');
                                $put_listing_obj = $upload_product_obj->update_product($etsy2,$put_listing_array);
                                update_option('sending_status','sending');
                                //send image
                                $upload_img_obj->update_image($selected_id,$product_listing_id);
                            }
                            elseif($state=='removed'){
                                error_log("in removed");
                                $post_listing_array = $product_listings->get_post_listings($selected_id,$other_val); //get listing array for post request
                                update_option('sending_status','sending_status_error');
                                $listing_obj=$upload_product_obj->insert_product($etsy2,$post_listing_array); //send data to etsy
                                update_option('sending_status','sending');

                                if(array_key_exists('error', (array)$listing_obj)){
                                    update_option('sending_status',$listing_obj->error);
                                    update_option('sending_status_error','sending_error');
                                }else{
                                    $listing_id=$listing_obj->results[0]->listing_id;//get listing id for each product
                                    update_post_meta($selected_id, '_product_listing_id', $listing_id);//save listing id for product
                                    $upload_img_obj->insert_image($selected_id,$listing_id);//insert image
                                }
                            }
                        }
                        else{
                            error_log("in insert");
                            $post_listing_array = $product_listings->get_post_listings($selected_id,$other_val);  //get listing array for post request
                            update_option('sending_status','sending_status_error');
                            $listing_obj=$upload_product_obj->insert_product($etsy2,$post_listing_array);//send data to etsy
                            update_option('sending_status','sending');

                            if(array_key_exists('error', (array)$listing_obj)){
                                update_option('sending_status',$listing_obj->error);
                                update_option('sending_status_error','sending_error');
                            }else{
                                $listing_id=$listing_obj->results[0]->listing_id; //get and save listing id for each product
                                update_post_meta($selected_id, '_product_listing_id', $listing_id);//save listing id for product
                                $upload_img_obj->insert_image($selected_id,$listing_id);//insert image
                            }


                        }
                    }
                    else{
                        update_option('sending_status','listing_price_conflict');
                    }
                }
            }
        }
        return false;
    }

    /**
     * Complete
     *
     * Override if applicable, but ensure that the below actions are
     * performed, or, call parent::complete().
     */
    protected function complete()
    {
        parent::complete();
        $sending_status = get_option('sending_status');
        if($sending_status == 'sending'){
            update_option("sending_status","completed");
            update_option('sending_status_error','no_error');
        }
    }
}

?>
