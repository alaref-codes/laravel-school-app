<?php

namespace App\DataTables;

use App\Models\StudentSubject;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;


class StudentSubjectDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'student_subjects.datatables_actions')
        ->editColumn('student_id', fn ($q) =>  $q->students ? $q->students->name : "DELETED")
        ->editColumn('subject_id', fn ($q) =>  $q->subjects ? $q->subjects->name : "DELETED");
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StudentSubject $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StudentSubject $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('studentsubject-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'student_id' => new Column(['title' => __('Student'), 'data' => 'student_id']),
            'subject_id'=> new Column(['title' => __('Subject'), 'data' => 'subject_id']),
            'degree',
            'degree_type'
        ];
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StudentSubject_' . date('YmdHis');
    }
}
