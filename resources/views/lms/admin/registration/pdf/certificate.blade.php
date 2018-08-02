@extends('lms.admin.registration.pdf.layout')

@section('body')

    <div class="container">

        <div class="row header">
            <div class="col-3 position-logo">
                <img src="{{ public_path('/images/ministerio_de_education_logo.jpg') }}" width="250"/>

            </div>
        </div>

        <div class="row title">
            <div class="col-12 text-center">
                <h1>CERTIFICADO DE INSCRIPCIÓN</h1>
            </div>
        </div>


        <div class="row body-text">
            <div class="col-1"></div>
            <div class="col-10">
                <p> <span>25 July, 2016</span><br/>Estimado/a Docente,</p>
                <p><span class="teacher-name">{{ $registration->student->first_name . ' '.$registration->student->last_name  }}</span>
                    <br/> <span class="teacher-id">{{ $registration->student->social_id }}</span></p>
                <p class="text-justify">El Ministerio de Educación tiene el agrado de comunicarle que usted ha realizado su inscripción de
                    manera exitosa para participar en el Curso de Capacitación de <span class="course-name">{{ $registration->course->short_name }}</span>,
                    con beca del Ministerio de Educación, a través la <span class="university-name">{{ $registration->course->university->name }}</span> y ALATA.
                </p>
                <br/>
                <p class="text-justify">Estamos seguros que la actualización de sus conocimientos pedagógicos contribuirá a su mejoramiento
                    profesional y, a la vez, incidirá en el bienestar de los estudiantes y de la institución educativa donde labora.
                </p>
                <br/>
                <p>Para ampliar cualquier consulta, no dude en contactarnos.</p>
                <p ><span class="strong">Dirección Nacional de Formación Continua</span><br/>
                <span class="strong">Teléfonos: </span><span>+ (593 2)3981446 - + (593 2)3981572 - + (593 2)3981379</span><br/>
                <span class="strong">Correo:</span> <a href="mailto:formacion.docente@educacion.gob.ec" target="_blank">formacion.docente@educacion.gob.ec</a></p>
            </div>
        </div>

        <div class="row footer">
            <div class="col-6">

                <img class="footer-image" src="{{ public_path('/images/republica_del_ecuador.png') }}" width="140"/>

            </div>
            <div class="col-6 text-right">
                <address>
                    Av. Amazonas N34-451 y Av. Atahualpa<br/>
                    Teléfono: 593-2-396-1300 / 1400 / 1500<br/>
                    www.educacion.gob.ec<br/>
                    1800-EDUCACIÓN<br/>
                    Quito - Ecuador<br/>
                </address>
            </div>

            <div id="watermark">
                <img src="{{ public_path('/images/ecuador_coat_of_arms.png') }}" height="100%" width="100%">
            </div>
    </div>


@stop