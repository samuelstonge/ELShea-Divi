<?php /* divi */

/**
 *	This will hide the Divi "Project" post type.
 *	Thanks to georgiee (https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080) for his improved solution.
 */
add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );
function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}

/*hide buttons for return to standard editor or default editor
founder here... https://www.peeayecreative.com/how-to-hide-the-gutenberg-and-standard-editor-buttons-in-divi/*/

/*hide the Return To Standard Editor button and adjust button left margin*/
add_action('admin_head', 'pa_hide_standard_editor_button');
function pa_hide_standard_editor_button() {

  echo '<style>
       .et-db #et-boc .et-l #et_pb_toggle_builder.et_pb_builder_is_used { display: none; }
       .et-db #et-boc .et-l #et_pb_fb_cta { margin-left: 0; }
    </style>';
}
/*hide the Return To Default Editor button nad hide the Use Default Editor button*/
add_action('admin_head', 'pa_hide_default_editor_button');
function pa_hide_default_editor_button() {

  echo '<style>
    .block-editor__container .editor-post-switch-to-gutenberg.components-button.is-default {display: none; }
    .block-editor__container #et-switch-to-gutenberg, .block-editor__container #et-switch-to-gutenberg.components-button.is-default {   display: none; }
  </style>';
}

/* include products in the search results */
function custom_remove_default_et_pb_custom_search() {
	remove_action( 'pre_get_posts', 'et_pb_custom_search' );
	add_action( 'pre_get_posts', 'custom_et_pb_custom_search' );
}
add_action( 'wp_loaded', 'custom_remove_default_et_pb_custom_search' );

function custom_et_pb_custom_search( $query = false ) {
	if ( is_admin() || ! is_a( $query, 'WP_Query' ) || ! $query->is_search ) {
		return;
	}

	if ( isset( $_GET['et_pb_searchform_submit'] ) ) {
		$postTypes = array();

		if ( ! isset($_GET['et_pb_include_posts'] ) && ! isset( $_GET['et_pb_include_pages'] ) ) {
            $postTypes = array( 'post' );
        }

		if ( isset( $_GET['et_pb_include_pages'] ) ) {
            $postTypes = array( 'page' );
        }

		if ( isset( $_GET['et_pb_include_posts'] ) ) {
            $postTypes[] = 'post';
        }

		/* BEGIN Add custom post types */
		$postTypes[] = 'product';
		/* END Add custom post types */

		$query->set( 'post_type', $postTypes );

		if ( ! empty( $_GET['et_pb_search_cat'] ) ) {
			$categories_array = explode( ',', $_GET['et_pb_search_cat'] );
			$query->set( 'category__not_in', $categories_array );
		}

		if ( isset( $_GET['et-posts-count'] ) ) {
			$query->set( 'posts_per_page', (int) $_GET['et-posts-count'] );
		}
	}
}
