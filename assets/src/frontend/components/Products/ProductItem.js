import {useContext} from 'react';
import useCart from 'frontend/hooks/useCart';

function ProductItem({product}) {
    const {addItem} = useCart();
    return (
        <>
            <div className="item">
                <div className="item-overlay" onClick={() => addItem(product)}>
                    <span className="add-to-cart">&#x2B;</span>
                </div>
                <div className="item-wrap">
                    <div className="img">
                        <img src="http://wp-test.test/wp-content/uploads/2024/02/T_2_front-1-450x450.jpg" alt="" />
                    </div>
                    <div className="title">{product.name}</div>
                </div>
            </div>
        </>
    );
}

export default ProductItem;