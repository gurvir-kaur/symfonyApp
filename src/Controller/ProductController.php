<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route ("add_product", name="add_product")
     *
     */
    public function add_product()
    {
        $action = $this->generateUrl('add_new_product');
        return $this->render('product/form.html.twig', ['action' => $action]);
    }

    /**
     * @Route ("add_new_product", name="add_new_product")
     *
     */
    public function addNewProduct(Request $request)
    {

        $name =$request->request->get('name');
        $price =$request->request->get('price');
        $description =$request->request->get('description');

        // creates an object of product and initializes some data for this example
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        //this return shows the new product added
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route ("listProducts", name="listProducts")
     */
    public function listProducts()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $respository = $entityManager->getRepository(product::class);
        $product = $respository->findAll();
        return $this->render('product/list.html.twig',
            [
                'product' => $product,
            ]
        );
    }

    /**
     * @Route ("deleteProducts/{id}", name="deleteProducts")
     */
    public function deleteProducts($id)
    {
        $product = $this->getDoctrine() ->getRepository(Product::class) ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->render('product/deleted.html.twig');
    }

    /**
     * @Route ("modify_product/{id}", name="modify_product")
     */
    public function modify_product($id){

        $product = $this->getDoctrine() ->getRepository(Product::class) ->find($id);
        return $this->render('product/modify.html.twig',
            [
                'product' => $product,
            ]
        );
    }

    /**
     * @Route ("modifiedProduct/{id}", name="modifiedProduct")
     */
    public function modifiedProduct(Request $request, $id){

        $product = $this->getDoctrine() ->getRepository(Product::class) ->find($id);

        $name =$request->request->get('name');
        $price =$request->request->get('price');
        $description =$request->request->get('description');

        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);
        $entityManager = $this->getDoctrine()->getManager();
        //$entityManager->persist($product);
        $entityManager->flush();

        //this return shows the new product added
        return $this->render('product/index.html.twig');

    }
}
