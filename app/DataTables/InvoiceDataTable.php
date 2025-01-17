<?php

namespace App\DataTables;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InvoiceDataTable extends DataTable
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
            ->addColumn('action', function (Invoice $invoice) {
                return view('invoice.action', ['invoice' => $invoice]);
            })
            ->editColumn('client_id', function (Invoice $invoice) {
                return $invoice->client->nama_client;
            })
            ->addColumn('status', function (Invoice $invoice) {
                if ($invoice->status === 'paid') {
                    return '<span class=" bg-success rounded-pill px-2 py-1 text-white  fw-bolder">PAID</span>'; // Biru untuk 'use'
                } elseif ($invoice->status === '-') {
                    return '<span class=" bg-danger rounded-pill px-2 py-1 text-white ">-</span>'; // Merah untuk 'not_use'
                }
                return '<span class=" bg-secondary rounded-pill px-2 py-1 text-white ">Unknown</span>'; // Abu-abu untuk status lainnya
            })
            ->addColumn('jumlah_item', function (Invoice $invoice) {
                return $invoice->detail->count();
            })->addColumn('jumlah_harga', function (Invoice $invoice) {
                return '<span class=""> Rp.'. number_format($invoice->detail->sum('jumlah_harga'), 0, ',', '.').'</span>';
            })
            ->filterColumn('client_id',  function ($query, $keyword) {
                $query->whereHas('client', function ($q) use ($keyword) {
                    $q->where('nama_client', 'like', "%$keyword%");
                });
            })
            ->filterColumn('jumlah_item', function ($query, $keyword) {
                $query->whereRaw('(SELECT COUNT(*) FROM invoice_detail WHERE invoice_detail.invoice_id = invoice.id) LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('jumlah_harga', function ($query, $keyword) {
                $query->whereRaw('(SELECT SUM(jumlah_harga) FROM invoice_detail WHERE invoice_detail.invoice_id = invoice.id) LIKE ?', ["%$keyword%"]);
            })
            ->setRowId('id')
            ->rawColumns(['status', 'jumlah_harga'])
        ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Invoice $model): QueryBuilder
    {
        $filterYear = request('tgl_invoice'); // Filter tahun (berdasarkan created_at atau tgl_invoice)
        $filterPtId = request('pt_id'); // Filter PT ID

        return $model->newQuery()
            ->select('invoice.*') // Pastikan kolom yang dibutuhkan
            ->when($filterYear, function ($query, $filterYear) {
                return $query->whereYear('invoice.tgl_invoice', $filterYear);
            })
            ->when($filterPtId, function ($query, $filterPtId) {
                return $query->where('invoice.pt_id', $filterPtId);
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('invoice-table')
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
            Column::make('tgl_invoice'),
            Column::make('kd_invoice')->title('Kode Invoice'),
            Column::make('client_id')->title('Nama Client'),
            Column::make('header_deskripsi')->title('Deskripsi'),
            Column::make('jumlah_item'),
            Column::make('jumlah_harga'),
            Column::make('no_fp')->title('FP'),
            Column::make('status'),
            Column::make('tgl_paid'),
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
        return 'Invoice_' . date('YmdHis');
    }
}
