<?php

class ProductManager extends AbstractController{
    
    
    private ProductManager $pm;
    
     public function __construct()  
    {  
        $this->pm = new ProductManager(); 
    }
            /* Pour la route /produits */  
    public function productsList() : void  
    {  
        $products = $this->pm->getAllProducts();// à remplacer par un appel au manager pour récupérer la liste de tous les produits  
      
        $this->render("products", [  
            "products" => $products  
        ]);  
    }
        /* Pour la route /produits/:slug-produit */  
    public function productDetails(string $productSlug) : void  
    {  
        $product = $this->pm->getProductBySlug($productSlug); // à remplacer par un appel au manager pour récupérer les informations d'un produit  
        $categories = $this->cm->getCategoriesByProductSlug($productSlug);
        $this->render("product", [  
            "product" => $product, 
            "categories" => $categories
        ]);  
    }
}
