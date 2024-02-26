function SearchBar() {
    return (
        <>
            <div className="search-bar">
                <div className="search-box">
                    <form action="" autoComplete="off">
                        <input type="text" name="search" id="product-search"/>
                        <span className="search-icon"></span>
                        <div className="search-type">
                            <a href="">Product</a>
                            <a href="">Scan</a>
                        </div>
                        <div className="search-result">
                            <div className="no-data-found"></div>
                            <div className="suggession"></div>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
}

export default SearchBar;