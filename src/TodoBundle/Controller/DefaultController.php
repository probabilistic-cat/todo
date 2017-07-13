<?php

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//index
use TodoBundle\Entity\TaskStatus as TaskStatus;

// signin
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $tasksTodo = $tasksInprogress = $tasksCompleted = array();
        
        $tasks = $this->getDoctrine()->getRepository('TodoBundle:Task')->findAll();
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
        
        return $this->render('TodoBundle:Default:index.html.twig', array(
            'tasksTodo' => $tasksTodo,
            'tasksInprogress' => $tasksInprogress,
            'tasksCompleted' => $tasksCompleted
        ));
    }
    
    public function signinAction(Request $request) 
    {
        //$getUsername = $request->request->get('username');
        $getPassword = $request->request->get('password');
        $getMail = $request->request->get('mail');
        
        if (/*$getUsername == "" ||*/ $getMail == "" || $getPassword == "") {
            //return $this->render('TodoBundle:Default:signin.html.twig', array());
        } else {
            $em = $this->getDoctrine()->getManager();
            //$user = $em->getRepository('TodoBundle:User')->findOneBy($criteria);
            
            
        }
        
        return $this->render('TodoBundle:Default:signin.html.twig', array());
    }
}
