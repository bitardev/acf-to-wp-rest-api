<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ACF_To_WP_REST_API_Term' ) ) {
	class ACF_To_WP_REST_API_Term extends ACF_To_WP_REST_API_Base {

		public function register_routes( $routes ) {
			$routes["/acf/(?P<tax>[\w\-\_]+)/(?P<id>\d+)/{$this->type}"] = array(
				array( array( $this, 'get_fields_by_term' ), WP_JSON_Server::READABLE )
			);

			return $routes;
		}

		public function get_fields_by_term( $tax, $id ) {
			$object = new stdClass;
			
			$object->taxonomy = sanitize_title( $tax );
			$object->ID       = absint( $id );

			return $this->get_fields( NULL, $object );
		}

	}
}

new ACF_To_WP_REST_API_Term();