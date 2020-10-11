<?php

namespace App\Repositories\ProjectImage;

//use Illuminate\Database\Eloquent\Model;

use App\ProjectImage;

class ProjectImageRepository implements ProjectImageRepositoryInterface
{
    protected $model;

    public function __construct(ProjectImage $model) {
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

//this function returns the award based on the logged in user's id
    public function find(int $id) {

        return $this->model->projectImage($id);
    }

    // update an award
    public function update(array $data, $id)
    {
        $projectImage = $this->get($id);

        return $projectImage->update($data);

    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // remove record from the database
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

}
