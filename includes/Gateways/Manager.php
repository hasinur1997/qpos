<?php
/**
 * Gateway Manager Class
 * 
 * @package qpos
 */
namespace Hasinur\Qpos\Gateways;

use Exception;
use WP_Error;

class Manager {
    /**
     * Constructor for Manager Class
     *
     * @return  void
     */
    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init_gateways' ], 11, 1 );

        add_action( 'woocommerce_payment_gateways', [ $this, 'payment_gateways' ] );
    }

    public function init_gateways() {

    }
    
    /**
     * Add QPOS Gateways
     *
     * @param   array  $gateways
     *
     * @return  array
     */
    public function payment_gateways( $gateways ) {
        $avaible_gateway = $this->get_available_gateway();

        return array_merge( $gateways, $avaible_gateway );
    }

    /**
     * Available Gateway
     *
     * @return  array
     */
    public function get_available_gateway() {
        return [
           'qpos_cash' => Cash::class,
        ];
    }

    /**
     * Get payment method
     *
     * @return  \WC_Payment_Gateway
     */
    public function get_payment_method( $payment_method_id ) {
        $avaible_gateways = $this->get_available_gateway();

        if (  empty( $avaible_gateways[$payment_method_id] ) ) {
            return new WP_Error( __( 'No payment method found', 'qpos' ), ['status' => 401] );
        }

        return new $avaible_gateways[$payment_method_id];
    }
}
