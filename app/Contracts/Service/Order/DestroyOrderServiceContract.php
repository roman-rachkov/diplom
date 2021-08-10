<?php

namespace App\Contracts\Service\Order;

interface DestroyOrderServiceContract
{
    public function destroy(string $id);
}