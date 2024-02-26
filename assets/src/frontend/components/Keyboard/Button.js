function Button(props) {
    const {text, setData} = props;
    return (
        <button 
            className="keyboard-key"
            onClick={() => setData(text)}
        >
            {text}
        </button>
    );
}

export default Button;