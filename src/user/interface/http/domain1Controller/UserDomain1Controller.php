<?php

declare(strict_types=1);

namespace user\interface\http\domain1Controller;

class UserDomain1Controller
{
    private CreateUserDomain1Handler $createUserDomain1Handler;


    public function __construct(
        CreateUserDomain1Handler $createUserDomain1Handler,
    )
    {
        $this->createUserDomain1Handler = $createUserDomain1Handler;

        $parts = explode("/", $_SERVER["REQUEST_URI"]);
        $method = explode("/", $_SERVER["REQUEST_METHOD"]);
        $id = $parts[6] ?? null;
        $this->processRequest($method[0], $id);
    }


    private function processRequest(string $method, ?string $id): void
    {
        switch ($method) {
            case "GET":
                http_response_code(404);
                break;

            case "POST":
                isset($id)? http_response_code(404): $this->createUserDomain1Handler->__invoke();
                break;
            
            case "PATCH":
                http_response_code(404);
                break;
            
            case "PUT":
                http_response_code(404);
                break;

            case "DELETE":
                http_response_code(404);
                break;

            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }


}