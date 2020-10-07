<?php 
namespace AppBundle\Controller; 

use AppBundle\Entity\Student; 
use AppBundle\Form\StudentType;
use AppBundle\Form\FormValidationType; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  


class StudentController extends Controller {    
   /** 
      * @Route("/student/new") 
   */ 
   public function newAction(Request $request) { 

      $student = new Student();
      $form = $this->createForm(StudentType::class, $student);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) { 
         // xử lý file
         $file = $student->getPhoto(); 
         $fileName = md5(uniqid()).'.'.$file->guessExtension(); 
         $file->move($this->getParameter('photos_directory'), $fileName); 
         //-----cập nhật dữ liệu student
         $student = $form->getData(); 
         $student->setPhoto($this->getParameter('photos_directory').$fileName);
         //------
         $em = $this->getDoctrine()->getManager();
         $em->persist($student);
         $em->flush(); 

         return new Response("User photo is successfully uploaded."); 
      } else { 
     
         return $this->render('@App/student/new.html.twig', array( 
            'form' => $form->createView(), 
         )); 
      } 
   }
    /** 
   * @Route("/student/update/{id}") 
   */ 
   public function updateAction($id) { 
      $doct = $this->getDoctrine()->getManager(); 
      $stud = $doct->getRepository('AppBundle:Student')->find($id);  
      
      if (!$stud) { 
         throw $this->createNotFoundException( 
            'No student found for id '.$id 
         ); 
      } 
      $stud->setAddress('7 south street'); 
      $doct->flush(); 
      
      return new Response('Changes updated!'); 
   }
   /** 
   * @Route("/student/display") 
   */ 
   public function displayAction() { 
      $stud = $this->getDoctrine() 
      ->getRepository('AppBundle:Student') 
      ->findAll();
      return $this->render('@App/student/display.html.twig', array('data' => $stud)); 
   }      
}  