<?php
namespace Hasinur\Qpos;

/**
 * Frontend pages handler.
 */
class Frontend {
    /**
     * Constructor for Frontend class
     *
     * @return  void
     */
    public function __construct() {
        add_action( 'template_redirect', [ $this, 'template_rewrite' ] );
        add_action( 'wp_head', [ $this, 'reset_style' ], 7 );
        add_action( 'wp_head', [ $this, 'reset_script' ], 8 );
        add_action( 'wp_head', [ $this, 'enqueue_scripts' ], 999 );
        add_action( 'qpos_footer', [ $this, 'wp_print_footer_scripts' ], 20 );
    }

    public function reset_style() {
        if ( qpos_is_frontend() ) {
            $wp_styles = wp_styles();
            $wp_styles->queue = [];
        }
    }

    public function reset_script() {
        if ( qpos_is_frontend() ) {
            $wp_scripts = wp_scripts();
            $wp_scripts->queue = [];
        }
    }

    public function enqueue_scripts() {
        if ( qpos_is_frontend() ) {
            do_action( 'qpos_enqueue_scripts' );
        }
    }

    public function wp_print_footer_scripts() {
        do_action( 'wp_print_footer_scripts' );
    }

    /**
     * Template rewrite
     *
     * @return  void
     */
    public function template_rewrite() {
        if ( wp_validate_boolean( get_query_var( 'qpos' ) ) ) {
            include_once QPOS_PATH . '/templates/qpos.php';
            exit;
        }
    }
}