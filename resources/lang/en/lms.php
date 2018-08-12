<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 06/05/2018
     * Time: 4:58 PM
     */

    return [

        'menu' => [
            'main_nav'          => 'MAIN NAVIGATION',
            'account_settings'  => 'ACCOUNT SETTINGS',
            'teachers'          => [
                'title'         => 'Teachers',
                'all'            => 'Teachers List',
                'portfolio'     => 'Teacher Portfolio',
                'registration_inspection'  => 'Registration Inspection',
            ],
            'course'            => [
                'title'             => 'Courses',
                'all'               => 'Courses List',
                'upcoming_courses'  => 'Upcoming Courses',
                'my_courses'        => 'My Courses',

            ],
            'user'              => [
                'my_portfolio'  => 'My Portfolio',
                'my_requests'  => 'Registration Requests'
            ],
            'university'        => 'University',
            'profile'           => 'My Profile',
			'master_course'     => 'Master Course',
            'settings'          => [
                                'title' => 'Settings',
                                'user_management' => 'User Management',
                                'location' => [
                                    'title' => 'Location',
                                    'province'  => 'Province',
                                    'canton'    => 'Canton',
                                    'parroquia'    => 'PARROQUIA',
                                ],
            ],
            'category'          => [
                                'title' => 'Category',
                                'type' => 'Type',
                                'label' => 'Label',
                                'sublabel' => 'Sublabel',
                                'knowledge' => 'Area of Knowledge',
                                'subject' => 'Subject'
            ]
        ],
        'location' => [
            'province' => [
                'index' => [
                    'page_header'=> 'Province',
                    'table_header' => 'Province List'
                ],
                'table' => [
                    'id'                => 'Id',
                    'province_name'     => 'Province',
                    'cantons'           => 'Cantons',
                    'action'            => 'Action'
                ]
            ],
            'canton' => [
                'index' => [
                    'page_header'       => 'Canton',
                    'table_header'      => 'Canton List'
                ],
                'table' => [
                    'province_name'     => 'Province',
                    'canton_name'       => 'Canton Name',
                    'canton_capital'    => 'Capital',
                    'district_name'     => 'District',
                    'district_code'     => 'Dist. Code',
                    'zone'              => 'Zone',
                    'action'            => 'Action'
                ]
            ],
            'parroquia' => [
                'index' => [
                    'page_header'       => 'Parroquia',
                    'table_header'      => 'Parroquia List'
                ],
                'table' => [
                    'province_name'     => 'Province',
                    'canton_name'       => 'Canton Name',
                    'parroquia'         => 'Parroquia',
                    'action'            => 'Action'
                ]
            ]
        ],
        'page' => [
            'teacher' => [
                'index' => [
                    'page_header'=> 'Teacher Portfolio',
                    'table_header' => 'Teacher Portfolio'
                ],
                'table' => [
                    'id'                => 'Id',
                    'security_id'       => 'Social Id',
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'moodle_id'          => 'Id Moodle',
                    'university'        => 'University',
                    'function'          => 'Function',
                    'location'          => 'Address',
                    'province'          => 'Province',
                    'edition'          => 'Edition',
                    'canton'            => 'Canton',
                    'district'          => 'District',
                    'district_code'     => 'District code',
                    'course_type'       => 'Course Type',
                    'course_name'       => 'Course Name',
                    'modality'          => 'modality',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'year'              => 'Year',
                    'approved'          => 'Approved',
                    'certificate'       => 'Certificate',
                    'diploma'           => 'Diploma',
                    'action'            => 'Action',
                ],
                'form' => [
                    'edit_title'        => 'Edit Teacher',
                    'add_title'         => 'Add New Teacher',
                ]
            ],
            'teacher_profile' => [
                'index' => [
                    'page_header'=> 'Teacher Profile',
                    'table_header' => 'Teacher Portfolio'
                ],
                'table' => [
                    'course_type'       => 'Course Type',
                    'course_name'       => 'Course Name',
                    'institute'         => 'University',
                    'modality'          => 'Modality',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'status'            => 'Status',
                    'certificate'       => 'Certificate',
                ]
            ],
            'course' => [
                'index' => [
                    'page_header'=> 'Course Management',
                    'table_header' => 'Courses - Inspection Processes'
                ],
                'table' => [
                    'id'                => 'Id',
                    'master_course'     => 'Master Course',
                    'course_id'         => 'Course Id',
                    'course_name'         => 'Course Name',
                    'short_name'        => 'Short Name',
                    'modality'          => 'Modality',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'grade_entry_start_date'  => 'Grade entry Start Date',
                    'grade_entry_end_date'    => 'Grade entry End Date',
                    'year'              => 'Year',
                    'quota'             => 'Quota',
                    'comment'           => 'Comment',
                    'state'             => 'State',
                    'edition'           => 'Edition',
                    'upload_rating'     => 'Upload Rating',
                    'action'            => 'Editor',
                    'stage'             => 'Stage',
                    'status'            => 'Status',
                ],
                'form'  =>[
                    'edit_title'        => 'Edit Course',
                    'add_title'         => 'Add New Course',
                    'course_id'         => 'Course Code',
                    'course_type'       => 'Course Type',
                    'course_modality'   => 'Modality',
                    'university'        => 'University',
                    'short_name'        => 'Short Name',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start date',
                    'end_date'          => 'End date',
                    'year'              => 'Year',
                    'quota'             => 'Quota',
                    'comment'           => 'Comment',
                    'description'       => 'Description',
                    'terms_condition'   => 'Terms & Condition',
                    'video'             => 'Video Information',
                    'video_type'        => 'Video Type',
                    'master_course'     => 'Master Course',
                    'cost'              => 'Cost',
                    'finance_type'      => 'Finance Type',
                    'video_embed'       => 'Embed Code',
                    'stage'             => 'Stage',
                    'status'            => 'Status',
                    'disclaimer_required' => 'Disclaimer Required',
                    'data_update'       => 'Data Update Tab Info',
                    'data_update_instructions'       => 'Instructions',
                    'registrations'     => 'Registrations',
                    'inspection_file_message' => 'After creating the course, you can upload inspection file.'
                ],
            ],
            'master_course' =>[
              'index' => [
                'header' => 'Master Course',
                'subheader' => 'Master Course',
                'all_master_course' => 'All Master Course',
                'create_new_course_type' => 'Create new Course Type',
                'master_course_info' => 'Master Course Info',
              ],
              'table' => [
                'course' => 'Course',
                'courses' => 'Courses',
                'subject' => 'Subject',
                'child_courses' => 'Child Courses',
                'course_title' => 'Course Title',
                'course_code' => 'Course Code',
              ]
            ],
            'upcoming' => [
                'index' => [
                    'page_header'=> 'Upcoming Course',
                    'table_header' => 'My registerable courses'
                ],
                'table' => [
                    'course_code'       => 'Course Code',
                    'course_type'       => 'Course Type',
                    'short_name'        => 'Course',
                    'institution'       => 'University',
                    'modality'          => 'Modality',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'hours'             => 'Hours',
                    'action'            => 'Register',
                    'stage'             => 'Stage',
                    'status'            => 'Status',
                ]
            ],
            'register' => [
                'index' => [
                    'page_header'=> 'Register Course',
                    'table_header' => 'Register Course'
                ],
            ],
            'registration' => [
                'all' => [
                    'index' => [
                        'page_header'=> 'Browse Registrations',
                        'table_header' => 'Registrations List'
                    ],
                    'table' => [
                        'id'                => 'Id',
                        'security_id'       => 'Social Id',
                        'name'              => 'Name',
                        'email'             => 'Email',
                        'moodle_id'          => 'Id Moodle',
                        'university'        => 'University',
                        'function'          => 'Function',
                        'location'          => 'Address',
                        'province'          => 'Province',
                        'canton'            => 'Canton',
                        'district'          => 'District',
                        'action'            => 'Action'
                    ]
                ],
                'pending' => [
                    'index' => [
                        'page_header'=> 'Search Course',
                        'table_header' => 'Pending Registrations',
                    ],
                    'table' => [
                        'course_code'       => 'Course Code',
                        'short_name'        => 'Short Name',
                        'institute'         => 'Institute',
                        'start_date'        => 'Start Date',
                        'end_date'          => 'End Date',
                        'security_id'       => 'Social Id',
                        'name'              => 'Name',
                        'email'             => 'Email',
                        'terms_condition'   => 'Terms & Condition',
                        'record_uploaded'   => 'Record Uploaded',
                        'is_approved'       => 'Approved',
                        'approved_by'       => 'Approved By',
                        'by'                => 'By',
                        'action'            => 'Action'
                    ]
                ]
            ],
            'university' => [
                'index' => [
                    'page_header'=> 'University Portfolio',
                    'table_header' => 'University Portfolio'
                ],
                'table' => [
                    'id'                => 'Id',
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'login_name'        => 'Login Name',
                    'login_email'       => 'Login Email',
                    'website'           => 'Website',
                    'phone'             => 'Phone',
                    'created_by'        => 'Created By',
                    'created_at'        => 'Created At',
                    'action'            => 'Action'
                ],
                'form'  =>[
                    'edit_title'        => 'Edit University',
                    'add_title'         => 'Add New University',
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'login_name'        => 'Login Name',
                    'login_email'       => 'Login Email',
                    'website'           => 'Website',
                    'phone'             => 'Phone',
                    'note'              => 'Note',
                    'profile_photo'     => 'Profile Photo',
                    'login_message'     => 'These login information will be used to create login user for university.'
                ],
                'view' => [
                    'table_header'      => 'Course list'
                ]
            ],
            'user' => [
                'index' => [
                    'page_header'=> 'User Management',
                    'table_header' => 'All Users List'
                ],
                'table' => [
                    'id'                => 'Id',
                    'first_name'        => 'First Name',
                    'last_name'         => 'Last Name',
                    'email'             => 'Email',
                    'role'              => 'Role',
                    'status'            => 'Status',
                    'creation_type'     => 'Creation Type',
                    'created_at'        => 'Created At',
                    'action'            => 'Action'
                ],
                'form'  =>[
                    'edit_title'        => 'Edit User',
                    'add_title'         => 'Add New User',
                    'first_name'        => 'First Name',
                    'last_name'         => 'Last Name',
                    'email'             => 'Email',
                    'role'              => 'Role',
                    'status'            => 'Status',
                ]
            ],
            'category' => [
                'titles'=> [
                  'type'      => 'Type',
                  'label'     => 'Label',
                  'sublabel'  => 'Sub Label',
                  'knowledge' => 'Knowledge',
                  'subject'   => 'Subject'
                ],
                'label' => [
                    'index' => [
                        'name'=> 'Label',
                        'page_header'=> 'Category Label Management',
                        'table_header' => 'All Label List'
                    ],
                    'table' => [
                        'id'                => 'Id',
                        'title'             => 'Title',
                        'action'            => 'Action',
                        'edit'            => 'Edit',
                        'remove'            => 'Remove',
                    ],
                    'form'  =>[
                        'edit_title'        => 'Edit Category Title',
                        'add_title'         => 'Add Category Title',
                        'remove_title'      => 'Remove Category Title',
                        'title'             => 'Title',
                    ]
                ]
            ]
        ],
        'elements' => [
            'button' => [
                'add'       => 'Add',
                'add_new'   => 'Add New',
                'edit'      => 'Edit',
                'create'    => 'Create',
                'delete'    => 'Delete',
                'remove'    => 'Remove',
                'save'      => 'Save',
                'close'     => 'Close',
                'cancel'    => 'Cancel',
                'retry'     => 'Retry',
                'import'    =>  'Import',
                'upload'    =>  'Upload',
                'finish'    =>  'Finish',
                'update'    =>  'Update',
                'change'    =>  'Change',
                'upload_diploma' => 'Diploma',
                'upload_course_request' => 'Upload Course Request', // in course list page
                'new_course_upload' => 'Upload New Course' // in course list page
            ],
        ],
        'words' =>[
            'ethnic_group'=> 'Ethnic Group',
            'disability'=> 'Disability',
            'action_type'=> 'Action Type',
            'action_description'=> 'Action Description',
            'speciality'=> 'Speciality',
            'reason_type'=> 'Reason Type',
            'location_info'=> 'Location Info',
            'function'=> 'Function',
            'category'=> 'Category',
            'work_hours' => 'Work hours',
            'work_area' => 'Work Area',
            'institute_email' => 'Institute Email',
            'work_details' => 'Work Details',
            'date_end' => 'End Date',
            'date_join' => 'Join Date',
            'personal_info' => 'Personal info',
            'university_info' => 'University info',
            'date_of_birth' => 'Date of Birth',
            'gender' => 'Gender',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'social_id' => 'Social Id',
            'course'                => 'Course',
            'course_modality'       => 'Course Modality',
            'diploma'               => 'Diploma',
            'grade'                 => 'Grade',
            'zone'                  => 'Zone',
            'last_updated'          => 'Last updated',
            'add_grade'             => 'Add Grade',
            'by'                    => 'by',
            'university' => 'University',
            'male' => 'Male',
            'female' => 'Female',
            'teacher' => 'teacher',
            'draft' => 'draft',
            'published' => 'published',
            'no' => 'No',
            'yes' => 'Yes',
            'approved' => 'Approved',
            'not_approved' => 'Not approved',
            'search' => 'Search',
            'search_by' =>'Search by',
            'search_term' =>'Search term',
            'all_fields' => 'All Fields',
            'download' => 'Download',
            'pending' => 'Pending',
            'sign_in' => 'Sign in',
        ],
        'form' => [
          'name' => ' Nombre',
          'first_name' => 'First Name',
          'last_name' => 'Last Name',
          'title' => 'Title',
          'action' => 'Action',
          'active' => 'Active',
          'inactive' => 'Inactive',
          'code' => 'Code',
          'updated_by' => 'Updated By',
          'updated_at' => 'Updated at',
          'select_option' => 'Select Option',
          'delete_item' => 'Delete Item',
        ],
        'upload_form' => [
          'select_files' => 'Select files',
          'drop_files' => 'Drop files here',
          'proc_drop_files' => 'Processing dropped files...',
          'file_type' => '.csv, .xls, .xlsx are supported.',
          'update_files' => ' Update Files',
          'show_form' => 'Show Form',
        ],
        'profile' => [
          'profile' => 'Perfil',
          'update_account' => 'Actualizar Cuenta',
          'login_user_name' => 'Nombre de usuario de ingreso',
          'change_email' => 'Cambiar Email',
        ],
        'messages' => [
            'create_course' => 'Create Course',
            'change_pword' => 'Change Password',
            'confirm_pword' => 'Confirm Password',
			      'new_pword' => 'Change Password',
            'logged_in' => 'You are logged in!',
            'grade_approved_by' => 'Grade Approved By',
            'upload_terms_cond' => 'Upload terms & Conditions',
            'upload_lette_regi' => 'Upload Letter of Registration',
			      'email_used_login' => 'This email will be used as login email address.',
            'proceed_to_the_course' => 'Proceed to the course',
            'upload_new_course' => 'Upload New Course',
            'download_sample_file' => 'Download Sample File',
            'upload_diploma_zip_file' => 'Upload Diploma Zip File',
            'course_request_list_modal' => 'Course Request List Modal',
            'diploma_upload_message' => 'Diploma upload will be enabled From Grade Entry Start Date',
            'master_course_confirm_message' => 'Do you want to delete this. May be it has some course too.',
            'm_ad_user_login' => 'Login with Active Directory User',
            'm_au_user_login' => 'Login with Admin or Universities',
            'download_grade_template' => 'Download Grade Template',
            'error_title' => 'Error Notice',
            'error_body' => 'Sorry, you are not authorized to see that page.',
            'search_teacher' => 'Search by Name, SocialID, Email, AMIE or Phone',
        ]
    ];
