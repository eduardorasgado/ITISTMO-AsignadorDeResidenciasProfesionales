import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import PeriodosDashboard from './PeriodosDashboard';

if (document.getElementById('PeriodosIndex')) {
    ReactDOM.render(<PeriodosDashboard />, document.getElementById('PeriodosIndex'));
}
