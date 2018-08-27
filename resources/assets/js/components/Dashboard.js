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
				periodAvailable: false,
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

		getPeriodAccess() {
			axios.get('/periodoConfirm')
			.then((response) => {
				console.log(response.data)
				if(response.data.periodos > 0){
					this.setState({
						periodAvailable: true,
					})
				}
				this.setState({
					periodAvailable: false,
				})
			})
			
		}
		componentWillMount () {
			// loading teachers lists
			this.getPeriodAccess()
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
         			{ this.state.period ? 
         				<div>
         						<div className="row">
	         				<div className="col-md-6">
	         						<CreateNewAssignment />
	         				</div>
	         				<div className="col-md-6">
	         					<AllTeachersListing />
	         				</div>
	         			</div>
	         			<br/>
	         			<div className="row">
	         				<div className="col-md-12">
	         					<SinodaliasTable />
	         				</div>
	         			</div>
         				</div>
	         			:
	         			<div>
					        <br/><br/>
					        <div>
					        <div style={{width:800, fontSize:40, marginLeft:300}} className="alert alert-success" role="alert">
					            Aún no has agregado ningún periodo
					            </div>
					        </div>
					        <p className="text-center">
					        Agregar un nuevo periodo en el botón 
					        <span style={{color:'blue'}}> Periodos</span></p>
								</div>

         			}

            </div>
        );
    }
}

export default Index