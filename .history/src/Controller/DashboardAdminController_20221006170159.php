<?php

namespace App\Controller;

use App\Entity\Subcategoria;
use App\Form\SubcategoriaType;
use App\Repository\SubcategoriaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;
use DateTimeInterface;


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

    /**
     * @Route("/search_subcategoria/", name="app_search_subcategoria", methods={"GET"})
     */
    public function searchSubcategoriasbycategoria(
        SubcategoriaRepository $subcategoriaRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $nameSystem = $this->getParameter('nameSystem');
        $fondo = $this->getParameter('fondo');
        $logo = $this->getParameter('logo');
        $iconos = $this->getParameter('iconos');
        $dircss = $this->getParameter('dircss');
        $favIcon = $this->getParameter('favIcon');
        $idCatgoria = intval($request->query->get('id'));

        $server_name = $_SERVER['SERVER_NAME'];
        $puerto = $this->getParameter('puerto');
        if ($puerto == "443") {
            $rutaServidor = "https://" . $server_name .  "/";
        } else {
            $rutaServidor = "http://" . $server_name .  ":" . $puerto . "/";
        }
        $direccion_finala = $rutaServidor;
        $directorio = $this->getParameter('archivos');
        $url_final = str_replace($directorio, $direccion_finala, $directorio) . "assets/archivos/";

        // buscamos las categorias y las paginamos
        $canReg = $request->query->getInt('can_reg', 20);
        $misRegistros = $subcategoriaRepository->findAllbyCategoria($idCatgoria);
        $registros = $paginator->paginate(
            // Consulta Doctrine, no resultados
            $misRegistros,
            // Definir el par??metro de la p??gina
            $request->query->getInt('page', 1),
            // Items per page
            $canReg
        );

        return $this->render('subcategoria/index.html.twig', [
            'subcategorias' => $registros,
            'url_final' => $url_final,
            'directorio' => $directorio,
            'controller_name' => $nameSystem,
            'titlePage' => $nameSystem,
            'fondo' => $fondo,
            'logo' => $logo,
            'iconos' => $iconos,
            'dircss' => $dircss,
            'favIcon' => $favIcon,
            'canReg' => $canReg
        ]);
    }
}
