<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

interface ClientRepositoryInterface
{
    public function create(Array $params) : Client;
    public function read() : Collection;
    public function readOne(int $id) : Client | Array;
    public function update(Client $client, Array $params) : bool | Array;
    public function delete(int $id) : bool | Array;
}
