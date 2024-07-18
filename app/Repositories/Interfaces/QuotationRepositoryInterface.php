<?php

namespace App\Repositories\Interfaces;

interface QuotationRepositoryInterface
{
    public function index(array $requestParams): Array;
}
