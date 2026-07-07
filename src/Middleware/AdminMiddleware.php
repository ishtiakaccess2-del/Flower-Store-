<?php
namespace App\Middleware;

class AdminMiddleware {
    public static function check() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /login?error=unauthorized");
            exit();
        }
    }
}