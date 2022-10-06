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
        $nameSystem = $this->getParameter('nameSystem');
        $fondo = $this->getParameter('fondo');
        $logo = $this->getParameter('logo');
        $iconos = $this->getParameter('iconos');
        $dircss = $this->getParameter('dircss');
        $imagenFondo = $this->getParameter('imagenFondo');
        $favIcon = $this->getParameter('favIcon');
        return $this->render('dashboard_admin/index.html.twig', [
            'controller_name' => $nameSystem,
            'titlePage' => $nameSystem,
            'fondo' => $fondo,
            'logo' => $logo,
            'iconos' => $iconos,
            'dircss' => $dircss,
            'imagenFondo' => $imagenFondo,
            'favIcon' => $favIcon,
        ]);
    }
}
