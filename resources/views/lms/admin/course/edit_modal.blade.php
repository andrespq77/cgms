<!-- Modal -->
<div class="modal" id="edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        <span class="js-modal-title-edit hidden">{{ __('lms.page.course.form.edit_title') }}</span>
                        <span class="js-modal-title-add">{{ __('lms.page.course.form.add_title') }}</span>
                    </h4>
            </div>
            <form class="form-horizontal js-edit-course-form" >

                <div class="modal-body">

                    <div class="js-course-form">


                        @component('lms.admin.components.form-group', [   'name' => 'master-course', 'grid' => 10,
                            'title' => __('lms.page.course.form.master_course')])
                            <select id="js-edit-course-master-course" style="width: 100%"
                                    class="js-edit-course-master-course js-select-master-course form-control js-lms-select2" >
                            </select>
                        @endcomponent

                        @component('lms.admin.components.form-group', [   'name' => 'course_type', 'grid' => 10,
                                'title' => __('lms.page.course.form.course_type')])
                            <select id="js-edit-course-type" class="js-edit-course-type js-lms-select2 form-control"
                                    style="width: 100%">
                            </select>
                        @endcomponent

                        @component('lms.admin.components.form-group', [   'name' => 'course-university', 'grid' => 10,
                                'title' => __('lms.page.course.form.university')])
                            <select id="js-edit-course-university" name="university" style="width: 100%"
                                class="js-edit-course-university js-select-university form-control js-lms-select2" >
                            </select>
                        @endcomponent

                        <div class="form-group">

                            <div class="js-error-block js-course_code-block">

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'course_code', 'grid' => 4,
                            'title' => __('lms.page.course.form.course_id')])
                                <input id="js-edit-course-code" type="text" class="js-edit-course-code form-control"
                                       name="course_code"
                                value="" required placeholder="{{ __('lms.page.course.form.course_id') }}" maxlength="100">
                                    <div class="help-block"></div>
                            @endcomponent
                            </div>

                            <div class="js-error-block js-course_edition-block">

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'course_edition', 'grid' => 4,
                                        'title' => 'Course Edition'])
                                <input id="js-edit-course-edition" type="text" class="js-edit-course-edition form-control"
                                name="course_edition" value="" required placeholder="Edition" maxlength="100">

                                    <div class="help-block"></div>
                                @endcomponent
                            </div>

                        </div>

                        @component('lms.admin.components.form-group', [   'name' => 'short_name', 'grid' => 10,
                                'title' => __('lms.page.course.form.short_name')])
                                <input id="js-edit-course-short_name" type="text"   maxlength="100" value=""
                                       class="js-edit-course-short_name form-control" name="short_name"
                                       placeholder={{ __('lms.page.course.form.short_name') }}/>
                        @endcomponent

                        <div class="form-group">

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'course-start_date', 'grid' => 4,
                                        'title' => __('lms.page.course.form.start_date')])
                                <input id="js-edit-course-start_date" type="text" autocomplete="off"
                                       class="js-edit-course-start_date js-datepicker form-control" name="Start Date"
                                       placeholder={{ __('lms.page.course.form.start_date') }}/>

                            @endcomponent

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'course-end_date', 'grid' => 4,
                                'title' => __('lms.page.course.form.end_date')])
                                    <input id="js-edit-course-end_date" type="text" autocomplete="off"
                                           class="js-edit-course-end_date js-datepicker form-control" name="end_date"
                                           placeholder={{ __('lms.page.course.form.end_date') }}/>
                            @endcomponent

                        </div>

                        <div class="form-group">

                            <div class="js-error-block js-grade-entry-start-date-block">

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'grade-entry-start-date',
                                'grid' => 4, 'title' => 'Grade Entry Start Date'])
                                <input id="js-edit-grade-entry-start-date" type="text" name="grade-entry-start-date"
                                       class="js-edit-grade-entry-start-date js-datepicker form-control"
                                       autocomplete="off" />

                            @endcomponent
                                <div class="help-block"></div>
                            </div>

                            <div class="js-error-block js-grade-entry-end-date-block">
                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'grade-entry-end-date',
                                    'grid' => 4, 'title' => 'Grade Entry End Date'])
                                    <input id="js-edit-grade-entry-end-date" type="text" name="grade-entry-end-date"
                                           class="js-edit-grade-entry-end-date js-datepicker form-control"
                                           autocomplete="off" />
                            @endcomponent
                                <div class="help-block"></div>
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="js-error-block js-hours-block">
                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'hours', 'grid' => 4,
                                'title' => __('lms.page.course.form.hours')])
                                <input id="js-edit-course-hours" type="number"
                                       class="js-edit-course-hours form-control" name="hours"
                                       value="" required placeholder={{ __('lms.page.course.form.hours') }} />
                                    <div class="help-block"></div>

                                @endcomponent
                            </div>

                            <div class="js-error-block js-quota-block">
                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'quota', 'grid' => 4,
                                'title' => __('lms.page.course.form.quota')])
                                    <input id="js-edit-course-quota" type="number"
                                           class="js-edit-course-quota form-control" name="quota"
                                           value="" required placeholder={{ __('lms.page.course.form.quota') }} />
                                    <div class="help-block"></div>
                                @endcomponent
                            </div>

                        </div>

                        @component('lms.admin.components.form-group', [   'name' => 'course_comment', 'grid' => 10,
                            'title' => __('lms.page.course.form.comment')])
                                <input id="js-edit-course-comment" type="text"
                                       class="js-edit-course-comment form-control" name="course_comment"
                                       value="" required placeholder={{ __('lms.page.course.form.comment') }} />
                        @endcomponent

                        @component('lms.admin.components.form-group', [   'name' => 'course_description', 'grid' => 10,
                        'title' => __('lms.page.course.form.description')])
                            <textarea id="js-edit-course-description" type="text"
                                      class="js-edit-course-description form-control" name="course_description"
                                      placeholder="{{ __('lms.page.course.form.description') }}" ></textarea>
                        @endcomponent

                        @component('lms.admin.components.form-group', [   'name' => 'course_video', 'grid' => 10,
                            'title' => __('lms.page.course.form.video_type')])
                                <textarea id="js-edit-course-video"
                                          class="js-edit-course-video form-control" name="course_video"
                                          placeholder="{{ __('lms.page.course.form.video') }}" ></textarea>
                        @endcomponent

                        <div class="form-group">
                            {{--@component('lms.admin.components.bootstrap.group_block', [   'name' => 'video_type', 'grid' => 4,--}}
                                {{--'title' => __('lms.page.course.form.video_type')])--}}
                                    {{--<select id="js-edit-course-video_type" name="video_type" style="width: 100%"--}}
                                            {{--class="js-edit-course-video_type js-select-video_type form-control js-lms-select2" >--}}
                                        {{--<option value="youtube">Youtube</option>--}}
                                    {{--</select>--}}
                            {{--@endcomponent--}}

                            @component('lms.admin.components.bootstrap.group_block',
                            [ 'name' => 'video_embed_code', 'grid' => 4, 'title' => ''])

                                @slot('label')
                                        <a href="javascript:void(0)" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Add youtube full url" data-triger="hover"
                                        data-content="" >
                                        <i class="fa fa-info"></i> </a> {{ __('lms.page.course.form.video_embed') }}
                                @endslot
                                    <input id="js-edit-course-video_embed_code"
                                           class="js-edit-course-video_embed_code form-control" name="video_embed_code"
                                           value="" required placeholder="{{ __('lms.page.course.form.video_embed') }}" />
                            @endcomponent

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'Disclaimer Required', 'grid' => 4,
                                'title' => __('lms.page.course.form.disclaimer_required')])
                                <select id="js-edit-course-disclaimer_required" name="disclaimer_required" style="width: 100%"
                                        class="js-edit-course-disclaimer_required js-select-disclaimer_required form-control" >
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            @endcomponent

                        </div>

                        @component('lms.admin.components.form-group', [   'name' => 'course_terms_condition', 'grid' => 10,
                                              'title' => __('lms.page.course.form.terms_condition')])
                                <textarea id="js-edit-course-terms_condition"
                                          class="js-edit-course-terms_condition form-control" name="course_terms_condition"
                                          placeholder="{{ __('lms.page.course.form.terms_condition') }}" ></textarea>
                        @endcomponent

                        @component('lms.admin.components.form-group', [   'name' => 'course_data_update', 'grid' => 10,
                            'title' => __('lms.page.course.form.data_update')])
                                <textarea id="js-edit-course-data_update"
                                          class="js-edit-course-data_update form-control" name="course_data_update"
                                          placeholder="{{ __('lms.page.course.form.data_update') }}" ></textarea>
                        @endcomponent

                        <div class="form-group">
                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'course_stage', 'grid' => 4,
                                'title' => __('lms.page.course.form.stage')])
                                <select id="js-edit-course-stage" name="course_stage"
                                        class="js-edit-course-stage js-select-course-stage form-control" >
                                    <option value="0">Draft</option>
                                    <option value="1">Published</option>
                                </select>
                            @endcomponent

                            @component('lms.admin.components.bootstrap.group_block', [   'name' => 'course_status', 'grid' => 4,
                                'title' => __('lms.page.course.form.status')])
                                <select id="js-edit-course-status" name="course_status"
                                        class="js-edit-course-status js-select-course-status form-control" >
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            @endcomponent
                        </div>
                        <div class="form-group">
                            @component('lms.admin.components.bootstrap.group_block', ['name' => 'Cost', 'grid' => 4,
                                'title' => __('lms.page.course.form.cost')])
                                <input id="js-edit-course-cost" class="js-edit-course-cost form-control" type="number"
                                        step="any" placeholder="{{ __('lms.page.course.form.cost') }}" />
                            @endcomponent

                            @component('lms.admin.components.bootstrap.group_block', ['name' => 'Finance Type', 'grid' => 4,
                                'title' => __('lms.page.course.form.finance_type')])
                                    <input id="js-edit-course-finance_type" type="text" maxlength="200"
                                           class="js-edit-course-finance_type form-control"
                                           required placeholder="{{ __('lms.page.course.form.finance_type') }}" />
                            @endcomponent
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <input type="hidden" name="id" class="js-course-id" value=""/>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                        <i class="fa fa-info-circle"></i> <code>{{ __('lms.page.course.form.inspection_file_message')  }}</code>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="row js-course-inspection-form hidden">

                        <div class="col-md-12 col-md-12 col-sm-12">

                            <code>Upload Terms and Condition</code>
                            <div id="course-terms_condition-uploader-manual-trigger"></div>

                            <code>Upload Letter of Registration</code>
                            <div id="course-letter_of_registration-uploader-manual-trigger"></div>

                            <div class="js-disclaimer-wrapper hidden">
                            <code>Upload Disclaimer</code>
                            <div id="course-disclaimer-uploader-manual-trigger"></div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="row">

                        <div class="col-lg-6 col-sm-6 col-md-6 text-left">
                            <button class="btn btn-info btn-update-course-files hidden"
                                    type="button"><i class="fa fa-cloud-upload"></i> Update Files</button>
                            <button class="btn btn-info btn-show-course-form hidden"
                                    type="button">Show Form</button>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="btn-edit-course" data-id="" class="btn btn-primary" data-type="update">
                                <i class="fa fa-plus"></i> Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('lms.admin.course.templates.terms_condition_upload_template')
@include('lms.admin.course.templates.letter_of_registration_template')
@include('lms.admin.course.templates.disclaimer_upload_template')