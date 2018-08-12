<td>
    @if(isset($registration->diploma_path))

        <form method="post" target="_blank"
              action="{{ url("/admin/registration/$registration->id/download/diploma") }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-link btn-link-download" rel="tooltip"
                    title="{{ basename($registration->diploma) }}"
            ><i class="fa fa-cloud-download"></i> {{ __('lms.words.download') }}</button>
        </form>

    @endif

    @isset($registration->diploma_download_time)
        <small>
            <span>Última descarga </span><br/>
            <span class="text-info">
                {{ date('d M Y', strtotime($registration->diploma_download_time)) }}<br/>
                {{ date('h:i a', strtotime($registration->diploma_download_time)) }}
            </span>
        </small>
    @endisset

</td>
