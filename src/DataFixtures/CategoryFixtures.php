<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = [
            1 => [
                'id'            => '2',
                'parent_id'     => '1',
                'name'          => 'Cinéma',
                'slug'          => 'cinema',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'actualites',
                        'slug'          => 'actualites',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'critique',
                        'slug'          => 'critique',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'dossiers',
                        'slug'          => 'dossiers',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'evenements',
                        'slug'          => 'evenements',
                        'picture'       => '1.jpg'
                    ]
                ]
            ],
            2 => [
                'id'            => '3',
                'parent_id'     => '2',
                'name'          => 'series',
                'slug'          => 'series',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'actualites',
                        'slug'          => 'actualites',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'critique',
                        'slug'          => 'critique',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'dossiers',
                        'slug'          => 'dossiers',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'evenements',
                        'slug'          => 'evenements',
                        'picture'       => '1.jpg'
                    ]
                ]
            ],
            3 => [
                'id'            => '4',
                'parent_id'     => '3',
                'name'          => 'Asiaverse',
                'slug'          => 'Asiaverse',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'actualites',
                        'slug'          => 'actualites',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'critiques manga',
                        'slug'          => 'critiques-manga',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'evenements',
                        'slug'          => 'evenements',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'mangas',
                        'slug'          => 'mangas',
                        'picture'       => '1.jpg'
                    ]
                ]
            ],

            4 => [
                'id'            => '5',
                'parent_id'     => '4',
                'name'          => 'ARTS ET SPECTACLES',
                'slug'          => 'spectacles',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'EXPOSITIONS',
                        'slug'          => 'expositions-arts',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'SCÈNE',
                        'slug'          => 'theatre-scene',
                        'picture'       => '1.jpg'
                    ]
                ]
            ],
            5 => [
                'id'            => '6',
                'parent_id'     => '5',
                'name'          => 'MUSIQUE',
                'slug'          => 'musique',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'ACTUALITÉS',
                        'slug'          => 'actualites-musique',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'CRITIQUE',
                        'slug'          => 'critiques-musique',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'EVÉNEMENTS',
                        'slug'          => 'evenements-musique',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'NOUVEAUX TALENTS',
                        'slug'          => 'nouveaux-talents',
                        'picture'       => '1.jpg'
                    ],
                ]
            ],
            5 => [
                'id'            => '6',
                'parent_id'     => '5',
                'name'          => 'COIN LECTURE',
                'slug'          => 'bande-dessinee-comics-litterature',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'BD FRANCO-BELGES',
                        'slug'          => 'bd-franco-belges',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'COMICS',
                        'slug'          => 'comics-bande-dessinee',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'EVÉNEMENTS',
                        'slug'          => 'evenements-musique',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'LITTÉRATURE',
                        'slug'          => 'litterature',
                        'picture'       => '1.jpg'
                    ],
                ]
            ],

            5 => [
                'id'            => '6',
                'parent_id'     => '5',
                'name'          => 'JUSTFOCUS WEEKLY',
                'slug'          => 'justfocus-weekly',
                'picture'       => '1.jpg',
                'sc'            => [
                    [
                        'name'          => 'BOOKS',
                        'slug'          => 'books',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'MOVIES',
                        'slug'          => 'movies',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'TV SHOWS',
                        'slug'          => 'tv-shows',
                        'picture'       => '1.jpg'
                    ],
                    [
                        'name'          => 'WANDERLUST',
                        'slug'          => 'wanderlust',
                        'picture'       => '1.jpg'
                    ],
                ]
            ],
        ];

        foreach($category as $key => $value) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setSlug($value['slug']);
            $category->setImage($value['picture']);
            $category->setIsValid('1');
            $manager->persist($category);

            foreach ($value['sc'] as $subcat) { 
                $subcategorie = new Category();
                $subcategorie->setName($subcat['name']);
                $subcategorie->setSlug($subcat['slug']);
                $subcategorie->setImage($subcat['picture']);
                $subcategorie->setIsValid('1');
                $subcategorie->setSubCategory($category);
                $manager->persist($subcategorie);
            }
        }
        $manager->flush();
    }
}
