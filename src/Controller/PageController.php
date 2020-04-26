<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/{slug}", name="page_show")
     */

    public function show($slug)
    {
        $page = $this->getDoctrine()
            ->getRepository(Page::class)
            ->findOneBy(['slug' => $slug, 'show_page' => 1]);
        if (!$page) {
            throw $this->createNotFoundException();
        }

        return $this->render('page/'.$page->getTemplate(), [
            'page' => $page,
        ]);
    }

}