import React, {useState, useEffect} from 'react'
import '../App.css';

function Home() {
    useEffect(() =>{
        fetchNews();
    },[]);

    const [items, setItems] = useState([]);

    const fetchNews = async () => {
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        const data = await fetch("http://localhost:50/eltiempokids/post");

        const items = await data.json();
        console.log(items);

        setItems(items);
    }
  return (
    <div className="container">
        <div className="news-header">
            <h1>See what's new for you</h1>
        </div>
        <div className="news-content">        
            {
                items.map((item, index) =>(
                    <div key={index} className="news-post">
                        <img src={"http://localhost:50"+item.field_image}></img>                    
                        <h2>{item.post_title}</h2>                        
                        <h4>by {item.field_author}</h4>
                        <p>{item.field_content}</p>
                        <h3>Published at {item.field_date} // Category: {item.field_tags}</h3>                       
                    </div>
                ))
            }
        
        </div>
    </div>
  );
}

export default Home;