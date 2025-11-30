<?php

/*----------------------------------------------------------
  <p>削除
----------------------------------------------------------*/

add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
}

/*----------------------------------------------------------
  郵便番号バリデーション
----------------------------------------------------------*/

add_filter( 'wpcf7_validate_text*', 'validate_zipcode', 10, 2 );
function validate_zipcode( $result, $tag ) {
  if ( $tag->name == 'zipcode' ) { // zipcode = name
    $value = str_replace( ' ', '', $result['value'] );
    if ( ! preg_match( '/^\d{3}-\d{4}$/', $value ) ) {
      $result->invalidate( $tag, '郵便番号は 123-4567 の形式で入力してください。' );
    }
  }
  return $result;
}

?>