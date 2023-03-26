<?php  
 
class Router {  
    private ProductController $pc;
    private CategoryController $cc;
    private AuthController $auth; 
  
    public function __construct()  
        {  
            $this->pc = new ProductController();
            $this->cc = new CategoryController();
            $this->auth = new AuthController(); 
        }
    private function splitRouteAndParameters(string $route) : array  
        {  
            $routeAndParams = [];  
            $routeAndParams["route"] = null;  
            $routeAndParams["categorySlug"] = null;  
            $routeAndParams["productSlug"] = null;  
            
            
            if(strlen($route) > 0) // si la chaine de la route n'est pas vide (donc si ça n'est pas la home)  
            {  
                $tab = explode("/", $route);  
          
                if($tab[0] === "categories") // écrire une condition pour le cas où la route commence par "categories"  
                {  
                    // mettre les bonnes valeurs dans le tableau  
                    $routeAndParams["route"] = "categories";  
                    $routeAndParams["categorySlug"] = $tab[1];
                    
                }
                else if($tab[0] === "creer-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "check-creer-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "modifier-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["categorySlug"] = $tab[1];
                }
                else if($tab[0] === "check-modifier-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["categorySlug"] = $tab[1];
                }
                else if($tab[0] ===  "supprimer-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["categorySlug"] = $tab[1];
                }
                else if($tab[0] === "produits") // écrire une condition pour le cas où la route commence par "produits"  
                {  
                    // mettre les bonnes valeurs dans le tableau  
                    $routeAndParams["route"] = "products";
                    if (isset($tab[1])){
                        
                    $routeAndParams["productSlug"] = $tab[1];
                    
                    }
                }
                else if($tab[0] === "creer-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "check-creer-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "modifier-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["productSlug"] = $tab[1];
                }
                else if($tab[0] === "check-modifier-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["productSlug"] = $tab[1];
                }
                else if($tab[0] ===  "supprimer-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["productSlug"] = $tab[1];
                }
                else if($tab[0] === "creer-un-compte") // écrire une condition pour le cas où la route commence par "creer-un-compte"  
                {  
                    // mettre les bonnes valeurs dans le tableau  
                    $routeAndParams["route"] = $tab[0];  
                }  
                else if($tab[0] === "check-creer-un-compte") // écrire une condition pour le cas où la route commence par "check-creer-un-compte"  
                {  
                    // mettre les bonnes valeurs dans le tableau  
                    $routeAndParams["route"] = $tab[0];  
                }  
                else if($tab[0] === "connexion") // écrire une condition pour le cas où la route commence par "connexion"  
                {  
                    // mettre les bonnes valeurs dans le tableau  
                    $routeAndParams["route"] = $tab[0];  
                }  
                else if($tab[0] === "check-connexion") // écrire une condition pour le cas où la route commence par "check-connexion"  
                {  
                    // mettre les bonnes valeurs dans le tableau  
                    $routeAndParams["route"] = $tab[0];  
                }
            }
            
            else  
            {  
                $routeAndParams["route"] = "";  
            }  
          
            return $routeAndParams;  
        }
        public function checkRoute(string $route) : void  
    {  
        $routeTab = $this->splitRouteAndParameters($route);
        
    
        if($routeTab['route'] === "") // condition(s) pour envoyer vers la home  
        {  
            // appeler la méthode du controlleur pour afficher la home
            $this->cc->categoriesList();
        }
        else if($routeTab['route'] === "creer-categorie")
        {
            $post = $_POST;
            $this->cc->createCategory($post);
        }
        else if($routeTab['route'] === "check-creer-categorie")
        {
            $post = $_POST;
            $this->cc->checkCreateCategory($post);
        }
        else if($routeTab['route'] === "modifier-categorie" && $routeTab['categorySlug'] !== null)
        {
            $this->cc->editCategory($routeTab ['categorySlug']);
        }
        else if($routeTab['route'] === "check-modifier-categorie" && $routeTab['categorySlug'] !== null)
        {
            $post = $_POST;
            $this->cc->checkEditCategory($post, $routeTab['categorySlug']);
        }
        else if($routeTab['route'] === "supprimer-categorie"&& $routeTab['categorySlug'] !== null)
        {
            $this->cc->deleteCategory($routeTab['categorySlug']);
        }
        else if($routeTab['route'] === "produits" && $routeTab['productSlug'] === null) // condition(s) pour envoyer vers la liste des produits  
        {  
            // appeler la méthode du controlleur pour afficher les produits
            $this->pc->productsList();
        }  
        else if($routeTab['route'] === "creer-produit")
        {
            $post = $_POST;
            $this->pc->createProduct($post);
        }
        else if($routeTab['route'] === "check-creer-produit")
        {
            $post = $_POST;
            $this->pc->checkCreateProduct($post);
        }
        else if($routeTab['route'] === "modifier-produit" && $routeTab['productSlug'] !== null)
        {
            $this->pc->editProduct($routeTab['productSlug']);
        }
        else if($routeTab['route'] === "check-modifier-produit" && $routeTab['productSlug'] !== null)
        {
            $post = $_POST;
            $this->pc->checkEditProduct($post, $routeTab['productSlug']);
        }
        else if($routeTab['route'] === "supprimer-produit" && $routeTab['productSlug'] !== null)
        {
            $this->pc->deleteProduct($routeTab['productSlug']);
        }
        else if($routeTab['route'] === "categories" && $routeTab['categorySlug'] !== null) // condition(s) pour envoyer vers la liste des produits d'une catégorie  
        {  
            // appeler la méthode du controlleur pour afficher les produits d'une catégorie
            $this->cc->productsInCategory($routeTab['categorySlug']);  
        }  
        else if($routeTab['route'] === "produits" && $routeTab['productSlug'] !== null) // condition(s) pour envoyer vers le détail d'un produit  
        {  
            // appeler la méthode du controlleur pour afficher le détail d'un produit
            $this->pc->productDetails($routeTab['productSlug']);
        }
        else if($routeTab["route"] === "creer-un-compte") // condition pour afficher la page du formulaire d'inscription  
        {  
            $this->auth->register();// appeler la méthode du controlleur pour afficher la page d'inscription  
        }  
        else if($routeTab["route"] === "check-creer-un-compte") // condition pour l'action du formulaire d'inscription  
        {  
            $this->auth->checkRegister();// appeler la méthode du controlleur pour créer un utilisateur et renvoyer vers l'accueil  
        }  
        else if($routeTab["route"] === "connexion") // condition pour afficher la page du formulaire de connexion  
        {  
            $this->auth->login(); // appeler la méthode du controlleur pour afficher la page d'inscription  
        }  
        else if($routeTab["route"] === "check-connexion") // condition pour l'action du formulaire de connexion  
        {  
            $this->auth->checkLogin(); // appeler la méthode du controlleur pour vérifier la connexion et renvoyer vers l'accueil  
        }
            
    }
}