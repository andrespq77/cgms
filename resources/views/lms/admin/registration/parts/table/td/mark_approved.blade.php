<td class="js-mark">{{ $registration->mark == null ? '' : $registration->mark }}</td>
<td class="js-mark-approved">
    @if($registration->mark_approved == REGISTRATION_MARK_APPROVED)
        <span class="label label-success">{{ __('lms.words.yes') }}</span>
        <small>{{ __('lms.words.by') }} <span class="text-info js-mark-approved-by">{{ $registration->markApprovedBy->name }}</span></small><br/>
        <small><i class="fa fa-clock-o">&nbsp;{{ date('d M Y h:i a', strtotime($registration->mark_upload_time)) }}</i></small>
    @else

        <span class="label label-warning">{{ __('lms.words.no') }}</span>

    @endif

</td>
