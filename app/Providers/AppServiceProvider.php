<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Cart;
use App\ProductType;
use App\Category;
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
            $loai_sp_nu = ProductType::where('gender',0)->orderBy('gender','desc')->get();
            $loai_sp_nam = ProductType::where('gender',1)->orderBy('gender','desc')->get();
            $category = Category::where('gender',0)->get();
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $count = count($cart->items);
                $view->with(['loai_sp_nu'=>$loai_sp_nu,'category'=>$category,'loai_sp_nam'=>$loai_sp_nam,'counttt'=>$count]);
            }
            else{
                $view->with(['loai_sp_nu'=>$loai_sp_nu,'category'=>$category,'loai_sp_nam'=>$loai_sp_nam]);
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
