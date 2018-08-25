import React, { Component } from 'react'
import axios from 'axios';

class SinodaliasTable extends Component {
	constructor(props) {
		super(props)
		this.state = {
			sinodalias: [],
		}
	}

	// traer las sinodalias
		componentWillMount () {
			this.getSinodaliasData()
		}

		getSinodaliasData() {
			axios.get('/sinodalias')
			.then((response) => {
				console.log(response)
				this.setState({
					sinodalias: [...this.state.sinodalias,...response.data.sinodalias],
				})
			})
		}

	render() {
		return (
				<div>
					<div>
						<h2 className="text-center">Lista de Sinodalías creadas</h2>
						<br/>
					</div>
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
					      <th scope="col">Aprobar</th>
					    </tr>
					  </thead>
					  <tbody>
					  	{ this.state.sinodalias.map(sinodalia => (
					  			<tr>
							      <th scope="row">{sinodalia.residente}</th>
							      <td>{sinodalia.proyecto}</td>
							      <td>{sinodalia.carrera}</td>
							      <td>@mdo</td>
							    </tr>
					  		)) }
					    <tr>
					      <th scope="row">1</th>
					      <td>Mark</td>
					      <td>Otto</td>
					      <td>@mdo</td>
					    </tr>
					    <tr>
					      <th scope="row">2</th>
					      <td>Jacob</td>
					      <td>Thornton</td>
					      <td>@fat</td>
					    </tr>
					    <tr>
					      <th scope="row">3</th>
					      <td>Larry</td>
					      <td>the Bird</td>
					      <td>@twitter</td>
					    </tr>
					  </tbody>
					</table>
				</div>
			)
	}
}

export default SinodaliasTable