import React, { Component } from 'react'
import axios from 'axios'

class CreateNewAssigment extends Component {
	constructor (props) {
		super(props)
		this.state = {
			residente: '',
			carrera: '',
			num_control: 0,
			proyecto: '',
			presidente: 0,
			secretario: 0,
			vocal: 0,
			vocalSuplente: 0,
			teachers: [],
		}
		//bindings
		this.handleSubmit = this.handleSubmit.bind(this)
	}

	postTeachersData() {
		axios.post('/teachers')
	}

	handleSubmit(event) {
		event.preventDefault()
	}
	render(){
		return(
				<div className="card">
					<div className="card-header">
						<h2>Asignación de nueva Sinodalía</h2>
					</div>
					<div className="card-body">
						<form onSubmit={this.handleSubmit}>
						<div className="form-group">
							<label for="residente">Nombre del residente</label>
							<input id="residente" type="text" className="form-control"
								onChange={this.handleChange} value={this.state.residente}
								required/>
						</div>
						<div className="form-group">
							<label for="carrera">Carrera</label>
							<input id="carrera" type="text" className="form-control" 
									onChange={this.handleChange} value={this.state.carrera}
							required/>
						</div>
						<div className="form-group">
							<label for="num_control">Num. de Control</label>
							<input id="num_control" type="number" className="form-control" 
											onChange={this.handleChange} value={this.state.num_control}
							required/>
						</div>
						<div className="form-group">
							<label for="proyecto">Nombre del Proyecto</label>
							<input id="proyecto" type="text" className="form-control" 
								onChange={this.handleChange} value={this.state.proyecto}
							required/>
						</div>
						<div className="form-group">
							<label for="presidente">Asignado Presidente(disponibles)</label>
							<select className="form-control" id="presidente" 
											onChange={this.handleChange} value={this.state.presidente}>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label for="secretario">Asignado Secretario(disponibles)</label>
							<select className="form-control" id="secretario"
											onChange={this.handleChange} value={this.state.secretario}>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label for="vocal">Asignado Vocal(disponibles)</label>
							<select className="form-control" id="vocal" 
												onChange={this.handleChange} value={this.state.vocal}>>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label for="vocalSuplente">Asignado Vocal Suplente(disponibles)</label>
							<select className="form-control" id="vocalSuplente"
												onChange={this.handleChange} value={this.state.vocalSuplente}>>
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<input type="submit" value="Crear sinodalía" className="form-control" />
					</form>
					</div>
				</div>
			)
	}
}

export default CreateNewAssigment