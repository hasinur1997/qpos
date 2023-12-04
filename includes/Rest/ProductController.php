<?php
/**
 * Product API Controller
 * 
 * @package Qpos
 */
namespace Hasinur\Qpos\Rest;

/**
 * Product Controller Class
 */
class ProductController extends \WC_REST_Products_Controller {
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
    protected $base = 'products';

    /**
     * Register the routes for products
     *
     * @return  void
     */
    public function register_routes() {
        register_rest_route( $this->namespace, '/' . $this->base, [
            [
                'methods'   => \WP_REST_Server::READABLE,
                'callback'  => [ $this, 'get_products' ],
                'permission_callback' => [ $this, 'get_product_permissions_check' ],
                'args'  => $this->get_collection_params(),
            ],
            'schema' => array( $this, 'get_item_schema' ),
        ]);
    }

    /**
     * Get product permission checking
     *
     * @return  bool
     */
    public function get_product_permissions_check() {
        return true;
    }

    /**
     * Get products
     *
     * @param   [type]  $request  [$request description]
     *
     * @return  \WP_Error|\WP_REST_Response
     */
    public function get_products( $request ) {
        return $this->get_items( $request );
    }
}