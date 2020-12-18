<?php

namespace App\Controller;

use App\Entity\SearchPenalties;
use App\Form\SearchPenaltiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PvController extends AbstractController
{
     private $httpClient;
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }
    /**
     * @Route("/pv", name="pv", methods={"POST", "GET"})
     */
    public function index(Request $request): Response
    {
        $paramSearch = new SearchPenalties();
        $form = $this->createForm(SearchPenaltiesType::class, $paramSearch);
//        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
    //            $responsegithube = $this->httpClient->request(
                    $responsePv = $this->httpClient->request(
                        'GET',
                        'https://api.github.com/repos/symfony/symfony-docs'
                    );
    //        $responsePv = $this->httpClient->request(
    //            'GET',
    //            'http://10.0.2.2:8282/agent/19684'
    //        );
                $statusCode = $responsePv->getStatusCode();
                // $statusCode = 200
                $contentType = $responsePv->getHeaders()['content-type'][0];
                // $contentType = 'application/json'
                $content = $responsePv->getContent();
                // $content = '{"id":521583, "name":"symfony-docs", ...}'
    //        $content = $responsePv->toArray();
                // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
                return $this->render('pv/show.html.twig', [
                    'content'=> $content
                ]);
                return $this->render('pv/show.html.twig', [
                    'content'=> $content
                ]);

            }
        }

        return $this->render('pv/index.html.twig', [
            'form' => $form->createView(),
        ]);




    }
}
