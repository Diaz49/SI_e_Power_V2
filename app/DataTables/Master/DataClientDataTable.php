<?php

namespace App\DataTables\Master;

use App\Models\DataClient;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataClientDataTable extends DataTable
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
            ->addColumn('action', function(DataClient $dataclient){
                return view('master.data-client.action', ['dataclient'=> $dataclient]);
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(DataClient $model): QueryBuilder
    {
        $filterYear = request('created_at'); // Filter tahun (berdasarkan created_at atau tgl_invoice)
        $filterPtId = request('pt_id'); // Filter PT ID

        return $model->newQuery()
            ->select('client.*') // Pastikan kolom yang dibutuhkan
            ->when($filterYear, function ($query, $filterYear) {
                return $query->whereYear('client.created_at', $filterYear);
            })
            ->when($filterPtId, function ($query, $filterPtId) {
                return $query->where('client.pt_id', $filterPtId);
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dataclient-table')
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
            Column::make('nama_client'),
            Column::make('alamat'),
            Column::make('no_tlp')->title('No Telpon'),
            Column::make('up_invoice'),
            Column::make('up_sph'),
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
        return 'DataClient_' . date('YmdHis');
    }
}
