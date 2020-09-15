<?php

namespace App\Repositories\Education;

interface EducationRepositoryInterface
{

    public function get(int $id);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, $id);


}
