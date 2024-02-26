import useCart from "frontend/hooks/useCart";

function CartItem({item, index}) {
    const {removeItem, increaseLineItem, decreaseLineItem} = useCart();

    return (
        <>
            <tr>
                <td className="name">{item.product.name}</td>
                <td className="qty"><span onClick={() => decreaseLineItem(item.product.id)}>-</span> {item.quantity} <span onClick={() => {increaseLineItem(item.product.id)}}>+</span></td>
                <td className="price">{item.lineTotal}</td>
                <td className="action"><span></span></td>
                <td className="" onClick={() => {removeItem(index)}}>
                    <span className="remove">&#x2717;</span>
                </td>
            </tr>
        </>
    );
}

export default CartItem;