<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
        public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

    //     $lesSports=$this->chargeFichier("sport.csv");
    //     foreach ($lesSports as $value) {
    //       $sport=new Sport();
    //       $sport ->setId(intval($value[0]))
    //                ->setNom($value[1])
    //                ->setCouleur();
    //       $manager->persist($sport);
    //       $this->addReference("style".$sport->getId(),$sport);

    //   }
    //      }

    // public function chargeFichier($fichier){
    //   $fichierCsv=fopen(DIR."/".$fichier,"r");
    //     while (!feof($fichierCsv)) {
    //       $data[]=fgetcsv($fichierCsv);
    //     }
    //     fclose($fichierCsv);
    //     return $data;
        

    
    }

}
    