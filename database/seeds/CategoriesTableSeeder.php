<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->truncate();
        // factory(App\Category::class, 50)->create();
        $categories = [
            [
                'name' => 'Books',
                'children' => [
                        [    
                            'name' => 'Comic',
                            'children' => [
                                    [
                                        'name' => 'Marvel',
                                    ],
                                    [
                                        'name' => 'DC Book',
                                    ],
                                    [
                                        'name' => 'Action',
                                    ],
                            ],
                        ],
                        [    
                            'name' => 'Textbooks',
                                'children' => [
                                    [
                                        'name' => 'Business',
                                    ],
                                    [
                                        'name' => 'Finance',
                                    ],
                                    [
                                        'name' => 'Science',
                                    ],
                            ],
                        ],
                    ],
            ],
            [
                'name' => 'Electronics',
                   'children' => [
                        [
                            'name' => 'TV',
                            'children' => [
                                [
                                    'name' => 'LED',
                                ],
                                [
                                    'name' => 'Blu-ray',
                                ],
                            ],
                        ],
                        [
                            'name' => 'Mobile',
                            'children' => [
                                [
                                    'name' => 'Samsung',
                                ],
                                [
                                    'name' => 'iPhone',
                                ],
                                [
                                    'name' => 'Xiomi',
                                ],
                            ],
                        ],
                    ],
            ],
        ];
        
        foreach($categories as $category)
        {
            \App\Category::create($category);
        }
    }
}
