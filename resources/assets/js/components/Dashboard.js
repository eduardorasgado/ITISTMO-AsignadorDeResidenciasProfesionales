import React, { Component } from 'react'
import CreateNewAssignment from './CreateNewAssignment'
import SinodaliasTable from './SinodaliasTable'
import AllTeachersListing from './AllTeachersListing'

class Index extends Component {
    render() {
        return (
            <div className="container-fluid">
            <br/>
            <hr/>
         			<div className="row">
         				<div className="col-md-6">
         						<CreateNewAssignment />
         				</div>
         				<div className="col-md-6">
         					Hola
         				</div>
         			</div>
         			<br/>
         			<div className="row">
         				<div className="col-md-12">
         					<SinodaliasTable />
         				</div>
         			</div>
            </div>
        );
    }
}

export default Index