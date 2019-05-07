<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Link;
use App\Form\LinksType;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $linkList = $em
            ->getRepository(Link::class)
            ->findAll();
        

        $links = new Link();
        
        $form = $this->createForm(LinksType::class, $links);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $links->setDate(new \DateTime('now'));

            $em->persist($links);
            $em->flush();

            $this->addFlash("linkAdded", "Votre lien a bien été ajouté !");
            return $this->redirectToRoute("app");
        }
        return $this->render("app/index.html.twig", [
            "form" => $form->createView(),
            "linkList" => $linkList
        ]);
    }
}
