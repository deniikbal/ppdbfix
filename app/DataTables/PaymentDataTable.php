<?php

namespace App\DataTables;


use App\Models\payment_xendit;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentDataTable extends DataTable
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
                <a href="' . url("editpaymentadmin/$row->id") . '" class="badge badge-' . ($row->status == 'PENDING' ?
                        'warning' : ($row->status == 'SETTLED' ?
                            'success' : 'dark')) . '">' . $row->status . '</a>
                ';
                return $aksi;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(payment_xendit $model): QueryBuilder
    {
        //$query = payment_xendit::with('student')->get();
        return $model->newQuery()->with('student');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('xendit_payments-table')
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
            'name' => new \Yajra\DataTables\Html\Column(['title' => 'Nama Siswa', 'data' => 'student.name', 'name' =>
                'student.name']),
            'nodaftar' => new \Yajra\DataTables\Html\Column(['title' => 'No Daftar', 'data' => 'student.nodaftar', 'name' =>
                'student.nodaftar']),
            'invoice' => new \Yajra\DataTables\Html\Column(['title' => 'Invoice', 'data' => 'external_id', 'name' =>
                'external_id']),
            Column::make('amount'), 'status' => new \Yajra\DataTables\Html\Column(['title' => 'Status', 'data' => 'action', 'name' => 'action']),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Payment_' . date('YmdHis');
    }
}
