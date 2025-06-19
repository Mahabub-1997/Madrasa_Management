<div class="card">
    <div class="card-header header-elements-inline bg-success">
        <h6 class="font-weight-bold card-title">সময় স্লট ব্যবস্থাপনা - {{ $ttr->name }}</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body collapse">
        <table id="time_slots_table" class="table datatable-button-html5-columns">
            <thead>
            <tr>
                <th>ক্রমিক</th>
                <th>শুরু সময়</th>
                <th>শেষ সময়</th>
                <th>অ্যাকশন</th>
            </tr>
            </thead>
            <tbody>
            @foreach($time_slots as $tms)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tms->time_from }}</td>
                    <td>{{ $tms->time_to }}</td>
                    <td class="text-center">
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    {{-- সম্পাদনা --}}
                                    <a href="{{ route('ts.edit', $tms->id) }}" class="dropdown-item">
                                        <i class="icon-pencil"></i> সংশোধন করুন
                                    </a>

                                    {{-- মুছুন --}}
                                    @if(Qs::userIsSuperAdmin())
                                        <a id="{{ $tms->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item">
                                            <i class="icon-trash"></i> মুছুন
                                        </a>
                                        <form method="post" id="item-delete-{{ $tms->id }}" action="{{ route('ts.destroy', $tms->id) }}" class="hidden">
                                            @csrf @method('delete')
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
