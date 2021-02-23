<?php
namespace admin_notice;
/**
 * Class Admin_notice
 * @package admin_notice
 */
class Admin_notice{

    /**
     * get current page anem
     * @since 1.0.0
     */
    public function get_page_name(){
        $get_page = get_current_screen();
        return $get_page->id;
    }

    /**
     * @return false|mixed|void
     * since 1.0.0
     *
     */
    public function get_notice_status(){
        $remove_notice = get_option('remove_notice');
        return $remove_notice;
    }

    /**
     * wp success admin notice
     * @since 1.0.0
     */
    public function sample_admin_notice__success() {
        if($this->get_page_name()=='etsy-feed_page_etsy-api-settings'){
            if($this->get_notice_status()!=='remove_notice'){
                ?>
                <div class="notice notice-success is-dismissible remove_notice" style="height: 70px;padding:10px" id="remove_all_notice">
                    <p style="font-size: 17px"><?php _e( 'All products have sent successfully!', 'sample-text-domain' ); ?>
                        <br>
                        <button id="remove_notice" style="color: red;font-size: 15px">No Thank's (it's mendatory)</button>
                </div>
                <?php
            }
        }
    }

    /**
     * WP product sending background admin notice
     * @since 1.0.0
     */
    public function sample_admin_notice__sending() {
        if($this->get_page_name()=='etsy-feed_page_etsy-api-settings'){
            if($this->get_notice_status()!=='remove_notice'){
                ?>

                <div class="notice notice-success is-dismissible" style="height:70px;padding: 10px" id="remove_all_notice">
                    <p style="font-size: 15px"><?php _e( 'Product is sending on background please wait..', 'sample-text-domain' ); ?></p>
                </div>
                <?php
            }
        }
    }

    /**
     * WP sending admin notice exact error
     * @since 1.0.0
     */
    public function sample_admin_notice__error() {
        if($this->get_page_name()=='etsy-feed_page_etsy-api-settings'){
            if($this->get_notice_status()!=='remove_notice'){
                $sending_status = get_option('sending_status');
                ?>
                <div class="notice notice-success is-dismissible" style="height:70px;padding: 10px" id="remove_all_notice">
                    <p style="font-size: 15px;color:red"><?php _e( $sending_status.'. product not send successfully.Clear batch, put correct information and try again!!', 'sample-text-domain' ); ?></p>
                </div>
                <?php
            }
        }
    }

    /**
     * WP product sending failed notice
     * @since 1.0.0
     */
    public function sample_admin_notice__sending_error() {
        if($this->get_page_name()=='etsy-feed_page_etsy-api-settings'){
            if($this->get_notice_status()!=='remove_notice'){
                $sending_status = get_option('sending_status');
                ?>
                <div class="notice notice-success is-dismissible remove_all_notice" style="height:70px;padding: 10px" id="remove_notice">
                    <p style="font-size: 15px;color: red"><?php _e( $sending_status.'. product send failed please try again', 'sample-text-domain' ); ?></p>
                </div>
                <?php
            }
        }

    }


    /**
     * WP sending admin notice for conflict with listing price
     * @since 1.0.0
     */
    public function sample_admin_notice__listing_price_conflict() {
        if($this->get_page_name()=='etsy-feed_page_etsy-api-settings'){
            if($this->get_notice_status()!=='remove_notice'){
                ?>
                <div class="notice notice-success is-dismissible remove_all_notice" style="height:70px;padding: 10px" id="remove_notice">
                    <p style="font-size: 15px;color: red"><?php _e( 'Product price should not less than listing price', 'sample-text-domain' ); ?></p>
                </div>
                <?php
            }
        }

    }
}