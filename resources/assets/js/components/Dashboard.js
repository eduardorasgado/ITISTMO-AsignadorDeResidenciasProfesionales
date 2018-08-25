import React, { Component } from 'react'
import CreateNewAssignment from './CreateNewAssignment'
import SinodaliasTable from './SinodaliasTable'
import AllTeachersListing from './AllTeachersListing'

import axios from 'axios'

class Index extends Component {
		constructor(props){
			super(props)
			this.state = {
				teachers: [],
			}
			// bindings
			this.totalTeachers = this.totalTeachers.bind(this)
		}

		getTeachersData() {
		axios.get('/teachers')
		.then((response) => {
					console.log("done")
					this.setState({
						teachers: [...response.data.teachers],
					})
				}
			)
		}
		componentWillMount () {
			// loading teachers lists
			this.getTeachersData()
		}
		totalTeachers() {
			let total = this.state.teachers.length
			return total
		}
    render() {
        return (
            <div className="container-fluid">
            <br/>
            <hr/>
            	<p>Total de integrantes de la academia: { this.totalTeachers() }</p>
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