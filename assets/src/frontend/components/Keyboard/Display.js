function Display(props) {
    const {value, setData} = props;

    return (
        <>
            <form action="">
                <input 
                    type="text" 
                    className="display"
                    value={value} 
                    onChange={(e) => setData(e.target.value)} 
                />
            </form>
        </>
    );
}

export default Display;