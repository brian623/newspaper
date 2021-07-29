import React from 'react'
import './App.css';
import './custom.scss';

import Nav from './compnents/Nav';
import Home from './compnents/Home';
import Ads from './compnents/Ads';
import Edit from './compnents/Edit';
import Create from './compnents/Create';

import {BrowserRouter as Browser, Switch, Route} from 'react-router-dom';

function App() {
  return (
    <Browser>
      <div className="App">
        <Nav/>
        <Switch>
          <Route path="/" exact component={Home} />
          <Route path="/ads" component={Ads} />
        </Switch>        
      </div>
    </Browser>
  );
}

export default App;
