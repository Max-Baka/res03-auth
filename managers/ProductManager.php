<?php
class ProductManager extends AbstractManager {

    public function getAllProducts() : array  
    { 
        $query = $this->db->prepare('SELECT * FROM products');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);  
        $list = [];
        foreach($products as $product)
    {
        $prod = new Product($product["name"], $product["slug"], $product["description"], $product["price"]);
        $prod->setId($product["id"]);
        $list[] = $prod;
    }
        return $list;  
    }  
    
    public function getProductBySlug(string $productSlug) : Product  
    {  
        $query = $this->db->prepare('SELECT * FROM products WHERE slug = :product_slug');

        $parameters = [
            'product_slug' => $productSlug
        ];

        $query->execute($parameters);

        $productParams = $query->fetch(PDO::FETCH_ASSOC);

        $product = new Product($productParams['name'], $productParams['slug'], $productParams['description'], $productParams['price']);  
    
        return $product;  
    }
    public function createProduct(string $productSlug) : Product
    {
        $query = $this->db->prepare('INSERT INTO product VALUES (:name, :slug, :description, :price)');
        $parameters = [
        'name' => $product->getName(),
        'slug' => $product->getSlug(),
        'description' => $product->getDescription(),
        'price' => $product->getPrice()
        ];
        $query->execute($parameters);
        
        return $this->db->lastInsertId();// manque le last insert id et le return
        return $parameters;
    }
    public function editProduct(string $productSlug) : Product
    {
        $query = $this->db->prepare('UPDATE product SET name= :name, slug= :slug, description= :description, price= :price WHERE id= :id)');
        $parameters = [
        'name' => $product->getName(),
        'slug' => $product->getSlug(),
        'description' => $product->getDescription(),
        'price' => $product->getPrice()
        ];
        $query->execute($parameters);
        
        return $parameters;// manque le return
    }
    private function deleteProduct(string $productSlug) : void
    {
        $query = $this->db->prepare('DELETE FROM products WHERE slug = :slug');
        $parameters = [
            'product_slug' => $productSlug
            ];
        $query->execute($parameters);    
    }
    
    
    public function getProductsByCategorySlug(string $categorySlug) : array  
    {  
        $query = $this->db->prepare('SELECT products.* FROM products_categories JOIN products ON products_categories.products_id = products.id JOIN 
                                    categories ON products_categories.category_id = categories.id WHERE categories.slug =:slug ');

        $parameters = [
            'slug' => $categorySlug
        ];

        $query->execute($parameters);
        $list = [];
        $products = $query->fetchAll(PDO::FETCH_ASSOC);  
        foreach($products as $product)
   {
        $prod = new Product($product["name"], $product["slug"], $product["description"], $product["price"]);
        $prod->setId($product["id"]);
        $list[] = $prod;
   }
        return $list;  
    }
}