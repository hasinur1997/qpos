<?php
namespace Hasinur\Qpos;

/**
 * Scripts and Styles Class
 */
class Assets {

    function __construct() {

        if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', [ $this, 'register' ], 5 );
        } else {
            add_action( 'qpos_enqueue_scripts', [ $this, 'register' ], 5 );
        }
    }

    /**
     * Register our app scripts and styles
     *
     * @return void
     */
    public function register() {
        $this->register_scripts( $this->get_scripts() );
        $this->register_styles( $this->get_styles() );
        $this->enqueue_all_scripts();
        $this->register_localize();
    }

    /**
     * Register scripts
     *
     * @param  array $scripts
     *
     * @return void
     */
    private function register_scripts( $scripts ) {
        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
            $version   = isset( $script['version'] ) ? $script['version'] : WEPOS_VERSION;

            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
        }
    }

    /**
     * Register styles
     *
     * @param  array $styles
     *
     * @return void
     */
    public function register_styles( $styles ) {
        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, QPOS_VERSION );
        }
    }

    /**
     * Get all registered scripts
     *
     * @return array
     */
    public function get_scripts() {
        global $wp_version;

        $prefix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        $dependency = [ 'jquery', 'wepos-i18n-jed' ];

        if ( version_compare( $wp_version, '5.0', '<' ) ) {
            $dependency[] = 'wepos-wp-hook';
        }

        if ( ! is_admin() ) {
            $dependency[] = 'wepos-wp-hook';
        }

        $scripts = [
            
            'qpos-frontend' => [
                'src'       => QPOS_ASSETS . '/js/frontend'. $prefix .'.js',
                'version'   => filemtime( QPOS_PATH . '/assets/js/frontend'. $prefix .'.js' ),
                'in_footer' => true
            ],
            'qpos-admin' => [
                'src'       => QPOS_ASSETS . '/js/admin'. $prefix .'.js',
                'version'   => filemtime( QPOS_PATH . '/assets/js/admin'. $prefix .'.js' ),
                'in_footer' => true
            ],
        ];

        return $scripts;
    }

    /**
     * Get registered styles
     *
     * @return array
     */
    public function get_styles() {
        $prefix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        $styles = [
            
        ];

        return $styles;
    }

    public function enqueue_all_scripts() {
        if ( ! is_admin() ) {
            // Enqueue all style

            // Load scripts            
            do_action( 'qpos_load_forntend_scripts' );

            wp_enqueue_script( 'qpos-frontend' );
        }
    }

    /**
     * Set localize script data
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_localize() {
        
    }

     /**
     * SPA Routes
     *
     * @return array
     */
    public function get_admin_routes() {
        $routes = array(
            array(
                'path'      => '/settings',
                'name'      => 'Settings',
                'component' => 'Settings'
            ),
        );

        return apply_filters( 'wepos_admin_routes', $routes );
    }
}