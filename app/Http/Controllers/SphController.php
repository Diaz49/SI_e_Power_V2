<?php

namespace App\Http\Controllers;

use App\DataTables\SphDataTable;
use App\Http\Controllers\Controller;
use App\Models\Sph;
use Illuminate\Http\Request;

class SphController extends Controller
{

    public function index(SphDataTable $dataTable)
    {
        return $dataTable->render('sph.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
