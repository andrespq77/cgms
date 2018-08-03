@extends('lms.admin.registration.pdf.layout')

@section('body')

    <div class="container lor">

        <div class="row header">
            <div class="col-3 position-logo">
                <img src="{{ public_path('/images/ministerio_de_education_logo.jpg') }}" width="200"/>

            </div>
        </div>

        <div class="row title">
            <div class="col-12 text-center">
                <h1>CARTA COMPROMISO</h1>
                <h3>DEVENGACIÓN CURSO DE CAPACITACIÓN FINANCIADO POR EL MINISTERIO DE EDUCACIÓN - <span class="bold">{{ strtoupper($registration->course->university->name) }}</span> - ALATA</h3>
            </div>
        </div>


        <div class="row body-text">
            <div class="col-12">
                <p>En la ciudad de __________________ a los ____ días del mes de __________________de 2018, el /la Sr./
                    Sra.__________________________________________________________, en su calidad de Docente del
                    Magisterio Fiscal, quien en lo sucesivo se denominará “EL/LA SERVIDOR/A”, acuerda suscribir ante la
                    Dirección Nacional de Formación Continua, la presente carta compromiso al tenor de las declaraciones y cláusulas siguientes:
                </p>
            </div>
        </div>
        <div class="col-12 no-margin">
            <h3>DECLARACIONES</h3>
        </div>
        {{--<div class="row no-margin">--}}
            {{----}}
        {{--</div>--}}
        <div class="row">
            <div class="col-12">
                <ol>
                    <li>El/la servidor/a _________________________________________________________con número de cédula ___________________ declara que:</li>
                    <ol class="ol">
                        <li>Actualmente se encuentra laborando por nombramiento, dentro del Magisterio Fiscal, en la ________________________________________________________________con código AMIE ________________, en el Distrito (código) de la zona ________.</li>
                        <li>Asistirá al evento de capacitación: “<span>{{ strtoupper($registration->course->short_name) }}</span>”, que se desarrollará en modalidad semi-presencial, con una duración de {{ $registration->course->hours }} horas, cuyo valor total es de $2500,00; del cual, en caso de incumplir el compromiso establecido, usted deberá reembolsar $450 (monto asumido por MINEDUC).</li>
                        <li>El/la servidor/a declara que sus datos de contacto son: correo electrónico____________________________; número celular__________________ y número telefónico del domicilio (código de provincia + número telefónico) ________________________.</li>
                    </ol>
                </ol>
                <p>Expuesto lo anterior, “EL/LA SERVIDOR/A”, sujeta su compromiso a la forma y términos establecidos en las siguientes cláusulas:</p>
            </div>
        </div>
        <div class="row no-margin">
            <div class="col-12 no-margin">
                <h3>CLÁUSULAS</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>PRIMERA.</strong> “EL/LA SERVIDOR/A”, se compromete a cumplir en tiempo y forma establecidos con laasistencia y aprobación del evento de capacitación.</p>
                <p><strong>SEGUNDA.</strong> “EL/LA SERVIDOR/A”, se compromete a poner en práctica los conocimientos y estrategias metodológicas de inclusión escolar en su práctica pedagógica de aula.</p>
                <p><strong>TERCERA:</strong> “EL/LA SERVIDOR/A”, autoriza el descuento del 100% del valor del curso ($450.00 que corresponde a la beca otorgada por el MINEDUC) en caso de no aprobar el curso; en caso de no asistir al curso (excepto por causas de fuerza mayor bajo previa verificación contemplada en la normativa correspondiente) o de renunciar y salir de la institución sin haber permanecido el período de devengación de la beca, posterior a la finalización del curso y haber transmitido el conocimiento adquirido en el mismo.</p>
            </div>

        </div>

        <div class="row">
            <div class="col-12 no-margin">
                <p>NOMBRE DEL/LA SERVIDOR /A: ________________________________________________________________________</p>
                <p>No. CÉDULA DEL/LA SERVIDOR /A: ____________________________________________________________________</p>
                <p>FIRMA DEL/LA SERVIDOR/A: __________________________________________________________________________</p>
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