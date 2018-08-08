<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Historic Inspection Requests</h3>
            </div>
            <div class="box-body no-padding">
                @include('lms.admin.teacher.profile.approved-upcoming-table')
            </div>
        </div>

        <br><br>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pending Inspection Requests</h3>
            </div>
            <div class="box-body no-padding">
                @include('lms.admin.teacher.profile.upcoming-table')
            </div>
        </div>


    </div>
</div>