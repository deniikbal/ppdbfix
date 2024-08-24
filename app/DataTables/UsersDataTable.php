<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $aksi = '
                <a href="' . url("user/$row->id/edit") . '" class="btn btn-warning btn-sm">
                <i class="fas fa-user-edit"></i></a>
                <form action="' . url("user/$row->id") . '" method="post" style="display: inline-block">
                ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                <button onclick="return confirm(\'Yakin Mau Menghapus ' . $row->name . '\')" class="btn btn-danger btn-sm" type="submit">
                <i class="far fa-trash-alt"></i></button>
                </form>
                <form  action="' . url("/regisnewuser/$row->id") . '" method="post" style="display: inline-block">
                    ' . csrf_field() . '
                    ' . method_field("PUT") . '
                <button onclick="return confirm(\'Yakin Mau Mengirim WA ' . $row->name . '\')" class="btn btn-dark btn-sm"> <i class="fas fa-paper-plane"></i> ' . $row->notif_wa . ' </button>
                </form>
                ';
                return $aksi;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'asc')
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            //Column::make('role'),
            Column::make('no_handphone'),
            Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
