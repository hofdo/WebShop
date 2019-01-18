<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";
require_once "../Pages/Helper.php";


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<h1>Admin</h1>
<h2>Productlist</h2>

<div class="productList">
    <table id="productListTable" class="productListTable">
        <?php
        Product::renderProductList();
        ?>
        <tr>
            <td>
                <button onclick="showEditProductForm()">Change Product</button>
            </td>
            <td>
                <button onclick="deleteProduct()">Delete Product</button>
            </td>
            <td>
                <button onclick="showAddProductForm()">Add Product</button>
                </button></td>
            <td>
                <button onclick="showAddCategoryForm()">Add category</button>
                </button></td>
        </tr>
    </table>
    <label id="adminProductAddLabel"></label>
    <div id="productEdit" class="productEdit">
        <h2>Edit product</h2>
        <table>
            <tr>
                <td>
                    <button onclick="closeProductEdit()">X</button>
                </td>
            </tr>
            <tr>
                <td>ID:</td>
                <td><input id="adminSectionProductID" class="adminSectionID" name="ID" readonly></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input id="adminSectionProductName" type="text" value=""></td>
            </tr>
            <tr>
                <td>Value:</td>
                <td><input id="adminSectionValue" type="text" value=""></td>
            </tr>
            <tr>
                <td>Category:</td>
                <td><select id="adminSectionCategory">
                        <?php
                        $categories = Product::getCategories()->fetch_all();
                        foreach ($categories as $category) {
                            echo "<option value='$category[0]'>$category[0]</option>";
                        }

                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>
                    <button type='submit' id="adminChangeProduct" class="adminChangeProduct" onclick="editProduct()">
                        Edit product
                    </button>
                </td>
                <td>
                    <button type='submit' id="adminAddProduct" class="adminAddProduct" onclick="addProduct()">Add
                        product
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <div id="categoryAdd" class="categoryAdd">
        <table>
            <tr>
                <td>
                    <button onclick="closeCategoryAdd()">X</button>
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input id="adminSectionCategoryName" type="text" value=""></td>
            </tr>
            <tr>
                <td>
                    <button type='submit' id="adminAddCategory" class="adminAddCategory" onclick="addCategory()">Add
                        category
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>
