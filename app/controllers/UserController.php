<?php
namespace App\Controllers;

use App\Core\Router;
use App\Models\User;
use App\Utils\Email;

class UserController {

  public static function index() {
    echo 'controller index';
    $user = User::findById('1');

    Router::render('pages/index', 'layout', [
      'title' => 'Home',
      'user' => $user
    ]);

    exit;
  }

  public static function register( $token = '') {
    echo 'controller register';

    $mail = new Email(
      'example@example.com',
      'example',
      'example lastname',
      '13erewrdsf91283fksjri2u23478sdk'
    );
    $response = $mail->SendMail(
      'example',
      'Example Mail',
      'Register',
      $_ENV['HOST'] . '/function/'
    );

    if ($response) echo '<div>email sent</div>';
    else echo '<div>email not sent</div>';

    Router::render('pages/register', 'layout', [
      'title' => 'register'
    ]);

    exit;
  }
}

?>