import React, { Component } from 'react'
import axios from 'axios';

class SinodaliasTable extends Component {
	constructor(props) {
		super(props)
		this.state = {
			sinodalias: [],
			teachers: [],
		}

		// bindings
		this.compareTeaching = this.compareTeaching.bind(this)
		this.getSinodaliasData = this.getSinodaliasData.bind(this)
		this.linked = this.linked.bind(this)
	}

	// traer las sinodalias
		componentWillMount () {
			this.getSinodaliasData()
			this.getTeachersData()
		}

		componentDidMount() {
			// actualizar cada 10 segundos
			this.interval = setInterval(() => this.getSinodaliasData(), 10000)
		}

		componentWillUnmount() {
			// limpiar el montaje
			clearInterval(this.interval)
		}

		getSinodaliasData() {
			axios.get('/sinodalias')
			.then((response) => {
				console.log(response)
				this.setState({
					sinodalias: [...response.data.sinodalias],
				})
			})
			.catch(error => {
  			console.log(error.message);
			})
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

		compareTeaching(sinodal) {
			let teacher= ''
			// buscando el maestro que corresponde al id
			for(let i = 0; i < this.state.teachers.length; i++){
				if (this.state.teachers[i].id == sinodal) {
					teacher = this.state.teachers[i].name
				}
			}
			return teacher
		}

		linked(id){
			return '/sinodalias/'+id
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
					      <th scope="col">Aprobación Final</th>
					    </tr>
					  </thead>
					  <tbody>
					  	{ this.state.sinodalias.map(sinodalia => (
					  			<tr key={sinodalia.id}>
							      <th scope="row">{sinodalia.residente}</th>
							      <td>{sinodalia.proyecto}</td>
							      <td>{sinodalia.carrera}</td>
							      <td>{sinodalia.num_control}</td>
							      <td>{this.compareTeaching(sinodalia.user_id)}</td>
							      <td>{this.compareTeaching(sinodalia.id_secretario)}</td>
							      <td>{this.compareTeaching(sinodalia.id_vocal)}</td>
							      <td>{this.compareTeaching(sinodalia.id_vocal_sup)}</td>
							      <td><a href={this.linked(sinodalia.id)} className="btn btn-success">
							      			Editar</a>
							      </td>
							    </tr>
					  		)) 
					  }
					  </tbody>
					</table>
					{ this.state.sinodalias.length == 0 &&
						<div style={{ width:800, fontSize:35, marginLeft:300 }}>
			  			<div className="alert alert-danger" role="alert" style={{ marginRight:15 }}>
					  		Aún no has agregado ninguna sinodalía
							</div>
			  		</div>
					}
				</div>
			)
	}
}

export default SinodaliasTable