<?php

namespace App\Contracts\Service\OrderItem;

interface DestroyOrderItemServiceContract
{
    public function destroy(string $id);
}