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

$lesSports=$this->chargeFichier("sport.csv");
foreach ($lesSports as $value) {
$sport=new Sport();
$sport ->setId(intval($value[0]));
$sport ->setlibelle($value[1]);
$sport ->setimage($value[2]);
$manager->persist($sport);
$this->addReference("style".$sport->getId(),$sport);

}



$lesEquipes=$this->chargeFichier("equipe.csv");
foreach ($lesEquipes as $value) {
$equipe=new Equipe();
$equipe ->setId(intval($value[0]));
$equipe ->setLibelle($value[1]);
$equipe ->setImage($value[2]);
$equipe ->setSport($this->getReference("sport".intval($value[3])));
$manager->persist($equipe);
$this->addReference("equipe".$equipe->getId(),$equipe);
$manager->flush();


}
$lesMaillots=$this->chargeFichier("maillot.csv");
foreach ($lesMaillots as $value) {
$maillot=new maillot();
$maillot ->setId(intval($value[0]));
$maillot ->setTypeMaillot($value[1]);
$maillot ->setSaison($value[2]);
$maillot ->setImage($value[3]);
$maillot ->setMatiere($value[4]);
$maillot ->setTaille($value[5]);
$maillot ->setPrix($value[6]);
$maillot ->setDescription($value[7]);
$maillot ->setDisponibilite($value[8]);
$maillot ->setStock($value[9]);
$maillot ->setEquipe($this->getReference("equipe".intval($value[10])));
$manager->persist($maillot);
$this->addReference("maillot".$maillot->getId(),$maillot);
$manager->flush();


}

$LesPaniers=$this->chargeFichier("panier.csv");
foreach ($LesPaniers as $value) {
$panier=new Panier();
$panier ->setId(intval($value[0]));
$panier ->setDatePanier($value[1]);
$panier ->setMoyenPaiement($value[2]);
//$panier ->setSport($this->getReference("panier".intval($value[3])));
$manager->persist($panier);
$this->addReference("panier".$panier->getId(),$panier);
$manager->flush();


}
//jerem
// $LesAchats=$this->chargeFichier("acheter.csv");
// foreach ($LesAchats as $value) {
// $acheter=new acheter();
// $acheter ->setId(intval($value[0]));
// $acheter ->setlibelle($value[1]);
// $acheter ->setimage($value[2]);
// $manager->persist($acheter);
// $this->addReference("acheter".$acheter->getId(),$acheter);

// }

}
public function chargeFichier($fichier){
$fichierCsv=fopen(__DIR__."/".$fichier,"r");
while (!feof($fichierCsv)) {
$data[]=fgetcsv($fichierCsv);
}
fclose($fichierCsv);
return $data;

}
}