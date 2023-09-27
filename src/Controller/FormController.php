<?php

namespace App\Controller;

use App\Entity\Kilometers;
use App\Entity\User;
use App\Form\KilometerFormType;
use App\Repository\KilometersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    private $kilometersRepository;
    private $em;

    public function __construct(KilometersRepository $kilometersRepository, EntityManagerInterface $em)
    {
        $this->kilometersRepository = $kilometersRepository;
        $this->em = $em;
    }

    #[Route('/deelwagen', name: 'deelwagen')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
        ]);
    }

    #[Route('/deelwagen/form', name: 'form')]
    public function create(Request $request): Response
    {
        $trip = new Kilometers();
        $form = $this->createForm(KilometerFormType::class, $trip);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newTrip = $form->getData();
            $newTrip->setTotalKm($newTrip->getEndKm() - $newTrip->getStartKm());
            $newTrip->setUser($this->getUser());

            $this->em->persist($newTrip);
            $this->em->flush();

            return $this->redirectToRoute('deelwagen');
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
}
