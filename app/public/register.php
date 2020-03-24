<?php
include __DIR__ .'../../core/ini.php';

use Config\Config;
use Utility\Input;
use Utility\Token;
use Validation\Validation;
use Session\Session;
use Utility\Redirect;

$validation = new Validation($conn);
if( Input::exist('post') && Input::get('register')){
    if(Token::check(Input::get('token'))){

        $input = array();
        $input['username'] = $_POST['username'];
        $input['password'] = $_POST['password'];
        $input['email'] = $_POST['email'];
        $input['password_again'] = $_POST['password_again'];
        foreach($input as $key =>$alue){
            $input[$key] = sanitaze($alue);
        }

        $validation->check($input, array(
            'username'=> array(
                'required' => true,
                'max'      => '30',
                'min'      => '6'
            ),
            'email'=> array(
                'required' => true,
                'email' => true,
                'unique' => 'users'

            ),
            'password'=> array(
                'required' => true,
                'max'      => '50',
                'min'      => '6'
            ),
            'password_again'=> array(
                'required' => true,
                'max'      => '50',
                'min'      => '6',
                'match' =>'password'
            ),
        ));
        if($validation->passed()) {


            $result = $userService->register($input);
            if (!$result) {
                Session::flash('error', 'Something went wrong, please try again later.');
                Redirect::to('register.php');
            }
            Session::flash('success', 'success!');
            Redirect::to('login.php');
        }

    }

}
$page_title = Config::get('register_page/title');
include_once ROOT_PATH."includes/header.php";

?>
<div id="background">
    <div id="registerContainer">
        <div id="inputContainer">
            <h1>Register</h1>
            <form method="POST" action="<?php echo BASE_URL."register.php"?>">
                <p>
                    <span class="validationError"><?php echo $validation->getError('username')?$validation->getError('username'):''?></span>
                    <label for="username">Username</label>
                    <input type="text" value="<?php echo Input::get('username')?>" name="username" id="username" placeholder="e.g vidavi">
                </p>
                <p>
                    <span class="validationError"><?php echo $validation->getError('email')?$validation->getError('email'):''?></span>
                    <label for="email">Email</label>
                    <input type="Email" value="<?php echo Input::get('email')?>" name="email" id="email" placeholder="e.g vidavi@gmail.com">
                </p>
                <p>
                    <span class="validationError"><?php echo $validation->getError('password')?$validation->getError('password'):''?></span>

                    <label for="password">Password</label>
                    <input type="password" value="" name="password" id="password" placeholder="Yout password">
                </p>
                <p>
                    <span class="validationError"><?php echo $validation->getError('password_again')?$validation->getError('password_again'):''?></span>

                    <label for="password_again">Password again</label>
                    <input type="password" value="" name="password_again" id="password_again" placeholder="Your password again">
                </p>
                <input type="hidden" name="token" value="<?php echo Token::tokenForm()?>">
                <button type="submit" name="register" value="register">Submit</button>
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