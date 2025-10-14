<?php

namespace App\Controller;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AuthorType;
use App\Entity\Author;



final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/list', name: 'list_author')]
    public function listAuthors()
    {   $var = "3A28";
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
                'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
                ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
                'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        return $this->render("author/list.html.twig",
            array('x'=>$var,'tabAuthors'=>$authors));
    }

    #[Route('/listAuthor', name: 'list_authors')]
    public function list(AuthorRepository $repository)
    {
        $authors= $repository->findAll();
        //var_dump($authorss).die();
        return $this->render("author/listAuthors.html.twig",
        array('tab'=>$authors));
    }

#[Route('/showAuthor/{id}', name: 'show_auth')]
public function show(AuthorRepository $repository, int $id)
{
    $author = $repository->find($id);

    return $this->render("author/showAuthor.html.twig",
        array('author' => $author)
    );
}
#[Route('/addAuthor', name: 'add_auth')]
public function add (ManagerRegisty $doctrine )
{
    $author = new Author();
    $author->setUsername("mariem");
    $author->setEmail("mariem@esprit.tn");
    $author->setNbrBooks(10);
    $em= $doctrine->getManager();
    $em->persist($author);
    $em->flush();
    return $this->redirectToRoute("list_authors");

}
 #[Route('/addWithForm', name: 'addForm_auth')]
 public function addWithForm(Request $request,ManagerRegistry $doctrine)
 {
    $author = new Author();
    $form= $this->createForm(AuthorType::class,$author);
    $form->handleRequest($request);
    if($form->isSubmitted()){
        $em= $doctrine->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute("list_authors");
    }
    return $this->render("author/add.html.twig",["formulaireAuthor"=>$form]);

 }
#[Route('/updateAuthor/{id}' , name: 'update_auth')]
public function update($id,AuthorRepository $repository,Request $request,ManagerRegistry $doctrine)
{
    $author = $repository->find($id);
    $form= $this->createForm(AuthorType::class,$author);
    $form->handleRequest($request);
    if($form->isSubmitted()){
        $em= $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute("list_authors");
    }
    return $this->render("author/update.html.twig",["formulaireAuthor"=>$form]);
}
#[Route('/removeAuthor/{id}' , name: 'remove_auth')]
public function delete(ManagerRegistry $doctrine,$id,AuthorRepository $repository)
{
    $author= $repository->find($id);
    $em= $doctrine->getManager();
    $em->remove($author);
    $em->flush();
    return $this->redirectToRoute("list_authors");
}


}