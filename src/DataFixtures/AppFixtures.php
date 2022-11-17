<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use App\Entity\Acheter;
use App\Entity\Maillot;
use App\Entity\Panier;
use App\Entity\Equipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
        public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

<<<<<<< HEAD
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
=======
        $lesSports=$this->chargeFichier("sport.csv");
        foreach ($lesSports as $value) {
          $sport=new Sport();
          $sport   ->setId(intval($value[0]));
          $sport   ->setLibelle($value[1]);
          $sport   ->setImage($value[2]);
          $manager->persist($sport);
          $this->addReference("sport".$sport->getId(),$sport);
          $manager->flush();
          

      }

        $lesEquipes=$this->chargeFichier("equipe.csv");
        foreach ($lesEquipes as $value) {
          $equipe=new Equipe();
          $equipe   ->setId(intval($value[0]));
          $equipe   ->setLibelle($value[1]);
          $equipe   ->setImage($value[2]);
          $equipe   ->setSport($this->getReference("sport".intval($value[3])));
          $manager->persist($equipe);
          $this->addReference("equipe".$equipe->getId(),$equipe);
          $manager->flush();
        

    }
        $lesMaillots=$this->chargeFichier("maillot.csv");
            foreach ($lesMaillots as $value) {
              $maillot=new maillot();
              $maillot   ->setId(intval($value[0]));
              $maillot   ->setTypeMaillot($value[1]);
              $maillot   ->setSaison($value[2]);
              $maillot   ->setImage($value[3]);
              $maillot   ->setMatiere($value[4]);
              $maillot   ->setTaille($value[5]);
              $maillot   ->setPrix($value[6]);
              $maillot   ->setDescription($value[7]);
              $maillot   ->setDisponibilite($value[8]);
              $maillot   ->setStock($value[9]);
              $maillot   ->setEquipe($this->getReference("equipe".intval($value[10])));
              $manager->persist($maillot);
              $this->addReference("maillot".$maillot->getId(),$maillot);
              $manager->flush();
        

    }
    }
    public function chargeFichier($fichier){
      $fichierCsv=fopen(__DIR__."/".$fichier,"r");
        while (!feof($fichierCsv)) {
          $data[]=fgetcsv($fichierCsv);
        }
        fclose($fichierCsv);
        return $data;
>>>>>>> b9ec44a3e2647b69c140cc4e292b8418415cdccd
        
    
    
    }

}
    