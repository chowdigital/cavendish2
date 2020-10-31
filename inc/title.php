<h1 id="main-title">
	<?php
		if ( is_day() ) 
			printf( __( 'Daily Archives: %s', 'newcavendish' ), get_the_date() );
		elseif ( is_month() ) 
			printf( __( 'Monthly Archives: %s', 'newcavendish' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'newcavendish' ) ) );
		elseif ( is_year() ) 
			printf( __( 'Yearly Archives: %s', 'newcavendish' ), get_the_date( _x( 'Y', 'yearly archives date format', 'newcavendish' ) ) );
		elseif (is_category())
			printf( __( 'Category Archives: %s', 'newcavendish' ), single_cat_title( '', false ) ); 
		elseif( is_tag() )
			printf( __( 'Tag Archives: %s', 'newcavendish' ), single_tag_title( '', false ) );
		elseif( is_tax()) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			echo $term->taxonomy.': '.$term->name;
		} elseif (is_author()) {
			the_post();
			printf( __( 'All posts by %s', 'newcavendish' ), get_the_author() );
			$author_description = get_the_author_meta( 'description' );
			rewind_posts();
		} elseif (is_post_type_archive())
			post_type_archive_title();
		elseif (is_search())
			printf( __( 'Search Results for: %s', 'newcavendish' ), get_search_query() );
		elseif (is_archive())
			_e("Archives");
		elseif (is_404())
			_e( 'Not Found', 'newcavendish' );
		elseif (!is_home())
			echo _x('Posts','post type general name');
	?>
</h1>
<?php
	$term_description = term_description();
	if ( ! empty( $term_description ) ) echo '<div class="taxonomy-description">'.$term_description.'</div>';
	if ( ! empty( $author_description ) ) echo '<div class="author-description">'.$author_description.'</div>';
?>