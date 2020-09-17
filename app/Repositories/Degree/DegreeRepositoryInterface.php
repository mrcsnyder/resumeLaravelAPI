<?php

namespace App\Repositories\Degree;

interface DegreeRepositoryInterface
{

    public function get(int $id);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, $id);

}
