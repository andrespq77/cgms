<td class="js-mark">{{ $registration->mark == null ? '' : $registration->mark }} / 100</td>
<td class="js-mark-approved">
    @if($registration->mark_approved == REGISTRATION_MARK_APPROVED)
        <span class="label label-success">Yes</span>
        <small>By <span class="text-info js-mark-approved-by">{{ $registration->markApprovedBy->name }}</span></small><br/>
        <small><i class="fa fa-clock-o">&nbsp;{{ date('d M Y h:i a', strtotime($registration->mark_upload_time)) }}</i></small>
    @endif
</td>