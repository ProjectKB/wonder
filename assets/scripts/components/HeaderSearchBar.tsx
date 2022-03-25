import {useState, useEffect} from 'react'
import ReactDOM from 'react-dom'
import axios from '../../../node_modules/axios/index';

type SearchResult = {
  title: string;
  id: number;
};

const HeaderSearchbar = () => {
  const BASE_URL = window.location.origin
  const [searchValue, setSearchValue] = useState("");
  const [searchResults, setSearchResults] = useState([]);

  const FetchQuestionByTitle = async () => {
    try {
      return await axios.post(
        `${BASE_URL}/search/questions`,
        JSON.stringify(searchValue),
      );
    } catch (error) {
      return false;
    }
  };

  const SearchBarResults = () => (
    searchResults.length ? <div className='block header-search-result mt-40'>
        <ul>
          {searchResults.map((searchResult: SearchResult) => (
            <a href={`${BASE_URL}/question/${searchResult.id}`} key={searchResult.id}>
              <li className='px-5'>{searchResult.title}</li>
            </a>
          ))}
        </ul>
    </div> : null
  );

  useEffect(() => {
      FetchQuestionByTitle().then(res => setSearchResults(res ? res.data : []));
  }, [searchValue]);

  return (
    <div className="d-flex flex-fill">
      <input className='flex-fill' type="text" value={searchValue} onChange={value => setSearchValue(value.target.value)}></input>
      <SearchBarResults />
    </div>
  )
}

ReactDOM.render(<HeaderSearchbar />, document.getElementById('headerSearchbar'));
