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
				periodsList: [],
				periodLoaded: false, 
			}
			// bindings
			this.totalTeachers = this.totalTeachers.bind(this)
			this.lastPeriod = this.lastPeriod.bind(this)
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
			this.setState({
				periodLoaded: false,
			})
			axios.get('/periodoConfirm')
			.then((response) => {
				console.log("la respuesta de periodos", response.data.periodos)
				if(response.data.periodos.length > 0){
					this.setState({
						periodAvailable: true,
						periodsList: [...response.data.periodos],
						periodLoaded: true,
					})
				}
			})
			
		}
		componentWillMount () {
			// loading teachers lists
			this.getPeriodAccess()
			this.getTeachersData()
		}
		totalTeachers() {
			if (this.state.teachers.length > 0) {
				let total = this.state.teachers.length
				return total
			}
			return 'No disponible'
		}

		lastPeriod() {
			if (this.state.periodLoaded) {
				let name = this.state.periodsList[0].name
				console.log("ultimo periodo", name)
				return name
			}
			return 'Cargando...'
		}
    render() {
        return (
            <div className="container-fluid">
            <br/>
            <hr/>
            	<div className="jumbotron" style={{ padding:10, backgroundColor:'#F1F8FF' }}>
            		<div>
            			<p className="font-weight-bold">
	            			Total de integrantes de la academia: { this.totalTeachers() }
	            		</p>
	            	</div>
	            	<div>
	            		<p className="font-weight-bold">
	            			Periodo Actual: {this.lastPeriod()}
	            		</p>
	            	</div>
            	</div>
            	

         			{ this.state.periodAvailable ? 
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