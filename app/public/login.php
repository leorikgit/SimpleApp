<?php
include_once __DIR__."../../core/ini.php";

use Utility\Input;
use Utility\Token;
use Validation\Validation;
use Utility\Redirect;
use Session\Session;
use Config\Config;

$validation = new Validation($conn);
if(Input::exist('POST') && Input::get('login')){

    if(Token::check(Input::get('token'))){
        $input = [];
        $input['email'] = $_POST['email'];
        $input['password'] = $_POST['password'];
        foreach ($input as $key => $value){
            $input[$key] = sanitaze($value);
        }


        $validation->check($input, array(
            'email' => array(
                'required' => true,

            ),
            'password' => array(
                'required' => true
            )
        ));
        if($validation->passed()) {
            $user = $userService->login($input['email'], $input['password']);

            if ($user) {
                Redirect::to('index.php');
            }

        }


    }
}
$page_title = Config::get('login_page/title');
include_once ROOT_PATH."includes/header.php";

?>
<div id="background">
    <div id="registerContainer">
        <div id="inputContainer">
            <h1>Login</h1>
            <div id="newAccountFlashMessage"><h2><?php echo Session::flash('success')?></h2></div>
            <form method="POST" action="<?php echo BASE_URL."login.php"?>">
                <p>
                    <span class="validationError"><?php echo $validation->getError('email')? $validation->getError('email'):''?></span>
                    <label for="email">Email</label>
                    <input type="Email" value="<?php echo Input::get('email')?>" name="email" id="email" placeholder="e.g vidavi@gmail.com">
                </p>
                <p>
                    <span class="validationError"><?php echo $validation->getError('password')? $validation->getError('password'):''?></span>

                    <label for="password">Password</label>
                    <input type="password" value="" name="password" id="password" placeholder="Yout password">
                </p>
                <input type="hidden" name="token" value="<?php echo Token::tokenForm()?>">
                <button type="submit" name="login" value="login">Submit</button>
            </form>
            <div id="hasAccountText">
                <a href="<?php echo BASE_URL."login.php" ?>">Already have an account? Log in here.</a>
            </div>
        </div>
        <div id="registerText">
            <h1>Get great music, right now</h1>
            <h2>Listen to loads of songs for free.</h2>
            <ul>
                <li>Discover music you'll fall in love with</li>
                <li>Create your own playlists</li>
                <li>Follow artists to keep up to date</li>
            </ul>
        </div>

    </div>

</div>
<?php include_once ROOT_PATH."includes/footer.php";?>
