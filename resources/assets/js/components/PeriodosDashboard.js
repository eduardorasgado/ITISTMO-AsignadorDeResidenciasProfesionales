import React, { Component } from 'react'
import axios from 'axios'

class PeriodosDashboard extends Component {
	constructor(props){
		super(props)
		this.state = {
			periods: [],
			periodLoaded: false,
		}

		this.getPeriodState = this.getPeriodState.bind(this)
		this.closePeriod = this.closePeriod.bind(this)
	}

	componentWillMount() {
		this.getPeriodos()
	}

	componentDidMount() {
		this.tableUpdate = setInterval(() => this.getPeriodos(), 5000)
	}

	componentWillUnmount() {
		clearInterval(this.tableUpdate)
	}

	getPeriodos() {
		this.setState({
				periodLoaded: false,
			})
			axios.get('/periodoConfirm')
			.then((response) => {
				console.log("la respuesta de periodos", response.data.periodos)
				if(response.data.periodos.length > 0){
					this.setState({
						periods: [...response.data.periodos.reverse()],
						periodLoaded: true,
					})
				}
			})
	}

	getPeriodState(estado) {
		if (estado) {
			return 'Activo'
		}
		// estado 0 ->cerrado
		return 'Cerrado'
	}

	closePeriod(id) {
		var closeConfirm = confirm("Estás a punto de cerrar un periodo, estás seguro/a?")
		if (closeConfirm) {
			// return alert("CERRADO")
			axios.post('/closePeriodo',{
				id: id,
			})
			.then((response) => {
				console.log(response.data)
			})
		}
	}

	actuallity(periodID) {
		if (this.state.periods[0].id == periodID) {
			return '(Actual)'
		}
		return
	}

	render(){
		return(
				<div>
					{ this.state.periods.length > 0 ?
						<table className="table">
						<thead className="thead-dark">
					    <tr>
					      <th scope="col">Periodo</th>
					      <th scope="col">estado</th>
					      <th scope="col">Cerrar Periodo</th>
					     </tr>
					  </thead>
					  <tbody>
					  	{ this.state.periods.map(period => (
					  			<tr key={period.id}>
							      <th scope="row">{period.name}{this.actuallity(period.id)}</th>
							      <td>{this.getPeriodState(period.estado)}</td>
							      <td><button className="btn btn-danger" 
							      			onClick={() => this.closePeriod(period.id)}>
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