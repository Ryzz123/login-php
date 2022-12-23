<?php

namespace Repository;
require_once __DIR__ . '/../user/user.php';

use User\User;

interface Login {
    function register(User $user): User;

    function findByid(string $username): ?User;
}

class LoginImpl implements Login {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function register(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO user(username, password, confirm) VALUES(?,?,?)");
        $statement->execute([
            $user->username,
            $user->password,
            $user->confirm,
        ]);
        return $user;
    }

    public function findByid(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE username = ?");
        $statement->execute([$username]);

        // melakukan close cursor
        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->confirm = $row['confirm'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}