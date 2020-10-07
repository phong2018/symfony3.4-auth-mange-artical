<?php
// src/AppBundle/Controller/TaskController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 

class TaskController extends Controller
{
    /** 
      * @Route("/task/new") 
   */ 
    public function newAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        // tạo form
        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class, ['widget' => 'single_text'])

            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
