<td>
    @if($registration->inspection_certificate_signed == REGISTRATION_INSPECTION_CERTIFICATE_SIGNED)
    <form method="post" target="_blank"
          action="{{ url("/admin/registration/$registration->id/download/student-inspection-form") }}">
    {{ csrf_field() }}
    <i class="fa fa-file-pdf-o"></i>
    <button type="submit" class="btn btn-link btn-link-download"  rel="tooltip"
            title="{{ basename($registration->inspection_certificate) }}"> {{ __('lms.words.download') }}</button>
    </form>
    <small><i class="fa fa-clock-o"></i>
        {{ date('d M, Y - h:i a', strtotime($registration->inspection_certificate_upload_time)) }}</small>
    @endif
</td>