<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Cart;
use App\ProductType;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('page.giohang',function($view)
        {
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }      
        });
        view()->composer('header',function($view)
        {
            $loai_sp = ProductType::orderBy('description','desc')->get();
           
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $count = count($cart->items);
                $view->with(['loai_sp'=>$loai_sp,'counttt'=>$count]);
            }
            else{
                $view->with('loai_sp',$loai_sp);
            }

            
        });
        view()->composer('page.thanhtoan',function($view)
        {
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }     
        });
    }
}
