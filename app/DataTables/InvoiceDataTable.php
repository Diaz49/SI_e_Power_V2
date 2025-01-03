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
            ->editColumn('client_id', function(Invoice $invoice){
                return $invoice->client->nama_client;
            })
            ->addColumn('status', function (Invoice $invoice) {
                if ($invoice->status === 'paid') {
                    return '<span class="badge bg-success fw-bolder">PAID</span>'; // Biru untuk 'use'
                } elseif ($invoice->status === '-') {
                    return '<span class="badge bg-danger">-</span>'; // Merah untuk 'not_use'
                }
                return '<span class="badge bg-secondary">Unknown</span>'; // Abu-abu untuk status lainnya
            })
            ->addColumn('jumlah_item', function (Invoice $invoice) {
                return $invoice->detail->count();
            })->addColumn('jumlah_harga', function (Invoice $invoice) {
                return $invoice->detail->sum('jumlah_harga');
            })
            ->setRowId('id')
            ->rawColumns(['status'])
        ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Invoice $model): QueryBuilder
    {
        return $model->newQuery();
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
