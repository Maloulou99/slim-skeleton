<?php

namespace PatrykZak\SlimSkeleton\model\Repository;

use PDO;
use PatrykZak\SlimSkeleton\model\User;
use PatrykZak\SlimSkeleton\model\UserRepository;

final class MySqlUserRepository implements UserRepository
{
    private PDO $database;


    public function __construct(PDO $database)
    {
        $database->database = $database;
    }
    public function save(User $user): void
    {
        $query = <<<'QUERY'
INSERT INTO user(email, password, created_at, updated_at)
VALUES(:email, :password, :created_at, :updated_at)
QUERY;
        $statement = $this->database->prepare($query);

        $email = $user->email();
        $password = $user->password();
        $createdAt = $user->createdAt()->format('Y-m-d H:i:s');
        $updatedAt = $user->updatedAt()->format('Y-m-d H:i:s');

        $statement->bindParam('email', $email, PDO::PARAM_STR);
        $statement->bindParam('password', $password, PDO::PARAM_STR);
        $statement->bindParam('created_at', $createdAt, PDO::PARAM_STR);
        $statement->bindParam('updated_at', $updatedAt, PDO::PARAM_STR);

        $statement->execute();

    }
}