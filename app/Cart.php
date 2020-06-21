<?php

namespace App;

class Cart
{
	public $items = array(); //đây là 1 mảng chứa các iteam theo id
	//public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			//$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id){
		$k = -1;
		$max = 0;
		$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item,'color'=>null];
		//kiểm tra tồn tại sản phẩm trong giỏ chưa
		
		foreach ($this->items as $key => $value ) {
			if($value['item']->id==$id && $value['item']->promotion_price == $item->promotion_price && $value['color']==null){
				$giohang = $value;
				$k = $key;
			}
			if($max<$key){
				$max=$key;
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

		//$this->items[$id] = $giohang; // bằng 1 mảng $giohang
		if($k== -1){
			$this->items[$max+1]= $giohang;
			
		}
		else{
			$this->items[$k]= $giohang;

		}
		//$this->totalQty++;
		$this->totalPrice += $item->promotion_price * $qty;
		
		
	}
	public function addInDetail($item, $id, $qty, $color){
		
		$k = -1;
		$max = 0;
		$giohang = ['qty'=>0, 'price' => $item->promotion_price, 'item' => $item,'color'=>$color];
		
		
		foreach ($this->items as $key => $value ) {
			if($value['item']->id==$id && $value['item']->promotion_price == $item->promotion_price && $value['color']==$color){
				$giohang = $value;
				$k = $key;
			}
			if($max<$key){
				$max=$key;
			}
			
		}

			
		$oldQty = $giohang['qty'];
		$giohang['qty'] = $giohang['qty'] + $qty;
		if($giohang['qty']>20){
			$giohang['qty']=20;
			$qty = 20-$oldQty;
		}
		$giohang['price'] = $item->promotion_price * $giohang['qty'];
		
		//$this->items[$id] = $giohang;
		if($k== -1){
			$this->items[$max+1]= $giohang;
		}
		else{
			$this->items[$k]= $giohang;
		}
		
		//$this->totalQty += ($qty-$oldQty);	
		$this->totalPrice += $item->promotion_price * $qty;
		//dd(session('cart'));

		
	}
	public function update($item, $id, $qty)
	{
		$k = -1;
		$max = 0;
		if($qty > 20){
			$qty = 20;
		}
		if($qty < 0 ){
			$qty = 0;
		}
		$giohang = ['qty'=>1, 'price' => $item->promotion_price, 'item' => $item,'color'=>null];
		
		//dd($giohang);
		foreach ($this->items as $key => $value ) {
			if($key==$id && $value['item']->promotion_price == $item->promotion_price ){
				$giohang = $value;
				$k= $key;	
			}
			if($max<$key){
				$max=$key;
			}
			
		}
		
		$oldQty = $giohang['qty'];//tạo 1 biến lưu giá trị Qty cũ
		$giohang['qty'] =  $qty; // Qty mới mà mình thay đổi

		$giohang['price'] = $item->promotion_price * $giohang['qty'];
		
		//$this->items[$id] = $giohang;
		if($k== -1){
			
		}
		else{
			$this->items[$k]= $giohang;
			//$this->totalQty += ($qty-$oldQty); //?

			$oldPrice = $oldQty*$item->promotion_price;
			$newPrice = $giohang['qty']*$item->promotion_price;

			$this->totalPrice += $newPrice-$oldPrice;
		}
		
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}

	}
	
	//xóa nhiều
	public function removeItem($id){
		//$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
