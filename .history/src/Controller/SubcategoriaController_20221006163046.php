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
 * @Route("/subcategoria")
 */
class SubcategoriaController extends AbstractController
{
    /**
     * @Route("/", name="app_subcategoria_index", methods={"GET"})
     */
    public function index(SubcategoriaRepository $subcategoriaRepository): Response
    {
        return $this->render('subcategoria/index.html.twig', [
            'subcategorias' => $subcategoriaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_subcategoria_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SubcategoriaRepository $subcategoriaRepository): Response
    {
        $subcategorium = new Subcategoria();
        $form = $this->createForm(SubcategoriaType::class, $subcategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subcategoriaRepository->add($subcategorium, true);

            return $this->redirectToRoute('app_subcategoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subcategoria/new.html.twig', [
            'subcategorium' => $subcategorium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_subcategoria_show", methods={"GET"})
     */
    public function show(Subcategoria $subcategorium): Response
    {
        return $this->render('subcategoria/show.html.twig', [
            'subcategorium' => $subcategorium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_subcategoria_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Subcategoria $subcategorium, SubcategoriaRepository $subcategoriaRepository): Response
    {
        $form = $this->createForm(SubcategoriaType::class, $subcategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subcategoriaRepository->add($subcategorium, true);

            return $this->redirectToRoute('app_subcategoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subcategoria/edit.html.twig', [
            'subcategorium' => $subcategorium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_subcategoria_delete", methods={"POST"})
     */
    public function delete(Request $request, Subcategoria $subcategorium, SubcategoriaRepository $subcategoriaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $subcategorium->getId(), $request->request->get('_token'))) {
            $subcategoriaRepository->remove($subcategorium, true);
        }

        return $this->redirectToRoute('app_subcategoria_index', [], Response::HTTP_SEE_OTHER);
    }
}
