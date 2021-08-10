<?php

namespace App\Contracts\Order;

interface DestroyOrderServiceContract
{
    public function destroy(string $id);
}