<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use apiResponseTrait;
    public function index()
    {
        return $this->apiSuccess([
            'post 1',
            'post 2',
            'post 3',
        ], 'Ini adalah data post');

    }
}