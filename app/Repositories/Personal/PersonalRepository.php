<?php

namespace App\Repositories\Personal;


//use Illuminate\Database\Eloquent\Model;

use App\Personal;

class PersonalRepository implements PersonalRepositoryInterface
{
    protected $model;

    public function __construct(Personal $model) {
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

//with('education', 'work', 'scholarships', 'honors', 'coding_skills', 'methods_devops_skills', 'software_skills', 'operating_systems_skills', 'business_skills', 'projects')

//this function returns the personal based on the logged in user's id
    public function find(int $id) {

        return $this->model->personal($id)->first();

    }

    // update a personal record
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
