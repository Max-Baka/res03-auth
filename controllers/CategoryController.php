<?php

class CategoryController extends AbstractController {
    
    private CategoryManager $cm;
    
    public function __construct()
    {
        $this->cm = new CategoryManager();
    }
    public function categoriesList() : void  
    {  
       $categories = $this->cm->getAllCategories();  // à remplacer par un appel au manager pour récupérer la liste des catégories  
      
        $this->render("index", [  
            "categories" => $categories  
        ]);  
    }
        /* Pour la route /categories/:slug-categorie */  
    public function productsInCategory(string $categorySlug) : void  
    {  
        $products = $this->pm->getProductsByCategorySlug($categorySlug); // à remplacer par un appel au manager pour récupérer la liste des produits d'une catégorie  

        $this->render("category", [  
            "products" => $products,
            "category" => $categorySlug
        ]);  
    }
    
    public function createCategory(array $post) : void
    {   
        $this->render("create-category", [
            ]);
    }
    
    public function checkCreateCategory(array $post) : void
    {   
        
        $tab = [];
        $category = new Category($post["name"],$this->slugify($post["name"]),$post["description"]);
        $newcateg = $this->cm->createCategory($category);
    }
    
    public function editCategory(string $categorySlug) : void
    {
        $editCategory = $this->cm->getCategoryBySlug($categorySlug);
        $this->render("edit-category", [
            "categorie" =>$editCategory
            ]);
        
    }
    
    public function checkEditCategory(array $post, string $categorySlug) : void
    {
        
        
        $editCategory =  new Category($post["name"],$this->slugify($post["name"]),$post["description"]);
        $editCategory->setId($post["id"]);
        $category = $this->cm->editCategory($editCategory);
    }
    
    public function deleteCategory(string $categorySlug) : void
    {
         $category = $this->cm->deleteCategory($categorySlug);
       
    }
}