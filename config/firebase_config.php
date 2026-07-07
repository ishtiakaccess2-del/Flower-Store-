<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseConfig {
    public static function init() {
        $factory = (new Factory)
            ->withServiceAccount(__DIR__.'/google-service-account.json')
            ->withDatabaseUri('https://golap-canon.firebaseio.com');

        return [
            'auth' => $factory->createAuth(),
            'firestore' => $factory->createFirestore()->database(),
            'storage' => $factory->createStorage()
        ];
    }
}