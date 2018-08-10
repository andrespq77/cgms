@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1> <i class="fa fa-user-plus"></i>
        @if( isset($teacher) )
            <span class="js-modal-title-edit">{{ __('lms.page.teacher.form.edit_title') .' : '. $teacher->first_name }}</span>
        @else
            <span class="js-modal-title-add">{{ __('lms.page.teacher.form.add_title') }}</span>
        @endif
    </h1>

@stop

@section('content')

    <form class="form-horizontal teacher-form" role="form">

        <div class="row">

            <div class="col-md-6 col-lg-6 ">

                <div class="box box-primary">

                    <div class="box-header"><h3 class="box-title">{{ __('lms.words.personal_info') }}</h3></div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-first_name-block">
                                    <label for="teacher-first-name" class="col-md-3 control-label">{{ __('lms.page.user.table.first_name') }}</label>
                                    <div class="col-md-9">
                                        <input id="teacher-first-name" type="text" class="form-control" name="first_name"
                                               value="{{ isset($teacher) ? $teacher->first_name : '' }}"
                                               placeholder="{{ __('lms.form.first_name') }}" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-last_name-block">

                                    <label for="teacher-last-name" class="col-md-3 control-label">{{ __('lms.page.user.table.last_name') }}</label>
                                    <div class="col-md-9">
                                        <input id="teacher-last-name" type="text" class="form-control" name="last_name"
                                               value="{{ isset($teacher) ? $teacher->last_name : '' }}"
                                               placeholder="{{ __('lms.form.last_name') }}" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="form-group js-error-block js-social_id-block">
                                    <label for="teacher-social-id" class="col-md-3 control-label">{{ __('lms.words.social_id') }}</label>
                                    <div class="col-md-9">
                                        <input id="teacher-social-id" type="text" class="form-control" name="social_id"
                                               value="{{ isset($teacher) ? $teacher->social_id : '' }}"
                                               placeholder="{{ __('lms.words.social_id') }}" maxlength="100"
                                                {{ isset($teacher) ? 'disabled': '' }}>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="form-group js-error-block js-cc-block">
                                    <label for="teacher-cc" class="col-md-3 control-label">CC</label>
                                    <div class="col-md-9">
                                        <input id="teacher-cc" type="text" class=" form-control" name="cc"
                                               value="{{ isset($teacher) ? $teacher->cc : '' }}" placeholder="CC" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--@unless($is)--}}

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-email-block">
                                    <label for="teacher-email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input id="teacher-email" type="email" class="js-edit-canton-name form-control" name="email"
                                               value="{{ isset($teacher) ? $teacher->email : '' }}"
                                               placeholder="Email" maxlength="100" {{ isset($teacher) ? 'disabled': '' }}>
                                            <div class="help-block"></div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block has-warning">
                                    <div class="col-md-9 col-md-offset-3">
                                        <span class="help-block"> <i class="fa fa-caret-left"></i>
                                            {{ __('lms.messages.email_used_login') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--@endunless--}}


                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group js-error-block js-telephone-block">
                                    <label for="teacher-telephone" class="col-md-3 control-label">{{ __('lms.words.telephone') }}</label>
                                    <div class="col-md-9">
                                        <input id="teacher-telephone" type="text" class=" form-control" name="telephone"
                                               value="{{ isset($teacher) ? $teacher->telephone : '' }}"
                                               placeholder="{{ __('lms.words.telephone') }}" maxlength="100">
                                        <div class="help-block"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group js-error-block js-mobile-block">
                                    <label for="teacher-mobile" class="col-md-3 control-label">{{ __('lms.words.mobile') }}</label>
                                    <div class="col-md-9">
                                        <input id="teacher-mobile" type="text" class=" form-control" name="mobile"
                                               value="{{ isset($teacher) ? $teacher->mobile : '' }}"
                                               placeholder="{{ __('lms.words.mobile') }}" maxlength="100">
                                        <div class="help-block"></div>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>

            <div class="col-md-6 col-lg-6">

                <div class="box box-primary">

                    <div class="box-header"><h3 class="box-title">Personal</h3></div>
                    <div class="box-body">

                        <div class="row">

                            <div class="col-lg-5 col-sm-12">

                                <div class="form-group js-error-block js-gender-block">
                                    <label class="col-md-3 control-label" for="Gender">{{ __('lms.words.gender') }}</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline" for="Gender-0">
                                            <input type="radio" name="gender" id="Gender-0" value="m"
                                                    {{ isset($teacher) ? $teacher->gender == 'M' ? 'checked' : '' : '' }}>
                                            {{ __('lms.words.male') }}
                                        </label>
                                        <label class="radio-inline" for="Gender-1">
                                            <input type="radio" name="gender" id="Gender-1" value="f"
                                                    {{ isset($teacher) ? $teacher->gender == 'F' ? 'checked' : '' : '' }}
                                            >
                                            {{ __('lms.words.female') }}
                                        </label>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12">

                                <div class="form-group js-error-block js-date_of_birth-block">
                                    <label for="teacher-dob" class="col-md-3 control-label">{{ __('lms.words.date_of_birth') }}</label>
                                    <div class="col-md-9">
                                        <input id="teacher-dob" type="text" class="js-datepicker form-control" name="date_of_birth"
                                               value="{{ isset($teacher) ? date('d/m/Y', strtotime($teacher->date_of_birth)) : '' }}"
                                               placeholder="{{ __('lms.words.date_of_birth') }}" maxlength="20">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-5 col-sm-12">

                                <div class="form-group  ">
                                    <label class="col-md-3 control-label" >Cell 2</label>
                                    <div class="col-md-9">
                                        <label class="">{{ isset($teacher) ? $teacher->phone2 : '' }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12">

                                <div class="form-group ">
                                    <label class="col-md-3 control-label">Email 2</label>
                                    <div class="col-md-9"><label class="">{{ isset($teacher) ? $teacher->email2 : '' }}</label></div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6">

            <div class="box box-info">

                <div class="box-header"><h3 class="box-title">{{ __('lms.words.university_info') }}</h3></div>

                <div class="box-body">

                    <div class="row">
                        <div class="col-lg-2 col-sm-12">

                            <div class="form-group">
                                <label for="teacher-university" class="col-md-3 col-lg-3 control-label">{{ __('lms.page.teacher.table.university') }}</label>
                            </div>

                        </div>

                        <div class="col-lg-10 col-md-12 col-sm-12">

                            <div class="form-group js-error-block js-university-block">
                                <div class="col-lg-12">
                                    <input id="teacher-university" type="text" class="form-control" name="university"
                                           value="{{ isset($teacher) ? $teacher->university_name : '' }}"
                                           placeholder={{ __('lms.page.teacher.table.university') }} maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group js-error-block js-join_date_block">
                                <label for="teacher-join_date" class="col-md-3 control-label">{{ __('lms.words.date_join') }}</label>
                                <div class="col-md-9">
                                    <input id="teacher-join_date" type="text" class="js-datepicker form-control" name="join_date"
                                           value="{{ isset($teacher) ? $teacher->join_date == null ? '' : date('d/m/Y', strtotime($teacher->join_date)) : '' }}"
                                           required placeholder={{ __('lms.words.date_join') }} maxlength="10">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group js-error-block js-end_date-block">
                                <label for="teacher-end_date" class="col-md-3 control-label">{{ __('lms.words.date_end') }}</label>
                                <div class="col-md-9">
                                    <input id="teacher-end_date" type="text" class="js-datepicker form-control" name="end_date"
                                           value="{{ isset($teacher) ? $teacher->end_date == null ? '' : date('d/m/Y', strtotime($teacher->end_date)) : '' }}"
                                           placeholder={{ __('lms.words.date_end') }} maxlength="10">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">

                            <div class="form-group js-error-block js-amie-block">
                                <label for="teacher-amie" class="col-md-3 control-label">AMIE</label>
                                <div class="col-md-9">
                                    <input id="teacher-amie" type="text" class="form-control" name="amie"
                                           value="{{ isset($teacher) ? $teacher->amie : '' }}"
                                           placeholder="AMIE" maxlength="10">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">

                        </div>

                    </div>

                </div>
            </div>

        </div>

            <div class="col-lg-6">

            <div class="box box-info">

                <div class="box-header"><h3 class="box-title">{{ __('lms.words.work_details') }}</h3></div>

                <div class="box-body">

                    <div class="row">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-inst_email-block">
                                <label for="teacher-inst-email" class="col-md-3 control-label">{{ __('lms.words.institute_email') }}</label>
                                <div class="col-md-9">
                                    <input id="teacher-inst-email" type="email" class="form-control" name="inst_email"
                                           value="{{ isset($teacher) ? $teacher->inst_email : '' }}"
                                           placeholder="{{ __('lms.words.institute_email') }}" maxlength="100"
                                            {{ isset($teacher) ? 'disabled': '' }}>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-work_area-block">
                                <label for="teacher-work_area" class="col-md-3 control-label">{{ __('lms.words.work_area') }}</label>
                                <div class="col-md-9">
                                    <input id="teacher-work_area" type="text" class="form-control" name="work_area"
                                           value="{{ isset($teacher) ? $teacher->work_area : '' }}"
                                           placeholder={{ __('lms.words.work_area') }} maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-teacher_function-block">
                                <label for="teacher-function" class="col-md-3 control-label">{{ __('lms.words.function') }}</label>
                                <div class="col-md-9">
                                    <input id="teacher-function" type="text" class=" form-control" name="teacher_function"
                                           value="{{ isset($teacher) ? $teacher->function : '' }}"
                                           placeholder="{{ __('lms.words.function') }}" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-category-block">
                                <label for="teacher-category" class="col-md-3 control-label">{{ __('lms.words.category') }}</label>
                                <div class="col-md-9">
                                    <input id="teacher-category" type="text" class="form-control" name="category"
                                           value="{{ isset($teacher) ? $teacher->category : '' }}"
                                           placeholder="{{ __('lms.words.category') }}" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-work_hours-block">
                                <label for="work_hours" class="col-md-3 control-label">{{ __('lms.words.work_hours') }}</label>
                                <div class="col-md-9">
                                    <input id="work_hours" type="text" class=" form-control" name="work_hours"
                                           value="{{ isset($teacher) ? $teacher->work_hours : '' }}"
                                           placeholder="{{ __('lms.words.work_hours') }}" maxlength="20">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="box box-info">

                    <div class="box-header"><h3 class="box-title">{{ __('lms.words.location_info') }}</h3></div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-province-block">
                                    <label for="province" class="col-md-3 control-label">{{ __('lms.location.province.index.page_header') }}</label>
                                    <div class="col-md-9">
                                        <input type="hidden" class="js-edit-province"
                                               value="{{ isset($teacher) ? $teacher->province : '' }}">
                                        <select id="province" class="form-control js-province" name="province"></select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-canton-block">
                                    <label for="canton" class="col-md-3 control-label">Canton</label>
                                    <div class="col-md-9">
                                        <select id="canton" class="form-control js-canton" name="canton"></select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-parroquia-block">
                                    <label for="Parroquia" class="col-md-3 control-label">Parroquia</label>
                                    <div class="col-md-9">
                                        <input id="Parroquia" type="text" class="form-control" name="parroquia"
                                               value="{{ isset($teacher) ? $teacher->parroquia : '' }}"
                                               placeholder="Parroquia" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-zone-block">

                                    <label for="Zone" class="col-md-3 control-label">{{ __('lms.words.zone') }}</label>
                                    <div class="col-md-9">
                                        <select id="zone" class="form-control js-zone" name="zone">
                                            <option {{ isset($teacher) ? $teacher->zone =='Zona 1' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 1">{{ __('lms.words.zone') }} 1</option>
                                            <option {{ isset($teacher) ? $teacher->zone =='Zona 2' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 2">{{ __('lms.words.zone') }} 2</option>
                                            <option {{ isset($teacher) ? $teacher->zone =='Zona 3' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 3">{{ __('lms.words.zone') }} 3</option>
                                            <option {{ isset($teacher) ? $teacher->zone == 'Zona 4' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 4">{{ __('lms.words.zone') }} 4</option>
                                            <option {{ isset($teacher) ? $teacher->zone =='Zona 5' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 5">{{ __('lms.words.zone') }} 5</option>
                                            <option {{ isset($teacher) ? $teacher->zone =='Zona 6' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 6">{{ __('lms.words.zone') }} 6</option>
                                            <option {{ isset($teacher) ? $teacher->zone =='Zona 7' ? 'SELECTED' : '' : '' }}
                                                    value="Zona 7">{{ __('lms.words.zone') }} 7</option>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group js-error-block js-district-block">
                                    <label for="district" class="col-md-3 control-label">{{ __('lms.page.teacher.table.district') }}</label>
                                    <div class="col-md-9">
                                        <input id="district" type="text" class="form-control" name="district"
                                               value="{{ isset($teacher) ? $teacher->district : '' }}"
                                               placeholder="{{ __('lms.page.teacher.table.district') }}" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-dist_code-block">
                                    <label for="dist_code" class="col-md-3 control-label">{{ __('lms.page.teacher.table.district_code') }}</label>
                                    <div class="col-md-9">
                                        <input id="dist_code" type="text" class="form-control" name="dist_code"
                                               value="{{ isset($teacher) ? $teacher->district_code : '' }}"
                                               placeholder="{{ __('lms.page.teacher.table.district_code') }}" maxlength="10">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="box box-info">

                    <div class="box-header"><h3 class="box-title">Other info</h3></div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-reason_type-block">
                                    <label for="reason_type" class="col-md-3 control-label">{{ __('lms.words.reason_type') }}</label>
                                    <div class="col-md-9">
                                        <input id="reason_type" type="text" class=" form-control" name="reason_type"
                                               value="{{ isset($teacher) ? $teacher->reason_type : '' }}"
                                               placeholder="{{ __('lms.words.reason_type') }}" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-action_type-block">
                                    <label for="speciality" class="col-md-3 control-label">{{ __('lms.words.speciality') }}</label>
                                    <div class="col-md-9">
                                        <input id="speciality" type="text" class="form-control" name="speciality"
                                               value="{{ isset($teacher) ? $teacher->speciality : '' }}"
                                               placeholder="{{ __('lms.words.speciality') }}" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-action_type-block">
                                    <label for="action_type" class="col-md-3 control-label">{{ __('lms.words.action_type') }}</label>
                                    <div class="col-md-9">
                                        <input id="action_type" type="text" class=" form-control" name="action_type"
                                               value="{{ isset($teacher) ? $teacher->action_type : '' }}"
                                               placeholder={{ __('lms.words.action_type') }} maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-action_description-block">
                                    <label for="action_description" class="col-md-3 control-label">{{ __('lms.words.action_description') }}</label>
                                    <div class="col-md-9">
                                        <input id="action_description" type="text" class=" form-control" name="action_description"
                                               value="{{ isset($teacher) ? $teacher->action_description : '' }}"
                                               placeholder="{{ __('lms.words.action_description') }}" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-disability-block">
                                    <label for="disability" class="col-md-3 control-label">{{ __('lms.words.disability') }}</label>
                                    <div class="col-md-9">
                                        <input id="disability" type="text" class="form-control" name="disability"
                                               value="{{ isset($teacher) ? $teacher->disability : '' }}"
                                               placeholder="{{ __('lms.words.disability') }}" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-ethnic_group-block">
                                    <label for="ethnic_group" class="col-md-3 control-label">{{ __('lms.words.ethnic_group') }}</label>
                                    <div class="col-md-9">
                                        <input id="ethnic_group" type="text" class="form-control" name="ethnic_group"
                                               value="{{ isset($teacher) ? $teacher->ethnic_group : '' }}"
                                               placeholder={{ __('lms.words.ethnic_group') }} maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="col-md-12">
                    <button type="button" class="btn btn-submit-teacher btn-block btn-info"
                            data-type="{{ isset($teacher) ? 'update' : 'insert' }}"
                            data-id="{{ isset($teacher) ? $teacher->id : '' }}"
                            ><i class="fa fa-upload"></i> Submit</button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="js-message"></div>
            </div>
        </div>

    </form>

    <br/>
    @include('lms.admin.teacher.profile.portfolios')

    @include('lms.admin.teacher.profile.upcoming')



@stop
