<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Register extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'confirm_password' => ['label' => 'confirm password', 'rules' => 'matches[password]']
        ];

        if ($this->validate($rules)) 
        {
            $user = new UserModel();

            $data = [
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            
            $user->save($data);

            return $this->respond(['message' => 'Registered Successfully'], 200);
        }
        else 
        {
            $response = [
                'error' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];

            return $this->fail($response, 409);
        }
    }
}
