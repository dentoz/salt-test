<?php
namespace App\Repository;

use App\Models\Users;

class RegisterRepository {

    public function save($input) {
        $users = new Users();
        $users->name = $input['name'];
        $users->email = $input['email'];
        $users->password = $input['password'];
        return $users->saveOrFail();
    }
}
