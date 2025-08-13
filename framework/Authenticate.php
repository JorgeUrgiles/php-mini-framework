<?php
namespace Framework;

class Authenticate
{
public function login(string $email, string $password): bool
{
    $user =db()->query('SELECT * FROM users WHERE email = :email', [
        'email' => $email,
    ])->first();

    if($user && password_verify($password, $user['password'])) {
        session()->set('user', [
        'id' => $user['id'],
        'email' => $user['email'],
        'name' => $user['name'],
        ]);

        return true;
    }

    return false;
}

public function logout() 
{
    session()->remove('user');

    session_destroy();
}
}