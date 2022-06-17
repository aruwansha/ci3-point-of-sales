<div class="card-header py-3">
    <a data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm text-white">
        Add Product
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach ($products as $product) {
    ?>
        <div class="container">
            <tbody>
                <tr>
                    <td>
                        <p class="my-3"><?= $product['name'] ?></p>
                    </td>
                    <td>
                        <p class="my-3">Rp <?= $product['price'] ?></p>
                    </td>
                    <td>
                        <form action="<?= base_url('cart/add') ?>" method="post">
                            <input type='hidden' name='product_id' value='<?= $product['id'] ?>'>
                            <button type="submit" class="btn btn-warning my-3 text-white" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </div>
    <?php
    }
    ?>
</table>
<div class="container">
    <?php
    echo $this->pagination->create_links();
    ?>
</div>