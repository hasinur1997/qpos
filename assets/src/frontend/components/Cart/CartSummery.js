import {useState} from 'react';
import useCart from "frontend/hooks/useCart";
import Keyboard from '../Keyboard';
function CartSummery() {
    const {subtotal} = useCart();
    const [discounts, setDiscounts] = useState([]);
    const [fees, setFees] = useState([]);

    const addDiscount = (amount = 20) => {
        const newDiscount = [...discounts, amount]

        setDiscounts(newDiscount);
    };

    const removeDiscount = (index) => {
        const newDiscount = [...discounts];

        newDiscount.splice(index, 1);

        setDiscounts(newDiscount);
    }

    const addFee = (amount = 10) => {
        const newFees = [...fees, amount]

        setFees(newFees);
    }

    const removeFee = (index) => {
        const newFees = [...fees];
        newFees.splice(index, 1);

        setFees(newFees);
    }

    return (
        <>
            <div className="cart-calculation">
                <div className="discount-popup">
                    <Keyboard/>
                </div>
                <form action="">
                    <table className="cart-total-table">
                        <tbody>
                            <tr className="metadata">
                                <td className="label">Subtotal</td>
                                <td className="price">{subtotal}</td>
                                <td className="action"></td>
                            </tr>
                            {discounts.map( (discount, index) => (
                                <tr className="metadata" key={index}>
                                    <td className="label">
                                        Discount
                                        <span className="name">-${discount}</span>
                                    </td>
                                    <td className="price">{discount}</td>
                                    <td className="action">
                                        <span className="remove" onClick={() => removeDiscount(index)}>&#x2717;</span>
                                    </td>
                                </tr>
                            ))}

                            {fees.map((fee, index) => (
                                <tr className="metadata" key={index}>
                                    <td className="label">Fee
                                        <span className="name">+${fee}</span>
                                    </td>
                                    <td className="price">{fee}</td>
                                    <td className="action"><span className="remove" onClick={() => removeFee(index)}>&#x2717;</span></td>
                                </tr>
                            ))}

                            <tr className="cart-action">
                                <td colSpan="3">
                                    <a onClick={(e) => addDiscount()}>Add Discount</a>
                                    <a onClick={(e) => addFee()}>Add Fee</a>
                                    <a >Add Note</a>
                                </td>
                            </tr>
                            <tr className="pay-now">
                                <td>Pay Now</td>
                                <td className="amount">30</td>
                                <td className="icon">
                                    <span className="flat-icon">X</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </>
    )
}

export default CartSummery;