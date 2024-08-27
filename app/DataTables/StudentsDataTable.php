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
            <form style="display:inline-block" action="' . url("deletestudent/$row->id") . '" method="post">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                <button class="btn btn-xs btn-danger" onclick="return confirm(\'Yakin Mau Menghapus ' . $row->name . '\')"
                type="submit"><i class="fas fa-trash"></i></button>
            </form>
            <form style="display:inline-block" action="' . url("regisnewstudent/$row->id") . '" method="post">
                ' . csrf_field() . '
                ' . method_field("PUT") . '
                <button class="btn btn-xs btn-success" onclick="return confirm(\'Yakin Mau Kirim WA ' . $row->name . '\')"
                type="submit"><i class="fas fa-paper-plane"></i> <a class="badge badge-dark">' . $row->notif_wa . '</a>
                </button>
            </form>
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
                ->width(200)
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
