<?php

namespace App\Repositories\ProjectImage;

interface ProjectImageRepositoryInterface
{

    public function get(int $id);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete(int $id);

}
