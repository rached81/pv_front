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
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class PvController extends AbstractController
{
     private $httpClient;
    //  private $containerBag;
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
        
    }
    /**
     * @Route("/penalties", name="pv", methods={"POST", "GET"})
     */

    //  /**
    //  * @Route(
    //  *     "/{_locale}/penalties",
    //  *     name="pv",
    //  *     requirements={
    //  *         "_locale": "fr|ar|en",
    //  *     },
    //  *     methods={"POST", "GET"}
    //  * )
    //  */
    public function index($_locale, Request $request, TranslatorInterface $translator, ContainerBagInterface $containerBag): Response
    {
        // $l = $request->getLocale();
        // $tl = $containerBag->get('locale');
        // $t = $containerBag->resolveValue('ar');
        // //->get('locale');
        // $dl = $request->getDefaultLocale();
        // phpinfo();
        // die;
        // $loacle = $this->getParameter('locale');
        // dump($locale);
       $request->setlocale($_locale);
        $paramSearch = new SearchPenalties();
        $form = $this->createForm(SearchPenaltiesType::class, $paramSearch);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // $score = $recaptcha3Validator->getLastResponse()->getScore();
            // dump($score);
            $data = $form->getData();
            $identity = $data->getIdentify();
            $identityType = $data->getIdentifyType();
            $url = 'http://127.0.0.1:8080/api/penalite/ncin/'.$identity;

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
                    dump($content);
                    // $tpl = ('ar' == $locale) ? 'pv/show-table-ar.html.twig' : 'pv/show-table.html.twig';
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
       
        // $tpl = ('ar' == $locale) ? 'pv/index-ar.html.twig' : 'pv/index.html.twig';
        return $this->render('pv/index.html.twig', [
            'form' => $form->createView(),
        ]);




    }
}
