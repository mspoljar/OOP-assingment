<?php

class IndexController extends Controller
{
    public function index()
    {
       $this->view->render('homepage',[
           'items'=>Catalog::show()
       ]);
    }

    public function testud()
    {
        $i=$_POST;
        return var_dump($i);
    }

    public function add()
    {
        Catalog::add();
      /* $this->view->render('test',[
           'test'=>$_POST
       ]);
       */
      header('location: /');
    }

    public function shop()
    {
        $this->view->render('shop',[
            'items'=>Catalog::show()
        ]);
    }

    public function cartadd()
    {
        $items=array(Catalog::find());
        $itemArray=[];
       foreach($items as $item){
           $sku=strval($item->sku);
           $itemArray=[
               $sku=>[
               'name'=>$item->product_name,
               'sku'=>$sku,
               'price'=>$item->price,
               'quantity'=>$_POST['quantity']
           ]
            ];
       }
        
        if(!empty($_SESSION['cart'])){
            if(array_key_exists($itemArray[$sku]['sku'],$_SESSION['cart'])){
                foreach($_SESSION['cart'] as $k=>$v){
                    if($itemArray[$sku]['sku']==$k){
                        if(empty($_SESSION["cart"][$k]["quantity"])){
                            $_SESSION["cart"][$k]["quantity"]=0;
                        }
                        $_SESSION["cart"][$k]["quantity"]+= $_POST['quantity'];
                    }
                }
                
            }else{
                $_SESSION['cart']=array_replace($_SESSION['cart'],$itemArray);
            }
        }else{
            $_SESSION['cart']=$itemArray;
        }
        header('location: /index/shop');
        
    }

    public function checkout()
    {
        $totalprice=0;
       $itemArray=array();
        foreach($_SESSION['cart'] as $item){
            $totalprice=$totalprice+($item['price'] * $item['quantity']);
        }
        $itemArray=array_merge($itemArray,$_SESSION['cart']);
        $this->view->render('checkout',[
            'items'=>$itemArray,
            'totalprice'=>$totalprice
        ]);
    }

    public function remove()
    {
        if(!empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $k){
                if($_POST["sku"] == $k['sku']){
                    $a=intval($k['quantity']);
                    $b=intval($_POST['removequant']);
                    $c=$a-$b;
                    $_SESSION['cart'][$k['sku']]['quantity']=$c;
                    if($_SESSION['cart'][$k['sku']]['quantity']<0){
                        unset($_SESSION['cart'][$k['sku']]);
                    } 
                }									
					if(empty($_SESSION["cart"])){
                        unset($_SESSION["cart"]);
                    }
            }
        }
        header('location:/index/shop');

        
    }
}