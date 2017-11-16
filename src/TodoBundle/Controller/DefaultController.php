<?php

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TodoBundle\Entity\TaskStatus as TaskStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * Index action
     * @return Response
     */
    public function indexAction(): Response
    {
        $tasksTodo = array();
        $tasksInprogress = array();
        $tasksCompleted = array();

        $tasks = $this->getDoctrine()->getRepository("TodoBundle:Task")->findAll();
        foreach ($tasks as $task) {
            $taskStatusCode = $task->getTaskStatusCode()->getTaskStatusCode();
            if ($taskStatusCode == TaskStatus::TODO) {
                $tasksTodo[] = $task;
            } else if ($taskStatusCode == TaskStatus::INPROGRESS) {
                $tasksInprogress[] = $task;
            } else if ($taskStatusCode == TaskStatus::COMPLETED) {
                $tasksCompleted[] = $task;
            }
        }

        return $this->render("TodoBundle:Default:index.html.twig", array(
            "tasksTodo" => $tasksTodo,
            "tasksInprogress" => $tasksInprogress,
            "tasksCompleted" => $tasksCompleted
        ));
    }

    public function adminAction(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!1');

        return new Response('<html><body>Admin page!</body></html>');
    }
}
