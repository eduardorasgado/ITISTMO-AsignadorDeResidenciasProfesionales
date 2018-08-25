import React, { Component } from 'react'
import CreateNewAssigment from './CreateNewAssigment'
import SinodaliasTable from './SinodaliasTable'
import AllTeachersListing from './AllTeachersListing'

class Index extends Component {
    render() {
        return (
            <div className="container-fluid">
            <br/>
            <hr/>
         			<div className="row">

         				<div className="col-md-2 jumbotron">
         					<AllTeachersListing />
         				</div>
         				
         				<div className="col-md-6">
         						<CreateNewAssigment />
         						<SinodaliasTable />
         				</div>
         			</div>

            </div>
        );
    }
}

export default Index