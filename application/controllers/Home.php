<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_home');
	}

	public function index()
	{
		$total_product = $this->Model_home->total_product();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'home/index/';
		$config['total_rows'] = $total_product;
		$config['per_page'] = 5;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['products']  = $this->Model_home->index($config['per_page'], $from);
		$data['title'] = 'Point of Sales App';
		$this->load->view('main/header', $data);
		$this->load->view('main/index');
		$this->load->view('main/add_product_modal');
		$this->load->view('main/footer');
	}

	public function add_new_product_to_database()
	{
		$product_name = $this->input->post('name');
		$product_price = $this->input->post('price');
		if ($product_name == '' || $product_price == '') {
			echo "<script>alert('Field cannot be empty...!')</script>";
			echo "<script>window.location = '" . base_url('') . "'</script>";
		} else {
			$data = array(
				"name" => $product_name,
				"price" => $product_price
			);
			$this->Model_home->add_product($data);
			echo "<script>window.location = '" . base_url('') . "'</script>";
		}
	}

	public function add_product_to_cart()
	{
		$product_id = htmlspecialchars($this->input->post('product_id'));
		if ($this->session->userdata('cart') !== null) {
			$item_array_id = array_column($this->session->userdata('cart'), "product_id");
			if (in_array($product_id, $item_array_id)) {
				echo "<script>alert('Product is already added in the cart..!')</script>";
				echo "<script>window.location = '" . base_url() . "'</script>";
			} else {
				$count = count($this->session->userdata('cart'));
				$item_array = array(
					'product_id' => $product_id
				);
				$_SESSION['cart'][$count] = $item_array;
				echo "<script>window.location = '" . base_url() . "'</script>";
			}
		} else {
			$item_array = array(
				'product_id' => $product_id
			);
			$_SESSION['cart'][0] = $item_array;
			echo "<script>window.location = '" . base_url() . "'</script>";
		}
	}

	public function cart()
	{
		$data['products']  = $this->Model_home->get_product();
		$data['cart'] = $this->session->userdata('cart');
		$data['title'] = 'Point of Sales App | Checkout';
		$this->load->view('main/header', $data);
		$this->load->view('main/checkout');
		$this->load->view('main/footer');
	}

	public function remove_product_from_cart($id)
	{
		foreach ($this->session->userdata('cart') as $key => $value) {
			if ($value["product_id"] == $id) {
				array_splice($_SESSION['cart'], $key, 1);
				echo "<script>alert('Product has been Removed...!')</script>";
				echo "<script>window.location = '" . base_url('cart') . "'</script>";
			}
		}
	}

	public function add_cart_to_database()
	{
		$products = $this->input->post('data');
		$total_paid = $this->input->post('cash');
		if (!$products) {
			echo "<script>alert('Choose product first...!')</script>";
			echo "<script>window.location = '" . base_url() . "'</script>";
		}
		if (!$total_paid) {
			echo "<script>alert('Field cash is required...!')</script>";
			echo "<script>window.location = '" . base_url('cart') . "'</script>";
		} else {
			$date_rand = str_shuffle(date('Ymd'));
			$receipt_id = str_shuffle($date_rand);
			$product = array();
			$total = 0;
			for ($i = 0; $i < count($products); $i++) {
				$product_total = @$products[$i]['count'] * @$products[$i]['price'];
				$product[$i] = array(
					'receipt_id' => $receipt_id,
					'product_id' => @$products[$i]['product_id'],
					'count' => @$products[$i]['count'],
				);
				$total += $product_total;
			}
			$data = array(
				"receipt_id" => $receipt_id,
				"total_paid" => $total_paid,
				"products" => $product
			);
			if ($total_paid < $total) {
				echo "<script>alert('Need more money...!')</script>";
				echo "<script>window.location = '" . base_url('cart') . "'</script>";
			} else {
				$this->Model_home->add_cart($data);
				unset($_SESSION['cart']);
				echo "<script>window.location = '" . base_url('receipt/') . $receipt_id  . "'</script>";
			}
		}
	}

	public function receipt($receipt_id)
	{
		$data['receipt'] = $this->Model_home->receipt($receipt_id);
		$this->load->view('main/receipt', $data);
	}
}
