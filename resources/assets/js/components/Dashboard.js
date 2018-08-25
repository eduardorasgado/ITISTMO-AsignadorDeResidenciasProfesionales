import React, { Component } from 'react'
import CreateNewAssigment from './CreateNewAssigment'
import SinodaliasTable from './SinodaliasTable'
import AllTeachersListing from './AllTeachersListing'

class Index extends Component {
    render() {
        return (
            <div className="container-fluid">
         			<CreateNewAssigment />
         			<SinodaliasTable />
         			<AllTeachersListing />
            </div>
        );
    }
}

export default Index