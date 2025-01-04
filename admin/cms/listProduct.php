<?php
// Add product
if(isset($_POST['btn_add'])){
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $proDes = $_POST['proDes'];
    $sql = "INSERT INTO products (productName, productPrice, productCategory, productDescription) VALUES ('$productName', '$productPrice', '$productCategory', '$proDes')";
    $exe = mysqli_query($conn, $sql);
    if($exe){
        echo "<script>alert('Product added successfully')</script>";
    }else{
        echo "<script>alert('Product not added')</script>";
    }
}
// End Add product

$id = "";
$op = "";
if(isset($_GET['op'])){
    $op = $_GET['op'];
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
// echo $id;


// Update product
if(isset($_POST['btn_update'])){
    // echo "<script>alert('Product updated successfully')</script>";
    // echo $id;
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $proDes = $_POST['proDes'];
    $sql_up = "UPDATE products SET productName = '$productName', productPrice = '$productPrice', productCategory = '$productCategory', productDescription = '$proDes'  WHERE id = '$id';";
    $exe = mysqli_query($conn, $sql_up);
    if($exe){
        header('location: ./index.php');
    }

}








?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main class="px-6">
<div class="relative overflow-x-auto">
    <h2 class="text-center text-gray-800 dark:text-white font-bold py-3">Products Lsit</h2>

    <div class="flex items-center gap-3 mb-4">
        <div class="py-3 pl-3">
            <button type="button" href="?tag=add&id=<?=$product['id']?>" class="inline-block rounded-lg bg-blue-700 px-6 py-2 text-center font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-target="crud-modal" data-modal-toggle="crud-modal"><i class="fa-solid fa-plus"></i></button>
        </div>
        <!-- <form action="">
            <input type="text" placeholder="Search" name="search" id="search" class="h-auto pl-10 py-2 bg-gray-200 text-sm border border-gray-500 rounded-md focus:outline-none focus:bg-white dark:bg-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-950 dark:focus:ring-gray-500 dark:focus:border-gray-500">
        </form> -->
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                </th>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM products";
                $exe = mysqli_query($conn, $sql);
                $i = 0;
                while($product = mysqli_fetch_assoc($exe)){
                    $i++;
                ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?=$i?>
                </th>
                <td class="px-6 py-4">
                    <?=$product['productName']?>
                </td>
                <td class="px-6 py-4">
                    <?=$product['productPrice']?>$
                </td>
                <td class="px-6 py-4">
                    <?=$product['productCategory']?>
                </td>
                <td class="px-6 py-4">
                    <?=$product['productDescription']?>
                </td>
                <td class="py-2">
                    <a href="?tag=listProducts&op=update&id=<?= $product['id']?>" name="btn_update" onclick="opentModalupdate()" class="btn-update inline-block rounded-lg bg-yellow-700 px-6 py-2 text-center font-medium text-white hover:bg-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800" data-modal-toggle="edit-modal"><i class="fa-solid fa-pen-to-square"></i></a>
                    <button class="btn-delete inline-block rounded-lg bg-red-700 px-6 py-2 text-center font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-modal-target="update-modal" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-delete-id="<?= $product['id'] ?>"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>

      <?php
            }
            ?>
         
        </tbody>
    </table>
</div>
</main>














<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Product
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="productName" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="productPrice" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="productCategory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select category</option>
                            <option value="Iphone">Iphone</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Oppo">Oppo</option>
                            <option value="Vivo">Vivo</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                        <textarea  
                        name="proDes" 
                        rows="4" 
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Write product description here"></textarea>
                    </div>
                </div>
                <button type="submit" name="btn_add" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new product
                </button>
            </form>
        </div>
    </div>
</div> 
<!-- End Main modal -->






<!-- Update modal -->

<?php
if($op=="update"){
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $exe = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($exe);
?>
<div id="update-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Upadte Product
                </h3>
                <button onclick="closeModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post">
            <input type="hidden" name="id_update" id="id_update">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input value="<?=$product['productName']?>" type="text" name="productName" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input value="<?=$product['productPrice']?>" type="text" name="productPrice" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="productCategory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                     
                        <option value="Iphone" <?= $product['productCategory'] === 'TV' ? 'selected' : '' ?>>Iphone</option>
                        <option value="Samsung" <?= $product['productCategory'] === 'PC' ? 'selected' : '' ?>>Samsung</option>
                        <option value="Oppo" <?= $product['productCategory'] === 'GA' ? 'selected' : '' ?>>Oppo</option>
                        <option value="Vivo" <?= $product['productCategory'] === 'PH' ? 'selected' : '' ?>>Vivo</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                        <textarea  
                        name="proDes" 
                        rows="4" 
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Write product description here"><?= $product['productDescription']?></textarea>                                            
                    </div>
                </div>
                <button type="submit" name="btn_update" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new product
                </button>
            </form>
        </div>
    </div>
</div> 
<?php
}
?>





<!-- End Update modal -->






<!-- Delete modal -->


<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" onclick="hide_delete_modal()" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <form action="">
                    <input type="hidden" name="update-id" id="delete-id">
                    <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button onclick="hide_delete_modal()" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Delete modal -->















<script>

    // Modal Add Product
    document.addEventListener('DOMContentLoaded', () => {
    const modalToggles = document.querySelectorAll('[data-modal-toggle]');

    modalToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const modalId = toggle.getAttribute('data-modal-toggle');
            const modal = document.getElementById(modalId);

            if (modal) {
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden'); // Show modal
                    modal.classList.add('flex'); // Add flex for alignment
                } else {
                    modal.classList.add('hidden'); // Hide modal
                    modal.classList.remove('flex'); // Remove flex alignment
                }
            }
        });
    });

    const modals = document.querySelectorAll('.fixed');
    modals.forEach(modal => {
        modal.addEventListener('click', (event) => {
            const modalContent = modal.querySelector('.relative');
            
            // Check if click is outside modal content
            if (event.target === modal || !modalContent.contains(event.target)) {
                modal.classList.add('hidden'); // Hide modal
                modal.classList.remove('flex'); // Remove flex alignment
            }
        });
    });
});


// End Modal Add Product


// Modal Delete Product
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function() {
            const deleteId = this.getAttribute('data-delete-id'); // Correct attribute name
            document.getElementById('delete-id').value = deleteId;
        });
    });
});

function hide_delete_modal() {
    document.getElementById('popup-modal').classList.add('hidden');
    document.getElementById('popup-modal').classList.remove('flex');
}
// End Modal Delete Product


// opent Modal update
function closeModal() {
    document.getElementById('update-modal').classList.add('hidden');
}

</script>

</body>
</html>