<form action="<?= base_url('cart/submit') ?> " method="post">
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="my-3">
                    <h4>My Cart</h4>
                    <?php
                    global $total;
                    global $data;

                    if ($cart !== null) {
                        foreach ($products as $product) {

                            for ($i = 0; $i < count($cart); $i++) {
                                if ($product['id'] == $cart[$i]['product_id']) {
                    ?>
                                    <div class="border rounded">
                                        <div class="row bg-white">
                                            <div class="col-md-6">
                                                <h5 class="pt-2"><?= $product['name'] ?></h5>
                                                <h5 class="pt-2">Rp <?= $product['price']; ?></h5>
                                                <a class="btn btn-danger" href="<?= base_url('cart/remove/') . $product['id'] ?>">Remove</a>
                                            </div>
                                            <div class="col-md-3 py-5">
                                                <h6 class="pt-2">Count</h6>
                                                <input type="text" name="data[<?= $i ?>][count]" value="1" class="form-control d-inline">
                                                <input type="hidden" name="data[<?= $i ?>][price]" value="<?= $product['price']; ?>" />
                                                <input type="hidden" name="data[<?= $i ?>][product_id]" value="<?= $product['id']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>

                    <?php
                    } else {
                    ?>
                        kosong

                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                <div class="pt-4">
                    <h6>Submit Cart</h6>
                    <hr>
                    <h6 class="pt-2">Cash</h6>
                    <input type="number" name="cash" class="form-control d-inline mb-2">
                    <button type="submit" class="btn btn-success" name="checkout">Submit</button>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>