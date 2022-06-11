<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PostTypeModel;
use CodeIgniter\API\ResponseTrait;

class PostType extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new PostTypeModel();
        $data['post_type'] = $model->orderBy('jenis', 'ASC')->findAll();
        //return $this->respond($data);

        $response = [
            'msg' => 'Get All Success',
            'post_type' => $data['post_type']
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
        $model = new PostTypeModel();
        $data = $model->getWhere(['id' => $id])->getResult();
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
        $data = [
            'jenis' => $this->request->getVar('jenis'),
            'type' => $this->request->getVar('type')
        ];
        
        $model = new PostTypeModel();

        $fieldName  = 'jenis';
        $fieldRules = 'is_unique[posttypes.jenis]';

        $model->setValidationRule($fieldName, $fieldRules);

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
        $data = [
            'jenis' => $this->request->getVar('jenis'),
            'type' => $this->request->getVar('type')
        ];

        $model = new PostTypeModel();

        $check = $model->find($id);
        if(!$check) return $this->failNotFound('No Data Found with id '.$id);

        if($check['jenis']!=$data['jenis'])
        {
            $model2 = new PostTypeModel();
            $check_jenis = $model2->where("jenis", $data['jenis'])->first();
            if($check_jenis) $response = [
                'msg' => 'Failed. There are existing Jenis with same name.'
            ];
            return $this->respond($response);;
        }

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
        $model = new PostTypeModel();

        $check = $model->find($id);
        if(!$check) return $this->failNotFound('No Data Found with id '.$id);
        if(!$model->delete($id)) return $this->respond($model->errors());

        $response = [
            'msg' => 'Delete Success'
        ];
        return $this->respond($response);
    }
}
