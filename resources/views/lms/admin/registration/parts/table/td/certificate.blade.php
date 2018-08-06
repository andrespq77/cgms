<td class="js-certificate">
    @if($registration->is_approved == REGISTRATION_IS_APPROVED)

        <form method="post" target="_blank"
              action="{{ url("/admin/registration/$registration->id/download/certificate") }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-link btn-link-download" rel="tooltip"
                    title="{{ basename($registration->certificate_path) }}"
            ><i class="fa fa-cloud-download"></i> Download</button>
        </form>

    @endif
</td>