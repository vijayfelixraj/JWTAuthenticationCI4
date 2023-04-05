<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Codeigniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    
    public function index()
    {
        $user = new UserModel();

        $result = $user->findAll();

        return $this->respond($result, 200);
    }
}
