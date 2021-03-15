<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/list/{id}")
     */
    public function list(Product $productById): Response
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        // look for a single Product by name
        $productByName = $repository->findOneBy(['name' => 'Keyboard']);
        // or find by name and price
        $productByNameAndPrice = $repository->findOneBy([
            'name' => 'Keyboard',
            'price' => 1999,
        ]);

        // look for multiple Product objects matching the name, ordered by price
        $products = $repository->findBy(
            ['name' => 'Keyboard'],
            ['price' => 'ASC']
        );

        // look for *all* Product objects
        $productsAll = $repository->findAll();

        $results = array($productById, $productByName, $productByNameAndPrice, $products, $productsAll);

        return $this->render('product/list.html.twig', ['results' => $results]);
    }
}