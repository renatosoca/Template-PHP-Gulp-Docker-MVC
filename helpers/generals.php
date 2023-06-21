<?php

function debugging( $variable ): void {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;
}

function ste( $element ): string {
  return $sanitize = htmlspecialchars( $element );
}

function messageError( $message ): string {
  echo "<div style='color: red;' >$message</div>";
  return $message;
};