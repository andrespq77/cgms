<div class="row">
    <div class="col-lg-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Solicitudes de Inspección Pendientes</h3>
            </div>
            <div class="box-body no-padding">
                @include('lms.admin.teacher.profile.upcoming-table')
            </div>
        </div>

        <br><br>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Solicitudes de Inspección Históricas</h3>
            </div>
            <div class="box-body no-padding">
                @include('lms.admin.teacher.profile.historical-upcoming-table')
            </div>
        </div>

    </div>
</div>
