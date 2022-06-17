<style>
    td,
    th {
        text-align: left;
        padding-right: 2em;
    }
</style>
Warung AW <br>
Jl. TInalan 1 No.43 <br>
<table>
    <?php
    $sum_total = 0;
    foreach ($receipt['receipt'] as $key) {
        $sum_total += $key['pricexcount'];
    ?>
        <tbody>
            <tr>
                <td>
                    <p><?= $key['name'] ?></p>
                </td>
                <td>
                    <p><?= $key['count'] ?></p>
                </td>
                <td>
                    <p>Rp <?= $key['price'] ?></p>
                </td>
                <td>
                    <p>Rp <?= $key['pricexcount'] ?></p>
                </td>
            </tr>
        </tbody>
    <?php
    }
    ?>
    <tr>
        <td></td>
    </tr>
    <tr>
        <th>
            Total
        </th>
        <td></td>
        <td></td>
        <td>
            Rp <?= $sum_total ?>
        </td>
    </tr>
    <tr>
        <th>
            Paid
        </th>
        <td></td>
        <td></td>
        <td>
            Rp <?= $receipt['total_paid'][0]['total_paid'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Changes
        </th>
        <td></td>
        <td></td>
        <td>
            Rp <?= $receipt['total_paid'][0]['total_paid'] - $sum_total ?>
        </td>
    </tr>
</table>
<p>Thanks for purchasing</p>
<p>
    <?= date('Y/m/d H:i', strtotime($receipt['total_paid'][0]['created_at'])) ?>
</p>