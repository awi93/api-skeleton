<?php

namespace Tests\Services;

use App\Models\Tables\Menu;
use App\Services\Impl\MenuServiceImpl;
use Tests\TestCase;

class MenuServiceTest extends TestCase
{

    private function generateMockMenu() : array {
        $menus = array();

        $dashboard = new Menu();
        $dashboard->id = 1;
        $dashboard->menu_id = null;
        $dashboard->code = "DASH";
        $dashboard->icon = "dashboard";
        $dashboard->label = "dashboard";
        $dashboard->description = "description";
        $dashboard->link = "/";

        $menus[] = $dashboard;

        $product = new Menu();
        $product->id = 2;
        $product->menu_id =  null;
        $product->code = "PROD";
        $product->icon = "Product";
        $product->label = "Product";
        $product->description = "Product";
        $product->link = "";

        $menus[] = $product;

        $listProduct = new Menu();
        $listProduct->id = 3;
        $listProduct->menu_id =  2;
        $listProduct->code = "LPROD";
        $listProduct->icon = "list_product";
        $listProduct->label = "List Product";
        $listProduct->description = "Product";
        $listProduct->link = "/products";

        $menus[] = $listProduct;

        $createProduct = new Menu();
        $createProduct->id = 4;
        $createProduct->menu_id =  2;
        $createProduct->code = "LPROD";
        $createProduct->icon = "list_product";
        $createProduct->label = "List Product";
        $createProduct->description = "Product";
        $createProduct->link = "/products";

        $menus[] = $createProduct;

        $deleteProduct = new Menu();
        $deleteProduct->id = 5;
        $deleteProduct->menu_id =  9;
        $deleteProduct->code = "LPROD";
        $deleteProduct->icon = "list_product";
        $deleteProduct->label = "List Product";
        $deleteProduct->description = "Product";
        $deleteProduct->link = "/products";

        $menus[] = $deleteProduct;

        return $menus;
    }

    public function test_structure_tree_success() {
        $module = new MenuServiceImpl();

        $result = $module->structureTree($module->groupMenu($this->generateMockMenu()), null);

        $this->assertCount(2, $result);

        $this->assertCount(2, $result[1]->children);
    }

}
