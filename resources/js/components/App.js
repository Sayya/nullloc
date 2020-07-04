import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Link } from 'react-router-dom';
import axios from 'axios';

export default class Card extends Component {
  constructor(props) {
    super(props);
    this.state = {
      date: new Date(),
    }
  }

  componentDidMount() {
    axios
      .get('/api/home/json')
      .then((response) => { console.log(response.data) })
      .catch(() => { console.log('通信失敗') });
    //fetch('/api/home/json')
    //  .then(response => { return response.json() })
    //  .then(promise => console.log(promise));
    this.timerID = setInterval(
      () => this.tick(),
      1000
    );
  }

  componentWillUnmount() {
    clearInterval(this.timerID);
  }

  tick() {
    this.setState({
      date: new Date()
    });
  }

  render() {
    return (
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-md-8">
            <div className="card">
              <div className="card-header">Dashboard</div>
              <div className="card-body">
                <div className="alert alert-success" role="alert">
                  session.status
                </div>
                You are logged in!
              </div>
            </div>
            <div className="card">
              <div className="card-header">{this.props.header}</div>
              <div className="card-body">
                I'm {this.props.name}!<br/>
                {this.state.date.toLocaleTimeString()}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

const App = () => (
  <BrowserRouter>
    <div>
      <Header />
      <Route exact path="/home" component={Home} />
      <Route path="/home/memo" component={Memo} />
      <Route path="/home/profile" component={Profile} />
    </div>
  </BrowserRouter>
);

const Header = () => (
  <div>
    <p>Header</p>
    <ul>
      <li><Link to="/home">Home</Link></li>
      <li><Link to="/home/memo">Memo</Link></li>
      <li><Link to="/home/profile">Profile</Link></li>
    </ul>
  </div>
)

const Home = () => (
  <Card header="Home" name="Hero" />
)

const Memo = () => (
  <Card header="Memo" name="Writer" />
)

const Profile = () => (
  <Card header="Profile" name="Smith" />
)

if (document.getElementById('example')) {
  // ReactDOM.render(<Example />, document.getElementById('example'));
  ReactDOM.render(<App />, document.getElementById('example'));
}
