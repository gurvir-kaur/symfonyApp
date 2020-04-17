<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsuarioController extends AbstractController
{
    /**
     * @Route("/usuario", name="usuario")
     */
    public function index()
    {
        return $this->render('usuario/index.html.twig');
    }

    /**
     * @Route ("add_new_usuario", name="add_new_usuario")
     *
     */
    public function add_new_usuario()
    {
        $action = $this->generateUrl('add_new_usuario');
        return $this->render('usuario/form.html.twig', ['action' => $action]);
    }

    /**
     * @Route ("add_usuario", name="add_usuario")
     *
     */
    public function add_usuario(Request $request)
    {

        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        // creates an object of product and initializes some data for this example
        $usuario = new Usuario();
        $usuario->setName($name);
        $usuario->setEmail($email);
        $usuario->setPassword($password);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($usuario);
        $entityManager->flush();


        return $this->render('usuario/index.html.twig');
    }

    /**
     * @Route ("mostrar_usuario", name="mostrar_usuario")
     */
    public function mostrar_usuario()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $respository = $entityManager->getRepository(usuario::class);
        $usuario = $respository->findAll();
        return $this->render('usuario/mostrar.html.twig',
            [
                'usuario' => $usuario,
            ]
        );
    }


    /**
     * @Route ("delete_usuario/{id}", name="delete_usuario")
     */
    public function delete_usuario($id)
    {
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($usuario);
        $entityManager->flush();

        return $this->render('usuario/index.html.twig');
    }

    /**
     * @Route ("modify_usuario/{id}", name="modify_usuario")
     */
    public function modify_usuario($id)
    {

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);
        return $this->render('usuario/modify.html.twig',
            [
                'usuario' => $usuario,
            ]
        );
    }

    /**
     * @Route ("modified_usuario/{id}", name="modified_usuario")
     */
    public function modified_usuario(Request $request, $id)
    {

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);

        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $usuario->setName($name);
        $usuario->setEmail($email);
        $usuario->setPrice($password);

        $entityManager = $this->getDoctrine()->getManager();
        //$entityManager->persist($item);
        $entityManager->flush();

        //this return shows the new item added
        return $this->render('usuario/index.html.twig');

    }

    /**
     * @Route ("usuario_products", name="usuario_products")
     */
    public function usuario_products()
    {
        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find(4);

        $products = $usuario->getProducts();

        return new JsonResponse($products);
    }
}
