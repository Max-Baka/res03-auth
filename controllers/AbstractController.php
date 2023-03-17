<?php  

abstract class AbstractController  
{  
    protected function render(string $template, array $values)  
    {  
        $data = $values;  
        $page = $template;  
  
        require "templates/layout.phtml";  
    }  
    public function __construct()  
{  
    $this->pm = new ProductManager();  
    $this->cm = new CategoryManager();  
}
}