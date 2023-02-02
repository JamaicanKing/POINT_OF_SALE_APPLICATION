<?php

    include "../migrations/create_products_inventory_table.php";

    $productInventory = new CreateProductsInventoryTable;
    $productInventory->createtable();

?>