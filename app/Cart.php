<?php

namespace App;

class Cart
{
	public $items = null; //đây là 1 mảng chứa các iteam theo id
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id){
		$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item];
		//kiểm tra tồn tại sản phẩm trong giỏ chưa
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$oldQty = $giohang['qty'];
		$qty = 1;
		$giohang['qty'] = $giohang['qty'] + $qty;
		if($giohang['qty']>20){
			$giohang['qty']=20;
			$qty = 0;
		}
		$giohang['price'] = $item->promotion_price * $giohang['qty'];

		$this->items[$id] = $giohang; // bằng 1 mảng $giohang
		$this->totalQty++;
		$this->totalPrice += $item->promotion_price * $qty;
		
		
	}
	public function addInDetail($item, $id, $qty){
		$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$oldQty = $giohang['qty'];
		$giohang['qty'] = $giohang['qty'] + $qty;
		if($giohang['qty']>20){
			$giohang['qty']=20;
			$qty = 20-$oldQty;
		}
		$giohang['price'] = $item->promotion_price * $giohang['qty'];
		
		$this->items[$id] = $giohang; 
		$this->totalQty++;	
		$this->totalPrice += $item->promotion_price * $qty;
		
	}
	public function update($item, $id, $qty)
	{
		if($qty > 20){
			$qty = 20;
		}
		$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}

		$oldQty = $giohang['qty']; //tạo 1 biến lưu giá trị Qty cũ
		$giohang['qty'] =  $qty; // Qty mới mà mình thay đổi
		$giohang['price'] = $item->promotion_price * $giohang['qty'];
		
		$this->items[$id] = $giohang;
		$this->totalQty += $qty-$oldQty; //?

		$oldPrice = $oldQty*$item->promotion_price;
		$newPrice = $giohang['qty']*$item->promotion_price;
		$this->totalPrice += $newPrice-$oldPrice;
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}

	}
	
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
