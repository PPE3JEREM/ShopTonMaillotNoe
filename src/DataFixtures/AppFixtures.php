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

        $lesSports=$this->chargeFichier("sport.csv");
        foreach ($lesSports as $value) {
          $sport=new Sport();
          $sport ->setId(intval($value[0]))
                   ->setNom($value[1])
                   ->setCouleur();
          $manager->persist($sport);
          $this->addReference("style".$sport->getId(),$sport);

      }
      $lesArtistes=$this->chargeFichier("artiste.csv");
      $genres=["men","women"];
        foreach ($lesArtistes as $value) {
            $artiste=new Artiste();
            $artiste ->setId(intval($value[0]))
                     ->setNom($value[1])
                     ->setDescription("<p>".join("</p><p>",$faker->paragraphs(5)). "</p>")
                     ->setSite($faker->url())
                     ->setImage('https://randomuser.me/api/portraits/%27.$faker-%3ErandomElement($genres).%22/%22.mt_rand(1,99).%22.jpg%22')
                     ->setType($value[2]);
            $manager->persist($artiste);
            $this->addReference("artiste".$artiste->getId(),$artiste);

        }

        $lesAlbums=$this->chargeFichier("album.csv");
        foreach ($lesAlbums as $value) {
          $album=new Album();
          $album ->setId(intval($value[0]))
                 ->setNom($value[1])
                 ->setDate(intval($value[2]))
                 ->setImage("/images/daft-punk.jpg")
                 ->addStyle($this->getReference("style".$value[3]))
                 ->setArtiste($this->getReference("artiste".$value[4]));
          $manager->persist($album); 
          $this->addReference("album".$album->getId(), $album);
        }

        $lesMorceaux=$this->chargeFichier("morceau.csv");
        foreach ($lesMorceaux as $value) {
          $morceau=new Morceau();
          $morceau  ->setId(intval($value[0]))
                    ->setTitre($value[2])
                    ->setAlbum($this->getReference("album".$value[1]))
                    ->setPiste(intval($value[4]))
                    ->setDuree(date("i:s",$value[3]));
          $manager->persist($morceau);
          $this->addReference("morceau".$morceau->getId(), $morceau);
        }
        $manager->flush();
    }

    public function chargeFichier($fichier){
      $fichierCsv=fopen(DIR."/".$fichier,"r");
        while (!feof($fichierCsv)) {
          $data[]=fgetcsv($fichierCsv);
        }
        fclose($fichierCsv);
        return $data;
        

    
    }

}
    