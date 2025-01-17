<?php

namespace App\DataTables;

use App\Models\Bast;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BastDataTable extends DataTable
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
            ->addColumn('action', function (Bast $bast) {
                return view('bast.action', ['bast' => $bast]);
            })
            ->addColumn('invoice_id', function (Bast $bast) {
                return $bast->invoice->kd_invoice;
            })->addColumn('deskripsi', function (Bast $bast) {
                return $bast->invoice->header_deskripsi;
            })->addColumn('jumlah_item', function (Bast $bast) {
                return $bast->invoice->detail->count();
            })->addColumn('total_invoice', function (Bast $bast) {
                return 'Rp.' . number_format($bast->invoice->detail->sum('jumlah_harga'), 0, ',', '.');
            })
            ->filterColumn('deskripsi',  function ($query, $keyword) {
                $query->whereHas('invoice', function ($q) use ($keyword) {
                    $q->where('header_deskripsi', 'like', "%$keyword%");
                });
            })
            ->filterColumn('total_invoice', function ($query, $keyword) {
                $query->whereRaw('(SELECT SUM(jumlah_harga) FROM invoice_detail WHERE invoice_detail.invoice_id = invoice.id) LIKE ?', ["%$keyword%"]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Bast $model): QueryBuilder
    {
        $filterYear = request('tanggal'); // Filter tahun (berdasarkan created_at atau tgl_invoice)

        return $model->newQuery()
            ->join('invoice', 'bast.invoice_id', '=', 'invoice.id') // Join ke tabel invoice
            ->select('bast.*', 'invoice.header_deskripsi') // Pilih kolom dari tabel invoice jika diperlukan

            ->when($filterYear, function ($query, $filterYear) {
                return $query->whereYear('bast.tanggal', $filterYear);
            })
        ;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('bast-table')
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
            Column::make('tanggal')->titel('Tanggal Bast'),
            Column::make('invoice_id')->title('Kode Invoice'),
            Column::make('deskripsi'),
            Column::make('nama'),
            Column::make('jabatan'),
            Column::make('jumlah_item'),
            Column::make('total_invoice'),
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
        return 'Bast_' . date('YmdHis');
    }
}
