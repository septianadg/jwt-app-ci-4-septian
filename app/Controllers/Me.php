<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Me extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $key = getenv('S3CR3TK3Y');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token key required');
        $token = explode(' ',$header)[1];

        try{
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $response = [
                'id' => $decoded,
                'email' => $decoded->email
            ];
            return $this->respond($response);
        } catch (\Throwable $th)
        {
            return $this->fail('Invalid token key');
        }
    }

}
