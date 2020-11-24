<?php

namespace App\Controller;

use App\DataFixtures\PlaceFixture;
use App\Entity\Place;
use App\Form\Type\PersonType;
use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Security;

class PersonController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/person", name="person")
     */
    public function new(Request $request)
    {
        $session = $request->getSession();

       $places = $this->getDoctrine()
            ->getRepository(Place::class)
            ->getAll();

        if (empty($places))
        {
            $places = (new PlaceFixture)->load($this->getDoctrine()->getManager());
        }

        $user = $this->security->getUser();
        
        if (empty($session->get('person'))) {
            $person = new Person();
            $person->setFullname("");
            $person->setBirthdate(new \DateTime());
            $person->setTimezone('Europe/Moscow');
            $person->setUser($user);
            if (!empty($places))
                $person->setPlace($places[count($places) - 1]);
        }
        else{
            $person = $session->get('person');
        }

        $form = $this->prepareAndCreateForm($person, $natal);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $person = $form->getData();
            $person->setUser($user);
            $person->setPlace($form->get('place')->getData());

            if ($form->get('newplace')->isClicked())
            {
                $session->set('person', $person);
                return $this->redirectToRoute("place");
            }
            if (($newName = $person->getFullname()) != "" && !(empty($person->getId()) &&
                $this->getDoctrine()->getRepository(Person::class)->isAlreadyStored($newName))) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($person);
                $entityManager->flush();

                return $this->redirectToRoute("person_show", ['id' => $person->getId()]);
            }
        }
        $form->get('place')->setData($person->getPlace());

         return $this->render('person/index.html.twig', [
            'person' => $person, 
             'people' => $this->getOthers(0),
            'form' => $form->createView(),
             'username' => (empty($user) ? "" : $user->getName()),
            'lastId' => 0,
            'root_prefix' => "",
            'natal_wheel_path' => $natal->natal_wheel_path,
            'natal_explanation' => $natal->natal_explanation,
            'natal_aspect_grid_path' => $natal->natal_aspect_grid_path,
            'planet_explanation_htmls' => $natal->planet_explanations,
            'sign_explanation_htmls' => $natal->sign_explanations,
            'offset_x_sign_explanation_border' => $natal->offset_x_sign_explanation_border,
        ]);
    }
    /**
     * @Route("/person/{id}", name="person_show")
     */
    public function show($id, Request $request)
    {
        $person = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);

        if (!$person) {
            return $this->redirectToRoute("person");
        }

        $user = $this->security->getUser();

        if(empty($user) || $person->getUser()->getId() != $user->getId())
        {
            return $this->redirectToRoute("person");
        }
        $form = $this->prepareAndCreateForm($person, $natal);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $person = $form->getData();
            $person->setUser($user);
            $person->setPlace($form->get('place')->getData());
            $request->getSession()->set('person', $person);

            if ($form->get('newplace')->isClicked())
            {
                return $this->redirectToRoute("place");
            }
            if ($form->get('newperson')->isClicked())
            {
                $request->getSession()->remove('person');
                return $this->redirectToRoute("person");
            }
            if ((($newName = $person->getFullname()) != "") &&
                !$this->getDoctrine()->getRepository(Person::class)->isAlreadyStored($newName, $id)) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($person);
                $entityManager->flush();

                return $this->redirectToRoute("person_show", ['id' => $person->getId()]);
            }
        }
        
        $others = $this->getOthers($id);
        $form->get('place')->setData($person->getPlace());
        
        return $this->render('person/index.html.twig', [
            'person' => $person,
            'people' => $others,
            'form' => $form->createView(),
            'username' => $user->getName(),
            'lastId' => $id,
            'root_prefix' => "../",
            'natal_wheel_path' => $natal->natal_wheel_path,
            'natal_aspect_grid_path' => $natal->natal_aspect_grid_path,
            'natal_explanation' => $natal->natal_explanation,
            'planet_explanation_htmls' => $natal->planet_explanations,
            'sign_explanation_htmls' => $natal->sign_explanations,
            'offset_x_sign_explanation_border' => $natal->offset_x_sign_explanation_border,
        ]);
    }

    public function prepareAndCreateForm(Person $person, &$natal)
    {
        $natal = new Natal;
        $natal->draw($person);
        return $this->createForm(PersonType::class, $person);
    }
    
    private function getOthers($id)
    {
        $user = $this->security->getUser();
        if (empty($user))
            return array();
        $people = $user->getPeople();
        $urls = array();
        foreach($people as $other)
        {
            if($other->getId() != $id)
            {
                $urls[$other->getId()] = $other->getFullname();
            }
        }
        return $urls;
    }
}
