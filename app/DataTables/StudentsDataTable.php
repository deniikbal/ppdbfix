<?php

namespace App\DataTables;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentsDataTable extends DataTable
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
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Edit
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="' . url("showstudent/$row->id/edit") . '">Edit</a>
                        <a class="dropdown-item" target="_blank" href="' . url("printform/$row->uuid") . '">Print Form</a>
                        <a class="dropdown-item" target="_blank" href="' . url("surat/$row->uuid") . '">Surat</a>
                        <form action="' . url("deletestudent/$row->id") . '" method="post">
                        ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                        <button class="dropdown-item" onclick="return confirm(\'Yakin Mau Menghapus ' . $row->name . '\')" type="submit">Delete</button>
                        </form>
                        <form action="' . url("regisnewstudent/$row->id") . '" method="post">
                        ' . csrf_field() . '
                            ' . method_field("PUT") . '
                        <button class="dropdown-item" onclick="return confirm(\'Yakin Mau Kirim WA ' . $row->name . '\')" type="submit">Send WA
                        <a class="badge badge-info">' . $row->notif_wa . '</a></button>
                        </form>
                    </div>
                </div>
                ';
                return $aksi;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Student $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('students-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'asc')
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
            Column::make('id'),
            Column::make('name'),
            Column::make('nodaftar'),
            Column::make('jenis_kelamin'),
            Column::make('asal_sekolah'),
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
        return 'Students_' . date('YmdHis');
    }
}
