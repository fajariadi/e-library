<?php

namespace App\DataTables;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BukusDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){
                $action = '';
                if(Gate::allows('update buku')){
                }
                $action = '<button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-primary btn-xs action" action=""><i class="fa fa-edit"></i></button>';
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-xs action" action=""><i class="fa fa-trash"></i></button>';

                if(Gate::allows('delete buku')){
                }
                return $action;
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Buku $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Buku $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bukus-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('judul'),
            Column::make('author'),
            Column::make('genre'),
            Column::make('jumlah_halaman'),
            Column::make('harga'),
            Column::make('jumlah_buku'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Bukus_' . date('YmdHis');
    }
}
