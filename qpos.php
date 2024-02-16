<?php
/*
 * Plugin Name:       QPos
 * Plugin URI:        https://github.com/hasinur1997
 * Description:       A point sale plugin for woocommerce
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hasinur Rahman
 * Author URI:        https://github.com/hasinur1997
 * License:           GPL v2 or later
 * License URI:       https://github.com/hasinur1997
 * Update URI:        https://github.com/hasinur1997
 * Text Domain:       qpos
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Qpos Class
 *
 * @class Qpos The class that holds the entire Qpos plugin
 */
final class Qpos {
    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Holds various class instance
     *
     * @var array
     */
    private $container = [];

    /**
     * Constructor for the Qpos class
     *
     * @return
     */
    public function __construct() {
        $this->define_constants();

        add_action( 'init', [$this, 'add_rewrite_rules'] );

        add_filter( 'query_vars', [$this, 'register_query_var'] );

        add_action( 'woocommerce_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Magic gettter to bypass referencing plugin.
     *
     * @param   string  $prop
     *
     * @return  mixed
     */
    public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[$prop];
        }

        return $this->{$prop};
    }

    /**
     * Initialize the Qpos class
     *
     * @return  \Qpos
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define constants
     *
     * @return  void
     */
    public function define_constants() {
        define( 'QPOS_VERSION', $this->version );
        define( 'QPOS_FILE', __FILE__ );
        define( 'QPOS_PATH', dirname( QPOS_FILE ) );
        define( 'QPOS_INCLUDES', QPOS_PATH . '/includes' );
        define( 'QPOS_URL', plugins_url( '', QPOS_FILE ) );
        define( 'QPOS_ASSETS', QPOS_URL . '/assets' );
    }

    /**
     * Add the required rewrite rules
     *
     * @return  void
     */
    public function add_rewrite_rules() {
        add_rewrite_rule( 'qpos/?$', 'index.php?qpos=true', 'top' );

        flush_rewrite_rules( true );
    }

    public function init_plugin() {
        $this->init_hooks();
        $this->includes();
    }

    public function init_hooks() {
        add_action( 'init', [$this, 'init_classes'] );
    }

    public function init_classes() {
        $this->container['frontend'] = new \Hasinur\Qpos\Frontend;
        $this->container['rest']     = new \Hasinur\Qpos\Rest\Manager();
        $this->container['gateways'] = new \Hasinur\Qpos\Gateways\Manager();
    }

    public function includes() {
        require_once QPOS_INCLUDES . '/functions.php';
    }

    /**
     * Register our query vars
     *
     * @param   array  $vars
     *
     * @return  array
     */
    public function register_query_var( $vars ) {
        $vars[] = 'qpos';

        return $vars;
    }
}

function qpos() {
    return Qpos::init();
}

// Kick off plugin.
qpos();