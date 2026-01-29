<?php
if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
session_start(); // Khởi động phiên làm việc

class Cart {
    private $items = array();

    public function __construct() {
        // Kiểm tra nếu giỏ hàng không tồn tại thì tạo mới
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $this->items = $_SESSION['cart'];
    }

    // Hàm thêm sản phẩm vào giỏ hàng với id, giá, tên và hình ảnh
public function addToCart($id, $price, $name, $image) {
    // Nếu sản phẩm đã tồn tại trong giỏ hàng thì hiển thị thông báo và không thực hiện thêm sản phẩm
    if (isset($this->items[$id])) {
        return false;
    }
    // Nếu sản phẩm chưa tồn tại trong giỏ hàng thì thêm vào với thông tin sản phẩm và số lượng là 1
    else {
        $this->items[$id] = array('price' => $price, 'name' => $name, 'image' => $image, 'quantity' => 1);
        $_SESSION['cart'] = $this->items;
        return true;
    }
}

    // Hàm tính tổng giá trị các sản phẩm trong giỏ hàng
    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // Hàm tính tổng số lượng sản phẩm trong giỏ hàng
public function getTotalQuantity() {
    return count($this->items);
}


    // Hàm tính số lượng các sản phẩm khác nhau trong giỏ hàng
    public function getUniqueItemCount() {
        return count($this->items);
    }
}
?>
