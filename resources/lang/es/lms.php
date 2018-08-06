<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 06/05/2018
     * Time: 4:58 PM
     */

    return [

        'menu' => [
            'main_nav'          => 'NAVEGACIÓN PRINCIPAL',
            'account_settings'  => 'CONFIGURACIONES DE LA CUENTA',
            'teachers'          => [
                'title'         => 'Maestros',
                'all'            => 'Lista de Maestros',
                'portfolio'     => 'Portafolio del Docente',
                'registration_inspection'  => 'Inspección de Registro',
            ],
            'course'            => [
                'title'             => 'Cursos',
                'all'               => 'Lista de Cursos',
                'upcoming_courses'  => 'Próximos cursos',
                'my_courses'        => 'Mis cursos',

            ],
            'user'              => [
                'my_portfolio'  => 'Mi Portafolio',
                'my_requests'  => 'Solicitudes de Registro'
            ],
            'university'        => 'Universidad',
            'profile'           => 'Mi perfil',
            'settings'          => [
                'title' => 'Ajustes',
                'user_management' => 'Gestión de usuarios',
                'location' => [
                    'title' => 'Ubicación',
                    'province'  => 'Provincia',
                    'canton'    => 'Cantón',
                    'parroquia'    => 'Parroquia',
                ],
            ]
        ],
        'location' => [
            'province' => [
                'index' => [
                    'page_header'=> 'Provincia',
                    'table_header' => 'Lista de Provincias'
                ],
                'table' => [
                    'id'                => 'Id',
                    'province_name'     => 'Provincia',
                    'cantons'           => 'Cantones',
                    'action'            => 'Acción'
                ]
            ],
            'canton' => [
                'index' => [
                    'page_header'       => 'Cantón',
                    'table_header'      => 'Lista de Cantones'
                ],
                'table' => [
                    'province_name'     => 'Provincia',
                    'canton_name'       => 'Nombre del Cantón',
                    'canton_capital'    => 'Capital',
                    'district_name'     => 'Distrito',
                    'district_code'     => 'Código Dist.',
                    'zone'              => 'Zona',
                    'action'            => 'Acción'
                ]
            ],
            'parroquia' => [
                'index' => [
                    'page_header'       => 'Parroquia',
                    'table_header'      => 'Lista de Parroquias'
                ],
                'table' => [
                    'province_name'     => 'Provincia',
                    'canton_name'       => 'Nombre del Cantón',
                    'parroquia'         => 'Parroquia',
                    'action'            => 'Acción'
                ]
            ]


        ],
        'page' => [
            'teacher' => [
                'index' => [
                    'page_header'=> 'Portafolio del docente',
                    'table_header' => 'Portafolio del docente'
                ],
                'table' => [
                    'id'                => 'Id',
                    'security_id'       => 'Cédula',
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'moodle_id'          => 'Id Moodle',
                    'university'        => 'Universidad',
                    'function'          => 'Funcción',
                    'location'          => 'Dirección',
                    'province'          => 'Provincia',
                    'canton'            => 'Cantón',
                    'district'          => 'Distrito',
                    'course_type'       => 'Tipo de Curso',
                    'course_name'       => 'Nombre de Curso',
                    'modality'          => 'modalidad',
                    'hours'             => 'Horas',
                    'start_date'        => 'Fecha Inicial',
                    'end_date'          => 'Fecha Final',
                    'year'              => 'Año',
                    'approved'          => 'Aprovado',
                    'certificate'       => 'Certificado',
                    'diploma'           => 'Diploma',

                    'action'            => 'Acción',
                ],
                'form' => [
                    'edit_title'        => 'Editar profesor',
                    'add_title'         => 'Agregar nuevo maestro',
                ]

            ],
            'teacher_profile' => [
                'index' => [
                    'page_header'=> 'Perfil del profesor',
                    'table_header' => 'Perfil del profesor'
                ],
                'table' => [
                    'course_type'       => 'Tipo de Curso',
                    'course_name'       => 'Nombre de Curso',
                    'institute'         => 'Universidad',
                    'modality'          => 'Modalidad',
                    'hours'             => 'Horas',
                    'start_date'        => 'Fecha de inicio',
                    'end_date'          => 'Fecha final',
                    'status'            => 'Estado',
                    'certificate'       => 'Certificado',
                ]
            ],
            'course' => [
                'index' => [
                    'page_header'=> 'Dirección del curso',
                    'table_header' => 'Cursos - Procesos de inspección'
                ],
                'table' => [
                    'id'                => 'Id',
                    'course_id'         => 'Id de Curso',
                    'short_name'        => 'Nombre corto',
                    'hours'             => 'Horas',
                    'start_date'        => 'Fecha Inicial',
                    'end_date'          => 'Fecha Final',
                    'Year'              => 'Año',
                    'quota'             => 'Cuota',
                    'comment'           => 'Commentario',
                    'state'             => 'Estado',
                    'upload_rating'     => 'Subir Rating',
                    'action'            => 'Editor'
                ],
                'form'  =>[
                    'edit_title'        => 'Editar Cursp',
                    'add_title'         => 'Agragar Nuevo Curso',
                    'course_id'         => 'Código de Curso',
                    'course_type'       => 'Tipo de Curso',
                    'course_modality'   => 'Modalidad',
                    'university'        => 'Universidad',
                    'short_name'        => 'Nombre Corto',
                    'hours'             => 'Horas',
                    'start_date'        => 'Fecha Inicial',
                    'end_date'          => 'Fecha Final',
                    'quota'             => 'Cuota',
                    'comment'           => 'Commentario',
                    'description'       => 'Descripción',
                    'terms_condition'   => 'Términos y Condiciones',
                    'video'             => 'Informción de Video',
                    'video_type'        => 'Tipo de Video',
                    'video_embed'       => 'Código Embebido',
                    'data_update'       => 'Pestaña informativa de Subida de datos',
                    'registrations'     => 'Registrations',
                    'inspection_file_message' => 'Despues de crear el curso, usted puede subit el archivo de inspección.'
                ],
            ],
            'upcoming' => [
                'index' => [
                    'page_header'=> 'Próximo curso',
                    'table_header' => 'Mis cursos registrables'
                ],
                'table' => [
                    'course_code'       => 'Código de Curso',
                    'course_type'       => 'Tipo de Curso',
                    'short_name'        => 'Curso',
                    'institution'       => 'Universidad',
                    'modality'          => 'Modalidad',
                    'start_date'        => 'Fecha Inicial',
                    'end_date'          => 'Fecha Final',
                    'hours'             => 'Horas',
                    'action'            => 'Registrar'
                ]

            ],
            'register' => [
                'index' => [
                    'page_header'=> 'Registrar curso',
                    'table_header' => 'Registrar curso'
                ],
            ],
            'registration' => [
                'all' => [
                    'index' => [
                        'page_header'=> 'Examinar registros',
                        'table_header' => 'Lista de inscripciones'
                    ],
                    'table' => [
                        'id'                => 'Id',
                        'security_id'       => 'Cédula',
                        'name'              => 'Nombre',
                        'email'             => 'Email',
                        'moodle_id'         => 'Id Moodle',
                        'university'        => 'Universidad',
                        'function'          => 'Funcción',
                        'location'          => 'Dirección',
                        'province'          => 'Provincia',
                        'canton'            => 'Cantón',
                        'district'          => 'Distrito',
                        'action'            => 'Acción'
                    ]
                ],
                'pending' => [
                    'index' => [
                        'page_header'=> 'Buscar curso',
                        'table_header' => 'Registros pendientes',

                    ],
                    'table' => [
                        'course_code'       => 'Código de curso',
                        'short_name'        => 'Nombre Corto',
                        'institute'         => 'Institución',
                        'start_date'        => 'Fecha Inicial',
                        'end_date'          => 'Fecha Final',
                        'security_id'       => 'Cédula',
                        'name'              => 'Nombre',
                        'email'             => 'Email',
                        'terms_condition'   => 'Términos & Condiciones',
                        'record_uploaded'   => 'Registro subido',
                        'is_approved'       => 'Aprobado',
                        'approved_by'       => 'Aprobado por',
                        'by'                => 'por',
                        'action'            => 'Acción'
                    ]
                ]
            ],
            'university' => [
                'index' => [
                    'page_header'=> 'Portafolio de la Universidad',
                    'table_header' => 'Portafolio de la Universidad'
                ],
                'table' => [
                    'id'                => 'Id',
                    'name'              => 'Nombre',
                    'email'             => 'Email',
                    'login_name'        => 'Nombre de ingreso',
                    'login_email'       => 'Email de ingreso',
                    'website'           => 'Website',
                    'phone'             => 'Teléfono',
                    'created_by'        => 'Creado por',
                    'created_at'        => 'Creado el',
                    'action'            => 'Acción'
                ],
                'form'  =>[
                    'edit_title'        => 'Editar Universidad',
                    'add_title'         => 'Agregar nueva universidad',
                    'name'              => 'Nombre',
                    'email'             => 'Email',
                    'login_name'        => 'Nombre de ingreso',
                    'login_email'       => 'Email de ingreso',
                    'website'           => 'Website',
                    'phone'             => 'Teléfono',
                    'note'              => 'Nota',
                    'profile_photo'     => 'Foto de perfil',
                    'login_message'     => 'Esta información de ingreso sera usada para crear el usuario de ingreso para la universidad.'
                ],
                'view' => [
                    'table_header'      => 'Lista de cursos'
                ]

            ],
            'user' => [
                'index' => [
                    'page_header'=> 'Gestión de usuarios',
                    'table_header' => 'Lista de todos los usuarios'
                ],
                'table' => [
                    'id'                => 'Id',
                    'first_name'        => 'Nombre',
                    'last_name'         => 'Apellido',
                    'email'             => 'Email',
                    'role'              => 'Rol',
                    'status'            => 'Estado',
                    'creation_type'     => 'Tipo de Creación',
                    'created_at'        => 'Creado el',
                    'action'            => 'Acción'
                ],
                'form'  =>[
                    'edit_title'        => 'Editar Usuario',
                    'add_title'         => 'Agregar Nuevo Usuario',
                    'first_name'        => 'Nombre',
                    'last_name'         => 'Apellido',
                    'email'             => 'Email',
                    'role'              => 'Rol',
                    'status'            => 'Estado',
                ]

            ]


        ],
        'elements' => [
            'button' => [
                'edit'      => 'Editar',
                'create'    => 'Crear',
                'delete'    => 'Eiminar',
                'remove'    => 'Borrar',
                'close'     => 'Cerrar',
                'import'    =>  'Importar',
                'upload'    =>  'Subir',
                'upload_diploma' => 'Diploma',
                'upload_course_request' => 'Cargar solicitud de curso', // in course list page
                'new_course_upload' => 'Cargar un nuevo curso' // in course list page
            ],
        ],
        'words' =>[
            'ethnic_group'=> 'Grupo étnico',
            'disability'=> 'Discapacidad',
            'action_type'=> 'Tipo de acción',
            'action_description'=> 'Acción Descripción',
            'speciality'=> 'Especialidad',
            'reason_type'=> 'Tipo de razón',
            'location_info'=> 'Información de ubicación',
            'function'=> 'Función',
            'category'=> 'Categoría',
            'work_hours' => 'Horas laborales',
            'work_area' => 'Área de trabajo',
            'institute_email' => 'Email del instituto',
            'work_details' => 'Detalles del trabajo',
            'date_end' => 'Fecha final',
            'date_join' => 'Fecha de Ingreso',
            'personal_info' => 'Información personal',
            'university_info' => 'Información universitaria',
            'date_of_birth' => 'Fecha de nacimiento',
            'gender' => 'Género',
            'mobile' => 'Móvil',
            'email' => 'Email',
            'telephone' => 'Teléfono',
            'social_id' => 'Social Id',
            'course'    => 'Curso',
            'course_modality' => 'Course Modality',
            'diploma' => 'Diploma',
            'grade' => 'Grado',
            'zone'  => 'Zona',
            'last_updated' => 'Última actualización',
            'add_grade'             => 'Add Grade',
            'by' => 'por',
        ],
        'messages' => [
            'create_course' => 'Crear curso',
            'grade_approved_by' => 'Grado aprobado por',
            'proceed_to_the_course' => 'Proceda al curso',
            'upload_new_course' => 'Cargar un nuevo curso',
            'download_sample_file' => 'Descargar archivo de muestra',
            'upload_diploma_zip_file' => 'Upload Diploma Zip File',
            'course_request_list_modal' => 'Course Request List Modal',
            'diploma_upload_message' => 'La carga del diploma se habilitará desde la fecha de inicio de la entrada al grado',
            'master_course_confirm_message' => '¿Quieres borrar esto? Puede ser que tenga algún curso para niños.'

        ]
    ];
