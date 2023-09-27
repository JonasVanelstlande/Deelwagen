<?php

namespace App\Controller;

use App\Entity\Kilometers;
use App\Form\ExportFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\KilometersRepository;
use Doctrine\ORM\EntityManagerInterface;

class ExportController extends AbstractController
{
    private $kilometersRepository;

    public function __construct(KilometersRepository $kilometersRepository)
    {
        $this->kilometersRepository = $kilometersRepository;
    }

    #[Route('/export', name: 'export')]
    public function export(Request $request): Response
    {
        $form = $this->createForm(ExportFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dates = $form->getData();

            if ($dates['startDate'] > $dates['endDate']) {
                return $this->render('export/index.html.twig', [
                    'exportform' => $form->createView(),
                    'errorMessage' => "De begindatum moet eerder vallen dan de einddatum"
                ]);
            }

            $trips = $this->kilometersRepository->findAllInDateRange($dates['startDate'], $dates['endDate']);


            //create the data array
            $rows = [];

            //set title row
            $titles = ['Datum', 'Gebruiker', 'Totaal kilometers', 'Start kilometerstand', 'Eind kilometerstand'];
            $rows[] = implode(",", $titles);

            foreach ($trips as $trip) {
                $user = $trip->getUser()->getFirstName() . " " . $trip->getUser()->getLastName();
                $date = $trip->getDate()->format('d-m-Y');
                $totalKm = $trip->getTotalKm() . " km";
                $startKm = $trip->getStartKm() . " km";
                $endKm = $trip->getEndKm() . " km";

                $data = [$date, $user, $totalKm, $startKm, $endKm];

                $rows[] = implode(",", $data);
            }

            $content = implode("\n", $rows);
            $response = new Response($content);
            $response->headers->set('Content-Type', 'text/csv');

            return $response;
        }

        return $this->render('export/index.html.twig', [
            'exportform' => $form->createView()
        ]);
    }
}
