<?php
namespace LoginResponse;
require_once __DIR__ . '/../user/user.php';
use User\User;

class LoginResponse {
    public User $user;
}