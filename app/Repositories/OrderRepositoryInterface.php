<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function create(array $params): Order;
    public function read(): Collection;
    public function readOne(int $id): Order | array;
    public function update(Order $order, array $params): bool | array;
    public function delete(int $id): bool | array;
}
