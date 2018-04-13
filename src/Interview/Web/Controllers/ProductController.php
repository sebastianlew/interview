<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

namespace Sebastianlew\Interview\Web\Controllers;

use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('interview::products.index');
    }

    public function create()
    {
        return view('interview::products.create');
    }

    public function edit($id)
    {
        return view('interview::products.edit', compact('id'));
    }
}