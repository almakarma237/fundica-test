<?php

declare(strict_types=1);

require_once "_boot/config.php";

use _lib\events\EventManager;
use article\interface\http\articleController\ArticleController;
use user\interface\http\domain3Controller\CreateUserDomain3Handler;
use user\interface\http\domain2Controller\CreateUserDomain2Handler;
use user\interface\http\domain1Controller\CreateUserDomain1Handler;
use user\interface\http\domain1Controller\UserDomain1Controller;
use user\interface\http\domain2Controller\UserDomain2Controller;
use user\interface\http\domain3Controller\UserDomain3Controller;
use user\infrastructure\UserCollection;
use user\interface\email\UserCreatedEmailListener;
use user\infrastructure\MySqlUserRepository;
use user\interface\http\userController\CreateUserHandler;
use user\application\useCases\CreateUser;
use user\interface\http\userController\UserController;



spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[3] != "api") {
    http_response_code(404);
    exit;
}

$database = new Database(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$eventManager = new EventManager();

new UserCollection($database);

new UserCreatedEmailListener($eventManager,$database);

if ($parts[4] == "users") {
    new UserController(
        new CreateUserHandler(
            new CreateUser ( 
                $eventManager,
                new MySqlUserRepository($database)
            )
        ),
    );

}

if ($parts[4] == "domain1" && $parts[5] == "users") {
    new UserDomain1Controller(
        new CreateUserDomain1Handler(
            new CreateUser ( 
                $eventManager,
                new MySqlUserRepository($database)
            )
        ),
    );

}

if ($parts[4] == "domain2" && $parts[5] == "users") {
    new UserDomain2Controller(
        new CreateUserDomain2Handler(
            new CreateUser ( 
                $eventManager,
                new MySqlUserRepository($database)
            )
        ),
    );

}

if ($parts[4] == "domain3" && $parts[5] == "users") {
    new UserDomain3Controller(
        new CreateUserDomain3Handler(
            new CreateUser ( 
                $eventManager,
                new MySqlUserRepository($database)
            )
        ),
    );

}

