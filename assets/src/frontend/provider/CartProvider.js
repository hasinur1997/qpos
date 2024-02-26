import {useState} from 'react';
import CartContext from "frontend/context/CartContext";

/**
 * Cart Provider
 * 
 * @param {Component} param0 
 * 
 * @returns CartContext.Provider
 */
function CartProvider({children}) {
    /**
     * Store Cart Items
     */
    const [cartItems, setCartItems] = useState([]);

    /**
     * Add product to cart
     * 
     * @param {Object} item 
     */
    const addItem = (item) => {
        if ( isProductExistOnCart(item.id) ) {
            updateItemQuantity(item.id);
            return;
        }

        const cartData = {
            product: item,
            quantity: 1,
            get lineTotal() {
                return this.product.price * this.quantity
            },
            set lineTotal(value) {
                return this.product.price * this.quantity
            }
        };
        // console.log(cartData);
        setCartItems([...cartItems, cartData])
    }

    const increaseLineItem = (productId) => {
        updateItemQuantity(productId);
    }

    const decreaseLineItem = (productId) => {
        const index = cartItems.findIndex(item => item.product.id == productId);
        if ( index == -1 ) {
            return;
        }

        const newItems = [...cartItems];
        if ( newItems[index].quantity < 2 ) {
            return;
        }

        newItems[index].quantity--;
        newItems[index].lineTotal = newItems[index].product.price * newItems[index].quantity;
        setCartItems(newItems)
    }

    /**
     * Remove product from cart
     * 
     * @param {integer} index 
     */
    const removeItem = (index) => {
        const newCartItems = [...cartItems];
        newCartItems.splice(index, 1);

        setCartItems(newCartItems)
    }

    const clearCart = () => {
        console.log('Clear Items');
    }

    const subtotal = cartItems.reduce((total, item) => total + item.lineTotal, 0);

    const isProductExistOnCart = (productId) => cartItems.some(item => item.product.id == productId)

    const updateItemQuantity = ( productId, quantity = 1 ) => {
        const index = cartItems.findIndex(item => item.product.id == productId);
        if ( index == -1 ) {
            return;
        }

        const newItems = [...cartItems];
        newItems[index].quantity++;
        newItems[index].lineTotal = newItems[index].product.price * newItems[index].quantity;
        setCartItems(newItems)
    }

    return (
        <CartContext.Provider 
            value={{
                cartItems, 
                subtotal,
                setCartItems, 
                addItem, 
                removeItem, 
                clearCart,
                increaseLineItem,
                decreaseLineItem,
            }}
        >
            {children}
        </CartContext.Provider>
    );
}

export default CartProvider;