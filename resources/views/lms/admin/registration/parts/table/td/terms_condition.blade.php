<td>
        @if ($registration->accept_tc == REGISTRATION_ACCEPT_TERMS_AND_CONDITION_TRUE)
            <span class="label label-success">{{ __('lms.words.yes') }}</span>
                <small><i class="fa fa-clock-o"></i>
            {{ date('d M, Y', strtotime($registration->tc_accept_time)) }}</small><br/>
            <small>{{ date('h:i a', strtotime($registration->tc_accept_time)) }}</small>
        @else
                <span class="label label-warning">{{ __('lms.words.no') }}</span>
        @endif
</td>