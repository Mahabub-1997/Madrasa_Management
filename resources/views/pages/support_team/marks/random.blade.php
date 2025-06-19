<form class="ajax-update" action="{{ route('marks.update', [$exam_id, $my_class_id, $section_id, $subject_id]) }}" method="post">
    @csrf @method('put')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ক্রমিক</th>
            <th>নাম</th>
            <th>ভর্তির নং</th>
            @if($class_type->code == 'J')
                <th>১ম সিএ (১০)</th>
                <th>মধ্যবর্তী সিএ (২০)</th>
                <th>২য় সিএ (১০)</th>
                <th>পরীক্ষা (৬০)</th>
            @endif
            @if($class_type->code == 'S')
                <th>১ম সিএ (১৫)</th>
                <th>২য় সিএ (১৫)</th>
                <th>পরীক্ষা (৭০)</th>
            @endif
            @if($class_type->code == 'P')
                <th>১ম সিএ</th>
                <th>২য় সিএ</th>
                <th>মধ্যবর্তী সিএ</th>
                <th>পরীক্ষা</th>
            @endif
            @if($class_type->code == 'N')
                <th>টেস্ট</th>
                <th>পরীক্ষা</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($marks->sortBy('user.name') as $mk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mk->user->name }} </td>
                <td>{{ $mk->user->student_record->adm_no }}</td>

                @if($class_type->code == 'J')
                    <td><input min="1" max="10" class="w-50 text-center" name="t1_{{ $mk->id }}" value="{{ rand(1, 10) }}" type="number"></td>
                    <td><input min="1" max="20" class="w-50 text-center" name="t2_{{ $mk->id }}" value="{{ rand(1, 20) }}" type="number"></td>
                    <td><input min="1" max="10" class="w-50 text-center" name="t3_{{ $mk->id }}" value="{{ rand(1, 10) }}" type="number"></td>
                    <td><input min="1" max="60" class="w-50 text-center" name="exm_{{ $mk->id }}" value="{{ rand(1, 60) }}" type="number"></td>
                @endif

                @if($class_type->code == 'S')
                    <td><input min="1" max="15" class="w-50 text-center" name="t1_{{ $mk->id }}" value="{{ rand(1, 15) }}" type="number"></td>
                    <td><input min="1" max="15" class="w-50 text-center" name="t2_{{ $mk->id }}" value="{{ rand(1, 15) }}" type="number"></td>
                    <td><input min="1" max="70" class="w-50 text-center" name="exm_{{ $mk->id }}" value="{{ rand(1, 70) }}" type="number"></td>
                @endif

                @if($class_type->code == 'P')
                    <td><input min="1" class="w-50 text-center" name="t1_{{ $mk->id }}" value="{{ rand(1, 10) }}" type="number"></td>
                    <td><input min="1" class="w-50 text-center" name="t2_{{ $mk->id }}" value="{{ rand(1, 20) }}" type="number"></td>
                    <td><input min="1" class="w-50 text-center" name="t3_{{ $mk->id }}" value="{{ rand(1, 10) }}" type="number"></td>
                    <td><input min="1" class="w-50 text-center" name="exm_{{ $mk->id }}" value="{{ rand(1, 60) }}" type="number"></td>
                @endif

                @if($class_type->code == 'N')
                    <td><input min="1" max="40" class="w-50 text-center" name="t1_{{ $mk->id }}" value="{{ rand(1, 40) }}" type="number"></td>
                    <td><input min="1" max="60" class="w-50 text-center" name="exm_{{ $mk->id }}" value="{{ rand(1, 60) }}" type="number"></td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">মার্কস আপডেট করুন <i class="icon-paperplane ml-2"></i></button>
    </div>
</form>
