<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $title = trim($request->request->get('title'));

        if (empty($title)) return $this->redirectToRoute('to_do_list');

        $task = new Task;
        $task->setTitle($title);

        $this->getDoctrine()->getManager()->persist($task);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/switch-status/{id}", name="switch_status", methods={"GET"})
     */
    public function switchStatus($id)
    {
        exit('switch task...' . $id);
    }

    /**
     * @Route("/delete/{id}", name="delete_task", methods={"GET"})
     */
    public function delete($id)
    {
        exit('delete task...' . $id);
    }

}
