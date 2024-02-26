import {useContext} from 'react';
import CartContext from 'frontend/context/CartContext';

function useCart() {
    return useContext(CartContext);
}

export default useCart;