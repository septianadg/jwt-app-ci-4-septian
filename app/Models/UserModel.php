<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['fullname','email','phone','password'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = ['fullname' =>'required|min_length[3]',
                                        'phone'    => [
                                            'rules'  => 'required|min_length[10]|is_unique[users.phone]',
                                            'errors' => [
                                                'is_unique' => 'Failed. Phone already taken by another user.',
                                            ],
                                        ],
                                        'password' =>'required|min_length[8]',
                                        'confpassword' => 'matches[password_unhash]',
                                        'email'    => [
                                            'rules'  => 'required|valid_email|is_unique[users.email]',
                                            'errors' => [
                                                'is_unique' => 'Failed. Email already taken by another user.',
                                            ],
                                        ],                                    
                                       ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
