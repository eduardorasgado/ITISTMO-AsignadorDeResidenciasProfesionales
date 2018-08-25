import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Dashboard from './Dashboard';

if (document.getElementById('Index')) {
    ReactDOM.render(<Dashboard />, document.getElementById('Index'));
}
