<?php
/**
 * Rest API Manager Class
 * 
 * @package Qpos
 */
namespace Hasinur\Qpos\Rest;

/**
 * Rest Manager Handler
 */
class Manager {
    /**
     * Store classes
     *
     * @var array
     */
    protected $classes;

    /**
     * Constructor for Manager Class
     *
     * @return  void
     */
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }

    public function get_classes() {
        return [
            ProductController::class,
            CustomerController::class,
            PaymentController::class,
        ];
    }

    public function register_routes() {
        $classes = $this->get_classes();

        foreach ( $classes as $class ) {
            $controller = new $class();
            $controller->register_routes();
        }
    }
}