import {useState, useEffect, useRef, Ref} from 'react'
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
  const [showResults, setShowResults] = useState(true);
  const wrapperRef = useRef(null);
  
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
    searchResults.length && showResults ? <div className='block header-search-result mt-40'>
        <ul>
          {searchResults.map((searchResult: SearchResult) => (
            <a href={`${BASE_URL}/question/${searchResult.id}`} key={searchResult.id}>
              <li className='px-5'>{searchResult.title}</li>
            </a>
          ))}
        </ul>
    </div> : null
  );

  function useOutsideAlerter(ref) {
    useEffect(() => {
      // Alert if clicked on outside of element
      function handleClickOutside(event) {
        if (ref.current && !ref.current.contains(event.target)) {
          setShowResults(false);
        } else {
          setShowResults(true);
        }
      }

      // Bind the event listener
      document.addEventListener("mousedown", handleClickOutside);

      return () => {
        // Unbind the event listener on clean up
        document.removeEventListener("mousedown", handleClickOutside);
      };
    }, [ref]);
  }

  useOutsideAlerter(wrapperRef);

  useEffect(() => {
      FetchQuestionByTitle().then(res => setSearchResults(res ? res.data : []));
  }, [searchValue]);

  return (
    <div ref={wrapperRef} className="d-flex flex-fill">
      <input className='flex-fill' type="text" value={searchValue} onChange={value => setSearchValue(value.target.value)}></input>
      <SearchBarResults />
    </div>
  )
}

ReactDOM.render(<HeaderSearchbar />, document.getElementById('headerSearchbar'));
