<?php

namespace App\Controller;

use App\Entity\Kilometers;
use App\Form\KilometerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function create(): Response
    {
        $trip = new Kilometers();
        $form = $this->createForm(KilometerFormType::class, $trip);

        return $this->render('form/index.html.twig', [
            'firstname' => 'Jonas',
            'form' => $form->createView()
        ]);
    }

    
}
