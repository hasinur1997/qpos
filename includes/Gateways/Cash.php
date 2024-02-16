<?php
/**
 * Cash Payment Gateway
 *
 * @package qpos
 */
namespace Hasinur\Qpos\Gateways;

use WC_Payment_Gateway;

/**
 * Cash gateway payment for QPOS
 */
class Cash extends WC_Payment_Gateway {
    /**
     * Store instructions
     *
     * @var string
     */
    private $instructions;

    /**
     * Store methods
     *
     * @var string
     */
    private $enable_for_methods;

    /**
     * Store enable for virtual
     *
     * @var string
     */
    private $enable_for_virtual;

    /**
     * Constructor for the gateway
     *
     * @return  void
     */
    public function __construct() {
        $this->setup_properties();

        $this->init_form_fields();

        $this->init_settings();

        $this->title = $this->get_option( 'title' );
        $this->description = $this->get_option( 'description' );
        $this->instructions = $this->get_option( 'instructions' );

        $this->enable_for_methods = $this->get_option( 'enable_for_methods', array() );
        $this->enable_for_virtual = $this->get_option( 'enable_for_virtual', 'yes' ) === 'yes';

        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );

    }

    /**
     * Setup general properties for the gateway
     *
     * @return  void
     */
    protected function setup_properties() {
        $this->id                 = 'qpos_cash';
        $this->icon               = '';
        $this->method_title       = __( 'Qpos Cash', 'qpos' );
        $this->method_description = __( 'Have your customers pay with cash', 'qpos' );
        $this->has_fields         = false;
    }

    /**
     * Initialize Gateway Settings Form Fields.
     *
     * @return  void
     */
    public function init_form_fields() {
        $this->form_fields = [
            'enabled'     => [
                'title'       => __( 'Enable/Disable', 'qpos' ),
                'label'       => __( 'Enable cash gateway', 'qpos' ),
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'yes',
            ],
            'title'       => [
                'title'       => __( 'Title', 'qpos' ),
                'type'        => 'text',
                'description' => __( 'Payment method description that the marchent see in pos checkout', 'qpos' ),
                'default'     => __( 'Cash', 'qpos' ),
                'desc_tip'    => true,
            ],
            'description' => [
                'title'       => __( 'Description', 'qpos' ),
                'type'        => 'textarea',
                'description' => __( 'Payment method description that the marchent see in pos checkout', 'qpos' ),
                'default'     => __( 'Pay with cash', 'qpos' ),
            ],
        ];
    }

    /**
     * Check if the gateway available for use
     *
     * @return  bool
     */
    public function is_available() {
        $order = null;
        $needs_shipping = false;

        if ( is_page( wc_get_page_id( 'checkout' ) ) ) {
            return true;
        }

        return parent::is_available();
    }

    /**
     * Process the payment and return the result
     *
     * @param   int  $order_id  [$order_id description]
     *
     * @return  array
     */
    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );

        $order->payment_complete();

        $order->update_status( 'completed', __( 'Payment collected via cash', 'qpos' ) );

        // $order->add_order_note(
        //     sprintf( __( 'Cash tendered amount: %s, Change amount: %s', 'qpos' ), $order->get_data( '_qpos_cash_tendered_amount', true ), $order->get_data( '_qpos_cash_change_amount', true ) ),
        // );

        $order->save();

        return [
            'result'    => 'success',
        ];
    }
}
