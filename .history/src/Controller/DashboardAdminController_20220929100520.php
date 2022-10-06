<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/dashboard_admin")
 */
class DashboardAdminController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_admin", methods={"GET"})
     */
    public function index(): Response
    {
        $fondo = $this->getParameter('fondo');
        $logo = $this->getParameter('logo');
        $doc_launcher = $this->getParameter('doc_launcher');
        $title_doc_launcher = $this->getParameter('title_doc_launcher');
        return $this->render('dashboard_admin/index.html.twig', [
            'controller_name' => 'DashboardAdminController',
            'fondo' => $fondo,
            'logo' => $logo,
            'doc_launcher' => $doc_launcher,
            'title_doc_launcher' => $title_doc_launcher,
        ]);
    }
}
