import Display from "./Display";
import Button from "./Button";
import { useState } from "react";

function Keyboard() {
    const [value, setValue] = useState('');
    const buttons = [
        {
            key: '1',
            value: 1,
        },
        {
            key: '2',
            value: 2,
        },
        {
            key: '3',
            value: 3,
        },
        {
            key: '4',
            value: 4,
        },
        {
            key: '5',
            value: 5,
        },
        {
            key: '6',
            value: 6,
        },
        {
            key: '7',
            value: 7,
        },
        {
            key: '8',
            value: 8,
        },
        {
            key: '9',
            value: 9,
        },
        {
            key: 'x',
            value: 'x',
        },
        {
            key: '0',
            value: 0,
        },
        {
            key: '.',
            value: '.',
        },
    ];

    const setData = (data) => {
        let newValue = value;

        if ( 'x' == data ) {
            newValue = newValue.slice(0, -1);
        } else {
            newValue += data;
        }

        setValue(newValue);
    }

    return (
        <>
            <div className="keyboard-wrapper">
                <div className="display">
                    <Display 
                        value={value}
                        setData={setData}
                    />
                </div>
                <div className="keys">
                    {buttons.map((item, index) => (
                        <Button 
                            text={item.value} 
                            key={index}
                            setData={setData}
                        />                    
                    ))}
                </div>
            </div>
        </>
    );
}

export default Keyboard;