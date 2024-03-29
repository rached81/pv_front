<?php

namespace App\Controller;

use App\Entity\SearchPenalties;
use App\Form\SearchPenaltiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;

class PvController extends AbstractController
{
     private $httpClient;
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }
    /**
     * @Route("/penalties", name="pv", methods={"POST", "GET"})
     */
    public function index(Request $request): Response
    {

        // phpinfo();
        // die;
        $paramSearch = new SearchPenalties();
        $form = $this->createForm(SearchPenaltiesType::class, $paramSearch);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $score = $recaptcha3Validator->getLastResponse()->getScore();
            dump($score);
            $data = $form->getData();
            $identity = $data->getIdentify();
            $identityType = $data->getIdentifyType();
            $url = 'http://127.0.0.1:8181/api/penalite/ncin/'.$identity;

                    try{
                        $responsePv = $this->httpClient->request(
                            'GET',
                            $url
                        );
                        
                    } catch(Exception $e){
                        echo $e->getMessage();
                    }
            
                    $statusCode = $responsePv->getStatusCode();
                if($statusCode == 200){
                    // $statusCode = 200
                    $contentType = $responsePv->getHeaders()['content-type'][0];
                    // $contentType = 'application/json'
                    $content = $responsePv->getContent();
                    $content = $responsePv->toArray();
                
                    return $this->render('pv/show-table.html.twig', [
                        'content'=> $content
                ]);

                }else{
                $this->addFlash(
                   'warning',
                   'Nous sommes désolés, cette page est momentanément indisponible.'
                );
                    return $this->render('pv/index.html.twig', [
                        'form' => $form->createView(),
                    ]);


                }
        }
       

        return $this->render('pv/index.html.twig', [
            'form' => $form->createView(),
        ]);




    }
}
