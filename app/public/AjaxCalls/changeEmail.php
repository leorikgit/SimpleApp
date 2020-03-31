<?php
include_once __DIR__."../../../core/ini.php";
use \Utility\Input;
use \Utility\Redirect;
use Validation\Validation;

if(!Input::exist('POST')){
    Redirect::to("index.php");
}
if(!$userService->isLogin()){
    Redirect::to(403);
}

$validation = new Validation($conn);
$input = array();
$input['email'] = Input::get('email');
$validation->check($input, array(
    "email"=>array(
        "required" =>true,
        "emailFormat" => true,
        "unique" => 'users',
    )
));
if(!$validation->passed()){
    $errors = $validation->getErrors();
    echo json_encode(array('status'=> 0, 'message' => $errors));
    exit();
}
$user->setEmail($input['email']);
if(!$userRepository->save($user)){
    echo json_encode(array('status'=> 0, 'message' => 'Something went wrong, please try again later.'));
    exit();
}

echo json_encode(array('status'=> 1, 'message' => 'Email has been updated.'));
exit();

?>

