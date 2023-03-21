<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Form\FiltreEquipeType;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipe")
 */
class EquipeController extends AbstractController
{
    /**
     * @Route("/", name="app_equipe_index", methods={"GET"})
     */
    public function index(EquipeRepository $equipeRepository, Request $request): Response
{
    $formFiltreEquipe = $this->createForm(FiltreEquipeType::class);
    $formFiltreEquipe->handleRequest($request);

    $libelle = null;
    if ($formFiltreEquipe->isSubmitted() && $formFiltreEquipe->isValid()) {
        $libelle = $formFiltreEquipe->get('libelle')->getData();
    }

    $equipes = $libelle ? $equipeRepository->findByNom($libelle) : $equipeRepository->findAll();

    return $this->render('equipe/index.html.twig', [
        'equipes' => $equipes,
        'formFiltreEquipe' => $formFiltreEquipe->createView()
    ]);
}


    /**
     * @Route("/new", name="app_equipe_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EquipeRepository $equipeRepository): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipeRepository->add($equipe, true);

            return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_equipe_show", methods={"GET"})
     */
    public function show(Equipe $equipe): Response
    {
        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_equipe_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Equipe $equipe, EquipeRepository $equipeRepository): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipeRepository->add($equipe, true);

            return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_equipe_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipe $equipe, EquipeRepository $equipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipe->getId(), $request->request->get('_token'))) {
            $equipeRepository->remove($equipe, true);
        }

        return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
    }

    public function ListeEquipeSimple(EquipeRepository $equipeRepository)
    {
        return $this->render('equipe/dropdownequipe.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

     /**
     * @Route("/boutique/{id}", name="affichemaillot-equipe", methods={"GET"})
     */
    public function showbarca(Equipe $equipe): Response
    {
        return $this->render('equipe/'.$equipe->getLibelle().'.html.twig', [
            'equipe' => $equipe,
        ]);
    }
}
