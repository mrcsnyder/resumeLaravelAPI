<?php

namespace App\Repositories\Education;

//use Illuminate\Database\Eloquent\Model;

use App\Education;

class EducationRepository implements EducationRepositoryInterface
{
    protected $model;

    public function __construct(Education $model) {
        $this->model = $model;
    }

    public function get(int $id) {

        return $this->model->findOrFail($id);

    }

    // Get the model
    public function getModel()
    {
        return $this->model;
    }

//this function returns the education based on the logged in user's id
    public function find(int $id) {

        return $this->model->education($id);

    }

    // update an award
    public function update(array $data, $id)
    {
        $personal = $this->get($id);

        return $personal->update($data);

    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

}
