<?php

declare(strict_types=1);

namespace Tests\Unit;

use MyApp\Controllers\IndexController;

use MyApp\Models\Users;
use MyApp\Models\Products;

class IndexControllerTest extends AbstractUnitTest
//class UnitTest extends \PHPUnit\Framework\TestCase
{


    public function testUsers()
    {
        $model = new Users();

        $model->name = 'Deeksha';
        $model->email = "1@gmail.com";
        $model->password = "Deeksha@123";
        $res=$model->validateemail($model->email);
        $this->assertEquals($res, 1);
        $r=$model->validation();
        $this->assertEquals($r, 0);
        $r=$model->strongpassword("Deeksha@123");
        $this->assertEquals($r, 1);
        $r=$model->strongpassword("@123");
        $this->assertEquals($r, 0);
        $r=$model->strongpassword("123");
        $this->assertEquals($r, 0);
        $r=$model->strongpassword("dddd");
        $this->assertEquals($r, 0);
        $r=$model->strongpassword("DDDDD");
        $this->assertEquals($r, 0);
        $r=$model->strongpassword("DeekshaP");
        $this->assertEquals($r, 0);
    }
    public function testProducts()
    {
        $model = new Products();

        $model->name = 'bottle';
        $model->category = "electronics";
        $model->price = 123;
        $model->quantity=1;
        $model->name = 'necklace';
        $model->category = "jwellery";
        $model->price = 113;
        $model->quantity=10;
        $r=$model->validation();
        $this->assertEquals($r, 0);
        $r=$model->validateprice(-1);
        $this->assertEquals($r, 0);
        $r=$model->validateprice(100);
        $this->assertEquals($r, 1);
        $r=$model->validatequantity(-1);
        $this->assertEquals($r, 0);
        $r=$model->validatequantity(100);
        $this->assertEquals($r, 1);
        $r=$model->validatequantity(0);
        $this->assertEquals($r, 0);
        $r=$model->validateprice(0);
        $this->assertEquals($r, 0);
        $r=$model->validatecategory("electronics");
        $this->assertEquals($r, 1);
        $r=$model->validatecategory("jwellery");
        $this->assertEquals($r, 1);
        $r=$model->validatecategory("mud");
        $this->assertEquals($r, 0);

    }
}
