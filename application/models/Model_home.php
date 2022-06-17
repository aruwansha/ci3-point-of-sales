<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_home extends CI_Model
{
    function index($number, $offset)
    {
        return $this->db->get('product', $number, $offset)->result_array();;
    }

    function get_product()
    {
        return $this->db->get('product')->result_array();;
    }

    function add_product($data)
    {
        $this->db->insert('product', $data);
    }

    function total_product()
    {
        return $this->db->get('product')->num_rows();
    }


    function add_cart($data)
    {
        $this->db->insert('receipt', array("receipt_id" => $data['receipt_id'], "total_paid" => $data['total_paid']));
        $this->db->insert_batch('receipt_detail', $data['products']);
    }

    function receipt($data)
    {
        $get_receipt = $this->db->query(
            "SELECT receipt.receipt_id, product.name, 
                    receipt_detail.count, product.price, (receipt_detail.count*product.price) AS 'pricexcount'
                FROM receipt_detail
                    LEFT JOIN receipt ON receipt_detail.receipt_id=receipt.receipt_id
                    INNER JOIN product ON receipt_detail.product_id=product.id 
             WHERE receipt.receipt_id='$data'"
        )->result_array();
        $this->db->select('total_paid, created_at');
        $get_total_paid = $this->db->get_where('receipt', array("receipt_id" => $data))->result_array();
        return array("receipt" => $get_receipt, "total_paid" => $get_total_paid);
    }
}
