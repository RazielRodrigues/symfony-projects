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
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy([], ["id" => "DESC"]);
        return $this->render('index.html.twig', ["tasks" => $tasks]);
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
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $task->setStatus(!$task->getStatus());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/delete/{id}", name="delete_task")
     */
    public function delete(Task $id)
    {
        $this->getDoctrine()->getManager()->remove($id);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('to_do_list');
    }

}
