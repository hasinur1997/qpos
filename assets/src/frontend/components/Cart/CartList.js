import CartItem from "./CartItem";
import useCart from "frontend/hooks/useCart";

function CartList() {
    const {cartItems} = useCart();
    return (
        <>
            <div className="cart-content">
                <table className="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        {cartItems.map((item, index) => {
                            return <CartItem key={item.product.id} item={item} index={index}/>
                        })}
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default CartList;