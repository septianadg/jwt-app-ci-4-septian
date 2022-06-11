<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PostinganModel;
use App\Models\PostTypeModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Postingan extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new PostinganModel();
        $data['postingan'] = $model->select($select='postingans.*, posttypes.jenis, posttypes.type, users.fullname as created_by')
                            ->join('users','postingans.users_id=users.id')
                            ->join('posttypes','postingans.posttypes_id=posttypes.id')
                            ->orderBy('posttypes.jenis', 'ASC')->findAll();

        $response = [
            'msg' => 'Get All Success',
            'postingan' => $data['postingan']
        ];
        return $this->respond($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new PostinganModel();
        $data = $model->select($select='postingans.*, posttypes.jenis, posttypes.type, users.fullname as created_by')
                ->join('users','postingans.users_id=users.id')
                ->join('posttypes','postingans.posttypes_id=posttypes.id')
                ->getWhere(['postingans.id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    use ResponseTrait;
    public function create()
    {
        /*get user login dari token key*/
        $key = getenv('S3CR3TK3Y');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        $token = explode(' ',$header)[1];
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        /*end of get*/

        /*get id jenis dari post type*/
        $modelcheckjenis = new PostTypeModel();
        if(!$this->request->getVar('jenis')) return $this->failNotFound('Jenis required');
        $check_jenis = $modelcheckjenis->where("jenis", $this->request->getVar('jenis'))->first();
        if(!$check_jenis) return $this->failNotFound('Jenis tidak ditemukan');
        /*end of get*/
        
        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'users_id' => $decoded->uid,
            'posttypes_id' => $check_jenis['id']
        ];

        $model = new PostinganModel();
        if(!$model->save($data)) return $this->respond($model->errors());

        $response = [
            'msg' => 'Create Success'
        ];
        return $this->respond($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new PostinganModel();
        $check = $model->find($id);
        if(!$check) return $this->failNotFound('No Data Found with id '.$id);

        /*get user login dari token key*/
        $key = getenv('S3CR3TK3Y');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        $token = explode(' ',$header)[1];
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        /*end of get*/

        /*cek postingan created by vs user login by token*/
        if($check['users_id']!=$decoded->uid) return $this->failNotFound('Postingan forbidden to edit by other user.');
        /*end of cek*/

        /*get id jenis dari post type*/
        $modelcheckjenis = new PostTypeModel();
        if(!$this->request->getVar('jenis')) return $this->failNotFound('Jenis required');
        $check_jenis = $modelcheckjenis->where("jenis", $this->request->getVar('jenis'))->first();
        if(!$check_jenis) return $this->failNotFound('Jenis tidak ditemukan');
        /*end of get*/

        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'users_id' => $decoded->uid,
            'posttypes_id' => $check_jenis['id']
        ];

        if(!$model->update($id, $data)) return $this->respond($model->errors());

        $response = [
            'msg' => 'Update Success'
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new PostinganModel();

        $check = $model->find($id);
        if(!$check) return $this->failNotFound('No Data Found with id '.$id);

        /*get user login dari token key*/
        $key = getenv('S3CR3TK3Y');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        $token = explode(' ',$header)[1];
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        /*end of get*/

        /*cek postingan created by vs user login by token*/
        if($check['users_id']!=$decoded->uid) return $this->failNotFound('Postingan forbidden to delete by other user.');
        /*end of cek*/

        if(!$model->delete($id)) return $this->respond($model->errors());

        $response = [
            'msg' => 'Delete Success'
        ];
        return $this->respond($response);
    }
}
