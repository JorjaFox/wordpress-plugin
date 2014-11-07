<?php
/*
Plugin Name: Remove Stopwords
Plugin URI:  http://halfelf.org
Description: Removes Stopwords
Version: 1.0

Stolen from Yoast's WordPress SEO.

*/

add_filter( 'name_save_pre', 'remove_stopwords_from_slug', 0 );

function remove_stopwords_from_slug( $slug ) {
	// Don't change an existing slug
	if ( isset( $slug ) && $slug !== '' ) {
		return $slug;
	}

	if ( ! isset( $_POST['post_title'] ) ) {
		return $slug;
	}

	// Lowercase the slug and strip slashes
	$clean_slug = sanitize_title( stripslashes( $_POST['post_title'] ) );

	// Turn it to an array and strip stopwords by comparing against an array of stopwords
	$clean_slug_array = array_diff( explode( '-', $clean_slug ), stopwords() );

	// Turn the sanitized array into a string
	$clean_slug = join( '-', $clean_slug_array );

	return $clean_slug;
}

/**
 * Returns the stopwords for the current language
 *
 * @since 1.1.7
 *
 * @return array $stopwords array of stop words to check and / or remove from slug
 */
function stopwords() {
	/* translators: this should be an array of stopwords for your language, separated by comma's. */
	$stopwords = explode( ',', __( "a,about,above,after,again,against,all,am,an,and,any,are,aren't,as,at,be,because,been,before,being,below,between,both,but,by,can't,cannot,could,couldn't,did,didn't,do,does,doesn't,doing,don't,down,during,each,few,for,from,further,had,hadn't,has,hasn't,have,haven't,having,he,he'd,he'll,he's,her,here,here's,hers,herself,him,himself,his,how,how's,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,itself,let's,me,more,most,mustn't,my,myself,no,nor,not,of,off,on,once,only,or,other,ought,our,ours,ourselves,out,over,own,same,shan't,she,she'd,she'll,she's,should,shouldn't,so,some,such,than,that,that's,the,their,theirs,them,themselves,then,there,there's,these,they,they'd,they'll,they're,they've,this,those,through,to,too,under,until,up,very,was,wasn't,we,we'd,we'll,we're,we've,were,weren't,what,what's,when,when's,where,where's,which,while,who,who's,whom,why,why's,with,won't,would,wouldn't,you,you'd,you'll,you're,you've,your,yours,yourself,yourselves", 'helf-stopwords' ) );

	/**
	 * Allows filtering of the stop words list
	 * Especially useful for users on a language in which WPSEO is not available yet
	 * and/or users who want to turn off stop word filtering
	 * @api  array  $stopwords  Array of all lowercase stopwords to check and/or remove from slug
	 */
	// $stopwords = apply_filters( 'wpseo_stopwords', $stopwords );

	return $stopwords;
}


/**
 * Check whether the stopword appears in the string
 *
 * @param string $haystack    The string to be checked for the stopword
 * @param bool   $checkingUrl Whether or not we're checking a URL
 *
 * @return bool|mixed
 */
function stopwords_check( $haystack, $checkingUrl = false ) {
	$stopWords = stopwords();

	if ( is_array( $stopWords ) && $stopWords !== array() ) {
		foreach ( $stopWords as $stopWord ) {
			// If checking a URL remove the single quotes
			if ( $checkingUrl ) {
				$stopWord = str_replace( "'", '', $stopWord );
			}

			// Check whether the stopword appears as a whole word
			// @todo [JRF => whomever] check whether the use of \b (=word boundary) would be more efficient ;-)
			$res = preg_match( "`(^|[ \n\r\t\.,'\(\)\"\+;!?:])" . preg_quote( $stopWord, '`' ) . "($|[ \n\r\t\.,'\(\)\"\+;!?:])`iu", $haystack, $match );
			if ( $res > 0 ) {
				return $stopWord;
			}
		}
	}

	return false;
}
