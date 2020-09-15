<?php

namespace App\Repositories\Award;

interface AwardRepositoryInterface
{

    public function get(int $id);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, $id);


}
