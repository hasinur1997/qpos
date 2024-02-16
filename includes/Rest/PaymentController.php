<?php
/**
 * Payment Controller
 *
 * @package qpos
 */
namespace Hasinur\Qpos\Rest;

use WC_REST_Orders_Controller;
use WP_Error;
use WP_REST_Server;

/**
 * Payment Controller Class
 */
class PaymentController extends WC_REST_Orders_Controller {
    /**
     * Endpoint namespace
     *
     * @var string
     */
    protected $namespace = 'qpos/v1';

    /**
     * Route name
     *
     * @var string
     */
    protected $base = 'payment';

    /**
     * Rest route
     *
     * @return  void
     */
    public function register_routes() {
        register_rest_route( $this->namespace, '/' . $this->base . '/getways', [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_available_gateway'],
                'permission_callback' => '__return_true',
                'args'                => $this->get_collection_params(),
            ],
        ] );

        register_rest_route( $this->namespace, '/' . $this->base . '/process', [
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'process_payment'],
                'permission_callback' => [$this, 'permission_check'],
            ],
        ] );
    }

    /**
     * Process payment permission callback
     *
     * @return  bool|WP_Error
     */
    public function permission_check() {
        return true;
    }

    /**
     * Get avaialble gatewyas
     *
     * @since 1.0.0
     *
     * @return  \WP_Error | \WP_Rest_Response | \WP_HTTP_Response
     */
    public function get_available_gateway( $request ) {
        $available_gateways = qpos()->gateways->get_available_gateway();

        $gatewyas = [];

        foreach($available_gateways as $gateway ) {
            $gatewyas[] = new $gateway();
        }

        return rest_ensure_response( $gatewyas );
    }

    /**
     * Return calculate order data
     *
     * @since 1.0.0
     *
     * @return  \WP_Error | \WP_Rest_Response | \WP_HTTP_Response
     */
    public function process_payment( $request ) {
        $order_id           = ! empty( $request['id'] ) ? intval( $request['id'] ) : 0;
        $payment_method     = ! empty( $request['payment_method'] ) ? sanitize_text_field( $request['payment_method'] ) : '';

        if ( ! $order_id ) {
            return new WP_Error( 'no-order-id', __( 'No order found', 'qpos' ), ['status' => 401] );
        }

        if ( ! wc_get_order( $order_id) ) {
            return new WP_Error( 'no-order', __( 'Invalid order id', 'qpos' ), ['status' => 401] );
        }

        $choosen_method = qpos()->gateways->get_payment_method( $payment_method );

        if ( is_wp_error( $choosen_method ) ) {
            return $choosen_method;
        }

        $process_payment = $choosen_method->process_payment( $order_id );

        return rest_ensure_response( $process_payment );
    }
}
