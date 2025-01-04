

<?php
require('../../connection.php');
if(isset($_POST['btn_add'])){
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $productDescription = $_POST['productDescription'];
    $productQuatity = $_POST['productQuatity'];
    $sql = "INSERT INTO products (productName, productPrice, productCategory, productDescription, productQty) VALUES ('$productName', '$productPrice', '$productCategory', '$productDescription', '$productQuatity')";
    $exe = mysqli_query($conn, $sql);
    if($exe){
        echo "
        <script>
        alert('Product added successfully');
        </script>
        ";
    }
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if ($op == 'update') {
    echo "<script>alert('Hello');</script>";
}


if (isset($_POST['btn']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $productDescription = $_POST['productDescription'];

    $query = "UPDATE products SET productName='$productName', productPrice='$productPrice', productCategory='$productCategory', productDescription='$productDescription' WHERE id='$id'";
    $exe = mysqli_query($conn, $query);

    if ($exe) {
        echo "<script>alert('Product updated successfully'); window.location.href = 'products.php';</script>";
    } else {
        echo "<script>alert('Failed to update product');</script>";
    }
}


?>
<main class="px-6">
<div class="relative overflow-x-auto">
    <h2 class="text-center text-gray-800 dark:text-white font-bold py-3">Products Lsit</h2>
    <div class="py-3 pl-3">
        <button type="button" href="?tag=add&id=<?=$product['id']?>" class="inline-block rounded-lg bg-blue-700 px-6 py-2 text-center font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-target="crud-modal" data-modal-toggle="crud-modal" >+</button>
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


<!-- Update Modal -->




<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Upadte Product
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post">
            <input type="hidden" name="productId" id="productId">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="productName" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" name="productPrice" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999">
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
                <button name="btn" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new product
                </button>
            </form>
        </div>
    </div>
</div> 


<script>
        $(document).ready(function(){
            $('.btn-update').click(function(){
              const updateId = $(this).attr('data-update-id');
              $("#update-id").val(updateId);
            });
        });
      </script>


<!-- Delete Modal -->


<button id="modal_delete" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
Toggle modal
</button>

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




// Add id to update modal 
// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.btn-update').forEach(function(button) {
//         button.addEventListener('click', function() {
//             const updateId = this.getAttribute('data-remove-id');
//             document.getElementById('update-id').value = updateId;
//         });
//     });
// });




// del product
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



// Up
document.querySelectorAll('.btn-update').forEach(button => {
   button.addEventListener('click', event => {
      // Get product data from the button's data attributes
      const productId = button.getAttribute('data-update-id');
      const productName = button.getAttribute('data-product-name');
      const productPrice = button.getAttribute('data-product-price');
      const productDescription = button.getAttribute('data-product-description');

      // Populate the modal form fields
      document.querySelector('#edit-modal input[name="productName"]').value = productName;
      document.querySelector('#edit-modal input[name="productPrice"]').value = productPrice;
      document.querySelector('#edit-modal textarea[name="producrtDescription"]').value = productDescription;

      // Optionally, you can store the product ID in a hidden field
      document.querySelector('#edit-modal input[name="productId"]').value = productId;
   });
});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>