<?php

class EPA_Test_Base extends WP_UnitTestCase {

	/**
	 * Prevents weird MySQLi error.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		self::$ignore_files = true;
	}

	/**
	 * Helps us keep track of actions that have fired
	 *
	 * @var array
	 * @since 1.0
	 */
	protected $fired_actions = array();

	/**
	 * Helps us keep track of applied filters
	 *
	 * @var array
	 * @since 1.0
	 */
	protected $applied_filters = array();

	/**
	 * Helper function to test whether a sync has happened
	 *
	 * @since 1.0
	 */
	public function action_sync_on_transition() {
		$this->fired_actions['epa_sync_on_transition'] = true;
	}

	/**
	 * Helper function to test whether a post has been deleted off ES
	 *
	 * @since 1.0
	 */
	public function action_delete_post() {
		$this->fired_actions['epa_delete_post'] = true;
	}

	/**
	 * Helper function to test whether a EP search has happened
	 *
	 * @since 1.0
	 */
	public function action_wp_query_search() {
		$this->fired_actions['epa_wp_query_search'] = true;
	}

	/**
	 * Helper function to check post sync args
	 *
	 * @since 1.0
	 */
	public function filter_post_sync_args( $post_args ) {
		$this->applied_filters['epa_post_sync_args'] = $post_args;

		return $post_args;
	}

	/**
	 * Setup a post type for testing
	 *
	 * @since 1.0
	 */
	public function setup_test_post_type() {
		$args = array(
			'public' => true,
			'taxonomies' => array( 'post_tag', 'category' ),
		);

		register_post_type( 'epa_test', $args );
	}
}