<?php

namespace App\Controller;

use App\Repository\SalveInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\AcessService;


class CovidController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
        private AcessService $service,

    ) {

    }

    #[Route('/covid', name: 'app_covid')]

    public function index(): Response
    {
        return $this->render('covid/index.html.twig', []);
    }

    #[Route('/api/save/{country}', methods: ['GET'], name: 'save_covid')]

    public function save($country): Response
    {
        try {
            if (empty($country)) {
                throw new \InvalidArgumentException('country not found.');
            }

            $result = $this->client->request('GET', 'https://dev.kidopilabs.com.br/exercicio/covid.php?pais=' . $country);
            $data = json_decode($result->getContent());

            $this->service->saveAccess($country);
            return $this->json($data);

        } catch (\Throwable $th) {
            return $this->json('Error ' . $th->getMessage(), 500);
        }
    }

    #[Route('/api/last-acess', methods: ['GET'], name: 'app_covid_last_acess')]
    public function lastAcess(): Response
    {
        try {
            $lastAcess = $this->service->getLastAcess();
            $acessResult = [
                'country'=>$lastAcess->getCountry(),
                'date'=>$lastAcess->getDate()->format('d/m/Y H:m'),
            ];
            return $this->json($acessResult);
        } catch (\Throwable $th) {
            return $this->json('Error ' . $th->getMessage(), 500);
        }

    }

}