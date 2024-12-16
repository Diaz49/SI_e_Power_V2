<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\DetailPo;
use App\Models\Po;
use Illuminate\Http\Request;

class DetailPoController extends Controller
{
    public function edit(string $id)
    {
        $po = Po::with('detail')->findOrFail($id);

        // Kirim data ke view dalam bentuk JSON untuk ditampilkan di modal
        return response()->json([
            'po' => $po,
            'detail' => $po->detail
        ]);
    }



    public function destroy(string $id)
    {
        $detail = DetailPo::findOrFail($id);
        $detail->delete();
        return response()->json();
    }
}
