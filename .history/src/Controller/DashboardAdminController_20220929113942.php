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
        /*
        icDoc: "/assets/images/icons8-documentos-96.png"
        titleIcDoc: "Gestión Documental"
        icAud: "/assets/images/icons8-asignacion-entregado-96.png"
        titleicAud: "Auditorías e Inspecciones"
        icMej: "/assets/images/icons8-settings-96.png"
        titleIcMej: "Mejoramiento Continuo"
        icOrg: "/assets/images/icons8-organización-96.png"
        titleIcOrg: "Contexto Org."
        icKpi: "/assets/images/icons8-chart-96.png"
        titleIcKpi: "Indicadores"
        */

        $nameSystem = $this->getParameter('nameSystem');
        $fondo = $this->getParameter('fondo');
        $logo = $this->getParameter('logo');
        $icDoc = $this->getParameter('icDoc');
        $titleIcDoc = $this->getParameter('titleIcDoc');
        $icAud = $this->getParameter('icAud');
        $titleIcAud = $this->getParameter('titleIcAud');
        $icMej = $this->getParameter('icMej');
        $titleIcMej = $this->getParameter('titleIcMej');
        $icOrg = $this->getParameter('icOrg');
        $titleIcOrg = $this->getParameter('titleIcOrg');
        $icKpi = $this->getParameter('icKpi');
        $titleIcKpi = $this->getParameter('titleIcKpi');
        $iconos = $this->getParameter('iconos');
        //var_dump("<pre>", $iconos, "</pre>");
        var_dump($iconos["documentos"]["icono"]);
        var_dump($iconos["documentos"]["titulo"]);
        var_dump($iconos["documentos"]["url"]);
        return $this->render('dashboard_admin/index.html.twig', [
            'controller_name' => $nameSystem,
            'titlePage' => $nameSystem,
            'fondo' => $fondo,
            'logo' => $logo,
            'icDoc' => $icDoc,
            'titleIcDoc' => $titleIcDoc,
            'icAud' => $icAud,
            'titleIcAud' => $titleIcAud,
            'icMej' => $icMej,
            'titleIcMej' => $titleIcMej,
            'icOrg' => $icOrg,
            'titleIcOrg' => $titleIcOrg,
            'icKpi' => $icKpi,
            'titleIcKpi' => $titleIcKpi,
            'iconos' => $iconos,
        ]);
    }
}
