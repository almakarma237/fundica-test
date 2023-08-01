<?php

declare(strict_types=1);

namespace user\interface\http\domain1Controller;
use user\application\useCases\CreateUserPayload;
use user\application\useCases\CreateUser;

class CreateUserDomain1Handler
{
    private CreateUser $createUser;
    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    // Create a function to decode and validate Request

    public function __invoke()
    {
        $request = file_get_contents('php://input');
        $body = json_decode($request, true);

        $email = $body['email'];
        $phone = $body['phone'];
        $firstName = $body['firstName'];

        $userId = $this->createUser->__invoke(new CreateUserPayload($email, $phone, $firstName));

        echo json_encode(["id" => $userId]);
        http_response_code(201);
        return;
    }
}
