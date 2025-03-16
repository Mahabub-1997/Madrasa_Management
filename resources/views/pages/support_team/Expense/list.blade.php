@extends('layouts.master')
@section('page_title', 'Expense List')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Expense List</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item">
                    <a href="#all-expenses" class="nav-link active" data-toggle="tab">Manage Expenses</a>
                </li>
                <li class="nav-item">
                    <a href="#add-expense" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Expense</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Expenses Table -->
                <div class="tab-pane fade show active" id="all-expenses">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $val)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $val->purpose }}</td>
                                <td>{{ number_format($val->amount, 2) }}</td>
                                <td>{{ $val->month }}</td>
                                <td>{{ $val->year }}</td>
                                <td>{{ ucfirst($val->type) }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a href="{{ route('expenses.edit', $val->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                {{-- Delete --}}
                                                <a id="{{ $val->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>

                                                    <form method="post" id="item-delete-{{ $val->id }}" action="{{ route('expenses.destroy', $val->id) }}" class="hidden">@csrf @method('delete')
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Add Expense Form -->
                <div class="tab-pane fade" id="add-expense">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('expenses.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Purpose <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="purpose" value="{{ old('purpose') }}" required type="text" class="form-control" placeholder="Purpose">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Amount <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="amount" value="{{ old('amount') }}" required type="number" class="form-control" placeholder="Amount">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Month <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select required class="form-control select" name="month">
                                            @foreach(range(1,12) as $m)
                                                @php $monthName = date("F", mktime(0, 0, 0, $m, 1)); @endphp
                                                <option value="{{ $monthName }}" {{ old('month') == $monthName ? 'selected' : '' }}>
                                                    {{ $monthName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Year <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="year" value="{{ old('year') }}" required type="number" class="form-control" placeholder="Year">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Type
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control select" name="type">
                                            <option value="monthly" {{ old('type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="yearly" {{ old('type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
