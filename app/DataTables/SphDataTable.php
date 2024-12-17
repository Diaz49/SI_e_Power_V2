<?php

namespace App\DataTables;

use App\Models\Sph;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SphDataTable extends DataTable
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
        ->addColumn('action', function($row){
            return view('sph.action', ['sph'=> $row]);
        })
        ->addColumn('nama_client', function ($row) {
            return $row->dataClient->nama_client; // Ambil nama_client dari relasi
        })
        ->addColumn('up_sph', function ($row) {
            return $row->dataClient->up_sph; 
        })
        ->addColumn('price', function ($row) {
            return $row->detailSph->price; 
        })
        ->addColumn('jumlah_harga', function ($row) {
            return $row->detailSph->jumlah_harga; 
        })
        ->setRowId('id')
        ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Sph $model): QueryBuilder
    {
        return $model->newQuery()->with('dataClient'); // Muat relasi client
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sph-table')
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
            Column::make('tanggal')->title('Tanggal'),
            Column::make('kode_sph')->title('Kode SPH'),
            Column::make('nama_client')->title('Nama Client'),
            Column::make('up_sph')->title('Up'),
            Column::make('price')->title('Total Item'),
            Column::make('jumlah_harga')->title('Total SPH'),
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
        return 'Sph_' . date('YmdHis');
    }
}
