<?php

namespace Service;
require_once __DIR__ . '/../model/RegisterRequest.php';
require_once __DIR__ . '/../model/RegisterResponse.php';
require_once __DIR__ . '/../repository/repository.php';
require_once __DIR__ . '/../user/user.php';
require_once __DIR__ . '/../exception/exception.php';
require_once __DIR__ . '/../model/LoginRequest.php';
require_once __DIR__ . '/../model/LoginResponse.php';

use LoginRequest\LoginRequest;
use LoginResponse\LoginResponse;
use RegisterUser\RegisterRequest;
use Register\RegisterResponse;
use Repository\LoginImpl;
use User\User;
use Exception\ExceptionMessage;

class userService
{
    private LoginImpl $repository;
    private ExceptionMessage $exceptionMessage;

    public function __construct(LoginImpl $repsository)
    {
        $this->repository = $repsository;
        $this->exceptionMessage = new ExceptionMessage();
    }

    public function register(RegisterRequest $request): RegisterResponse
    {
        $this->registerValidation($request);

        $user = $this->repository->findByid($request->username);

        if ($user != null) {
            $message = $this->exceptionMessage->message = "User Sudah ada";
            header("Location: ./register.php?message=$message");
            exit();
        }

        $user = new User();
        $user->username = $request->username;

        // melakukan encryption password
        $user->password = password_hash($request->password, PASSWORD_BCRYPT);
        $user->confirm = password_hash($request->confirm, PASSWORD_BCRYPT);

        $this->repository->register($user);

        // simpan data
        $response = new RegisterResponse();
        $response->user = $user;

        return $response;
    }

    private function registerValidation(RegisterRequest $request)
    {
        if ($request->username == null || $request->password == null || $request->confirm == null || trim($request->username) == "" || trim($request->password) == "" || trim($request->confirm) == "") {
            $message = $this->exceptionMessage->message = "Username, Password Tidak Boleh Kosong";
            header("Location: ./register.php?message=$message");
            exit();
        }
    }

    public function login(LoginRequest $request): LoginResponse {
        $this->loginValidation($request);

        $user = $this->repository->findByid($request->username);

        if ($user == null) {
            $message = $this->exceptionMessage->message = "username dan password tidak ada";
            header("Location: ./login.php?message=$message");
            exit();
        }

        if (password_verify($request->password, $user->password)) {
            $response = new LoginResponse();
            $response->user = $user;
            return $response;
        } else {
            $message = $this->exceptionMessage->message = "username dan password tidak ditemukan";
            header("Location: ./login.php?message=$message");
            exit();
        }
    }

    private function loginValidation(LoginRequest $request)
    {
        if ($request->username == null || $request->password == null || $request->confirm == null || trim($request->username) == "" || trim($request->password) == "" || trim($request->confirm) == "") {
            $message = $this->exceptionMessage->message = "Username, Password Tidak Boleh Kosong";
            header("Location: ./login.php?message=$message");
            exit();
        }
    }
}