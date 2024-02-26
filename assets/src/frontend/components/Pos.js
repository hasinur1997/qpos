import ProductList from "./Products/ProductList";
import TopPanel from "./ProductTop/TopPanel";
import CartList from "./Cart/CartList";
import CartSummery from "./Cart/CartSummery";
import CartTop from "./Cart/CartTop";

function Pos() {
    return (
        <>
            <div id="qpos-main">
                <div className="content-product">
                    {/* Top Panel */}
                    <TopPanel/>
                    {/* Product Lists */}
                    <ProductList/>
                </div>
                
                <div className="content-cart">
                    {/* Cart Top Panel */}
                    <CartTop/>
                    <div className="cart-panel">
                        {/* Cart List */}
                        <CartList/>

                        {/* Cart Summery */}
                        <CartSummery/>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Pos;

// http://wp-test.test/wepos/#/