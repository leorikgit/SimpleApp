<?php
include_once __DIR__."../../../core/ini.php";
use \Utility\Input;
use \Utility\Redirect;
use Validation\Validation;
use Hash\Hash;

if(!Input::exist('POST')){
    Redirect::to("index.php");
}
if(!$userService->isLogin()){
    Redirect::to(403);
}


$validation = new Validation($conn);
$input = array();
$input['password'] = Input::get('oldPassword');
$input['newPassword'] = Input::get('newPassword');
$input['confirmPassword'] = Input::get('confirmPassword');
$validation->check($input, array(
    "password"=>array(
        "required" =>true,

    ),
    "newPassword" => array(
        "required" =>true,

    ),
    "confirmPassword" => array(
        "required" => true,
        "match" => "newPassword"
    )
));
$user = $userService->getUser();

if(!Hash::verify($input['password'], $user->getPassword())){
    echo json_encode(array('status'=> 0, 'message' => "Old password doesnt match."));
    exit();
}
if(!$validation->passed()){
    $errors = $validation->getErrors();
    echo json_encode(array('status'=> 0, 'message' => $errors));
    exit();
}
$newPAssword = Hash::generate($input['newPassword']);

$user->setPassword($newPAssword);
if(!$userRepository->save($user)){
    echo json_encode(array('status'=> 0, 'message' => 'Something went wrong, please try again later.'));
    exit();
}


echo json_encode(array('status'=> 1, 'message' => 'Password has been updated.'));
exit();

?>

