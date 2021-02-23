<?php
namespace listing_product;
/**
 * Class Listing_product
 * @package listing_product
 */

class Listing_product{

    /**
     * prepare listing for sending image
     * @param $product_id
     * @param $listing_id
     * @return array
     * @since 1.0.0
     */
    public function get_image_for_listing($product_id){
        $product = wc_get_product($product_id);
        $image_id = $product->get_image_id();
        $image_listing = array(
            'image'=>$this->scaled_image_path($image_id),
            'mimetype'=>get_post_mime_type($image_id),

        );
        return $image_listing;
    }

    /**
     * get listing for update product
     * @param $listing_id
     * @param $product_id
     * @return array
     * since 1.0.0
     */
    public function get_put_listings( $listing_id, $product_id,$other_val){

        $who_made = $other_val[0]['who_made'];
        $when_made = $other_val[0]['when_made'];
        $shipping_id = $other_val[0]['shipping_id'];
        $texonomy_id = $other_val[0]['texonomy_id'];

        //get product details
        $product = wc_get_product($product_id);

        $product_title = $product->get_title();
        $product_quantity = $product->get_stock_quantity();
        $product_description = $product->get_description();
        $product_price = $product->get_price();

        $array_val = array(
            'listing_id' => $listing_id,
            'title' => $product_title?$product_title:'no tttile',
            'description' => $product_description?$product_description:'no description',
            'who_made' => $who_made,
            'when_made' => $when_made,
            'is_supply' => true,
            'taxonomy_id' => $texonomy_id?$texonomy_id:45,
            'state' => 'draft',
            'shipping_template_id' => $shipping_id?$shipping_id:'119320778328'
        );
       return $array_val;
    }

    /**
     * prepare listing for send product
     * @param $id
     * @return array
     * @since 1.0.0
     */
    public function get_post_listings($id,$other_val){
        $who_made = $other_val[0]['who_made'];
        $when_made = $other_val[0]['when_made'];
        $shipping_id = $other_val[0]['shipping_id'];
        $texonomy_id = $other_val[0]['texonomy_id'];

        $product = wc_get_product($id);
        $product_title = $product->get_title();
        $product_quantity = $product->get_stock_quantity();
        $product_description = $product->get_description();
        $product_price = $product->get_price();

        $array_val = array(
            'quantity' => $product_quantity?$product_quantity:'1',
            'title' => $product_title?$product_title:'no tttile',
            'description' => $product_description?$product_description:'no description',
            'price' => $product_price?$product_price:1.1,
            'who_made' => $who_made,
            'when_made' => $when_made,
            'is_supply' => true,
            'taxonomy_id' => $texonomy_id?$texonomy_id:45,
            'state' => 'draft',
            'shipping_template_id' => $shipping_id?$shipping_id:'119320778328'
        );

        return $array_val;
    }

    /**
     * get image path
     * @param $attachment_id
     * @param string $size
     * @return false|string
     * @since 1.0.0
     */
    function scaled_image_path($attachment_id, $size = 'thumbnail') {
        $file = get_attached_file($attachment_id, true);
        if (empty($size) || $size === 'full') {
            // for the original size get_attached_file is fine
            return realpath($file);
        }
        if (! wp_attachment_is_image($attachment_id) ) {
            return false; // the id is not referring to a media
        }
        $info = image_get_intermediate_size($attachment_id, $size);
        if (!is_array($info) || ! isset($info['file'])) {
            return false; // probably a bad size argument
        }
        return realpath(str_replace(wp_basename($file), $info['file'], $file));
    }

}