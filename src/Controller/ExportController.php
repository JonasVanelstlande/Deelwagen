<?php

namespace App\Controller;

use App\Form\ExportFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\KilometersRepository;
use App\Repository\UserRepository;
use DateTime;

class ExportController extends AbstractController
{
    private $kilometersRepository;
    private $userRepository;

    public function __construct(KilometersRepository $kilometersRepository, UserRepository $userRepository)
    {
        $this->kilometersRepository = $kilometersRepository;
        $this->userRepository = $userRepository;
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

            $trips = $this->kilometersRepository->findAllInDateRange($dates['startDate']->format("Y-m-d"), $dates['endDate']->format("Y-m-d"));

            //create the data array
            $rows = [];

            //set title row
            $titles = ['Datum', 'Gebruiker', 'Totaal kilometers', 'Start kilometerstand', 'Eind kilometerstand'];
            $rows[] = implode(",", $titles);

            foreach ($trips as $trip) {
                $user = $this->userRepository->find($trip['user_id']);

                $userName = $user->getFirstName() . " " . $user->getLastName();

                $date = (new DateTime($trip['date']))->format('d-m-Y');
                $totalKm = $trip['total_km'] . " km";
                $startKm = $trip['start_km'] . " km";
                $endKm = $trip['end_km'] . " km";

                $data = [$date, $userName, $totalKm, $startKm, $endKm];

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
