<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $categories = [
            [
                'title' => 'DISCIPLINAR',
                'labels' => [
                    [
                        'title' => 'Educación Inicial',
                        'subLabels' => [
                            [
                                'title' => 'Inicial I',
                                'knowledges' => [
                                    [
                                        'title' => 'Educación Inicial',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Inicial'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Inicial II',
                                'knowledges' => [
                                    [
                                        'title' => 'Educación Inicial',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Inicial'
                                            ]
                                        ]
                                    ]
                                ]
                            ]

                        ]
                    ],
                    [
                        'title' => 'Educación General Básica',
                        'subLabels' => [
                            [
                                'title' => 'Preparatoria',
                                'knowledges' => [
                                    [
                                        'title' => 'Preparatoria (1ero de EGB)',
                                        'subjects' => [
                                            [
                                                'title' => 'Preparatoria (1ero de EGB)'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Básica Elemental',
                                'knowledges' => [
                                    [
                                        'title' => 'Generalistas',
                                        'subjects' => [
                                            [
                                                'title' => 'Generalistas'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Básica Media',
                                'knowledges' => [
                                    [
                                        'title' => 'Generalistas',
                                        'subjects' => [
                                            [
                                                'title' => 'Generalistas'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Básica Superior',
                                'knowledges' => [
                                    [
                                        'title' => 'Generalistas',
                                        'subjects' => [
                                            [
                                                'title' => 'Generalistas'
                                            ]
                                        ]
                                    ]
                                ]
                            ]



                        ]
                    ],
                    [
                        'title' => 'Bachillerato General Unificado',
                        'subLabels' => [
                            [
                                'title' => 'Bachillerato General Unificado',
                                'knowledges' => [
                                    [
                                        'title' => 'Lengua y Literatura',
                                        'subjects' => [
                                            [
                                                'title' => 'Lengua y Literatura'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Matemática',
                                        'subjects' => [
                                            [
                                                'title' => 'Matemática'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Ciencias Sociales',
                                        'subjects' => [
                                            [
                                                'title' => 'Ciencias Sociales'
                                            ],
                                            [
                                                'title' => 'Historia'
                                            ],
                                            [
                                                'title' => 'Filosofia'
                                            ],
                                            [
                                                'title' => 'Educación para la Ciudadanía'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Ciencias Naturales',
                                        'subjects' => [
                                            [
                                                'title' => 'Ciencias Naturales'
                                            ],
                                            [
                                                'title' => 'Biología'
                                            ],
                                            [
                                                'title' => 'Física'
                                            ],
                                            [
                                                'title' => 'Química'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Interdisciplinar',
                                        'subjects' => [
                                            [
                                                'title' => 'Emprendimiento y Gestión'
                                            ]
                                        ]
                                    ],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Bachillerato Internacional',
                        'subLabels' => [
                            [
                                'title' => 'Bachillerato Internacional',
                                'knowledges' => [
                                    [
                                        'title' => 'Bachillerato Internacional',
                                        'subjects' => [
                                            [
                                                'title' => 'Bachillerato Internacional'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Bachillerato Técnico',
                        'subLabels' => [
                            [
                                'title' => 'Bachillerato Técnico',
                                'knowledges' => [
                                    [
                                        'title' => 'Especialización Técnica',
                                        'subjects' => [
                                            [
                                                'title' => 'Especialización Técnica'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Otros',
                                        'subjects' => [
                                            [
                                                'title' => 'Otros'
                                            ]
                                        ]
                                    ]

                                ]
                            ]

                        ]
                    ],
                    [
                        'title' => 'Educación Especializada e Inclusiva',
                        'subLabels' => [
                            [
                                'title' => 'Educación Especializada e Inclusiva',
                                'knowledges' => [
                                    [
                                        'title' => 'Educación Especializada e Inclusiva',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Especializada e Inclusiva'
                                            ]
                                        ]
                                    ],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Educación Intercultural Bilingüe',
                        'subLabels' => [
                            [
                                'title' => 'Educación Intercultural Bilingüe',
                                'knowledges' => [
                                    [
                                        'title' => 'Educación Intercultural Bilingüe',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Intercultural Bilingüe'
                                            ]
                                        ]
                                    ],
                                ]
                            ]

                        ]
                    ],
                    [
                        'title' => 'Todos',
                        'subLabels' => [
                            [
                                'title' => 'Todos',
                                'knowledges' => [
                                    [
                                        'title' => 'Directivos',
                                        'subjects' => [
                                            [
                                                'title' => 'Directivos'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Educación Física',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Física'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Educación Cultural y Artística',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Cultural y Artística'
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => 'Lengua Extranjera',
                                        'subjects' => [
                                            [
                                                'title' => 'Lengua Extranjera'
                                            ]
                                        ]
                                    ]
                                ]
                            ]

                        ]
                    ]

                ]
            ],
            [
                'title' => 'TRANSVERSAL',
                'labels' => [
                    [
                        'title' => 'Transversal',
                        'subLabels' => [
                            [
                                'title' => 'Transversal',
                                'knowledges' => [
                                    [
                                        'title' => 'Transversal',
                                        'subjects' => [
                                            [
                                                'title' => 'Transversal'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Educación Especializada e Inclusiva',
                        'subLabels' => [
                            [
                                'title' => 'Educación Especializada e Inclusiva',
                                'knowledges' => [
                                    [
                                        'title' => 'Educación Especializada e Inclusiva',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Especializada e Inclusiva'
                                            ]
                                        ]
                                    ]
                                ]
                            ]

                        ]
                    ],
                    [
                        'title' => 'Educación Intercultural Bilingüe',
                        'subLabels' => [
                            [
                                'title' => 'Educación Intercultural Bilingüe',
                                'knowledges' => [
                                    [
                                        'title' => 'Educación Intercultural Bilingüe',
                                        'subjects' => [
                                            [
                                                'title' => 'Educación Intercultural Bilingüe'
                                            ]
                                        ]
                                    ]
                                ]
                            ]

                        ]
                    ]
                ]
            ],
            [
                'title' => 'OTROS',
                'labels' => [
                    [
                        'title' => 'Otros',
                        'subLabels' => [
                            [
                                'title' => 'Otros',
                                'knowledges' => [
                                    [
                                        'title' => 'Otros',
                                        'subjects' => [
                                            [
                                                'title' => 'Otros'
                                            ]
                                        ]
                                    ]
                                ]
                            ]

                        ]
                    ],
                ]
            ],
            [
                'title' => 'MAESTRIAS',
                'labels' => [
                    [
                        'title' => 'Maestría',
                        'subLabels' => [
                            [
                                'title' => 'Maestría',
                                'knowledges' => [
                                    [
                                        'title' => 'Maestría',
                                        'subjects' => [
                                            [
                                                'title' => 'Maestría'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]

                ]
            ]
        ]
        ;


        $repo = new \App\Repository\CategoryRepository();

        foreach ($categories as $type){

            // type area
            echo $type['title'].PHP_EOL;
            // add type

            $dataType['title'] = $type['title'];
            $dataType['type'] = true;
            $dataType['label'] = false;
            $dataType['sub_label'] = false;
            $dataType['knowledge'] = false;
            $dataType['subject'] = false;

            $dataType = $repo->insert($dataType);


            foreach ($type['labels'] as $label){
                // label area

                echo 'Label >> : '.$label['title'].PHP_EOL;
                //insert label
                $dataLabel['title'] = $label['title'];
                $dataLabel['type'] = false;
                $dataLabel['label'] = true;
                $dataLabel['sub_label'] = false;
                $dataLabel['knowledge'] = false;
                $dataLabel['subject'] = false;
                $dataLabel['parent_id'] = $dataType->id;

                $dataLabel = $repo->insert($dataLabel);

                foreach ($label['subLabels'] as $subLabel){
                    // sub label

                    echo 'SubLabel >> >> : '.$subLabel['title'].PHP_EOL;
                    // insert sub label

                    $dataSubLabel['title'] = $subLabel['title'];
                    $dataSubLabel['type'] = false;
                    $dataSubLabel['label'] = false;
                    $dataSubLabel['sub_label'] = true;
                    $dataSubLabel['knowledge'] = false;
                    $dataSubLabel['subject'] = false;
                    $dataSubLabel['parent_id'] = $dataLabel->id;

                    $dataSubLabel = $repo->insert($dataSubLabel);


                    foreach ($subLabel['knowledges'] as $knowledge){
                        // knowledge area

                        echo 'knowledge >> >> >> :'.$knowledge['title'].PHP_EOL;
                        //add knowledge

                        $dataKnowledge['title'] = $knowledge['title'];
                        $dataKnowledge['type'] = false;
                        $dataKnowledge['label'] = false;
                        $dataKnowledge['sub_label'] = false;
                        $dataKnowledge['knowledge'] = true;
                        $dataKnowledge['subject'] = false;
                        $dataKnowledge['parent_id'] = $dataSubLabel->id;

                        $dataKnowledge = $repo->insert($dataKnowledge);


                        foreach ($knowledge['subjects'] as $subject){

                            echo 'subject >> >> >> >> : '.$subject['title'].PHP_EOL;
                            // add subject

                            $dataSubject['title'] = $subject['title'];
                            $dataSubject['type'] = false;
                            $dataSubject['label'] = false;
                            $dataSubject['sub_label'] = false;
                            $dataSubject['knowledge'] = false;
                            $dataSubject['subject'] = true;
                            $dataSubject['parent_id'] = $dataKnowledge->id;

                            $dataSubject = $repo->insert($dataSubject);


                        }



                    }

                }

            }
            echo '======================================='.PHP_EOL;

        }

    }
}
