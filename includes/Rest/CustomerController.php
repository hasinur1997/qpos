<?php
/**
 * Customer Controller API
 *
 * @package qpos
 */
namespace Hasinur\Qpos\Rest;

use WC_REST_Customers_Controller;
use WP_REST_Server;

/**
 * Customer Controller API Class
 */
class CustomerController extends WC_REST_Customers_Controller {
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
    protected $base = 'customers';

    /**
     * Register the routes for the customers.
     *
     * @return  void
     */
    public function register_routes() {
        register_rest_route( $this->namespace, '/' . $this->base, [
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [ $this, 'create_customer' ],
                'permission_callback' => [$this, 'permission_check'],
                'args'                => $this->get_collection_params(),
            ],
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [ $this, 'get_customers' ],
                'permission_callback' => [$this, 'permission_check'],
                'args'                => $this->get_collection_params(),
            ],
            'schema' => [$this, 'get_public_item_schema'],
        ] );
    }

    public function permission_check() {
        return true;
    }

    /**
     * Create customer
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  \WP_Error | WP_Response
     */
    public function create_customer( $request ) {
        return $this->create_item( $request );
    }

    /**
     * Get Customers
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  \WP_Error | WP_Response
     */
    public function get_customers( $request ) {
        return $this->get_items( $request );
    }
}