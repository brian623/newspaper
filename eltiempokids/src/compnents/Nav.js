import React from 'react'
import { Link } from 'react-router-dom';
import '../App.css';

function Nav() {
  return (
      
    <div className="nav-links">
        <h3>El Tiempo Kids</h3>
        <ul>
            <Link to='/'><li>Home</li></Link>
            <Link to='/ads'><li>Ads</li></Link>
        </ul>
      
    </div>
  );
}

export default Nav;