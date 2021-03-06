<?php
//klasa s metodama za rad s tablicom catalog u bazi
class Catalog
{
    public static function show()
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from catalog');
        $data->execute();
        return $data->fetchAll();
    }
//metoda add sluzi za dodavanje količine pojedinačnih stavki u catalog tablici
    public static function add()
    {
        $quant=intval($_POST['quantity']);
        $sku=intval($_POST['sku']);
        $con=DB::getInstance();
        $data=$con->prepare('update catalog set quantity=quantity+:quantity where sku=:sku');
        $data->execute([
            'quantity'=>$quant,
            'sku'=>$sku
        ]);
    }

    public static function find()
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from catalog where sku=:sku');
        $data->execute([
            'sku'=>$_POST['sku']
        ]);
        return $data->fetch();
    }

    public static function checkoutdata($id)
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from catalog where sku=:sku');
        $data->execute([
            'sku'=>$id
        ]);
        return $data->fetch();
    }

    public static function removequant($q,$s)
    {
        $quant=intval($q);
        $sku=intval($s);
        $con=DB::getInstance();
        $data=$con->prepare('update catalog set quantity=quantity-:quantity where sku=:sku');
        $data->execute([
            'quantity'=>$quant,
            'sku'=>$sku
        ]);
    }

}