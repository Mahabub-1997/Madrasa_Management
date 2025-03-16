@extends('layouts.master')
@section('page_title', 'report')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Profit Loss Report</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-notices" class="nav-link active" data-toggle="tab">Manage Notices</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-notices">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Month, Year</th>
                            <th>Total Income</th>
                            <th>Total Salaries</th>
                            <th>Total Expenses</th>
                            <th>total Admission</th>
                            <th>Profit/Loss</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#</td>
                                <td>{{ $report['month'] }}, {{ $report['year'] }}</td>
                                <td>{{ $report['total_income'] }}</td>
                                <td>{{ $report['total_salaries'] }}</td>
                                <td>{{ $report['total_expenses'] }}</td>
                                <td>{{ $report['totalAdmissionThisMonth'] }}</td>
                                <td>{{ $report['profit_or_loss'] }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                {{--Edit--}}
                                                @if(Qs::userIsTeamSA())
                                                    <a href="{{ route('notice_board.edit', $report['id']) }}" class="dropdown-item">
                                                        <i class="icon-pencil"></i> Edit
                                                    </a>
                                                @endif
                                                {{--Delete--}}
                                                @if(Qs::userIsSuperAdmin())
                                                    <a id="delete-{{ $report['id'] }}" onclick="confirmDelete('{{ $report['id'] }}')" href="#" class="dropdown-item">
                                                        <i class="icon-trash"></i> Delete
                                                    </a>
                                                    <form method="post" id="item-delete-{{ $report['id'] }}" action="{{ route('notice_board.destroy', $report['id']) }}" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
