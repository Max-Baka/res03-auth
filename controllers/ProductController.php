<?php

class ProductController extends AbstractController{
    
    
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
    public function createProduct(array $post) : void
    {   
        $this->render("create-product", [
            ]);
    }
    
    public function checkCreateProduct(array $post) : void
    {   
        
        $tab = [];
        $product = new Product($post["name"],$this->slugify($post["name"]),$post["description"], intval($post["price"]));
        $newprod = $this->pm->createProduct($product);
    }
    
    public function editProduct(string $productSlug) : void
    {
        $editProduct = $this->pm->getProductBySlug($productSlug);
        $this->render("edit-product", [
            "edit-product" =>$editProduct
            ]);
        
    }
    
    public function checkEditProduct(array $post, string $productSlug) : void
    {
        $editProduct =  new Product($post["name"],$this->slugify($post["name"]),$post["description"], $post["price"]);
        $editProduct->setId($post["id"]);
        $product = $this->pm->editProduct($editProduct);
       
        
    }
    
    public function deleteProduct(string $productSlug) : void
    {
         $product = $this->pm->deleteProduct($productSlug);
       
    }
}
