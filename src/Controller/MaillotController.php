<?php

namespace App\Controller;
use App\Entity\Maillot;
use App\Form\FiltreMaillotType;
use App\Form\MaillotType;
use App\Repository\MaillotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maillot")
 */
class MaillotController extends AbstractController
{
    /**
     * @Route("/", name="app_maillot_index", methods={"GET"})
     */
    public function index(MaillotRepository $maillotRepository, Request $request): Response
    {
        $description=null;
        $formFiltreMaillot=$this->createForm(FiltreMaillotType::class);
        $formFiltreMaillot->handleRequest($request);
        if($formFiltreMaillot->isSubmitted() && $formFiltreMaillot->isValid()){
            $description=$formFiltreMaillot->get('description')->getData();
        } 
        $maillotRepository->reposito($description); 
        return $this->render('maillot/index.html.twig', [
            'maillots' => $maillotRepository->findAll(),
            'formFiltreMaillot'=>$formFiltreMaillot->createView()
        ]);
    }

    /**
     * @Route("/new", name="app_maillot_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MaillotRepository $maillotRepository): Response
    {
        
        $maillot = new Maillot();
        $form = $this->createForm(MaillotType::class, $maillot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maillotRepository->add($maillot, true);

            return $this->redirectToRoute('app_maillot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maillot/new.html.twig', [
            'maillot' => $maillot,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_maillot_show", methods={"GET"})
     */
    public function show(Maillot $maillot): Response
    {
        return $this->render('maillot/show.html.twig', [
            'maillot' => $maillot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_maillot_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Maillot $maillot, MaillotRepository $maillotRepository): Response
    {
        $form = $this->createForm(MaillotType::class, $maillot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maillotRepository->add($maillot, true);

            return $this->redirectToRoute('app_maillot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maillot/edit.html.twig', [
            'maillot' => $maillot,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_maillot_delete", methods={"POST"})
     */
    public function delete(Request $request, Maillot $maillot, MaillotRepository $maillotRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maillot->getId(), $request->request->get('_token'))) {
            $maillotRepository->remove($maillot, true);
        }

        return $this->redirectToRoute('app_maillot_index', [], Response::HTTP_SEE_OTHER);
    }
}
