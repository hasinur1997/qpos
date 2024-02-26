import ProductItem from "./ProductItem";
function ProductList() {
    const products = [
        {
            id: 1,
            name: 'Product One',
            price: 20,
        },
        {
            id: 2,
            name: 'Product Two',
            price: 30,
        },
        {
            id: 3,
            name: 'Product Three',
            price: 40,
        },
        {
            id: 4,
            name: 'Product Four',
            price: 50,
        },
        {
            id: 5,
            name: 'Product Five',
            price: 60,
        },
        {
            id: 6,
            name: 'Product Six',
            price: 70,
        },
    ];

    return (
        <>
            <div className="items-wrapper">
                {
                    products.map(element => {
                        return <ProductItem key={element.id} product={element}/>
                    })
                }
            </div>
        </>
    );
}

export default ProductList;