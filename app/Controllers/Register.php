<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Register extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use ResponseTrait;
    public function index()
    {
        /*helper(['form']);
        $rules = [
            'fullname' =>'required|min_length[3]',
            'phone' =>'required|min_length[10]|is_unique[users.phone]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' =>'required|min_length[8]',
            'confpassword' => 'matches[password]'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());*/
        $model = new UserModel();
        //$rules = $model->validationRules;
        //if(!$rules) return $model->errors();
        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'phone' => $this->request->getVar('phone'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'),PASSWORD_BCRYPT),
            'password_unhash' => $this->request->getVar('password'),
            'confpassword' => $this->request->getVar('confpassword')
        ];

        $model = new UserModel();
        //$registered = $model->save($data);
        //$this->respondCreated($registered);
        if(!$model->save($data)) return $this->respond($model->errors());

        $response = [
            'msg' => 'Register Success'
        ];
        return $this->respond($response);
    }

    
}
