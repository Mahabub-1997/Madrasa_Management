<form class="ajax-update" action="{{ route('marks.update', [$exam_id, $my_class_id, $section_id, $subject_id]) }}" method="post">
    @csrf @method('put')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ক্রমিক নং</th>
            <th>নাম</th>
            <th>ভর্তি নম্বর</th>
            <th>১ম সি এ (২০)</th>
            <th>২য় সি এ (২০)</th>
            <th>পরীক্ষা (৬০)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($marks->sortBy('user.name') as $mk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mk->user->name }} </td>
                <td>{{ $mk->user->student_record->adm_no }}</td>

                {{-- CA এবং পরীক্ষার নম্বর --}}
                <td><input title="১ম সি এ" min="1" max="20" class="text-center" name="t1_{{ $mk->id }}" value="{{ $mk->t1 }}" type="number"></td>
                <td><input title="২য় সি এ" min="1" max="20" class="text-center" name="t2_{{ $mk->id }}" value="{{ $mk->t2 }}" type="number"></td>
                <td><input title="পরীক্ষা" min="1" max="60" class="text-center" name="exm_{{ $mk->id }}" value="{{ $mk->exm }}" type="number"></td>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">নম্বর আপডেট করুন <i class="icon-paperplane ml-2"></i></button>
    </div>
</form>
