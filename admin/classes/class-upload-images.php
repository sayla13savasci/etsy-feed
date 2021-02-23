<?php
namespace upload_images;
/**
 * Class are used
 * @since 1.0.0
 */
use listing_product\Listing_product;
use upload_product\Upload_Product;

/**
 * Class Upload_images
 * @package upload_images
 * @since 1.0.0
 */
class Upload_images
{
    /**
     * @var
     * @since 1.0.0
     * get product listing class obj
     */
    protected $product_listing;

    /**
     * @var
     * @since 1.0.0
     * Get etsy authorization class obj
     */
    protected $etsy_authorization;

    /**
     * Upload_images constructor.
     * @since 1.0.0
     */
    public function __construct(){
        $this->product_listing = new Listing_product();
        $this->etsy_authorization = new \Etsy_Authorization();

    }

    /**
     * @param $selected_id
     * @param $listing_id
     * @throws \Etsy\Exception\ApiException
     * @throws \Etsy\Exception\RequestException
     * @since 1.0.0
     */
    public function insert_image($selected_id,$listing_id){
        $image_url =  $this->product_listing ->get_image_for_listing($selected_id);
        $image = $image_url['image'];
        if(!empty($image)){
            $listing_obj = $this->etsy_authorization->get_auth_etsy_class()->makeRequest('POST', '/listings/'.$listing_id.'/images', array(
                'image' => $image_url['image']
            ));
            if(array_key_exists('error', (array)$listing_obj)){
                update_option('sending_status',$listing_obj->error);
            }else{
                $listing_image_id = $listing_obj->results[0]->listing_image_id;
                update_post_meta($selected_id, '_listing_image_id', $listing_image_id);//save listing id for product
            }
        }

    }


    /**
     * @param $selected_id
     * @param $product_listing_id
     * @throws \Etsy\Exception\ApiException
     * @throws \Etsy\Exception\RequestException
     * @since 1.0.0
     */
    public function update_image($selected_id,$product_listing_id){
        $listing_image_id = get_post_meta($selected_id,'_listing_image_id',true);
        if(!empty($listing_image_id)){
            $listing_obj = $this->etsy_authorization->get_auth_etsy_class()->makeRequest('delete', '/listings/'.$product_listing_id.'/images/'.$listing_image_id);
            $image_url = $this->product_listing->get_image_for_listing($selected_id);
            $image = $image_url['image'];

            if(!empty($image)){
                $listing_obj = $this->etsy_authorization->get_auth_etsy_class()->makeRequest('POST', '/listings/'.$product_listing_id.'/images', array(
                    'image' => $image_url['image']
                ));
                $listing_image_id = $listing_obj->results[0]->listing_image_id;
                update_post_meta($selected_id, '_listing_image_id', $listing_image_id);//save listing id for product
            }
        }else{
            $image_url = $this->product_listing->get_image_for_listing($selected_id);
            $image = $image_url['image'];

            if(!empty($image)){
                $listing_obj = $this->etsy_authorization->get_auth_etsy_class()->makeRequest('POST', '/listings/'.$product_listing_id.'/images', array(
                    'image' => $image_url['image']
                ));
                $listing_image_id = $listing_obj->results[0]->listing_image_id;
                update_post_meta($selected_id, '_listing_image_id', $listing_image_id);//save listing id for product
            }
        }
    }

}