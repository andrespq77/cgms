<table class="table table-responsive table-borderless" id="teacher-table">
    <thead>
        <tr>
            <th width="40px">{{ __('lms.page.teacher.table.id') }}</th>
            <th width="100px">{{ __('lms.page.teacher.table.security_id') }}</th>
            <th width="18%">{{ __('lms.page.teacher.table.name') }}</th>
            <th width="180px;">{{ __('lms.page.teacher.table.email') }}</th>
            <th width="100px;">Teléfono</th>
            <th width="200px;">{{ __('lms.page.teacher.table.university') }}</th>
            <th width="120px;">Info y especialidad</th>
            <th>{{ __('lms.page.teacher.table.location') }}</th>
            <th width="140px">Info del curso</th>
            <th width="150px" class="text-right">{{ __('lms.page.teacher.table.action') }}</th>
        </tr>
    </thead>
    <tbody>

        @foreach($teachers as $teacher)
            <tr>
                <td><small class="text-muted">{{ $teacher->id }}</small></td>
                <td><code>{{ $teacher->social_id }}</code></td>
                <td><i class="fa fa-{{$teacher->gender=='F' ? 'male' : 'female'}}"></i>
                    <a href="{{ url('/admin/teachers/profile/'.$teacher->id) }}">
                    {{ $teacher->first_name}}&nbsp;{{ $teacher->first_name!==$teacher->last_name ? $teacher->last_name : '' }}
                    </a>
                </td>
                <td>{{ $teacher->email2 == null ? $teacher->inst_email : $teacher->email2 }}</td>
                <td>{{ $teacher->phone2 == null ? $teacher->mobile : $teacher->phone2 }}<br/>
                    {{ $teacher->telephone !== '' ? $teacher->telephone : '' }}
                </td>
                <td>{{ $teacher->university_name }}</td>
                <td><span class="text-success">{{ $teacher->action_type }}</span>,
                    <span class="text-info">{{ $teacher->speciality }}</span><br/>
                    <small>{{ $teacher->work_hours }} {{ $teacher->work_hours!==null ? ' hours' : '' }}</small>
                </td>
                <td>{{ $teacher->province }}<br/>
                    {{ $teacher->canton }},<br/>
                    <small>{{ $teacher->parroquia }}</small>,<br/>
                    <span class="text-muted">{{ $teacher->district }}</span>
                </td>
                <td>
                    Registrations: <span class="badge">{{ $teacher->registrations->count() }}</span>
                </td>
                <td class="text-right">
                    @include('lms.admin.teacher.action')
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
