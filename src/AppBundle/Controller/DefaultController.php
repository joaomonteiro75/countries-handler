<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }


    public function countriesAction()
    {
        $countries = $this->getDoctrine()->getRepository('AppBundle:Country')->findAll();

       if(!is_object($countries)){
//            throw $this->createNotFoundException();
        }
        return $countries;
    }

    public function countryByIso2Action($iso2)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneBy(array('iso2' => $iso2));

        if(!is_object($country)){
            throw $this->createNotFoundException();
        }
        return $country;
    }

    //this is crap - change it
    public function countriesByLanguageAction($lang)
    {
        $result = [];
        $countries = $this->getDoctrine()->getRepository('AppBundle:Country')->findAll();
        if(!is_object($countries)){
            throw $this->createNotFoundException();
        }

        foreach ($countries as $country)
        {
            foreach ( $country->getLanguages() as $language )
            {
                if ($language == $lan)
                {
                    $result[] = $country;
                    break;
                }
            }
        }
        return $result;
    }
}
