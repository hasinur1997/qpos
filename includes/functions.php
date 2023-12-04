<?php
/**
 * Qpos footer
 *
 * @return  void
 */
function qpos_footer() {
    do_action( 'qpos_footer' );
}

/**
 * Detect current page is qpos frontend
 *
 * @return  bool
 */
function qpos_is_frontend() {
    if ( wp_validate_boolean( get_query_var( 'qpos' ) ) ) {
        return true;
    }

    return false;
}