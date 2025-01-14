<?php

namespace App\DataTables;

use App\Models\Po;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchaseOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function (Po $po) {
                return view('po.action', ['po' => $po]);
            })
            ->editColumn('vendor_id', function (Po $po) {
                return $po->vendor->nama_vendor;
            })
            ->addColumn('up_vendor', function (Po $po) {
                return $po->vendor->up;
            })
            ->addColumn('kota_vendor', function (Po $po) {
                return $po->vendor->kota;
            })
            ->addColumn('tlp_vendor', function (Po $po) {
                return $po->vendor->no_tlp;
            })->addColumn('jumlah_item', function (Po $po) {
                return $po->detail->count();
            })
            ->editColumn('diskon', function (Po $po) {
                $diskon = floor($po->diskon);
                return 'Rp.' .  number_format($diskon, 0, ',', '.');
            })
            ->addColumn('jumlah_harga', function (Po $po) {
                $jumlah = floor($po->detail->sum('jumlah_harga') - $po->diskon);
                return 'Rp.' .  number_format($jumlah, 0, ',', '.');
            })
            ->filterColumn('vendor_id',  function ($query, $keyword) {
                $query->whereHas('vendor', function ($q) use ($keyword) {
                    $q->where('nama_vendor', 'like', "%$keyword%");
                });
            })->filterColumn('up_vendor',  function ($query, $keyword) {
                $query->whereHas('vendor', function ($q) use ($keyword) {
                    $q->where('up', 'like', "%$keyword%");
                });
            })
            ->filterColumn('jumlah_item', function ($query, $keyword) {
                $query->whereRaw('(SELECT COUNT(*) FROM po_detail WHERE po_detail.po_id = po.id) LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('jumlah_harga', function ($query, $keyword) {
                $query->whereRaw('(SELECT SUM(jumlah_harga) FROM po_detail WHERE po_detail.po_id = po.id) LIKE ?', ["%$keyword%"]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Po $model): QueryBuilder
    {
        $filterYear = request('tanggal_po'); // Filter tahun (berdasarkan created_at atau tgl_invoice)

        return $model->newQuery()
            ->select([
                'po.*', // Kolom utama dari tabel `po`
                DB::raw('(SELECT COUNT(*) FROM po_detail WHERE po_detail.po_id = po.id) as jumlah_item'), // Subquery untuk jumlah item
                DB::raw('(SELECT SUM(jumlah_harga) FROM po_detail WHERE po_detail.po_id = po.id) as jumlah_harga'), // Subquery untuk total harga
            ])
            ->when($filterYear, function ($query, $filterYear) {
                return $query->whereYear('po.tanggal_po', $filterYear);
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('purchaseorder-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No.') // Ubah judul kolom menjadi "No."
                ->searchable(false)
                ->orderable(false)
                ->width(30)
                ->addClass('text-center')
                ->searchable(false),
            Column::make('kode_po'),
            Column::make('tanggal_po'),
            Column::make('vendor_id')->title('Vendor'),
            Column::make('up_vendor')->title('up'),
            Column::make('kota_vendor')->title('Kota'),
            Column::make('tlp_vendor')->title('No Tlp'),
            Column::make('perihal'),
            Column::make('jumlah_item')->title('Jumlah Item'),
            Column::make('diskon'),
            Column::make('jumlah_harga')->title('Total PO'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PurchaseOrder_' . date('YmdHis');
    }
}
