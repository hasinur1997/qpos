import useCart from "frontend/hooks/useCart";
function CartTop() {
    return (
        <>
        <div onClick={() => {}}>Clear Cart</div>
        <div className="top-panel">
            <div className="customer-search-box">
                <form action="" autoComplete="off">
                    <input type="text" name="customer-search" id="customer-search"/>
                    <span className="add-new-customer"></span>
                    <div className="search-result"></div>
                </form>
            </div>
            <div className="action">
                <span className="more-options">&#8286;</span>
            </div>
        </div>
        </>
    );
}

export default CartTop;