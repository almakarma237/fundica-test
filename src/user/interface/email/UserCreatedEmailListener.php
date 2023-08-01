<?php

declare(strict_types=1);

namespace user\interface\email;
use mysqli;
use user\application\events\UserCreatedEvent;
use ErrorException;
use Database;
use _lib\events\EventManager;

class UserCreatedEmailListener
{
    private EventManager $eventManager;
    private mysqli $connection;
    public function __construct(EventManager $eventManager, Database $database)
    {
        $this->eventManager = $eventManager;
        $this->connection = $database->getConnection();

        $this->eventManager->attach('UserCreatedEvent', function (UserCreatedEvent $event){
    
            $id =$event->__invoke()->getId();
            $sql = "SELECT * FROM user WHERE `id` ='$id'";
            $result = $this->connection->query($sql);
            $user = [];
    
            if (!$result->num_rows > 0) {
                throw new ErrorException("Not Found", 404);
            }
            // OUTPUT DATA OF EACH ROW
            while ($row = $result->fetch_assoc()) {
                $user = $row;
            }
    
            echo json_encode($user);
        });
    }

}
