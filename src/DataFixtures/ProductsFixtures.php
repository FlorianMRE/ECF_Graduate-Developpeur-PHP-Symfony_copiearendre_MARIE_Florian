<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\Products;
use App\Entity\Type;
use App\Services\ProductService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductsFixtures extends Fixture
    implements DependentFixtureInterface
{

    public function __construct(private ProductService $productService)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'title' => 'Clio 4 pack Prenium',
                'description' => 'Vend magnifique Clio 4 pack Prenium pour un futur achat, quelques rayures dût au temps, n\'hésitez pas à me contact pour des informations',
                'price' => 6405 * 100,
                'kilometrages' => 114302,
                'yearsOfRelease' => 2018,
                'imgs' => [
                    'Renault_Clio_TCe_90_Luxe_(IV)_–_Frontansicht,_17._Mai_2013,_Münster.jpg',
                    'S7-Maxi-fiche-fiabilite-que-vaut-la-Renault-Clio-4-en-occasion-104931.jpg'
                ],
                'type' => $manager->getRepository(Type::class)->findOneBy(['type' => 'voiture'])
            ],
            [
                'title' => 'Peugeot Boxer',
                'description' => 'Vend Peugeot Boxer de 2017 avec un peu de vécu mais toujours entretenu avec soins et avec papiers à jour, caisse renforcée avec protections bois',
                'price' => 5095 * 100,
                'kilometrages' => 187676,
                'yearsOfRelease' => 2017,
                'imgs' => [
                    'QRLZ-16325-130753-795x596.jpg'
                ],
                'type' => $manager->getRepository(Type::class)->findOneBy(['type' => 'camionnette'])
            ],
            [
                'title' => 'Yamaha mt 07 Cyan Storm',
                'description' => 'Yamaha mt07 cyan blue de 2020 en très bon état, très bonne moto, un moteur joueur, qui a du pep\'s, très joueuse. Moto bridée A2, papier à jour, première main, toujours entretenue. 
                Possibilité de négocier dans la limite du raisonnable' ,
                'price' => 6320 * 100,
                'kilometrages' => 9061,
                'yearsOfRelease' => 2020,
                'imgs' => [
                    'photo-annonce-yamaha-mt-07-47-5cv-2022_61e6eea936a33691182886.jpg',
                    'photo-annonce-mt-07-35kw-possibilite-55kw-110-mois-cyan-storm_62bea94fea1ec680591439-640x480.jpg'
                ],
                'type' => $manager->getRepository(Type::class)->findOneBy(['type' => 'moto'])
            ],
            [
                'title' => 'Camion camping-car',
                'description' => 'Camion Man transformé en camping-car, parfait pour partir à l\'aventure, faire des expéditions dans des pays aux reliefs compliqués, camion entretenu. 
                Vendu avec un jeu de roues en plus en cas de crevaison, malette à outils en cas de réparation et valises + rangement.
                Prix ferme' ,
                'price' => 19237 * 100,
                'kilometrages' => 169371,
                'yearsOfRelease' => 2005,
                'imgs' => [
                    'Man-TGM-4x4-double-cabine.jpg'
                ],
                'type' => $manager->getRepository(Type::class)->findOneBy(['type' => 'camion'])
            ],
            [
                'title' => 'Vespa 125cc',
                'description' => 'Petit vespa tout droit importer d\'italie, pneus neufs, papier à jour avec une révision qui sera effectuée avant la vente.
                Couleur bleue pétrole carractéristique.',
                'price' => 5900 * 100,
                'kilometrages' => 12034,
                'yearsOfRelease' => 2007,
                'imgs' => [
                    'img_614a4ab651880.jpg'
                ],
                'type' => $manager->getRepository(Type::class)->findOneBy(['type' => 'scooter'])
            ],
        ];


        foreach ($products as $productItem) {
            $product = new Products();

            $product->setTitle($productItem['title'])
                ->setDescription($productItem['description'])
                ->setPrice($productItem['price'])
                ->setKilometrages($productItem['kilometrages'])
                ->setYearsOfRelease($productItem['yearsOfRelease']);
            if (!is_null($productItem['imgs']) && !empty($productItem['imgs'])) {
                $firstView = 0;
                foreach ($productItem['imgs'] as $productImg) {
                    $img = new Images();

                    $img->setProductsId($product->getId());
                    $img->setOriginalName($productImg);
                    $img->setName(md5(uniqid(rand(), true)). '.webp');


                    copy( dirname(__DIR__, 2).'/public/assets/uploads/products/imgsFixturesOriginal/' . $productImg  , dirname(__DIR__, 2).'/public/assets/uploads/products/' . $productImg);

                    rename( dirname(__DIR__, 2).'/public/assets/uploads/products/' . $productImg, dirname(__DIR__, 2).'/public/assets/uploads/products/' . $img->getName());

                    $img->setFirstView(false);

                    if ($firstView === 0) {
                        $img->setFirstView(true);
                        $firstView ++;
                    }

                    $manager->persist($img);

                    $product->addImage($img);
                }
            }

            $product->setType($productItem['type']);


            $product->setSlug($this->productService->generateRandomString(25));

            $product->setCreatedAt(new \DateTimeImmutable());

         $manager->persist($product);
//            dump($product);
        }

//        dd($product);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [TypeFixtures::class];
    }
}
