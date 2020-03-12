<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;

class TreeController extends Controller
{
    //

    public function index()
    {
        $tree = new Tree();

        $branch = $tree->buildTree($tree->elements, 0);

        return $branch;
    }

    public function show($id)
    {
        $tree = new Tree();

        $branch = $tree->buildTreePartly($tree->elements, $id, 0 );

        return $branch;
    }
}
