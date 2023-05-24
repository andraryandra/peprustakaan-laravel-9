@extends('user.anggota.layouts.main')

@section('container')
<section class="woocommerce single page-wrapper">
    <div class="container">
        <div class="row">
            <div class="p-2 container card mb-5" style="width: 100%;">
                {{-- <div class="col-12 text-end">
                    <div class="mt-2 text-end">
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"class="btn btn-primary fw-bold rounded-pill px-2 shadow btn-sm">Tambah +</a>
                    </div>
                    <br>
                </div> --}}
                <div class="col-lg-12 col-xl-12">
                    <div class="woocommerce-cart">
                        <div class="woocommerce-notices-wrapper"></div>
                        <form class="woocommerce-cart-form" action="" method="">
                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">thumbnail</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                    <td class="product-remove">
                                        <a href="#" class="remove" aria-label="Remove this item" data-product_id="30" data-product_sku="">×</a>						</td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img width="324" height="324" src="assets/images/shop/course-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></a>
                                    </td>

                                    <td class="product-name" data-title="Product">
                                        <a href="#">Trendy Cloth</a>
                                    </td>

                                    <td class="product-price" data-title="Price">
                                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>90.00</span>
                                    </td>

                                    <td class="product-quantity" data-title="Quantity">
                                        <div class="quantity">
                                            <label class="screen-reader-text" for="quantity_5cc58182489a8">Quantity</label>
                                            <input type="number" id=" " class="input-text qty text" step="1" min="0" max="" name="cart[34173cb38f07f89ddbebc2ac9128303f][qty]" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Sunglasses quantity">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Total">
                                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>90.00</span>
                                    </td>
                                </tr>
                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                    <td class="product-remove">
                                        <a href="#" class="remove" aria-label="Remove this item" data-product_id="30" data-product_sku="">×</a>						</td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img width="324" height="324" src="assets/images/shop/course-5.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></a>
                                    </td>

                                    <td class="product-name" data-title="Product">
                                        <a href="#">Sunglasses</a>
                                    </td>

                                    <td class="product-price" data-title="Price">
                                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>90.00</span>
                                    </td>

                                    <td class="product-quantity" data-title="Quantity">
                                        <div class="quantity">
                                            <label class="screen-reader-text" for="quantity_5cc58182489a8">Quantity</label>
                                            <input type="number" id="quantity_5cc58182489a8" class="input-text qty text" step="1" min="0" max="" name="cart[34173cb38f07f89ddbebc2ac9128303f][qty]" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Sunglasses quantity">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Total">
                                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>90.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="actions">
                                        <div class="coupon">
                                            <label for="coupon_code">Coupon:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code"> <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                        </div>
                                        <button type="submit" class="button" name="update_cart" value="Update cart" disabled="">Update cart</button>
                                        <input type="hidden" id="woocommerce-cart-nonce" name="woocommerce-cart-nonce" value="27da9ce3e8"><input type="hidden" name="_wp_http_referer" value="/cart/">				</td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
