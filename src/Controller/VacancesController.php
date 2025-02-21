<?php

namespace App\Controller;

use App\Entity\Vacances;
use App\Form\VacancesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vacances')]
class VacancesController extends AbstractController
{
    #[Route('/', name: 'vacances_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vacances = $entityManager->getRepository(Vacances::class)->findAll();
        return $this->render('vacances/index.html.twig', compact('vacances'));
    }

    #[Route('/new', name: 'vacances_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vacances = new Vacances();
        $form = $this->createForm(VacancesType::class, $vacances);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vacances);
            $entityManager->flush();
            return $this->redirectToRoute('vacances_index');
        }

        return $this->render('vacances/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'vacances_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vacances $vacances, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VacancesType::class, $vacances);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vacances_index');
        }

        return $this->render('vacances/edit.html.twig', [
            'vacances' => $vacances,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vacances_delete', methods: ['POST'])]
    public function delete(Request $request, Vacances $vacances, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacances->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vacances);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vacances_index');
    }
}
