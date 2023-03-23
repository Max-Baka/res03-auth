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
    
    public function createCategory(array $post) : category
    {   
        $this->render("category", [
            ]);
    }
    
    public function checkCreateCategory(array $post) : category
    {   
        
        $tab = [];
        $category = new Category($post["name"],$post["slug"],$post["description"]);
        $newcateg = $this->cm->createCategory($category);
    }
    
    public function editCategory(string $categorySlug) : category
    {
        
        $tab = [];
        $editCategory =  new Category($post["name"],$post["slug"],$post["description"]);
        $editCategory = $this->cm->getCategoryBySlug($categorySlug);
        $category = $this->cm->editCategory($editCategory);
        $tab[] = $editCategory->editCategory($editCategory);
        $this->render("category", [
            "edit-category"
            ]);
        
    }
    
    public function deleteCategory(string $categorySlug) : category
    {
         $category = $this->cm->deleteCategory($categorySlug);
       
    }
}