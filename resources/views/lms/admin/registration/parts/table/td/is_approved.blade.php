<td class="js-td-is-approved">
        @if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)

                @if(Auth::user()->can('approve_registration', $registration))
                        <div class="form-group">
                                <div class="checked">
                                        <label>
                                                <input type="checkbox"
                                                       class="js-approve-check-{{ $registration->id }}" /> Approve
                                        </label>
                                </div>
                                <button class="btn btn-xs btn-primary btn-flat btn-approve-confirm"
                                        data-id="{{ $registration->id }}">Confirm</button>
                        </div>
                @else
                        <span class="label label-warning">Not approved</span>
                @endif
        @else
                <span class="label label-success"><i class="fa fa-check"></i> Yes</span>
                <small><i class="fa fa-clock-o"></i>
                        {{ date('h:i a', strtotime($registration->approval_time)) }}<br/>
                        {{ date('d M, Y', strtotime($registration->approval_time)) }}
                </small>
        @endif
</td>