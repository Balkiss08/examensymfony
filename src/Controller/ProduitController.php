<?php
namespace App\Controller;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Produit;
use App\Entity\User;
use App\Form\ProduitType;

use App\Form\UserType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Entity\UserSearch;
use App\Form\UserSearchType;
use App\Entity\PriceSearch;
use App\Form\PriceSearchType;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ProduitController extends AbstractController
{
 /**
 * @Route("/produit/new", name="new_produit")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $produit = new Produit();
    $form = $this->createForm(ProduitType::class,$produit);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $produit = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($produit);
        $entityManager->flush();
        return $this->redirectToRoute('produit_list');
    }
    return $this->render('produits/new.html.twig',['form' => $form->createView()]);
    }
   

/**
 *@Route("/",name="produit_list")
 */
public function home(Request $request)
{
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $propertySearch = new PropertySearch();
    $form = $this->createForm(PropertySearchType::class,$propertySearch);
    $form->handleRequest($request);
    $produits= [];
    if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom de produit tapé dans le formulaire
            $nom = $propertySearch->getNom();
        if ($nom!="")
            //si on a fourni un nom du produit on affiche tous les produits ayant ce nom
            $produits= $this->getDoctrine()->getRepository(Produit::class)->findBy(['nom' => $nom] );
        else
            //si si aucun nom n'est fourni on affiche tous les produits
            $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
    }
    return $this->render('produits/index.html.twig',[ 'form' =>$form->createView(), 'produits' => $produits]);
 }



/**
 * @Route("/produit/{id}", name="produit_show")
*/
public function show($id) {
    $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
    return $this->render('produits/show.html.twig',array('produit' => $produit));
    }

/**
 * @Route("/produit/edit/{id}", name="edit_produit")
 * Method({"GET", "POST"})
 */
public function edit(Request $request, $id) {
    $produit = new Produit();
    $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
   
    $form = $this->createForm(ProduitType::class,$produit);
   
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
   
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
   
    return $this->redirectToRoute('produit_list');
    }
    return $this->render('produits/edit.html.twig', ['form' =>$form->createView()]);
    }
   
    
/**
 * @Route("/produit/delete/{id}",name="delete_produit")
 * @Method({"DELETE"})
 */
public function delete(Request $request, $id) {
    $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
   
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($produit);
    $entityManager->flush();
   
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('produit_list');
    }
/**
 * @Route("/user/newUser", name="new_user")
 * Method({"GET", "POST"})
 */
 public function newUser(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $produit = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        }
    return $this->render('produits/newUser.html.twig',['form'=>
    $form->createView()]);
    }

/**
 * @Route("/produit_user/", name="produit_par_user")
 * Method({"GET", "POST"})
 */

public function produitsParUSer(Request $request) {
    $userSearch = new UserSearch();
    $form = $this->createForm(UserSearchType::class,$userSearch);
    $form->handleRequest($request);
    $produits= [];
    if($form->isSubmitted() && $form->isValid()) {
        $user = $userSearch->getUser();
       
        if ($user!="")
       $produits= $user->getProduits();
        else
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
        }
       
        return $this->render('produits/produitsParUSer.html.twig',['form' => $form->createView(),'produits' => $produits]);
   }



/**
 * @Route("/produit_prix/", name="produit_par_prix")
 * Method({"GET"})
 */
public function produitsParPrix(Request $request)
{

    $priceSearch = new PriceSearch();
    $form = $this->createForm(PriceSearchType::class,$priceSearch);
    $form->handleRequest($request);
    $produits= [];
    if($form->isSubmitted() && $form->isValid()) {
    $minPrice = $priceSearch->getMinPrice();
    $maxPrice = $priceSearch->getMaxPrice();

    $produits= $this->getDoctrine()->
    getRepository(Produit::class)->findByPriceRange($minPrice,$maxPrice);
    }
    return $this->render('produits/produitsParPrix.html.twig',[ 'form' =>$form->createView(), 'produits' => $produits]); 
}

}
?>
