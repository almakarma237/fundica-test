<?php

declare(strict_types=1);

namespace user\interface\http\domain3Controller;
use user\application\useCases\CreateUserPayload;
use user\application\useCases\CreateUser;

class CreateUserDomain3Handler
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

        $firstName = $body['firstName'];
        $lastName = $body['lastName'];
        $postalCode = $body['postalCode'];

        $userId = $this->createUser->__invoke(
            new CreateUserPayload(null,
            null,
            $firstName,
            $lastName,
            $postalCode
        ));

        echo json_encode(["id" => $userId]);
        http_response_code(201);
        return;
    }
}
