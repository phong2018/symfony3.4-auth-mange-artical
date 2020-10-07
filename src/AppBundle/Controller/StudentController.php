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
     * @Route("/student/update_form/{id}", name="student_update_form")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function update_formAction(Request $request, $id){

       $entityManager = $this->getDoctrine()->getManager();
       $student = $entityManager->getRepository(Student::class)->findOneById($id);

  

       if (!$student) {
           throw $this->createNotFoundException(
               'No student found for id '.$id
           );
       }

     

       $form = $this->createForm(StudentType::class, (array) $student );

         echo $student->getName();
       die;

       $student->setName('New student name11!');
       $entityManager->flush();

       return $this->redirectToRoute('homepage');
   }
 
    /**
     * @Route("/student/update/{id}", name="student_update")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function updateAction(Request $request, $id){

       $entityManager = $this->getDoctrine()->getManager();
       $student = $entityManager->getRepository(Student::class)->find($id);

       if (!$student) {
           throw $this->createNotFoundException(
               'No student found for id '.$id
           );
       }

       $student->setName('New student name!');
       $entityManager->flush();

       return $this->redirectToRoute('homepage');
   }
    
   /** 
   * @Route("/student/display", name="student_list") 
   */ 
   public function displayAction() { 
      $stud = $this->getDoctrine() 
      ->getRepository('AppBundle:Student') 
      ->findAll();
      return $this->render('@App/student/display.html.twig', array('data' => $stud)); 
   }      
}  