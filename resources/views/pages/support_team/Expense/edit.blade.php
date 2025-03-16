@extends('layouts.master')

@section('page_title', 'Edit Expense')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Expense</h6>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">

            <div class="tab-content">
                <div class="tab-pane fade show active" id="edit-expense">
                    <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">
                                Purpose <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input name="purpose" value="{{ old('purpose', $expense->purpose) }}" required type="text" class="form-control" placeholder="Purpose">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">
                                Amount <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input name="amount" value="{{ old('amount', $expense->amount) }}" required type="number" class="form-control" placeholder="Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">
                                Month <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <select name="month" required class="form-control select">
                                    @foreach(range(1,12) as $month)
                                        <option value="{{ $month }}" {{ old('month', $expense->month) == $month ? 'selected' : '' }}>
                                            {{ date("F", mktime(0, 0, 0, $month, 1)) }}
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
                                <input name="year" value="{{ old('year', $expense->year) }}" required type="number" class="form-control" placeholder="Year">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">
                                Type
                            </label>
                            <div class="col-lg-9">
                                <select name="type" class="form-control select">
                                    <option value="monthly" {{ old('type', $expense->type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="yearly" {{ old('type', $expense->type) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
