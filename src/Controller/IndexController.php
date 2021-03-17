<?php

namespace App\Controller;

use App\Repository\TareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    const ELEMENTOS_POR_PAGINA = 10;

    /**
     * @Route(
     *  "/{pagina}",
     *  name="app_listado_tarea",
     *  defaults={"pagina": 1},
     *  requirements={"pagina"="\d+"},
     *  methods={"GET"}
     * )
     *
     * @param int $pagina
     * @param TareaRepository $tareaRepository
     * @return Response
     */
    public function index(int $pagina, TareaRepository $tareaRepository): Response
    {
        //dump($pagina);
        $tareas= $tareaRepository->buscarTodasPorUsuario($pagina, self::ELEMENTOS_POR_PAGINA);

        return $this->render('index/index.html.twig', [
            'tareas' => $tareas,
            'pagina' => $pagina,
        ]);
    }

}
