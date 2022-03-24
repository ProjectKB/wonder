import {useState, useEffect} from 'react'
import ReactDOM from 'react-dom'

const HeaderSearchbar = () => {
    const [searchValue, setSearchValue] = useState("");

    useEffect(() => {
        console.log(searchValue);
    });

    return <input type="text" value={searchValue} onChange={value => setSearchValue(value.target.value)}></input>;
}

ReactDOM.render(<HeaderSearchbar />, document.getElementById('headerSearchbar'));
