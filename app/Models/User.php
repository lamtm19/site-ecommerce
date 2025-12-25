<?php

namespace Mini\Models;

use Mini\Core\Model;
use Mini\Core\Database;
use PDO;

class User extends Model
{
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;

    // Récupère un utilisateur par son email
    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    // Crée un nouvel utilisateur
    public static function create($data)
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO users (firstname, lastname, email, password, created_at)
            VALUES (:firstname, :lastname, :email, :password, NOW())
        ";

        $stmt = $pdo->prepare($sql);

        // hash du mot de passe
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email'     => $data['email'],
            'password'  => $hashedPassword,
        ]);
    }
}
