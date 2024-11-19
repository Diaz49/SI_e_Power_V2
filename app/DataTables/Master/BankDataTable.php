<?php

namespace App\DataTables\Master;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BankDataTable extends DataTable
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
        ->addColumn('status_display', function (Bank $bank) {
            if ($bank->status === 'use') {
                return '<span class="badge bg-primary">Use</span>'; // Biru untuk 'use'
            } elseif ($bank->status === 'not_use') {
                return '<span class="badge bg-danger">Not Use</span>'; // Merah untuk 'not_use'
            }
            return '<span class="badge bg-secondary">Unknown</span>'; // Abu-abu untuk status lainnya
        })
        ->addColumn('action', function (Bank $bank) {
            return view('master.data-bank.action', ['bank' => $bank]);
        })
        ->setRowId('id')
        ->rawColumns(['status_display', 'action']); // Pastikan kolom ini di-raw untuk HTML
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Bank $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bank-table')
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
            Column::make('nama_bank'),
            Column::make('nama_rek'),
            Column::make('nomer_rek'),
            Column::computed('status_display') // Kolom baru untuk status
                ->title('Status') // Ubah nama kolom menjadi "Status"
                ->searchable(false)
                ->addClass('text-center'),
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
        return 'Bank_' . date('YmdHis');
    }
}
