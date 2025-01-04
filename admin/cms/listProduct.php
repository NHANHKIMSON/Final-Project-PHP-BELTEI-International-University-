<?php
if(isset($_POST['btn_add'])){
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $productDescription = $_POST['producrtDescription'];
    $sql = "INSERT INTO products (productName, productPrice, productCategory, productDescription) VALUES ('$productName', '$productPrice', '$productCategory', '$productDescription')";
    $exe = mysqli_query($conn, $sql);
    if($exe){
        echo "<script>alert('Product added successfully')</script>";
    }else{
        echo "<script>alert('Product not added')</script>";
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
    <div class="py-3 pl-3">
        <button type="button" href="?tag=add&id=<?=$product['id']?>" class="inline-block rounded-lg bg-blue-700 px-6 py-2 text-center font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-target="crud-modal" data-modal-toggle="crud-modal">+</button>
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
                    <?=$product['productDescription']?>
                </td>
                <td class="py-2">
                    
                    <!-- <a class="btn-update inline-block rounded-lg bg-yellow-700 px-6 py-2 text-center font-medium text-white hover:bg-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800" data-modal-target="edit-modal" data-modal-target="edit-modal" data-modal-toggle="edit-modal" data-update-id="<?= $product['id'] ?>">Edit</a> -->
                    <a
                        class="btn-update inline-block rounded-lg bg-yellow-700 px-6 py-2 text-center font-medium text-white hover:bg-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
                        data-modal-target="edit-modal"
                        data-modal-toggle="edit-modal"
                        data-update-id="<?= $product['id'] ?>"
                        data-product-name="<?= htmlspecialchars($product['productName'], ENT_QUOTES) ?>"
                        data-product-price="<?= $product['productPrice'] ?>"
                        data-product-description="<?= htmlspecialchars($product['productDescription'], ENT_QUOTES) ?>"
                        >
                        Edit
                    </a>
                    <button class="btn-delete inline-block rounded-lg bg-red-700 px-6 py-2 text-center font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-modal-target="update-modal" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-delete-id="<?= $product['id'] ?>">Delete</button>
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
                            <option value="TV">Iphone</option>
                            <option value="PC">Samsung</option>
                            <option value="GA">Oppo</option>
                            <option value="PH">Vivo</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                        <textarea id="description" name="producrtDescription" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>                    
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



















<script>
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
</script>

</body>
</html>