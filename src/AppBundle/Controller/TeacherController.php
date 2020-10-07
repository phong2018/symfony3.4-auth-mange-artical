<?php 
namespace AppBundle\Controller; 

use AppBundle\Entity\Teacher; 
use AppBundle\Form\TeacherType;
use AppBundle\Form\FormValidationType; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  


class TeacherController extends Controller {    
   /** 
      * @Route("/teacher/new") 
   */ 
   public function newAction(Request $request) { 

      $teacher = new Teacher();
      $form = $this->createForm(TeacherType::class, $teacher);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) { 
         //-----cập nhật dữ liệu Teacher
         $teacher = $form->getData(); 
         $em = $this->getDoctrine()->getManager();
         $em->persist($teacher);
         $em->flush(); 

         return new Response("User photo is successfully uploaded."); 
      } else { 
     
         return $this->render('@App/teacher/new.html.twig', array( 
            'form' => $form->createView(), 
         )); 
      } 
   }
   /**
     * @Route("/teacher/update/{id}", name="teacher_update")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function update_formAction(Request $request, $id){

       $entityManager = $this->getDoctrine()->getManager();
       $teacher = $entityManager->getRepository(Teacher::class)->findOneById($id);
       if (!$teacher) {
           throw $this->createNotFoundException(
               'No Teacher found for id '.$id
           );
       }
       
       $form = $this->createForm(TeacherType::class, $teacher);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) { 
           //-----cập nhật dữ liệu Teacher
           $teacher = $form->getData(); 
           $em = $this->getDoctrine()->getManager();
           $em->persist($teacher);
           $em->flush(); 

           return new Response("User photo is successfully uploaded."); 
        } else { 
       
           return $this->render('@App/teacher/new.html.twig', array( 
              'form' => $form->createView(), 
           )); 
        } 
     }
 
 
    
   /** 
   * @Route("/Teacher/display", name="Teacher_list") 
   */ 
   public function displayAction() { 
      $stud = $this->getDoctrine() 
      ->getRepository('AppBundle:Teacher') 
      ->findAll();
      return $this->render('@App/Teacher/display.html.twig', array('data' => $stud)); 
   }      
}  