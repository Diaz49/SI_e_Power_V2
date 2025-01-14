<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\Po;
use Illuminate\Http\Request;

class PrintPoController extends Controller
{
    public function viewPo(string $id)
    {
        $po = Po::with('detail')->findOrFail($id);
        return view('po.print')->with('po', $po);
    }
}
