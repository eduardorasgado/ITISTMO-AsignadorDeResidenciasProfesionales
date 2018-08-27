import React, { Component } from 'react'

class PeriodosDashboard extends Component {
	constructor(props){
		super(props)
		this.state = {
			periods: [],
		}
	}

	componentWillMount() {

	}
	render(){
		return(
				<div>
					{ this.state.periods.length > 0 ?
						<table className="table">
						<thead className="thead-dark">
					    <tr>
					      <th scope="col">Residente</th>
					      <th scope="col">Proyecto</th>
					      <th scope="col">Carrera</th>
					      <th scope="col">N.de Control</th>
					      <th scope="col">Presidente</th>
					      <th scope="col">Secretario</th>
					      <th scope="col">Vocal</th>
					      <th scope="col">Vocal Suplente</th>
					      <th scope="col">Aprobación Final</th>
					    </tr>
					  </thead>
					  <tbody>
					  	{ this.state.periods.map(period => (
					  			<tr key={period.id}>
							      <th scope="row">{period.name}</th>
							      <td><button className="btn btn-danger" 
							      			onClick="">
							      			Terminar</button>
							      </td>
							    </tr>
					  		)) 
					  	}
					  </tbody>
					</table>
					 :
		  			<div className="alert alert-danger" role="alert" style={{ marginRight:15 }}>
				  		Aún no has agregado ningún periodo.
						</div>			  	
					}
				</div>
			)
	}
}

export default PeriodosDashboard