<?php
use Database\Adapter\AdapterFactory;
use Config\Config;
use User\UserMapper;
use User\UserFactory;
use User\UserRepository;
use User\UserQuery;
use User\UserService;
use Hash\Hash;

$conn = AdapterFactory::getFactory()->getDriver(array("type" => "Mysql", "host" => Config::get('mysql/host'), "dbname" => Config::get('mysql/db'), "username" => Config::get('mysql/username'), "password" => Config::get('mysql/password')));
$userMapper = new UserMapper($conn);
$userFactory = new UserFactory();
$userRepository = new UserRepository($userMapper, $userFactory);
$groupMapper = new \Group\GroupMapper($conn);

$userQuery = new UserQuery($userMapper);
$userService = new UserService($userRepository, $userQuery, $userFactory, $groupMapper);
$user = $userService->getUser();
